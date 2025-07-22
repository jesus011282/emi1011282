<!-- El medico.php -->
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro de Médico</title>

  <!-- Se realiza el Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
      background-image: url('2.jpg');
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
  <img src="bueno.jpg" alt="Logo Torres Médicas" width="50" height="50">
  <h3 class="m-0">Torres Médicas</h3>
</header>

<div class="container">
  <div class="form-container mx-auto">
    <h2 class="text-center mb-4">Registro de Médico</h2>
    <form id="formMedico">
      <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" required>
      </div>

      <div class="form-group">
        <label for="hora">Especialidades:</label>
        <select class="form-control form-control-sm" id="especialidad" name="especialidad" required>
          <option value="Cardiólogo">Cardiólogo</option>
          <option value="Ginecología">Ginecología</option>
          <option value="Médico general">Médico general</option>
          <option value="Colposcopía">Colposcopía</option>
          <option value="Ultrasonido pélvico y revisión de mamas">Ultrasonido pélvico y revisión de mamas</option>
          <option value="Papiloma Humano (VPH)">Papiloma Humano (VPH)</option>
        </select>
      </div>

      <div class="form-group">
        <label for="telefono">Teléfono:</label>
        <input type="tel" class="form-control form-control-sm" id="telefono" name="telefono" placeholder="10 dígitos" required>
      </div>

      <div class="form-group">
        <label for="correo">Correo:</label>
        <input type="email" class="form-control form-control-sm" id="correo" name="correo" required>
        <small class="error" id="errorCorreo"></small>
      </div>

      <div class="form-group">
        <label for="usuario">Usuario:</label>
        <input type="text" class="form-control form-control-sm" id="usuario" name="usuario" required>
      </div>

      <div class="form-group">
        <label for="password">Contraseña:</label>
        <input type="password" class="form-control form-control-sm" id="password" name="password" minlength="8" maxlength="20" required>
      </div>

      <button type="submit" class="btn btn-primary btn-sm btn-block">Registrar Médico</button>
    </form>
  </div>
</div>

<script>
  $(document).ready(function () {
    $("#formMedico").submit(function (e) {
      e.preventDefault();

      var nombre = $("#nombre").val().trim();
      var especialidad = $("#especialidad").val().trim();
      var telefono = $("#telefono").val().trim();
      var correo = $("#correo").val().trim();
      var usuario = $("#usuario").val().trim();
      var password = $("#password").val().trim();

      if (!nombre || !especialidad || !telefono || !correo || !usuario || !password) {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Todos los campos son obligatorios.'
        });
        return;
      }

      var telefonoRegex = /^\d{10}$/;
      if (!telefonoRegex.test(telefono)) {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'El teléfono debe ser numérico de 10 dígitos.'
        });
        return;
      }

      var formData = {
        nombre: nombre,
        especialidad: especialidad,
        telefono: telefono,
        correo: correo,
        usuario: usuario,
        password: password
      };

      $.ajax({
        url: "registro_medico.php",
        type: "POST",
        data: formData,
        success: function (respuesta) {
          Swal.fire({
            icon: 'success',
            title: 'Médico registrado correctamente',
            text: 'Redirigiendo a inicio...',
            timer: 3000,
            showConfirmButton: false
          });
        },
        error: function () {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo un problema al registrar al médico.'
          });
        }
      });
    });
  });
</script>
</body>
</html>
