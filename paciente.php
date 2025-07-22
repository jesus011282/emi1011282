<!-- Sirve para el paciente.php -->
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro de Paciente</title>

  <!-- Se realiza el Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  
  <!-- Se realiza el jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  
  <!-- Se realiza el jQuery Validate -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
  
  <!-- Se realiza el SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <!-- Se realiza la fuente de impresion -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  
  <style>
    header {
      background-color: rgba(255, 255, 255, 0.85);
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
      background-image: url('3.jpg');
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
      background-color: rgba(255, 255, 255, 0.95);
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
    }

    .error {
      color: red;
      font-size: 0.9em;
    }
  </style>
</head>

<body>
  <?php require_once "menu.php";  ?>
  <menu></menu>
  <header class="text-center my-4 d-flex justify-content-center align-items-center gap-3">
    <img src="bueno.jpg" alt="Logo Torres Médicas" width="40" height="40">
    <h3 class="m-0">Torres Médicas</h3>
  </header>

  <div class="container">
    <div class="form-container mx-auto">
      <h2 class="text-center mb-4">Registro de Paciente</h2>
      <form id="formPaciente">
        <div class="form-group">
          <label for="usuario">Usuario:</label>
          <input type="text" class="form-control form-control-sm" id="usuario" name="usuario" required>
          <small class="error" id="errorUsuario"></small>
        </div>

        <div class="form-group">
          <label for="password">Contraseña:</label>
          <input type="password" class="form-control form-control-sm" id="password" name="password" minlength="8" maxlength="20" required>
          <small class="error" id="errorPassword"></small>
        </div>

        <div class="form-group">
          <label for="nombre">Nombre:</label>
          <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" required>
          <small class="error" id="errorNombre"></small>
        </div>

        <div class="form-group">
          <label for="telefono">Teléfono:</label>
          <input type="tel" class="form-control form-control-sm" id="telefono" name="telefono" maxlength="10" required>
          <small class="error" id="errorTelefono"></small>
        </div>

        <div class="form-group">
          <label for="correo">Correo:</label>
          <input type="email" class="form-control form-control-sm" id="correo" name="correo" required>
          <small class="error" id="errorCorreo"></small>
        </div>

        <div class="form-group">
          <label for="fecha_nacimiento">Fecha de nacimiento:</label>
          <input type="date" class="form-control form-control-sm" id="fecha_nacimiento" name="fecha_nacimiento" required>
          <small class="error" id="errorFecha"></small>
        </div>

        <button type="submit" class="btn btn-primary btn-sm btn-block">Registrar Paciente</button>
      </form>
    </div>
  </div>

  <script>
    $(document).ready(function () {
      $("#nombre").on("input", function () {
        const regex = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]*$/;
        const valor = $(this).val();
        if (!regex.test(valor)) {
          $(this).val(valor.slice(0, -1));
          $("#errorNombre").text("Solo se permiten letras y espacios.");
        } else {
          $("#errorNombre").text("");
        }
      });

      $("#telefono").on("input", function () {
        const valor = $(this).val();
        if (!/^\d*$/.test(valor)) {
          $(this).val(valor.replace(/\D/g, ""));
          $("#errorTelefono").text("Solo se permiten números.");
        } else {
          $("#errorTelefono").text("");
        }
      });

      $("#fecha_nacimiento").on("blur", function () {
        const fecha = new Date($(this).val());
        const minFecha = new Date("1970-01-01");
        const maxFecha = new Date("2010-12-31");

        if (fecha < minFecha || fecha > maxFecha) {
          $(this).val("");
          $("#errorFecha").text("La fecha debe estar entre 1970 y 2010.");
        } else {
          $("#errorFecha").text("");
        }
      });

      $("#formPaciente").submit(function (e) {
        e.preventDefault();

        if ($("#nombre").val().trim() === "" || $("#telefono").val().trim() === "" || $("#fecha_nacimiento").val().trim() === "" || $("#password").val().trim() === "") {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Por favor, completa todos los campos correctamente.'
          });
          return;
        }

        var formData = {
          usuario: $("#usuario").val().trim(),
          password: $("#password").val().trim(),
          nombre: $("#nombre").val().trim(),
          telefono: $("#telefono").val().trim(),
          correo: $("#correo").val().trim(),
          fecha_nacimiento: $("#fecha_nacimiento").val().trim()
        };

        $.ajax({
          url: "registrar_paciente.php",
          type: "POST",
          data: formData,
          success: function () {
            Swal.fire({
              icon: 'success',
              title: 'Paciente registrado correctamente',
              timer: 3000,
              showConfirmButton: false
            });
          },
          error: function () {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Hubo un problema al registrar al paciente.'
            });
          }
        });
      });
    });
  </script>
</body>
</html>
