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

  public function registracija()
  {
    $error="";

    return view('registracija', compact('error'));
  }

  public function registriraj()
  {
    /*
		VALIDACIJA: preveriti moramo, ali je uporabnik pravilno vnesel podatke (unikatno uporabniško ime, dolžina gesla,...)
		Validacijo vnesenih podatkov VEDNO izvajamo na strežniški strani. Validacija, ki se izvede na strani odjemalca (recimo Javascript), 
		služi za bolj prijazne uporabniške vmesnike, saj uporabnika sproti obvešča o napakah. Validacija na strani odjemalca ne zagotavlja
		nobene varnosti, saj jo lahko uporabnik enostavno zaobide (developer tools,...).
    */

    $error="";

    if($_POST["password"] != $_POST["repeat_password"])
    {
      $error = "Gesli se ne ujemata.";
      return view('registracija', compact('error'));
    }
    else if(Uporabnik::username_exists($_POST["username"]))
    {
      $error = "Uporabniško ime je že zasedeno.";
      return view('registracija', compact('error'));
    }
    //Podatki so pravilno izpolnjeni, registriraj uporabnika
    else if(Uporabnik::register_user($_POST["username"], $_POST["password"], $_POST["email"], $_POST["ime"], $_POST["priimek"], $_POST["naslov"], $_POST["posta"], $_POST["tel"], $_POST["spol"], $_POST["starost"])){
      return redirect('');
    }
    else{
      $error = "Prišlo je do napake med registracijo uporabnika.";
      return view('registracija', compact('error'));
    }
  }

}