<?php
include 'connect_dev.php';
$data = json_decode(file_get_contents("php://input"));
// Los enviados que se realiza a detalle de los codigos
try {
    if (isset($data->eliminar_id)) {
        // Se realiza la eliminarcion de la  cita
        $stmt = $conn->prepare("DELETE FROM cita WHERE id = ?");
        $stmt->execute([$data->eliminar_id]);
        echo json_encode(["success" => true, "accion" => "eliminado"]);
    } elseif (isset($data->id, $data->fecha, $data->hora)) {
        // Que se realiza al poder actualizar las cita
        $stmt = $conn->prepare("UPDATE cita SET fecha = ?, hora = ? WHERE id = ?");
        $stmt->execute([$data->fecha, $data->hora, $data->id]);
        echo json_encode(["success" => true, "accion" => "actualizado"]);
    } else {
        http_response_code(400);
        echo json_encode(["error" => "Datos incompletos"]);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
} finally {
    //Se realiza el Cierra conexión PDO
    $conn = null;
}
?>