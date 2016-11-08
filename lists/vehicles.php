<div id="data-return">
  <?php
  include '../models/Conexao.php';
  include '../models/Parking.php';
  include '../models/Client.php';
  include '../models/Vehicle.php';

  $vehicle= new Vehicle();
  $data = $vehicle->read();

  foreach($data as $k => $v){
    $client = new Client();
    $data[$k]['client'] = $client->select($v['client_id'],'id');
  }
  ?>
  <h3>Listar Veículos</h3>
<table border=1 class="table table-striped">
<tbody>
  <tr>
    <th>#</th>
    <th>Placa</th>
    <th>Cliente</th>
    <th>Carro</th>
    <th>Modelo</th>
    <th>Entrada</th>
    <th>Ações</th>
</tr>
  <?php

  foreach ($data as $key => $vehicle) {
    $remove_func = 'remove("api/vehicle/'.$vehicle['id'].'")';
    $created_at = date('d/m H:i', strtotime($vehicle['created_at']));
      echo '<tr><td>'.($key+1).'</td>
      <td>'.$vehicle['plaque'].'</td>
      <td>'.$vehicle['client']['name'].'</td>
      <td>'.$vehicle['title'].'</td>
      <td>'.$vehicle['model'].' +</td>
      <td>'.$created_at.'</td>';
      echo "<td class='collumnRemover'><a class='btn btn-small' href='#' onclick='$remove_func'>Remover</a></tr>";
      
  }
  if(count($data) == 0)
  echo '<tr><td>Não há resultados para exibir</td></tr>';
  ?>
</tbody>
</table>

  

</div>
