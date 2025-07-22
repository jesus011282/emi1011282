<?php
require_once "connect_dev.php";
$pdo = getConnection();

$stmt = $pdo->query("SELECT * FROM cita");
$data = [];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  $row['acciones'] = '<button class="btn btn-primary btn-sm edit-btn" data-id="'.$row['idPrimaria'].'" data-tipo="cita">Editar</button>';
  $data[] = $row;
}

echo json_encode(['data' => $data]);
?>
<!-- Se realiza para los codigos completos