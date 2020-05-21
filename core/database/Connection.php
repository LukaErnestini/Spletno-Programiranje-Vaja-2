<?php 

class Connection
{

  public static function make($config)
  {
    /* try {
      return new PDO(
        $config['connection'] . ';dbname=' . $config['name'],
        $config['username'],
        $config['password'],
        $config['options']
      );
    } catch (PDOException $e) {
      die($e->getMessage());
    } */

    try {      
      $baza = new mysqli('localhost', 'root', '', 'vaja1');
      $baza -> set_charset("UTF8");
      return $baza;
    } catch (mysqli_sql_exception $e) {
      die($e->getMessage());
    }
    
  }

}