<?php
require_once "connect_dev.php";
$pdo = getConnection();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Administración</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="container py-4">
  <h1 class="mb-4">Administración de registros</h1>

  <!-- La Navegacion  tabs -->
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="pacientes-tab" data-bs-toggle="tab" data-bs-target="#pacientes" type="button" role="tab">Pacientes</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="medicos-tab" data-bs-toggle="tab" data-bs-target="#medicos" type="button" role="tab">Médicos</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="citas-tab" data-bs-toggle="tab" data-bs-target="#citas" type="button" role="tab">Citas</button>
    </li>
  </ul>

  <!-- Las Tablas  panel -->
  <div class="tab-content mt-3">
    <div class="tab-pane fade show active" id="pacientes" role="tabpanel">
      <table id="tablaPacientes" class="table table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Correo</th>
            <th>Fecha Nacimiento</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $stmt = $pdo->query("SELECT * FROM paciente");
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
          ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <td><?= htmlspecialchars($row['usuario']) ?></td>
              <td><?= htmlspecialchars($row['nombre']) ?></td>
              <td><?= htmlspecialchars($row['telefono']) ?></td>
              <td><?= htmlspecialchars($row['correo']) ?></td>
              <td><?= substr($row['fecha_nacimiento'], 0, 10) ?></td>
              <td>
                <button class="btn btn-warning btn-sm edit-btn" data-id="<?= $row['id'] ?>" data-tipo="paciente">Editar</button>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>

    <div class="tab-pane fade" id="medicos" role="tabpanel">
      <table id="tablaMedicos" class="table table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Especialidad</th>
            <th>Teléfono</th>
            <th>Correo</th>
            <th>Usuario</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $stmt = $pdo->query("SELECT * FROM medico");
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
          ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <td><?= htmlspecialchars($row['nombre']) ?></td>
              <td><?= htmlspecialchars($row['especialidad']) ?></td>
              <td><?= htmlspecialchars($row['telefono']) ?></td>
              <td><?= htmlspecialchars($row['correo']) ?></td>
              <td><?= htmlspecialchars($row['usuario']) ?></td>
              <td>
                <button class="btn btn-warning btn-sm edit-btn" data-id="<?= $row['id'] ?>" data-tipo="medico">Editar</button>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>

    <div class="tab-pane fade" id="citas" role="tabpanel">
      <table id="tablaCitas" class="table table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Estado</th>
            <th>ID Paciente</th>
            <th>ID Médico</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $stmt = $pdo->query("SELECT * FROM cita");
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
          ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <td><?= substr($row['fecha'], 0, 10) ?></td>
              <td><?= $row['hora'] ?></td>
              <td><?= htmlspecialchars($row['estado']) ?></td>
              <td><?= $row['id_paciente'] ?></td>
              <td><?= $row['id_medico'] ?></td>
              <td>
                <button class="btn btn-warning btn-sm edit-btn" data-id="<?= $row['id'] ?>" data-tipo="cita">Editar</button>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- En el Modaledacion  General -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar Registro</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body" id="modalBodyContent">
        <!-- En la cual se realiza a aquí se inyecta contenido dinámico -->
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
  $('#tablaPacientes, #tablaMedicos, #tablaCitas').DataTable();

  // El botón Editar
  $(document).on('click', '.edit-btn', function() {
    var id = $(this).data('id');
    var tipo = $(this).data('tipo');

    var archivo = '';
    if (tipo === 'paciente') {
      archivo = 'modal_paciente.php';
    } else if (tipo === 'medico') {
      archivo = 'modal_medico.php';
    } else if (tipo === 'cita') {
      archivo = 'modal_cita.php';
    }

    $.post(archivo, { id: id }, function(data) {
      $('#modalBodyContent').html(data);
      $('#editModal').modal('show');
    });
  });

  // Se realiza al poder guardar actualización de formulario
  $(document).on('submit', '#formPaciente, #formMedico, #formCita', function(e) {
    e.preventDefault();
    var form = $(this);
    var tipo = form.attr('id').replace('form', '').toLowerCase();
    var archivoUpdate = 'update_' + tipo + '.php';

    $.post(archivoUpdate, form.serialize(), function(response) {
      var res = JSON.parse(response);

      if (res.success) {
        Swal.fire('¡Actualizado!', res.message, 'success').then(() => {
          location.reload(); // Lo que son las Recargas para actualizacion de las tablas
        });
      } else {
        Swal.fire('Error', res.message, 'error');
      }
    });
  });
});
</script>

</body>
</html>
