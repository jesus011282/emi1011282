<?php
require_once "connect_dev.php";
$pdo = getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir y limpiar las entradas
    $usuario      = trim($_POST['usuario'] ?? '');
    $password     = trim($_POST['password'] ?? '');
    $nombre       = trim($_POST['nombre'] ?? '');
    $especialidad = trim($_POST['especialidad'] ?? '');
    $telefono     = trim($_POST['telefono'] ?? '');
    $correo       = trim($_POST['correo'] ?? '');

    // Validación: asegurar que ningún campo esté vacío
    if (
        empty($usuario) || empty($password) || empty($nombre) ||
        empty($especialidad) || empty($telefono) || empty($correo)
    ) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    try {
        // se realiza al insertar en tabla medico
        $sqlMedico = "INSERT INTO medico (usuario, nombre, especialidad, telefono, correo) VALUES (?, ?, ?, ?, ?)";
        $stmtMedico = $pdo->prepare($sqlMedico);
        $stmtMedico->execute([$usuario, $nombre, $especialidad, $telefono, $correo]);

        if ($stmtMedico->rowCount() === 0) {
            echo "No se pudo registrar el médico.";
            exit;
        }

        // se realiza al insertar en tabla usuarios
        $sqlUsuario = "INSERT INTO usuarios (usuario, pass, id_logic, Tipo) VALUES (?, ?, ?, ?)";
        $stmtUsuario = $pdo->prepare($sqlUsuario);
        $stmtUsuario->execute([$usuario, $password, 1, 'medico']);

        if ($stmtUsuario->rowCount() === 0) {
            echo "Médico registrado, pero no se pudo registrar el usuario.";
            exit;
        }

        echo "Médico y usuario registrados correctamente.";
    } catch (PDOException $e) {
        echo "Error al registrar: " . $e->getMessage();
    }
}
?>
