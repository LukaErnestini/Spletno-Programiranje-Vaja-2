<?php

// Controller
// Receive request.
// Delegate.
// Return response.

namespace App\Controllers;

use App\Models\Oglas;
use App\Core\App;

class PagesController
{

  public function home()
  {
    //filtriranje po kategoriji
    $kategorijaID = "*";
    if(isset($_GET["category"])) {
      $kategorijaID = $_GET['category'];
    }

    $searchQuery = "";
    if(isset($_GET["searchQuery"])) {
      $searchQuery = $_GET['searchQuery'];
    }

    $oglasi = Oglas::sort(Oglas::getAll($kategorijaID, $searchQuery));
    
    return view('index', compact('kategorijaID','oglasi'));
  }

  public function about()
  {
    return view('about');
  }

  public function contact()
  {
    return view('contact');
  }

  public function prijava()
  {
    return view('prijava');
  }
  
  public function mojiOglasi()
  {
    // ce ni prijavljen ne pustimo na to stran sploh
    if (!isset($_SESSION["USER_ID"])) {
      return redirect('');
    }

    if(isset($_GET['deleteId']))
	  {
      Oglas::delete($_GET['deleteId']);
    }
    
    $oglasi = Oglas::sort(Oglas::getByOwner($_SESSION["USER_ID"]));

    return view('mojiOglasi', compact('oglasi'));
  }

}