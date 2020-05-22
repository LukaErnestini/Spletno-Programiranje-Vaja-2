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
  
}