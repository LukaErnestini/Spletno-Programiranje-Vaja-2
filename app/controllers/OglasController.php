<?php

// Controller tasks
// Receive request.
// Delegate.
// Return response.

namespace App\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Oglas;
use App\Core\App;

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

  public function edit()
  {
    if (isset($_GET['id']) && $_GET['id'] != null) {
      $oglasID = $_GET['id'];
    }
    else {
      die("No ad selected to show.");
    }

    $oglas = Oglas::get($oglasID);
    return view('oglasEdit', compact('oglas'));
  }

  public function submitEdit()
  {
    Oglas::update($_POST['newTitle'], $_POST['id'], $_POST['newDescription']);

    return redirect('mojiOglasi');
  }

  public function objava()
  {
    $error="";

    return view('objava', compact('error'));
  }

  public function store()
  {
    $error="";

    //Oglas::insert($_POST["title"], $_POST["description"], $_FILES["mainimage"], $_POST["category"]);
    
    //sprehodimo se čez vse izbrane kategorije in jih dodamo v tabelo relacij
    // foreach ($_POST["categoryMultiple"] as $category)
    //   Category::assignToAd($category, Oglas::last()->id);

    //upload slike v folder, poskrbimo tudi za unikatno ime
    $fileName = strtotime("now") . $_FILES['mainimage']['name']; // eg.: timestampFILENAME.JPG

    if($error = Image::store($fileName))
      return view('objava', compact('error'));

    //dodatne slike
    
    /* $fileNames = array_filter($_FILES['images']['name']);
    if(!empty($fileNames)){
      foreach($_FILES['images']['name'] as $key=>$val){
        // File upload path 
        $fileName = basename($_FILES['images']['name'][$key]);
        //dodatnim slikam pripnem še 'a' spredaj.
        $fileName = 'a' . $timestamp .  $fileName;
        $targetFilePath = $target_dir . $fileName;

        // Select file type
        $imageFileType = strtolower(pathinfo($targetFilePath,PATHINFO_EXTENSION));
        if(in_array($imageFileType,$extensions_arr)) {
          // Insert record & upload file if successful
          $query = "insert into images (name) values('".$fileName."')";
          $conn->query($query);
          // Upload file
          move_uploaded_file($_FILES["images"]["tmp_name"][$key], $targetFilePath);

          $image = lastimage();
          //v tabelo vnesemo dodatne slike ki spadajo k oglasu
          addImages($image->id, $oglas->id, 0);
        }
      }
    } */

    // return redirect('');
  }

}