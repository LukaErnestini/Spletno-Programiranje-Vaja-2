<?php

namespace App\Controllers;

use App\Models\Uporabnik;

class UporabnikController
{

  public function prijava()
  {
    $error="";

    return view('prijava', compact('error'));
  }

  public function prijavi()
  {
    $error="";

    //Preveri prijavne podatke
    if(($user_id = Uporabnik::validate_login($_POST["username"], $_POST["password"])) >= 0)
    {
      //Zapomni si prijavljenega uporabnika v seji in preusmeri na index
      $_SESSION["USER_ID"] = $user_id;
      return redirect('');
    }
    else
    {
      $error = "Prijava ni uspela.";
    }

    return view('prijava', compact('error'));
  }

  public function odjava()
  {
    session_start(); //Naloži sejo
    session_unset(); //Odstrani sejne spremenljivke
    session_destroy(); //Uniči sejo

    return redirect('');
  }

}