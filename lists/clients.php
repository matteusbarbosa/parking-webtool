<div id="data-return">
  <?php
  include '../models/Conexao.php';
  include '../models/Client.php';
  include '../models/Vehicle.php';

  $client = new Client();
  $data = $client->read();

  ?>
  <h3>Listar Clientes</h3>
<table border=1 class="table table-striped">
<tbody>
  <tr>
    <th>#</th>
    <th>Nome</th>
    <th>Data de Cadastro</th>
    <th>Ações</th>
</tr>
  <?php

  foreach ($data as $key => $client) {
     $remove_func = 'remove("api/client/'.$client['id'].'")';
      echo '<tr><td>'.($key+1).'</td>
      <td>'.$client['name'].'</td>
      <td>'.date('d/m H:i', strtotime($client['created_at'])).'</td>';
      echo "<td><a href='#' onclick='$remove_func'>X</a></td></tr>";
  }

  if(count($data) == 0)
  echo '<tr><td>Não há resultados para exibir</td></tr>';

  ?>
</tbody>
</table>


</div>
