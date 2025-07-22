<?php #include 'menu.php';?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage Médica</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
      <!-- Se realiza Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Se realiza jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Se realiza Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Se realiza SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Se realiza las fuentes de impresion -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #c8cad1ff, #c8cad1ff);
        }
        .container-fluid {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            max-width: auto;
            margin: auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .left-side {
            flex: 1;
            background: url('umedica.jpg') no-repeat center center;
            background-size: cover;
            min-height: 370px;
        }
        .right-side {
            flex: 1;
            padding: 10px;
            text-align: center;
        }
        .cards-section {
            padding: 40px;
        }
        .texto-home{
            font-size: 12px;
            text-justify: auto;
        }
        .texto-home-titulo{
            color: #708a65;
        }

    </style>
        <?php include ("menu.php");?>
        
      
</head>
<body>
    <!-- Se visualiza el menú de navegación -->
      <menu></menu>   
    <!-- Lo que son los contenidos Principales -->
    <div class="container-fluid">
        <div class="left-side"></div>
        <div class="right-side">
            <h3 class="texto-home-titulo">Descripción de la empresa</h3>
            <section class="texto-home">
                <p>
                El Dr. Luis Fernando Yamanaka Buenrostro es un médico cirujano egresado de la Universidad Latinoamericana (ULA) en Cuernavaca, Morelos. Cuenta con una cédula profesional número 08741379. Además, ha realizado un diplomado de Colposcopia en el Hospital Adolfo López Mateos en la Ciudad de México y un diplomado de Ultrasonido General e Intervencionista-Materno Fetal en Cuernavaca, Morelos. Es miembro del Colegio de Médicos Cirujanos del Estado de Morelos y del Colegio Mexicano de Ginecólogos dedicados a la Colposcopia.
                </p>
                <p>    
                En su consultorio, el Dr. Yamanaka ofrece servicios de colposcopía, ginecología y diagnóstico médico, especializándose en el Virus del Papiloma Humano (VPH). También ofrece un paquete de promoción que incluye consulta médica, papanicolaou, colposcopía, ultrasonido pélvico y revisión de mamas, con el objetivo de prevenir y tratar a tiempo el cáncer cervicouterino y el cáncer de mama. Además, realiza estudios de androscopia y citología uretral en hombres para prevenir el cáncer de pene y las lesiones asociadas al VPH.
                </p>
                <p>
                El Dr. Yamanaka también participa en el programa de radio Mundo 96.5 FM, donde se abordan temas relacionados con el VPH y se responden preguntas frecuentes. En su consulta general, ofrece control y seguimiento de diversas condiciones de salud, como diabetes mellitus, hipertensión arterial, colesterol, triglicéridos, climaterio, menopausia, control prenatal y planificación familiar, entre otros. El Dr. Yamanaka busca brindar una mejor calidad de vida a sus pacientes, priorizando siempre su salud.
                </p>
            </section>
        </div>
    </div>

    <!-- Se realiza la sección de tarjetas -->
<div class="container cards-section mt-4">
  <div class="row">
    
    <!-- Se realiza la tarjeta Pacientes -->
    <div class="col-md-4">
      <div class="card text-center shadow-sm mb-4">
        <div class="card-header bg-success text-white">
          <i class="fas fa-user-injured"></i> Pacientes
        </div>
        <div class="card-body">
          <img src="4.jpg" class="img-fluid mb-2 rounded" style="max-height: 150px;" alt="Paciente">
          <div class="descripcion" style="display: none;">
            <p class="card-text text-justify">Descripción breve del servicio.</p>
            <p class="card-text text-justify"><strong>* Paquete 1:</strong> Incluye consulta médica, Papanicolaou, Colposcopia y Ultrasonido Pélvico.</p>
            <p class="card-text text-justify"><strong>* Paquete 2:</strong> Incluye consulta médica, Papanicolaou, Colposcopia, Ultrasonido Mamario y Ultrasonido Pélvico.</p>
            <p class="card-text text-justify"><strong>* Paquete 3:</strong> Incluye consulta médica, Papanicolaou, Colposcopia, Ultrasonido Mamario, Ultrasonido Abdominal y Ultrasonido Pélvico.</p>
            <hr>
            <ul class="list-unstyled ps-3 text-start">   
              <li>● Prevención y tratamiento de VPH</li>
              <li>● Control prenatal con Ultrasonido Obstétrico</li>
              <li>● Planificación familiar</li>
              <li>● Climaterio y menopausia</li>
            </ul>
          </div>
        </div>
        <div class="card-footer text-end">
          <button class="btn btn-outline-primary verMasBtn">Ver más</button>
        </div>
      </div>
    </div>

    <!-- Se realiza la tarjeta Médico -->
    <div class="col-md-4">
      <div class="card text-center shadow-sm mb-4">
        <div class="card-header bg-success text-white">
          <i class="fas fa-user-md"></i> Médico
        </div>
        <div class="card-body">
          <img src="7.jpg" class="img-fluid mb-2 rounded" style="max-height: 150px;" alt="Médico">
          <div class="descripcion" style="display: none; text-align: justify;">
            <p class="card-text">
              El Dr. <strong>Luis Fernando Yamanaka Buenrostro</strong> es un médico cirujano egresado de la Universidad Latinoamericana (ULA) en Cuernavaca, Morelos. Cuenta con una cédula profesional número <strong>08741379</strong>.
            </p>
            <p class="card-text">
              Diplomados en Colposcopia y Ultrasonido General e Intervencionista-Materno Fetal.
            </p>
            <p class="card-text">
              Miembro de los colegios de médicos estatales y ginecológicos del país.
            </p>
            <p class="card-text">
              Brinda atención especializada en salud integral de la mujer.
            </p>
          </div>
        </div>
        <div class="card-footer text-end">
          <button class="btn btn-outline-primary verMasBtn">Ver más</button>
        </div>
      </div>
    </div>

    <!-- Se realiza tarjeta Citas -->
    <div class="col-md-4">
      <div class="card text-center shadow-sm mb-4">
        <div class="card-header bg-success text-white">
          <i class="fas fa-calendar-alt"></i> Citas
        </div>
        <div class="card-body">
          <img src="5.jpg" class="img-fluid mb-2 rounded" style="max-height: 150px;" alt="Citas">
          <div class="descripcion" style="display: none; text-align: justify;">
            <p class="card-text"><strong>Ubicación:</strong> Torre Médica Morrow 26, Esq. Av. Morelos, Primer Piso, Centro, Cuernavaca, Mor.</p>
            <p class="card-text"><strong>Horario:</strong> Lunes a viernes de 10:00 a 14:00 y de 17:00 a 20:00 hrs; sábados de 10:00 a 14:30 hrs.</p>
            <p class="card-text"><strong>Teléfono:</strong> 777 162 7438</p>
            <p class="card-text"><strong>Correo electrónico:</strong> <a href="mailto:yamanaka_14@hotmail.com">yamanaka_14@hotmail.com</a></p>
          </div>
        </div>
        <div class="card-footer text-end">
          <button class="btn btn-outline-primary verMasBtn">Ver más</button>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- Se tiene que realiza el script para mostrar/ocultar la descripción -->
<script>
  $(document).ready(function () {
    $('.verMasBtn').click(function () {
      const card = $(this).closest('.card');
      const descripcion = card.find('.descripcion');
      descripcion.slideToggle();
      $(this).text($(this).text() === 'Ver más' ? 'Ocultar' : 'Ver más');
    });
  });
</script>
<footer class="bg-dark text-white text-center py-2" style="position: fixed; width: 100%; bottom: 0; left: 0;">
    creanuevo@hotmail.com © 2025
  </footer>
</body>
</html>