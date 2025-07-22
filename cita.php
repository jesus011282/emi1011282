<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Cita</title>
  
  <!-- Lo que es Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <!-- Se realiza la fuente de impresion  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Los codigos de JavaScrip (JQuery) en la cual es la carga de la pàgina
   como son los codigos de CSS de estilos del formulario-->
  <script>
      $(document).ready(function () {
              $("menu").load("menu.php");
          });
    </script>
  <style>
    header {
  background-color: rgba(255, 255, 255, 0.85); /* fondo blanco con transparencia */
  padding: 10px 20px;
  border-radius: 12px;
  max-width: 400px;
  margin: 30px auto 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

header h3 {
  font-size: 1.8rem;
  font-weight: bold;
  color: #333;
  margin-left: 10px;
}

header img {
  border-radius: 50%;
  border: 2px solid #2c3e50;
}
     body {
    background-image: url('6.jpg'); /* Cambia 'fondo.jpg' por tu imagen */
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    background-attachment: fixed;
     min-height: 100vh;
     display: flex;
    flex-direction: column;
  }

    .form-container {
      margin-top: 40px;
      max-width: 500px;
      padding: 50px;
      border: 1px solid #ccc;
      border-radius: 10px;
      background-color: rgba(255, 255, 255, 0.95); /* Blanco con transparencia */
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
    }
    .error {
      color: red;
      font-size: 0.9em;
    }
  </style>
</head>
<body>
<menu></menu>
 <!--El formulario de los registro de cita mèdica permite lo que es el registrar en la cita medica
  donde selecciones lo que es la fecha, hora, estado de la cita medica, ID del paciente y medico
  en la cual se registra cita, modifica y elimina en los botones de registros
  AJAX en realizar el envio de los datos en los formularios en realizar la captura de los datos formularios en el servidores, en los registros en alerta 
  SweetAlert2-->
  <header class="text-center my-4 d-flex justify-content-center align-items-center gap-3">
  <img src="bueno.jpg" alt="Logo Torres Médicas" width="50" height="50">
  <h3 class="m-0">Torres Médicas</h3>
</header>
    
    <nav class="navbar"></nav>
  </header>
  <div class="container">
    <div class="form-container mx-auto">
      <h2 class="text-center mb-4">Registrar Cita <?php /*echo $rolUsuario*/  var_dump ($_SESSION)?></h2>

      <form id="formCita" method="POST" action="registrar_cita.php">
        <div class="form-group">
          <label for="fecha">Fecha:</label>
          <input type="date" class="form-control" id="fecha" name="fecha" required>
        </div>
        <div class="form-group">
          <label for="hora">Hora:</label>
          <select class="form-control" id="hora" name="hora" required>
            <option value="8">8 AM</option>
            <option value="9">9 AM</option>
            <option value="10">10 AM</option>
            <option value="11">11 AM</option>
            <option value="12">12 PM</option>
            <option value="13">1 PM</option>
            <option value="14">2 PM</option>
            <option value="15">3 PM</option>
            <option value="16">4 PM</option>
            <option value="17">5 PM</option>
            <option value="18">6 PM</option>
            <option value="19">7 PM</option>
            <option value="20">8 PM</option>
            
            
          </select>
        </div>
        <div class="form-group">
          <label for="estado">Estado:</label>
          <select class="form-control" id="estado" name="estado" required>
            <option value="pendiente">Pendiente</option>
            <option value="confirmada">Confirmada</option>
            <option value="cancelada">Cancelada</option>
          </select>
        </div>
        <div class="form-group">
          <label for="paciente">Paciente:</label>
          <!--<input type="number" class="form-control" id="id_paciente" name="id_paciente" required>-->
          <div id="grupo_paciente"></div>

        </div>

        <div class="form-group">
          <label for="medico">Médico:</label>
          <!--<input type="number" class="form-control" id="id_medico" name="id_medico" required>-->
          <div id="grupo_medico"></div>
        </div>
       <button type="submit" class="btn btn-primary btn-block">Registrar Cita</button>
       
        
      </form>
    </div>
  </div>

  <script>
    $(document).ready(function () {
      // Manejo del envío del formulario
      $("#formCita").submit(function (e) {
        e.preventDefault(); // Evita el envío normal del formulario

        // Obtener los valores
        var formData = {
          fecha: $("#fecha").val(),
          hora: $("#hora").val(),
          estado: $("#estado").val(),
          id_paciente: $("#id_paciente").val(),
          id_medico: $("#id_medico").val()
        };

        // Enviar los datos al servidor usando AJAX
        $.ajax({
          url: "registrar_cita.php",
          type: "POST",
          data: formData,
          success: function (respuesta) {
            Swal.fire({
              icon: 'success',
              title: 'Éxito',
              text: respuesta
            });
            // Limpiar el formulario si la cita se registró correctamente
            $("#formCita")[0].reset();
          },
          error: function () {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Hubo un problema al registrar la cita.'
            });
          }
        });
      });

      // Llamar al archivo PHP que obtiene los datos
  $.ajax({
    url: 'obtener_listados.php',
    type: 'GET',
    dataType: 'json',
    success: function (data) {
      // Campo de paciente
      if (data.pacienteActual) {
        // Si es paciente
        $('#grupo_paciente').html(`
          <div class="form-group">
            <label for="id_paciente">Paciente:</label>
            <input type="text" class="form-control" value="${data.pacienteActual.nombre}" disabled>
            <input type="hidden" name="id_paciente" id="id_paciente" value="${data.pacienteActual.id}">
          </div>
        `);
      } else {
        // Si es médico (mostrar lista de pacientes)
        let pacienteOptions = '<option value="">Seleccione un paciente</option>';
        data.pacientes.forEach(p => {
          pacienteOptions += `<option value="${p.id}">${p.nombre}</option>`;
        });
        $('#grupo_paciente').html(`
          <div class="form-group">
            <label for="id_paciente">Paciente:</label>
            <select class="form-control" name="id_paciente" id="id_paciente" required>
              ${pacienteOptions}
            </select>
          </div>
        `);
      }

      // Campo de médicos (para todos)
      let medicoOptions = '<option value="">Seleccione un médico</option>';
      data.medicos.forEach(m => {
        medicoOptions += `<option value="${m.id}">${m.nombre}</option>`;
      });
      $('#grupo_medico').html(`
        <div class="form-group">
          <label for="id_medico">Médico:</label>
          <select class="form-control" name="id_medico" id="id_medico" required>
            ${medicoOptions}
          </select>
        </div>
      `);
    },
    error: function (xhr, status, error) {
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'No se pudieron cargar los datos de pacientes y médicos.'
      });
    }
  });

  // Envío del formulario
  $("#formCita").submit(function (e) {
    e.preventDefault();

    var formData = {
      fecha: $("#fecha").val(),
      hora: $("#hora").val(),
      estado: $("#estado").val(),
      id_paciente: $("#id_paciente").val(),
      id_medico: $("#id_medico").val()
    };

    $.ajax({
      url: "registrar_cita.php",
      type: "POST",
      data: formData,
      success: function (respuesta) {
        Swal.fire({
          icon: 'success',
          title: 'Éxito',
          text: respuesta
        });
        $("#formCita")[0].reset();
      },
      error: function () {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Hubo un problema al registrar la cita.'
        });
      }
    });
  });// Llamar al archivo PHP que obtiene los datos
  $.ajax({
    url: 'obtener_listados.php',
    type: 'GET',
    dataType: 'json',
    success: function (data) {
      // Campo de paciente
      if (data.pacienteActual) {
        // Si es paciente
        $('#grupo_paciente').html(`
          <div class="form-group">
            <label for="id_paciente">Paciente:</label>
            <input type="text" class="form-control" value="${data.pacienteActual.nombre}" disabled>
            <input type="hidden" name="id_paciente" id="id_paciente" value="${data.pacienteActual.id}">
          </div>
        `);
      } else {
        // Si es médico (mostrar lista de pacientes)
        let pacienteOptions = '<option value="">Seleccione un paciente</option>';
        data.pacientes.forEach(p => {
          pacienteOptions += `<option value="${p.id}">${p.nombre}</option>`;
        });
        $('#grupo_paciente').html(`
          <div class="form-group">
            <label for="id_paciente">Paciente:</label>
            <select class="form-control" name="id_paciente" id="id_paciente" required>
              ${pacienteOptions}
            </select>
          </div>
        `);
      }

      // Campo de médicos (para todos)
      let medicoOptions = '<option value="">Seleccione un médico</option>';
      data.medicos.forEach(m => {
        medicoOptions += `<option value="${m.id}">${m.nombre}</option>`;
      });
      $('#grupo_medico').html(`
        <div class="form-group">
          <label for="id_medico">Médico:</label>
          <select class="form-control" name="id_medico" id="id_medico" required>
            ${medicoOptions}
          </select>
        </div>
      `);
    },
    error: function (xhr, status, error) {
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'No se pudieron cargar los datos de pacientes y médicos.'
      });
    }
  });

  // Envío del formulario
  $("#formCita").submit(function (e) {
    e.preventDefault();

    var formData = {
      fecha: $("#fecha").val(),
      hora: $("#hora").val(),
      estado: $("#estado").val(),
      id_paciente: $("#id_paciente").val(),
      id_medico: $("#id_medico").val()
    };

    $.ajax({
      url: "registrar_cita.php",
      type: "POST",
      data: formData,
      success: function (respuesta) {
        Swal.fire({
          icon: 'success',
          title: 'Éxito',
          text: respuesta
        });
        $("#formCita")[0].reset();
      },
      error: function () {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Hubo un problema al registrar la cita.'
        });
      }
    });
  });// Llamar al archivo PHP que obtiene los datos
  $.ajax({
    url: 'obtener_listados.php',
    type: 'GET',
    dataType: 'json',
    success: function (data) {
      // Campo de paciente
      if (data.pacienteActual) {
        // Si es paciente
        $('#grupo_paciente').html(`
          <div class="form-group">
            <label for="id_paciente">Paciente:</label>
            <input type="text" class="form-control" value="${data.pacienteActual.nombre}" disabled>
            <input type="hidden" name="id_paciente" id="id_paciente" value="${data.pacienteActual.id}">
          </div>
        `);
      } else {
        // Si es médico (mostrar lista de pacientes)
        let pacienteOptions = '<option value="">Seleccione un paciente</option>';
        data.pacientes.forEach(p => {
          pacienteOptions += `<option value="${p.id}">${p.nombre}</option>`;
        });
        $('#grupo_paciente').html(`
          <div class="form-group">
            <label for="id_paciente">Paciente:</label>
            <select class="form-control" name="id_paciente" id="id_paciente" required>
              ${pacienteOptions}
            </select>
          </div>
        `);
      }

      // Campo de médicos (para todos)
      let medicoOptions = '<option value="">Seleccione un médico</option>';
      data.medicos.forEach(m => {
        medicoOptions += `<option value="${m.id}">${m.nombre}</option>`;
      });
      $('#grupo_medico').html(`
        <div class="form-group">
          <label for="id_medico">Médico:</label>
          <select class="form-control" name="id_medico" id="id_medico" required>
            ${medicoOptions}
          </select>
        </div>
      `);
    },
    error: function (xhr, status, error) {
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'No se pudieron cargar los datos de pacientes y médicos.'
      });
    }
  });

  // Envío del formulario
  $("#formCita").submit(function (e) {
    e.preventDefault();

    var formData = {
      fecha: $("#fecha").val(),
      hora: $("#hora").val(),
      estado: $("#estado").val(),
      id_paciente: $("#id_paciente").val(),
      id_medico: $("#id_medico").val()
    };

    $.ajax({
      url: "registrar_cita.php",
      type: "POST",
      data: formData,
      success: function (respuesta) {
        Swal.fire({
          icon: 'success',
          title: 'Éxito',
          text: respuesta
        });
        $("#formCita")[0].reset();
      },
      error: function () {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Hubo un problema al registrar la cita.'
        });
      }
    });
  });
    });
  </script>
</body>
</html>
