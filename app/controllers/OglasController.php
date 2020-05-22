<?php

// Controller tasks
// Receive request.
// Delegate.
// Return response.

namespace App\Controllers;

use App\Models\Oglas;

class OglasController
{
  public function show()
  {
    if (isset($_GET['id']) && $_GET['id'] != null) {
      $oglasID = $_GET['id'];
    }
    else {
      die("No ad selected to show.");
    }

    $oglas = Oglas::get($oglasID);

    return view('oglas', compact('oglas', 'oglasID'));
  }

}