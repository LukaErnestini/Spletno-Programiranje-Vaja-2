<?php

class QueryBuilder {

  protected $pdo;

  public function __construct(PDO $pdo)
  {
    $this->pdo = $pdo;
  }

  public function selectAll($table)
  {
    $statement = $this->pdo->prepare("select * from {$table}");
    $statement-> execute();
    return($statement->fetchAll(PDO::FETCH_CLASS));
  }

  public function insert($table, $parameters)
  {
    $sql = sprintf(
      'insert into %s (%s) values (%s)',
      $table,
      implode(', ', array_keys($parameters)), // array kljuce zlista v string, loceni z vejico in presledkom
      ':' . implode(', :', array_keys($parameters)) // dodamo : pred imena, za data binding.
    );

    try {
      $statement = $this->pdo->prepare($sql);
      $statement -> execute($parameters); // execute-u dodamo array kot parameter,
      // ki je asociativni array. Vnasa glede na key.
      // https://www.w3schools.com/php/php_mysql_prepared_statements.asp
      echo 'Success';
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

}