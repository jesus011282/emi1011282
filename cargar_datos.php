<?php
require_once "connect_dev.php";

header('Content-Type: application/json');

try {
    $pdo = getConnection();
    $db = Database::getInstance();
} catch (Exception $e) {
    echo json_encode(["error" => "Error en la conexión a la base de datos: " . $e->getMessage()]);
    exit;
}

// Se realiza la capturar los parámetros enviados por POST
$tipo = $_POST['tipo'] ?? '';
$fecha = $_POST['fecha'] ?? null;
$estado = $_POST['estado'] ?? null;
$nombrePaciente = $_POST['nombrePaciente'] ?? null;

try {
    if ($tipo === 'citas') {
        $sql = "SELECT c.fecha, c.hora, c.estado, c.id_paciente, c.id_medico 
                FROM cita c 
                INNER JOIN paciente p ON c.id_paciente = p.id 
                WHERE 1=1";
        
        $params = [];

        // Se puede filtrar por fecha si está presente
        if (!empty($fecha)) {
            $sql .= " AND c.fecha_cita = ?";
            $params[] = $fecha;
        }

        // Se puede filtrar por estado si está presente
        if (!empty($estado)) {
            $sql .= " AND c.estado = ?";
            $params[] = $estado;
        }

        // Se puede filtrar por nombre del paciente si está presente
        if (!empty($nombrePaciente)) {
            $sql .= " AND p.nombre LIKE ?";
            $params[] = "%$nombrePaciente%";
        }

        $resultados = $db->query($sql, $params);
    } else {
        $validTables = ['paciente', 'medico'];
        if (!in_array($tipo, $validTables)) {
            throw new Exception("Tipo de tabla no válido: $tipo");
        }
        $resultados = $db->query("SELECT * FROM $tipo");
    }

    // Se realiza al verificar si hay resultados y enviarlos en formato JSON
    echo json_encode($resultados ?: ["error" => "No se encontraron resultados para la consulta."]);
    
} catch (Exception $e) {
    echo json_encode(["error" => "Error en la consulta SQL: " . $e->getMessage()]);
}
?>
