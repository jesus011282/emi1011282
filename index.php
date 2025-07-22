<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Responsive</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Se realiza los estilos y librerías -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <style>
        /* Los estilos personalizados CSS*/
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(to right, #74ebd5, #ACB6E5);
        }
        .container-fluid {
            display: flex;
            width: 80%;
            max-width: 900px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        /* Se realiza la creacion de los contenedores en forma de la tarjeta y lo que son los bordes*/
        .left-side {
            flex: 1;
            text-align: center;
            padding: 40px;
        }
        .left-side img {
            max-width: 100%;
            height: auto;
        }
        .right-side {
            flex: 1;
            padding: 40px;
            text-align: center;
            position: relative;
        }
        .profile-icon {
            width: 80px;
            height: 80px;
            background: #708A65;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            font-size: 40px;
            margin: 0 auto 20px;
        }
        .input-group { margin-bottom: 15px; }
        .toggle-password { cursor: pointer; }

        .spinner {
            display: none;
            width: 30px;
            height: 30px;
            border: 4px solid #ccc;
            border-top: 4px solid #5C6BC0;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 15px auto;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="left-side">
            <h2 class="torre-medica">TORRE MEDICA</h2>
            <img src="2.jpg" width="800" height="500">
        </div>
<!-- Lo que es la estructura de los formularios del login -->
        <div class="right-side">
            <div class="profile-icon"><i class="fas fa-user"></i></div>
            <h3>Iniciar Sesión</h3>
            <div class="spinner" id="spinner"></div>

            <form id="formLogin">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" name="usuario" placeholder="Usuario" required>
                </div>

                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    </div>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" minlength="8" maxlength="11" required>
                    <div class="input-group-append">
                        <span class="input-group-text toggle-password"><i class="fas fa-eye"></i></span>
                    </div>
                </div>

                <!-- Lo que es la CAPTCHA -->
                <div class="form-group mt-3">
                    <div class="g-recaptcha" data-sitekey="6LeebFwrAAAAAARd_Cwz0NYkrC6ChIHwTUFxbu3F"></div>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
            </form>
        </div>
    </div>

    <script>
    $(document).ready(function(){
        $(".toggle-password").click(function(){
            let input = $("#password");
            let icon = $(this).find("i");
            if (input.attr("type") === "password") {
                input.attr("type", "text");
                icon.removeClass("fa-eye").addClass("fa-eye-slash");
            } else {
                input.attr("type", "password");
                icon.removeClass("fa-eye-slash").addClass("fa-eye");
            }
        });

        $("#formLogin").submit(function(e){
            e.preventDefault();
            $("#spinner").show();

            $.post("login.php", $(this).serialize(), function(data){
                const respuesta = data.trim();
                if (respuesta === "OK") {
                    setTimeout(() => {
                        window.location.href = "inicio.php";
                    }, 800);
                } else {
                    $("#spinner").hide();
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de acceso',
                        text: respuesta
                    });
                    if (respuesta.includes("CAPTCHA")) {
                        grecaptcha.reset();
                    }
                }
            });
        });
    });
    </script>
</body>
</html>