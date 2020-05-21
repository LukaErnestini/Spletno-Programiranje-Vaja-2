<?php

// Controller tasks
// Receive request.
// Delegate.
// Return response.

namespace App\Controllers;

use App\Models\Oglas;

class PagesController
{

  public function home()  // Static page, doesn't need own controller.
  {
    //filtriranje po kategoriji
    $kategorijaID = "*";
    if(isset($_GET["category"])) {
      $kategorijaID = $_GET['category'];
    }

    $searchQuery = "";
    if(isset($_GET["searchQuery"])) {
      $kategorijaID = $_GET['searchQuery'];
    }
    
    $oglasi = Oglas::get_oglasi($kategorijaID, $searchQuery);
    
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

}