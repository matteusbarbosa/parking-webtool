<div id="data-return">
  <?php
  include '../models/Conexao.php';
  include '../models/Parking.php';
  include '../models/Client.php';
  include '../models/Vehicle.php';

  $parking = new Parking();
  $data = $parking->read();

  if(is_array($data) && count($data) > 0){
    foreach($data as $k => $v){
      $client = new Client();
      $vehicle = new Vehicle();
      $data[$k]['client'] = $client->select($v['client_id'],'id');
      $data[$k]['vehicle'] = $vehicle->select($v['vehicle_id'],'id');
    }
  }
  ?>
  <h3>Listar Estacionados</h3>
  <table border=1 class="table table-striped">
    <tbody>
      <tr>
        <th>#</th>
        <th>Placa</th>
        <th>Cliente</th>
        <th>Carro</th>
        <th>Detalhes</th>
        <th>Entrada</th>
        <th>Saída</th>
        <th>Ações</th>
      </tr>
      <?php

      if(is_array($data) && count($data) > 0){
        foreach ($data as $key => $park) {
          $remove_func = 'remove("api/parking/'.$park['id'].'")';
          $end_at = $park['end_at'] == null ? '<span style="color:#22ff11;">℗</span> Estacionado' : date('d/m H:i', strtotime($park['end_at']));
          echo '<tr><td>'.($key+1).'</td>
          <td>'.$park['vehicle']['plaque'].'</td>
          <td>'.$park['client']['name'].'</td>
          <td>'.$park['vehicle']['title'].'</td>
          <td>'.$park['details'].' +</td>
          <td>'.date('d/m H:i', strtotime($park['start_at'])).'</td>
          <td>'.$end_at.'</td>';
          echo "<td><a href='#' onclick='$remove_func'>X</a></td></tr>";
        }
      }
      if(count($data) == 0)
      echo '<tr><td>Não há resultados para exibir</td></tr>';
      ?>
    </tbody>
  </table>
</div>
