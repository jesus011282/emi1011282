<?php
include 'connect_dev.php';
$data = json_decode(file_get_contents("php://input"));
// Lo que son las conexiones y las lecturas de los datos 

try {
    // Como se realiza la eliminacion del medico
    if (isset($data->eliminar_id)) {
        $stmt = $conn->prepare("DELETE FROM medico WHERE id = ?");
        $stmt->execute([$data->eliminar_id]);
        echo json_encode(["success" => true, "accion" => "eliminado"]);
    } elseif (isset($data->id)) {
        // Las actualizacion de los medicos 
        $stmt = $conn->prepare("UPDATE medico SET nombre = ?, especialidad = ?, telefono = ?, correo = ?, usuario = ? WHERE id = ?");
        $stmt->execute([
            $data->nombre, $data->especialidad, $data->telefono,
            $data->correo, $data->usuario, $data->id
        ]);
        echo json_encode(["success" => true, "accion" => "actualizado"]);
    } else {
        // Los manejos de los errores 
        http_response_code(400);
        echo json_encode(["error" => "Datos incompletos"]);
    }
    // Las captura de los errores y el cierre
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
} finally {
    $conn = null;
}
?>
