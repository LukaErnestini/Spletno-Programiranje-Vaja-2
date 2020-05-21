<?php

// Controller tasks
// Receive request.
// Delegate.
// Return response.

namespace App\Controllers;

class PagesController
{

  public function home()  // Static page, doesn't need own controller.
  {
    

    return view('index');
  }

  public function about()
  {
    return view('about');
  }

  public function contact()
  {
    return view('contact');
  }

}