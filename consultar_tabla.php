<?php
require_once "connect_dev.php";

header('Content-Type: application/json');

try {
    $pdo = getConnection();
} catch (Exception $e) {
    die(json_encode(["error" => "Error en la conexión a la base de datos: " . $e->getMessage()]));
}

$tabla = $_POST['tabla'] ?? '';

if (empty($tabla)) {
    die(json_encode(["error" => "Debe seleccionar una tabla para la consulta."]));
}

// Se realiza la validación de tablas permitidas
$validTables = ['cita', 'paciente', 'medico', 'usuarios', 'historial_medico'];
if (!in_array($tabla, $validTables)) {
    die(json_encode(["error" => "Tabla no válida."]));
}

try {
    $stmt = $pdo->query("SELECT * FROM $tabla");
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($resultados) {
        echo json_encode($resultados);
    } else {
        echo json_encode(["error" => "No se encontraron registros en la tabla seleccionada."]);
    }
} catch (Exception $e) {
    echo json_encode(["error" => "Error en la consulta SQL: " . $e->getMessage()]);
}
?>
