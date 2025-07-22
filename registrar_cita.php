<?php
require_once "connect_dev.php";
$pdo = getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Se realiza el recibir y limpiar las entradas
    $fecha     = $_POST['fecha'] ?? '';     //Lo  Usamos el timestamp tal cual
    $hora      = trim($_POST['hora'] ?? '');
    $estado    = trim($_POST['estado'] ?? '');
    $id_paciente = trim($_POST['id_paciente'] ?? '');
    $id_medico  = trim($_POST['id_medico'] ?? '');

    // Se realiza la validación: asegurar que ningún campo esté vacío
    if (empty($fecha) || empty($hora) || empty($estado) || empty($id_paciente) || empty($id_medico)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    // Se realiza validar que la hora sea un número (debe ser una hora válida)
    if (!is_numeric($hora) || $hora < 0 || $hora > 23) {
        echo "La hora debe ser un valor numérico entre 0 y 23.";
        exit;
    }

    // Se realiza el validar que el estado sea uno de los valores posibles (por ejemplo "pendiente", "confirmada", "cancelada")
    $estadosValidos = ["pendiente", "confirmada", "cancelada"];
    if (!in_array(strtolower($estado), $estadosValidos)) {
        echo "El estado debe ser 'pendiente', 'confirmada' o 'cancelada'.";
        exit;
    }

    try {
        // Se realiza el Insertar datos en la tabla 'citas'
        $sql = "INSERT INTO cita (fecha, hora, estado, id_paciente, id_medico) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$fecha, $hora, $estado, $id_paciente, $id_medico]);

        echo "Cita registrada correctamente.";
    } catch (PDOException $e) {
        echo "Error al registrar: " . $e->getMessage();
    }
}
?>
