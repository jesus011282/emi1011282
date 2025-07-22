<?php
session_start();

// Se realiza lo que es el inicio de la sesion y control de los accesos PHP
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}
// se realiza la identificacion de la pagina actual 
$currentPage = basename($_SERVER['PHP_SELF']);

// Se realiza lo que es la definicion del menu de la navegacion 
// En la cual define los items menu en tres elemento 
// Que son la clase del texto mostrado 
//Los iconos de FontAwesome 
// El color de las botones (Bootstrap o clases personalizado)
$menuItems = [
    'inicio.php'        => ['Inicio', 'fas fa-home', 'primary'],
    'paciente.php'      => ['Pacientes', 'fas fa-user-injured', 'success'],
    'medico.php'        => ['Médicos', 'fas fa-user-md', 'info'],
    'cita.php'          => ['Citas', 'fas fa-calendar-plus', 'warning'],
    'vercita.php'       => ['Ver Citas', 'fas fa-calendar-alt', 'secondary'],
    'verpaciente.php'   => ['Ver Pacientes', 'fas fa-address-book', 'secondary'],
    'vermedico.php'     => ['Ver Médicos', 'fas fa-address-card', 'secondary']
];
// Se realiza lo que es el control de los permisos por rol 
$permisosPorRol = [
    'admin'    => array_keys($menuItems),
    'medico'   => ['inicio.php', 'cita.php', 'verpaciente.php', 'vercita.php'],
    'paciente' => ['inicio.php', 'cita.php', 'vercita.php']
];

//Se realiza los $rolUsuario = $_SESSION['rol'] ?? 'invitado';
$rolUsuario = $_SESSION['rol'];
//Se realiza el var_dump($rolUsuario);
$itemsPermitidos = $permisosPorRol[$rolUsuario] ?? [];
?>
<!-- Lo que es la contruccion de los menu en HTML-->
<div class="menu">
    <div class="menu-left">
        <?php foreach ($menuItems as $page => $details): ?>
            <?php if (in_array($page, $itemsPermitidos)): ?>
                <a href="<?php echo $page; ?>" 
                   class="<?php echo ($currentPage === $page ? 'active ' : '') . ($details[2] ?? ''); ?>">
                    <i class="<?php echo $details[1]; ?>"></i> <?php echo $details[0]; ?>
                </a>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<!-- Lo que es la informacion de los usuarios y los botones de la cerrada de sesion-->
    <div class="menu-right">
        <span class="session-info">
            <i class="fas fa-user"></i> <?php echo $_SESSION['usuario'] ?? 'Invitado'; ?>
        </span>

        <form action="logout.php" method="post" style="display:inline;">
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Cerrar sesión
            </button>
        </form>
    </div>
</div>
<!--Lo que son las librerias extrenas-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    /* Los estilos de CSS que son personalizados */
:root {
    --verde: #708A65;
    --dorado: #B9A86F;
    --negro: #e83636;
    --fondo: #F9F9F9;

}
/* Define lo que son la variable CSS de los colores para el uso de todos los diseños */
body {
    font-family: Arial, sans-serif;
    background-color: #f0f2f5;
    margin: 0;
    padding: 0;
}
/*Los estilos generales de los fondos y fuentes*/
.menu {
    display: flex;
    justify-content: space-between; /* La separación entre el menú y la sesión/logout */
    align-items: center;
    background-color: var(--verde);
    padding: 10px 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}
.menu-left {
    display: flex;
    gap: 15px;
}
.menu-right {
    display: flex;
    align-items: center;
    gap: 15px;
}
/* Muestra la forma del menu que son los espacios del color y los fondos y sombras*/
.menu a {
    text-decoration: none;
    padding: 10px 15px;
    border-radius: 5px;
    font-weight: bold;
    color: white;
    transition: 0.3s;
}
.menu a.active {
    background-color: var(--dorado);
    color: white;
}
.menu a:hover {
    background-color: var(--dorado);
}
.session-info {
    font-size: 16px;
    font-weight: bold;
    color: white;
}
/* Lo que son los estilos de los enlance del menu que se puede colorear en poder pasar el mouse asi como los archios*/
.logout-btn {
    background: var(--negro);
    color: white;
    border: none;
    padding: 8px 15px;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s;
}
.logout-btn:hover {
    background: #B10000;
}
</style>