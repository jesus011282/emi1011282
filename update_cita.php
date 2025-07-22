<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Cita</title>
  
  <!-- Se realiza el Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    .form-container {
      margin-top: 50px;
      margin-bottom: 50px;
      max-width: 500px;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 10px;
      background: #f9f9f9;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="form-container mx-auto">
      <h2 class="text-center mb-4">Registrar Cita</h2>
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
            <option value="21">9 PM</option>
            <option value="22">10 PM</option>
            <option value="23">11 PM</option>
            <option value="24">12 AM</option>
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
          <label for="id_paciente">ID del Paciente:</label>
          <input type="number" class="form-control" id="id_paciente" name="id_paciente" required>
        </div>
        <div class="form-group">
          <label for="id_medico">ID del Médico:</label>
          <input type="number" class="form-control" id="id_medico" name="id_medico" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Registrar Cita</button>
      </form>
    </div>
  </div>

  <script>
    $(document).ready(function () {
      // Se realiza el manejo del envío del formulario
      $("#formCita").submit(function (e) {
        e.preventDefault(); // Evita el envío normal del formulario

        //Para poder  obtener los valores
        var formData = {
          fecha: $("#fecha").val(),
          hora: $("#hora").val(),
          estado: $("#estado").val(),
          id_paciente: $("#id_paciente").val(),
          id_medico: $("#id_medico").val()
        };

        // Para poder enviar los datos al servidor usando AJAX
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
            // Para poder realizar y limpiar el formulario si la cita se registró correctamente
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
