<?php
require_once "connect_dev.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Explorador de Tablas</title>
    <!-- Se realiza el Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Se realiza el jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Se realiza el Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .container {
            margin-top: 30px;
            text-align: center;
        }
        .table-container {
            margin-top: 20px;
        }
    </style>

    <script>
        $(document).ready(function () {
            $("#btnConsultar").click(function () {
                let tablaSeleccionada = $("#tablaSelect").val();
                if (tablaSeleccionada) {
                    consultarTabla(tablaSeleccionada);
                } else {
                    alert("Por favor, seleccione una tabla.");
                }
            });
        });

        function consultarTabla(tabla) {
            $.ajax({
                url: 'consultar_tabla.php',
                method: 'POST',
                data: { tabla: tabla },
                dataType: 'json',
                success: function (response) {
                    actualizarTabla(response);
                },
                error: function () {
                    $('#tabla-datos').html("<tr><td colspan='5' class='text-danger text-center'>Error al cargar los datos.</td></tr>");
                }
            });
        }

        function actualizarTabla(datos) {
            let html = "";
            if (datos.error) {
                html = `<tr><td colspan='5' class='text-danger text-center'>${datos.error}</td></tr>`;
            } else {
                datos.forEach(row => {
                    html += "<tr>";
                    for (const key in row) {
                        html += `<td>${row[key]}</td>`;
                    }
                    html += "</tr>";
                });
            }
            $('#tabla-datos').html(html);
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Explorador de Tablas</h2>

        <!-- Las selección de tabla -->
        <div class="input-group w-50 mx-auto">
            <select class="form-select" id="tablaSelect">
                <option value="">Seleccione una tabla</option>
                <option value="cita">Citas</option>
                <option value="paciente">Pacientes</option>
                <option value="medico">Médicos</option>
                <option value="usuarios">Usuarios</option>
                <option value="historial_medico">Historial Médico</option>
            </select>
            <button class="btn btn-primary" id="btnConsultar">Consultar</button>
        </div>

        <!-- La tabla para mostrar resultados -->
        <div class="table-container">
            <table class="table table-striped table-bordered text-center">
                <thead class="table-dark">
                    <tr id="tabla-header"></tr>
                </thead>
                <tbody id="tabla-datos"></tbody>
            </table>
        </div>
    </div>
</body>
</html>