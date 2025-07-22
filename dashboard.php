<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Consultorio</title>
  <!-- Se realiza el  Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Se realiza el jQuery CDN -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <!--Se realiza el  Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    body {
      background-color: #f8f9fa;
      padding: 20px;
    }
    .card {
      margin-bottom: 30px;
      border: 1px solid #dee2e6;
    }
    .tab-button {
      cursor: pointer;
      margin-right: 10px;
    }
    .folder-tabs {
      margin-bottom: 20px;
    }
    .folder-tabs span {
      background-color: #708A65;
      color: white;
      padding: 10px 15px;
      border-radius: 8px;
    }
    .folder-tabs span:hover {
      background-color: #B9A86F;
    }
  </style>
</head>
<body>

  <h2 class="text-center mb-4">Dashboard del Consultorio</h2>

  <!-- Se realizo el menú estilo carpetas -->
  <div class="folder-tabs d-flex justify-content-center">
  <a href="inicio.html" class="btn btn-outline-dark tab-button">
    <i class="bi bi-house-door-fill"></i> Inicio
  </a>
    <span class="tab-button" data-tab="citas">📅 Citas</span>
    <span class="tab-button" data-tab="pacientes">👤 Pacientes</span>
    <span class="tab-button" data-tab="medicos">🩺 Médicos</span>
  </div>

  <!-- Se realiza el cards contenedores -->
  <div class="card" id="card-citas" style="display:none;">
    <div class="card-header bg-success text-white">Citas</div>
    <div class="card-body">
      <div class="row mb-3">
        <div class="col">
          <input type="date" class="form-control" id="filtro-fecha" placeholder="Filtrar por fecha">
        </div>
        <div class="col">
          <input type="text" class="form-control" id="filtro-estado" placeholder="Filtrar por estado">
        </div>
        <div class="col">
          <button class="btn btn-success w-100" onclick="cargarDatos('citas')">Buscar</button>
        </div>
      </div>
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Estado</th>
            <th>ID Paciente</th>
            <th>ID Médico</th>
          </tr>
        </thead>
        <tbody id="tabla-citas"></tbody>
      </table>
    </div>
  </div>

  <div class="card" id="card-pacientes" style="display:none;">
    <div class="card-header bg-primary text-white">Pacientes</div>
    <div class="card-body">
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Fecha Nacimiento</th>
            <th>Teléfono</th>
            <th>Correo</th>
          </tr>
        </thead>
        <tbody id="tabla-pacientes"></tbody>
      </table>
    </div>
  </div>

  <div class="card" id="card-medicos" style="display:none;">
    <div class="card-header bg-info text-white">Médicos</div>
    <div class="card-body">
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Especialidad</th>
            <th>Teléfono</th>
            <th>Correo</th>
          </tr>
        </thead>
        <tbody id="tabla-medicos"></tbody>
      </table>
    </div>
  </div>

  <script>
    // Se puede realiza el mostrar cards tipo carpeta
    $('.tab-button').on('click', function () {
      const tab = $(this).data('tab');
      $('.card').hide();
      $('#card-' + tab).show();
      cargarDatos(tab);
    });

    function cargarDatos(tabla) {
      let filtros = {};
      if (tabla === 'citas') {
        filtros.fecha = $('#filtro-fecha').val();
        filtros.estado = $('#filtro-estado').val();
      }

      $.ajax({
        url: 'cargar_datos.php',
        method: 'POST',
        data: { tipo: tabla, ...filtros },
        success: function (response) {
          $('#tabla-' + tabla).html(response);
        }
      });
    }
  </script>

</body>
</html>