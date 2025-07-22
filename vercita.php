<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Vista de Citas</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<menu></menu> 
  <div class="container mt-4">
    <h2 class="mb-4">Citas Registradas</h2>
    <table id="citaTable" class="display table table-bordered">
      <thead class="thead-dark">
        <tr>
          <th>ID</th><th>Fecha</th><th>Hora</th><th>Paciente</th><th>Médico</th><th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        include 'connect_dev.php';
        try {
          $stmt = $conn->prepare("SELECT cita.id, cita.fecha, cita.hora, paciente.nombre AS paciente, medico.nombre AS medico FROM cita JOIN paciente ON cita.id_paciente = paciente.id JOIN medico ON cita.id_medico = medico.id");
          $stmt->execute();
          foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $cita) {
            echo "<tr>
              <td>{$cita['id']}</td>
              <td>{$cita['fecha']}</td>
              <td>{$cita['hora']}</td>
              <td>{$cita['paciente']}</td>
              <td>{$cita['medico']}</td>
              <td>
                <button class='btn btn-warning btn-sm mr-1' onclick='abrirModal({$cita["id"]}, \"{$cita["fecha"]}\", \"{$cita["hora"]}\", \"{$cita["paciente"]}\", \"{$cita["medico"]}\")'>
                  <i class='fas fa-edit'></i>
                </button>
                <button class='btn btn-danger btn-sm' onclick='eliminarCita({$cita["id"]})'>
                  <i class='fas fa-trash-alt'></i>
                </button>
              </td>
            </tr>";
          }
        } catch (PDOException $e) {
          echo "<tr><td colspan='6'>Error: " . $e->getMessage() . "</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <!-- Se realiza el Modal Actualizar -->
  <div class="modal" id="modalActualizar">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="formActualizar">
          <div class="modal-header">
            <h5 class="modal-title">Actualizar Cita</h5>
            <button type="button" class="close" onclick="$('#modalActualizar').modal('hide')">&times;</button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="id">
            <div class="form-group">
              <label>Paciente:</label>
              <input type="text" id="paciente" class="form-control" readonly>
            </div>
            <div class="form-group">
              <label>Médico:</label>
              <input type="text" id="medico" class="form-control" readonly>
            </div>
            <div class="form-group">
              <label>Fecha:</label>
              <input type="date" id="fecha" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Hora:</label>
              <input type="time" id="hora" class="form-control" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" id="btnGuardar" class="btn btn-success">
              <span id="spinnerGuardar" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
              <span id="textGuardar">Guardar</span>
            </button>
            <button type="button" class="btn btn-secondary" onclick="$('#modalActualizar').modal('hide')">Cancelar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<script>
$(document).ready(() => {
  $('#citaTable').DataTable();
  $("menu").load("menu.php");

});


function abrirModal(id, fecha, hora, paciente, medico) {
  $('#id').val(id);
  $('#fecha').val(fecha);
  $('#hora').val(hora);
  $('#paciente').val(paciente);
  $('#medico').val(medico);
  $('#modalActualizar').modal('show');
}

$('#formActualizar').on('submit', function(e) {
  e.preventDefault();

  $('#spinnerGuardar').removeClass('d-none');
  $('#textGuardar').text('Guardando...');

  const datos = {
    id: $('#id').val(),
    fecha: $('#fecha').val(),
    hora: $('#hora').val()
  };

  $.ajax({
    url: 'actualizar_cita.php',
    method: 'POST',
    contentType: 'application/json',
    data: JSON.stringify(datos),
    success: () => {
      $('#modalActualizar').modal('hide');
      $('#spinnerGuardar').addClass('d-none');
      $('#textGuardar').text('Guardar');

      Swal.fire({
        icon: 'success',
        title: 'Cita actualizada',
        showConfirmButton: false,
        timer: 1500
      }).then(() => location.reload());
    },
    error: () => {
      $('#spinnerGuardar').addClass('d-none');
      $('#textGuardar').text('Guardar');
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'No se pudo actualizar la cita.'
      });
    }
  });
});

function eliminarCita(id) {
  Swal.fire({
    title: '¿Eliminar esta cita?',
    text: 'Esta acción no se puede deshacer',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#6c757d',
    confirmButtonText: 'Sí, eliminar',
    cancelButtonText: 'Cancelar',
    showLoaderOnConfirm: true,
    preConfirm: () => {
      return $.ajax({
        url: 'actualizar_cita.php',
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({ eliminar_id: id })
      }).then(() => {
        Swal.fire({
          icon: 'success',
          title: 'Cita eliminada',
          showConfirmButton: false,
          timer: 1500
        }).then(() => location.reload());
      }).catch(() => {
        Swal.showValidationMessage('No se pudo eliminar la cita.');
      });
    },
    allowOutsideClick: () => !Swal.isLoading()
  });
}
</script>
</body>
</html>
