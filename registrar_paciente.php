<?php
require_once "connect_dev.php";
$pdo = getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario          = trim($_POST['usuario'] ?? '');
    $password         = trim($_POST['password'] ?? '');
    $nombre           = trim($_POST['nombre'] ?? '');
    $telefono         = trim($_POST['telefono'] ?? '');
    $correo           = trim($_POST['correo'] ?? '');
    $fecha_nacimiento = $_POST['fecha_nacimiento'];

    if (
        empty($usuario) || empty($password) || empty($nombre) ||
        empty($telefono) || empty($correo) || empty($fecha_nacimiento)
    ) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    try {
        //se realiza al  insertar en tabla paciente
        $sqlPaciente = "INSERT INTO paciente (usuario, nombre, telefono, correo, fecha_nacimiento) VALUES (?, ?, ?, ?, ?)";
        $stmtPaciente = $pdo->prepare($sqlPaciente);
        $stmtPaciente->execute([$usuario, $nombre, $telefono, $correo, $fecha_nacimiento]);

        if ($stmtPaciente->rowCount() === 0) {
            echo "No se pudo registrar el paciente.";
            exit;
        }

        //se realiza al insertar en tabla usuarios
        $sqlUsuario = "INSERT INTO usuarios (usuario, pass, id_logic, Tipo) VALUES (?, ?, ?, ?)";
        $stmtUsuario = $pdo->prepare($sqlUsuario);
        $stmtUsuario->execute([$usuario, $password, 1, 'paciente']);

        if ($stmtUsuario->rowCount() === 0) {
            echo "Paciente registrado, pero no se pudo registrar el usuario.";
            exit;
        }

        echo "Paciente y usuario registrados correctamente.";
    } catch (PDOException $e) {
        echo "Error al registrar: " . $e->getMessage();
    }
}
?>