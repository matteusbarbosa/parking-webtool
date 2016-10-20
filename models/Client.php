<?php

class Client extends Conexao{

  protected $table = 'client';

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

  /*
  * Cadastre um único registro
  */

  public function save() {

    $now = date('Y-m-d H:i:s');

    $query = "INSERT INTO `$this->table`
    (`name`, `created_at`)
    VALUES ('" . $this->name . "', '" . $now ."')";

    $result = $this->mysqli->query($query);

    if ($this->mysqli->insert_id) {
      return $this->mysqli->insert_id;
    } else {
      return null;
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
      return null;
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
}
