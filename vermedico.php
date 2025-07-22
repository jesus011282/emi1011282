<?php
// Se realiza el vermedico.php
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Vista de Médicos</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <style>
    .container { display: flex; }
    .datatable-container { width: 80%; }
    .card-container { width: 20%; padding: 10px; }
  </style>
</head>
<body>
<menu></menu>
<div class="container">
  <div class="datatable-container">
    <table id="citaTable" class="display table table-bordered">
      <thead class="thead-dark">
        <tr>
          <th>ID</th><th>Nombre</th><th>Especialidad</th><th>Teléfono</th><th>Correo</th><th>Usuario</th><th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        include 'connect_dev.php';
        try {
          $stmt = $conn->prepare("SELECT * FROM medico");
          $stmt->execute();
          foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            echo "<tr>
              <td>{$row['id']}</td>
              <td>{$row['nombre']}</td>
              <td>{$row['especialidad']}</td>
              <td>{$row['telefono']}</td>
              <td>{$row['correo']}</td>
              <td>{$row['usuario']}</td>
              <td>
                <button class='btn btn-warning btn-sm mr-1' onclick='abrirModal({$row["id"]}, \"{$row["nombre"]}\", \"{$row["especialidad"]}\", \"{$row["telefono"]}\", \"{$row["correo"]}\", \"{$row["usuario"]}\")'>
                  <i class='fas fa-edit'></i>
                </button>
                <button class='btn btn-danger btn-sm' onclick='eliminarMedico({$row["id"]})'>
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
  <div class="card-container">
    <div class="card">
      <div class="card-header text-center bg-success text-white">Número de Médicos</div>
      <div class="card-body text-center">
        <?php
        try {
          $stmt = $conn->prepare("SELECT COUNT(*) AS num_citas FROM medico");
          $stmt->execute();
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          echo "<p class='mb-2 h6'>Registrados:</p>";
          echo "<h2 class='card-title text-primary font-weight-bold'>{$row['num_citas']}</h2>";
        } catch (PDOException $e) {
          echo "<p>Error: " . $e->getMessage() . "</p>";
        }
        ?>
      </div>
    </div>
  </div>
</div>

<!-- Se visualiza el Modal Actualizar -->
<div class="modal" id="modalActualizarMedico">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formActualizarMedico">
        <div class="modal-header">
          <h5 class="modal-title">Actualizar Médico</h5>
          <button type="button" class="close" onclick="$('#modalActualizarMedico').modal('hide')">&times;</button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="id_medico">
          <div class="form-group"><label>Nombre:</label><input type="text" id="nombre_medico" class="form-control"></div>
          <div class="form-group"><label>Especialidad:</label><input type="text" id="especialidad_medico" class="form-control"></div>
          <div class="form-group"><label>Teléfono:</label><input type="text" id="telefono_medico" class="form-control"></div>
          <div class="form-group"><label>Correo:</label><input type="email" id="correo_medico" class="form-control"></div>
          <div class="form-group"><label>Usuario:</label><input type="text" id="usuario_medico" class="form-control"></div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Guardar</button>
          <button type="button" class="btn btn-secondary" onclick="$('#modalActualizarMedico').modal('hide')">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
$(document).ready(() => {
  $('#citaTable').DataTable();
  $('menu').load('menu.php');
});

function abrirModal(id, nombre, especialidad, telefono, correo, usuario) {
  $('#id_medico').val(id);
  $('#nombre_medico').val(nombre);
  $('#especialidad_medico').val(especialidad);
  $('#telefono_medico').val(telefono);
  $('#correo_medico').val(correo);
  $('#usuario_medico').val(usuario);
  $('#modalActualizarMedico').modal('show');
}

$('#formActualizarMedico').submit(function(e) {
  e.preventDefault();
  const datos = {
    id: $('#id_medico').val(),
    nombre: $('#nombre_medico').val(),
    especialidad: $('#especialidad_medico').val(),
    telefono: $('#telefono_medico').val(),
    correo: $('#correo_medico').val(),
    usuario: $('#usuario_medico').val()
  };

  $.ajax({
    url: 'actualizar_medico.php',
    type: 'POST',
    contentType: 'application/json',
    data: JSON.stringify(datos),
    success: function() {
      Swal.fire('Éxito', 'Médico actualizado', 'success').then(() => location.reload());
    },
    error: function() {
      Swal.fire('Error', 'No se pudo actualizar', 'error');
    }
  });
});

function eliminarMedico(id) {
  Swal.fire({
    title: '¿Eliminar médico?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Sí, eliminar',
    cancelButtonText: 'Cancelar',
    preConfirm: () => {
      return $.ajax({
        url: 'actualizar_medico.php',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({ eliminar_id: id })
      }).then(() => {
        Swal.fire('Eliminado', 'Médico eliminado correctamente', 'success').then(() => location.reload());
      }).catch(() => {
        Swal.fire('Error', 'No se pudo eliminar', 'error');
      });
    }
  });
}
</script>
</body>
</html>
