<form id="save-form">
  <h3>+ Nova Entrada</h3>
    <input type="hidden" name="park_in" value="1">
    <div class="form-group row">
      <div class="col-sm-9">
      <label for="f-vehicle_id">Veículo</label>
      <select name="vehicle_id" id="vehicle_id" title="" class="form-control" onmouseover="list_fill(this, 'api/vehicle')" onclick="list_fill_trigger(this, 'api/client','client_id')">
        <option>Passe o mouse...</option>
      </select>
      <input id="vehicle_new" name="vehicle_new" type="text" style="display: none;" class="form-control" placeholder="Novo veículo...">
    </div>
    <div class="col-sm-3">
      <a href="#" class="btn btn-primary btn-add-field" id="add-vehicle" title="Novo" onclick="toggle_field(this, 'vehicle_new', 'vehicle_id')" style="margin-top: 30px;">+</a>
    </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-9">
      <label for="f-client_id">Cliente</label>
      <select name="client_id" title="" id="client_id" class="form-control">
        <option>Escolha o veículo...</option>
      </select>
      <input id="client_new" name="client_new" type="text" style="display: none;" class="form-control" placeholder="Novo cliente...">
    </div>
    <div class="col-sm-3">
      <a href="#" class="btn btn-primary btn-add-field" id="add-client" title="Novo" onclick="toggle_field(this, 'client_new', 'client_id')" style="margin-top: 30px;">+</a>
    </div>
    </div>
  <div class="form-group row">
    <div class="col-sm-9">
    <label for="f-details">Detalhes</label>
    <textarea name="details" title="" class="form-control" placeholder=""></textarea>
    <p>Entrada em <?php echo date('d/m/Y H:i:s'); ?></p>
  </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-9">
    <button type="reset" class="btn btn-default">Limpar</button>
    <a href="#" class="btn btn-primary pull-right" onclick="save('api/parking')">Salvar</a>
  </div>
  </div>
</form>
