<?php
include 'connect_dev.php';
$data = json_decode(file_get_contents("php://input"));
// Eliminar el usuario 
try {
    if (isset($data->eliminar_id)) {
        $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
        $stmt->execute([$data->eliminar_id]);
        echo json_encode(["success" => true, "accion" => "eliminado"]);
        //Las actualizar los usarios 
    } elseif (
        isset($data->id, $data->usuario, $data->pass, $data->id_logic, $data->Tipo, $data->Perfil)
    ) {
        $stmt = $conn->prepare("UPDATE usuarios SET usuario = ?, pass = ?, id_logic = ?, Tipo = ?, Perfil = ? WHERE id = ?");
        $stmt->execute([
            $data->usuario,
            $data->pass,
            $data->id_logic,
            $data->Tipo,
            $data->Perfil,
            $data->id
        ]);
        echo json_encode(["success" => true, "accion" => "actualizado"])
        // Los faltantes de los datos
    } else {
        http_response_code(400);
        echo json_encode(["error" => "Datos incompletos"]);
    }
    // Los manejos de las excepciones de los cierres de las conexiones  
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
} finally {
    $conn = null;
}
?>
