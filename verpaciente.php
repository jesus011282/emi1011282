<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Vista de Pacientes</title>
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
    <h2 class="mb-4">Pacientes Registrados</h2>
    <table id="pacienteTable" class="display table table-bordered">
      <thead class="thead-dark">
        <tr>
          <th>ID</th><th>Usuario</th><th>Nombre</th><th>Teléfono</th><th>Correo</th><th>Nacimiento</th><th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        include 'connect_dev.php';
        try {
          $stmt = $conn->prepare("SELECT * FROM paciente");
          $stmt->execute();
          foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            echo "<tr>
              <td>{$row['id']}</td>
              <td>{$row['usuario']}</td>
              <td>{$row['nombre']}</td>
              <td>{$row['telefono']}</td>
              <td>{$row['correo']}</td>
              <td>{$row['fecha_nacimiento']}</td>
              <td>
                <button class='btn btn-warning btn-sm mr-1' onclick='abrirModal(" . json_encode($row) . ")'>
                  <i class='fas fa-edit'></i>
                </button>
                <button class='btn btn-danger btn-sm' onclick='eliminarPaciente({$row["id"]})'>
                  <i class='fas fa-trash-alt'></i>
                </button>
              </td>
            </tr>";
          }
        } catch (PDOException $e) {
          echo "<tr><td colspan='7'>Error: " . $e->getMessage() . "</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <!--Se realiza Modal -->
  <div class="modal" id="modalActualizar">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="formActualizar">
          <div class="modal-header">
            <h5 class="modal-title">Actualizar Paciente</h5>
            <button type="button" class="close" onclick="$('#modalActualizar').modal('hide')">&times;</button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="id">
            <div class="form-group"><label>Usuario:</label><input type="text" id="usuario" class="form-control" required></div>
            <div class="form-group"><label>Nombre:</label><input type="text" id="nombre" class="form-control" required></div>
            <div class="form-group"><label>Teléfono:</label><input type="text" id="telefono" class="form-control" required></div>
            <div class="form-group"><label>Correo:</label><input type="email" id="correo" class="form-control" required></div>
            <div class="form-group"><label>Fecha de nacimiento:</label><input type="date" id="fecha_nacimiento" class="form-control" required></div>
          </div>
          <div class="modal-footer">
            <button type="submit" id="btnGuardar" class="btn btn-success">
              <span id="spinnerGuardar" class="spinner-border spinner-border-sm d-none"></span>
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
  $('#pacienteTable').DataTable();
  $("menu").load("menu.php");
});

function abrirModal(data) {
  $('#id').val(data.id);
  $('#usuario').val(data.usuario);
  $('#nombre').val(data.nombre);
  $('#telefono').val(data.telefono);
  $('#correo').val(data.correo);
  $('#fecha_nacimiento').val(data.fecha_nacimiento);
  $('#modalActualizar').modal('show');
}

$('#formActualizar').on('submit', function(e) {
  e.preventDefault();
  $('#spinnerGuardar').removeClass('d-none');
  $('#textGuardar').text('Guardando...');

  const datos = {
    id: $('#id').val(),
    usuario: $('#usuario').val(),
    nombre: $('#nombre').val(),
    telefono: $('#telefono').val(),
    correo: $('#correo').val(),
    fecha_nacimiento: $('#fecha_nacimiento').val()
  };

  $.ajax({
    url: 'actualizar_paciente.php',
    method: 'POST',
    contentType: 'application/json',
    data: JSON.stringify(datos),
    success: () => {
      $('#modalActualizar').modal('hide');
      $('#spinnerGuardar').addClass('d-none');
      $('#textGuardar').text('Guardar');
      Swal.fire({ icon: 'success', title: 'Paciente actualizado', showConfirmButton: false, timer: 1500 }).then(() => location.reload());
    },
    error: () => {
      $('#spinnerGuardar').addClass('d-none');
      $('#textGuardar').text('Guardar');
      Swal.fire({ icon: 'error', title: 'Error', text: 'No se pudo actualizar el paciente.' });
    }
  });
});

function eliminarPaciente(id) {
  Swal.fire({
    title: '¿Eliminar este paciente?',
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
        url: 'actualizar_paciente.php',
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({ eliminar_id: id })
      }).then(() => {
        Swal.fire({ icon: 'success', title: 'Paciente eliminado', showConfirmButton: false, timer: 1500 }).then(() => location.reload());
      }).catch(() => {
        Swal.showValidationMessage('No se pudo eliminar el paciente.');
      });
    },
    allowOutsideClick: () => !Swal.isLoading()
  });
}
</script>
</body>
</html>
