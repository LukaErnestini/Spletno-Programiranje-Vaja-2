<?php

class QueryBuilder {

  protected $pdo;
  protected $mysqli;

  /* public function __construct(PDO $pdo)
  {
    $this->pdo = $pdo;
  } */

  public function __construct(mysqli $mysqli)
  {
    $this->mysqli = $mysqli;
  }

  public function executeCustomQuery($query)
  {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    try {
      return $this->mysqli->query($query);
    } catch (mysqli_sql_exception $e) {
      throw $e;
    }
  }

  public function selectAll($table)
  {
    
  }

  public function insert($table, $parameters)
  {
    
  }

  public function sanitizeString($dirtyString)
  {
    return mysqli_real_escape_string($this->mysqli, $dirtyString);
  }

  public function getMySqli()
  {
    return $this->mysqli;
  }



  /* public function selectAll($table)
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
  } */

}