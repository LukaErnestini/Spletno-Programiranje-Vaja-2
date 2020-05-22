<?php

namespace App\Models;

use App\Core\App;

class Uporabnik
{

  public static function validate_login($username, $password){
    $username = App::get('database')->sanitizeString($username);
    $pass = sha1($password);
    $query = "SELECT * FROM users WHERE username='$username' AND password='$pass'";
    $res = App::get('database')->executeCustomQuery($query);
    if($user_obj = $res->fetch_object()){
      return $user_obj->id;
    }
    return -1;
  }

  // Funkcija preveri, ali v bazi obstaja uporabnik z določenim imenom in vrne true, če obstaja.
  public static function username_exists($username){
    $username = App::get('database')->sanitizeString($username);
    $query = "SELECT * FROM users WHERE username='$username'";
    $res = App::get('database')->executeCustomQuery($query);
    return mysqli_num_rows($res) > 0;
  }

  // Funkcija ustvari uporabnika v tabeli users. Poskrbi tudi za ustrezno šifriranje gesla.
  public static function register_user($username, $password, $email, $ime, $priimek, $naslov, $posta, $tel, $spol, $starost){
    $pass = sha1($password);
    $email = stripslashes($email);    
    $username = App::get('database')->sanitizeString($username);
    $email = App::get('database')->sanitizeString($email);
    $ime = App::get('database')->sanitizeString($ime);
    $priimek = App::get('database')->sanitizeString($priimek);
    $naslov = App::get('database')->sanitizeString($naslov);
    $posta = App::get('database')->sanitizeString($posta);
    $tel = App::get('database')->sanitizeString($tel);
    $spol = App::get('database')->sanitizeString($spol);
    $starost = App::get('database')->sanitizeString($starost);

    $query = "INSERT INTO users (username, password, mail, ime, priimek, naslov, posta, tel, spol, starost) VALUES ('$username', '$pass', '$email', '$ime', '$priimek', '$naslov', '$posta', '$tel', '$spol', '$starost');";
    if(App::get('database')->executeCustomQuery($query)){
      return true;
    }
    else{
      echo mysqli_error(App::get('database')->getMySqli());
      return false;
    }
  }

  
}