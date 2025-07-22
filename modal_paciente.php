<div class="modal fade" id="modalPaciente" tabindex="-1" aria-labelledby="modalPacienteLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formPaciente">
        <div class="modal-header">
          <h5 class="modal-title" id="modalPacienteLabel">Actualizar Paciente</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="paciente_id">
          
          <div class="mb-3">
            <label for="paciente_usuario" class="form-label">Usuario</label>
            <input type="text" class="form-control" name="usuario" id="paciente_usuario" required>
          </div>
          
          <div class="mb-3">
            <label for="paciente_nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="paciente_nombre" required>
          </div>

          <div class="mb-3">
            <label for="paciente_telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" name="telefono" id="paciente_telefono" required>
          </div>

          <div class="mb-3">
            <label for="paciente_correo" class="form-label">Correo</label>
            <input type="email" class="form-control" name="correo" id="paciente_correo" required>
          </div>

          <div class="mb-3">
            <label for="paciente_fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
            <input type="date" class="form-control" name="fecha_nacimiento" id="paciente_fecha_nacimiento" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--Se realiza la mejora del modal de paciente -->