<?php
class Payment extends Conexao{

  const PRICE_HOUR = 8.50;
  protected $table = 'payment';

  /*
  * Cadastre um único registro
  */

  public function save() {

    $now = date('Y-m-d H:i:s');

    $query = "INSERT INTO `$this->table`
    (`vehicle_id`, `method_id`, `price`, `created_at`)
    VALUES ('" . $this->vehicle_id . "', '" . $this->method_id . "', '" . $this->price . "','" . $now ."')";

    $result = $this->mysqli->query($query);

    if ($this->mysqli->insert_id) {
      return $this->mysqli->insert_id;
    } else {
      return null;
    }
  }
}
