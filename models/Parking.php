<?php

class Parking extends Conexao{

  protected $table = 'parking';

  public function __construct($id = null){
    parent::__construct();
    if($id == null)
    return false;

    $data = $this->select($id,'id');
    if($data != null){
      $this->id = $data['id'];
      $this->client_id = $data['client_id'];
      $this->vehicle_id = $data['vehicle_id'];
      $this->details = $data['details'];
      $this->start_at = $data['start_at'];
      $this->end_at = $data['end_at'];
      return $this;
    } else {
      return false;
    }
  }

  public function save() {

    if(isset($this->id)){
      return $this->update();
    }

    $query = "INSERT INTO `$this->table`
    (`client_id`, `vehicle_id`, `details`, `start_at`)
    VALUES ('" . $this->client_id . "', '" . $this->vehicle_id . "','".$this->details."','" . $this->start_at . "')";

    $result = $this->mysqli->query($query);

    if ($this->mysqli->insert_id) {
      return $this->mysqli->insert_id;
    } else {
      return false;
    }
  }

  public function validate(){
    if(!is_int($this->client_id) || !is_int($this->vehicle_id)
    || !is_int(strtotime(date($this->start_at))))
    return false;
    else
    return true;
  }

  /*
  * Atualize um registro único
  */

  public function update() {
    $query = "UPDATE $this->table SET details='" . $this->details . "', end_at='" . $this->end_at . "' WHERE id=" . $this->id;
    $result = $this->mysqli->query($query);

    if ($result) {
      return true;
    } else {
      return false;
    }
  }

  /**  Listagem */
  public function read() {

    $query = "SELECT * FROM $this->table ORDER BY end_at ASC";

    $result = $this->mysqli->query($query);
    $numrows = $result->num_rows;

    if ($numrows > 0) {
      while ($rows = $result->fetch_assoc()) {
        $this->registers[] = $rows;
      }
      return $this->registers;
    }
    else {
      return null;
    }
  }


  /* Remova um registro específico  */

  public function delete() {

    $query = "DELETE FROM $this->table WHERE id=$this->id";

    $result = $this->mysqli->query($query);

    if ($result) {
      return true;
    } else {
      return false;
    }
  }

  /*
  * Pesquisa customizada  */

  public function select($param, $field = null) {

    switch ($param) {
      case 'last':
      $query = "SELECT * FROM $this->table ORDER BY id DESC";
      break;
      case 'first':
      $query = "SELECT * FROM $this->table ASC LIMIT 1";
      break;
      case 'count':
      $query = "SELECT count(id) FROM $this->table";
      break;
      default:
      $query = "SELECT * FROM $this->table WHERE $field='$param'";
      break;
    }

    $result = $this->mysqli->query($query);
    $numrows = $result->num_rows;
    $data = $result->fetch_assoc();

    if ($numrows > 0) {
      return $data;
    } else {
      return false;
    }
  }
}
?>