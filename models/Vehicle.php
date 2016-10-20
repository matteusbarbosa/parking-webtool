<?php
class Vehicle extends Conexao{

  protected $table = 'vehicle';

  /*
  * Cadastre um único registro
  */

  public function save() {

    $now = date('Y-m-d H:i:s');

    $query = "INSERT INTO `$this->table`
    (`client_id`, `title`, `model`, `plaque`, `created_at`)
    VALUES ('" . $this->client_id . "', '" . $this->title . "','" . $this->model . "',". " '" . $this->plaque . "',". " '" . date('Y-m-d H:i:s'). "')";

    $result = $this->mysqli->query($query);

    if ($this->mysqli->insert_id) {
      return $this->mysqli->insert_id;
    } else {
      return null;
    }
  }

  public function validate(){
    if(!is_int($this->client_id) || !is_string($this->model)
    || !is_string(strtotime(($this->plaque))))
    return false;
    else
    return true;
  }

  /*
  * Atualize um registro único de aula (admin)
  @param $param last,first,id,count
  @param $field
  */

  public function update($data) {
    $query = "UPDATE tb_aulas_opcionais SET model='" . $data['model'] . "', plaque='" . $data['plaque'] . "',"
    . " WHERE id=" . $data['id'];

    $result = $this->mysqli->query($query);

    if ($result) {
      return true;
    } else {
      return false;
    }
  }

  /**
  */
  public function read() {

    $query = "SELECT * FROM $this->table";

    $result = $this->mysqli->query($query);
    $numrows = $result->num_rows;

    if ($numrows > 0) {
      while ($rows = $result->fetch_assoc()) {
        $this->registers[] = $rows;
      }
      return $this->registers;
    }
    //Sem enquetes ativas dentro do prazo
    else {
      return false;
    }
  }


  /* Remova um registro específico
  */

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
  * Pesquisa customizada
  @param $param last,first,count,{valor}
  @param $field coluna a filtrar
  */

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

    //Tá vazia?

    if ($numrows > 0) {
      return $data;
    } else {
      return false;
    }
  }



}
