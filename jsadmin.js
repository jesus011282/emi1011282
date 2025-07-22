$(document).ready(function () {

  // Se realiza al Iniciar DataTables
  const tablaPacientes = $('#tablaPacientes').DataTable({
    ajax: 'api/pacientes.php',
    columns: [
      { data: 'idPrimaria' },
      { data: 'usuario' },
      { data: 'nombre' },
      { data: 'telefono' },
      { data: 'correo' },
      { data: 'fecha_nacimiento' },
      {
        data: null,
        render: function (data, type, row) {
          return `<button class="btn btn-warning btn-sm editarPaciente" data-id="${row.id}">Editar</button>`;
        }
      }
    ]
  });

  const tablaMedicos = $('#tablaMedicos').DataTable({
    ajax: 'api/medicos.php',
    columns: [
      { data: 'idPrimaria' },
      { data: 'nombre' },
      { data: 'especialidad' },
      { data: 'telefono' },
      { data: 'correo' },
      { data: 'usuario' },
      {
        data: null,
        render: function (data, type, row) {
          return `<button class="btn btn-warning btn-sm editarMedico" data-id="${row.id}">Editar</button>`;
        }
      }
    ]
  });

  const tablaCitas = $('#tablaCitas').DataTable({
    ajax: 'api/citas.php',
    columns: [
      { data: 'idPrimaria' },
      { data: 'fecha' },
      { data: 'hora' },
      { data: 'estado' },
      { data: 'id_paciente' },
      { data: 'id_medico' },
      {
        data: null,
        render: function (data, type, row) {
          return `<button class="btn btn-warning btn-sm editarCita" data-id="${row.id}">Editar</button>`;
        }
      }
    ]
  });

  // Se realiza el evento para botón editar (paciente)
  $('#tablaPacientes tbody').on('click', '.editarPaciente', function () {
    const data = tablaPacientes.row($(this).parents('tr')).data();
    $('#idPaciente').val(data.idPrimaria);
    $('#usuario').val(data.usuario);
    $('#nombre').val(data.nombre);
    $('#telefono').val(data.telefono);
    $('#correo').val(data.correo);
    $('#fecha_nacimiento').val(data.fecha_nacimiento.split(' ')[0]);
    $('#modalPaciente').modal('show');
  });

  // En la cual sirve para los formulario actualizar paciente
  $('#formEditarPaciente').submit(function (e) {
    e.preventDefault();
    $.ajax({
      url: 'api/actualizar_paciente.php',
      method: 'POST',
      data: $(this).serialize(),
      success: function (response) {
        Swal.fire('Éxito', response, 'success');
        $('#modalPaciente').modal('hide');
        tablaPacientes.ajax.reload();
      },
      error: function () {
        Swal.fire('Error', 'No se pudo actualizar', 'error');
      }
    });
  });

  // Aquí irían eventos para médicos y citas (similar)
});
