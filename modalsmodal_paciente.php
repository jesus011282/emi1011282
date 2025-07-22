<!-- Modal Editar Paciente -->
<div class="modal fade" id="modalPaciente" tabindex="-1" aria-labelledby="modalPacienteLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="formEditarPaciente">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editar Paciente</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="idPaciente" name="idPaciente">
          <div class="form-group">
            <label>Usuario</label>
            <input type="text" id="usuario" name="usuario" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Nombre</label>
            <input type="text" id="nombre" name="nombre" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Teléfono</label>
            <input type="text" id="telefono" name="telefono" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Correo</label>
            <input type="email" id="correo" name="correo" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Fecha de Nacimiento</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Actualizar</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!--Se realiza la mejora del modal de paciente -->