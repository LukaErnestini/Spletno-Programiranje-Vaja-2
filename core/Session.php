<?php

namespace App\Core;

class Session {

  public static function start()
  {
    session_start();

    //Seja poteče po 30 minutah - avtomatsko odjavi neaktivnega uporabnika
    if(isset($_SESSION['LAST_ACTIVITY']) && time() - $_SESSION['LAST_ACTIVITY'] < 1800){
      session_regenerate_id(true);
    }
    $_SESSION['LAST_ACTIVITY'] = time();
  }

}