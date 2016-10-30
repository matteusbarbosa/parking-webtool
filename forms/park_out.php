<form id="save-form">
  <h3>+ Nova Saída</h3>
  <input type="hidden" name="park_out" value="1">
  <div class="form-group">
    <label for="f-vehicle_id">Estacionados</label>
    <select name="parking_id" title="" class="form-control" onmouseover="list_fill(this, 'api/parking')" onclick="calculate_payment(this, 'payment_total', 'api/payment/calculate')">
      <option>Passe o mouse...</option>
    </select>
  </div>
  <div class="form-group" id="payment_total_wrap" style="display: none;">
    <label for="f-vehicle_id">Total a pagar</label>
    <div class="input-group">
      <span class="input-group-addon">R$</span><input id="payment_total" name="payment_total" type="text" class="form-control" placeholder="Valor a pagar">
    </div>
  </div>
  <div class="form-group">
    <label for="f-details">Detalhes</label>
    <textarea name="details" title="" class="form-control" placeholder=""></textarea>
  </div>
  <p>Saída em <?php echo date('d/m/Y H:i:s'); ?></p>
  <div class="form-group">
    <a href="#" class="btn btn-success pull-right" onclick="save('api/parking/exit')">Salvar</a>
  </div>
</form>
