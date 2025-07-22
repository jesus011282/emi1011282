<?php
session_start();
require_once "connect_dev.php";
$conn = getConnection();
//Se realiza el inicio sesion y lo que es la conexion de la base de datos 

// Se realiza la Validacion de  CAPTCHA
$captcha = $_POST['g-recaptcha-response'] ?? '';
if (empty($captcha)) {
    echo "Error en CAPTCHA: debes verificar que no eres un robot.";
    exit();
}
// Se recupera lo que es la capcha en el formulario
//En la cual si se encuentra vacio se realiza lo que es un mensaje de error y la terminacion el script
$secretKey = '6LeebFwrAAAAAKbXJ1Eah6F0CpW4bIAsO3AX7Jt_';
$verifyURL = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captcha";
$response = file_get_contents($verifyURL);
$responseData = json_decode($response);

if (!$responseData->success) {
    echo "Error en CAPTCHA: verificación fallida."; //Lo que son los errores de CAPTCHA.Que se puede verificar lo fallida
    exit();
}

//Se puede  validar las credenciales
if (isset($_POST['usuario']) && isset($_POST['password'])) {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
// Que se realiza la recuperacion de los valores enviados por medio de formulario
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = :usuario LIMIT 1");
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();
// Preparar las consultas en SQL, que se realiza la busqueda del usuario por medio de nombre
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($password === $user['pass']) {
            if ($user['id_logic'] == 1) {
                $_SESSION['usuario'] = $user['usuario'];
                $_SESSION['rol'] = $user['Tipo'];
                echo "OK";
                exit();
            } else {
                echo "Usuario inactivo. Contacta al administrador.";
            }
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }
} else {
    echo "Datos incompletos.";
}
?>