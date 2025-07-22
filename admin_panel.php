<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Administración de Registros</title>

  <!--Se realiza  Bootstrap 4 -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Se realiza el DataTables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
  <!-- El SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- El JQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Se realiza Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- Los DataTables JS -->
  <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

</head>
<body>

<div class="container mt-5">
  <div class="card">
    <div class="card-header">
      <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="pacientes-tab" data-toggle="tab" href="#pacientes" role="tab">Pacientes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="medicos-tab" data-toggle="tab" href="#medicos" role="tab">Médicos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="citas-tab" data-toggle="tab" href="#citas" role="tab">Citas</a>
        </li>
      </ul>
    </div>

    <div class="card-body">
      <div class="tab-content" id="myTabContent">

        <!-- Se realiza la tabla de Pacientes -->
        <div class="tab-pane fade show active" id="pacientes" role="tabpanel">
          <table id="tablaPacientes" class="display" style="width:100%">
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
          </table>
        </div>

        <!-- Se realiza la tabla de Médicos -->
        <div class="tab-pane fade" id="medicos" role="tabpanel">
          <table id="tablaMedicos" class="display" style="width:100%">
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
          </table>
        </div>

        <!-- Se realiza la tabla de Citas -->
        <div class="tab-pane fade" id="citas" role="tabpanel">
          <table id="tablaCitas" class="display" style="width:100%">
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
          </table>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- Los Modales -->
<?php
include 'modals/modal_paciente.php';
include 'modals/modal_medico.php';
include 'modals/modal_cita.php';
?>

<script src="js/admin.js"></script>

</body>
</html>
