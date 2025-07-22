<div class="modal fade" id="modalMedico" tabindex="-1" aria-labelledby="modalMedicoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formMedico">
        <div class="modal-header">
          <h5 class="modal-title" id="modalMedicoLabel">Actualizar Médico</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="medico_id">
          
          <div class="mb-3">
            <label for="medico_nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="medico_nombre" required>
          </div>

          <div class="mb-3">
            <label for="medico_especialidad" class="form-label">Especialidad</label>
            <input type="text" class="form-control" name="especialidad" id="medico_especialidad" required>
          </div>

          <div class="mb-3">
            <label for="medico_telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" name="telefono" id="medico_telefono" required>
          </div>

          <div class="mb-3">
            <label for="medico_correo" class="form-label">Correo</label>
            <input type="email" class="form-control" name="correo" id="medico_correo" required>
          </div>

          <div class="mb-3">
            <label for="medico_usuario" class="form-label">Usuario</label>
            <input type="text" class="form-control" name="usuario" id="medico_usuario" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--Se realiza la mejora del modal de medico -->