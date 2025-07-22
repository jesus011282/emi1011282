<?php
//Se realiza la conexion de las estructura de la base de datos 
require_once "connect_dev.php";
$conn = getConnection();

//Los $rolUsuario = $_SESSION['rol'];
//Los $idUsuario = $_SESSION['id_usuario'];

$response = [
    'pacientes' => [],
    'medicos' => [],
    'pacienteActual' => null
];

try {
    // Lo que hace es realizar para poder obtener los listado que es paciente
    if ($rolUsuario != 'paciente') {
        $stmt = $conn->query("SELECT id, nombre FROM pacientes");
        $response['pacientes'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        // Si es paciente, obtener su información
        $stmt = $conn->prepare("SELECT id, nombre FROM pacientes WHERE id = ?");
        $stmt->execute([$idUsuario]);
        $response['pacienteActual'] = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Para obtener los listado de médicos (para todos los roles)
    $stmt = $conn->query("SELECT id, nombre FROM medicos");
    $response['medicos'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // El Devolver JSON
    header('Content-Type: application/json');
    echo json_encode($response);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Error en la consulta: ' . $e->getMessage()]);
}
