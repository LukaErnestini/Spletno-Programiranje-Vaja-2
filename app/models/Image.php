<?php

namespace App\Models;

use App\Core\App;

class Image
{
  // Directory for storing images
  protected static $imagesDir = '\core\images\\';
  // Valid file extensions
  protected static $extensionsArr = array("jpg","jpeg","png","gif");

  //Ta funkcija prikaže dodatne slike
  public static function getAll($adID)
  {
    $query="SELECT * FROM `images` INNER JOIN ads_images ON images.id = ads_images.image_id 
            WHERE ads_images.ad_id = $adID AND ads_images.main = 0;";
    $res = App::get('database')->executeCustomQuery($query);
    if ($res->num_rows > 0){
      while ($row = $res->fetch_assoc()){
        echo '<div class="col-lg-3 col-md-4 col-xs-6 thumb">';
        echo '  <a class="thumbnail" href="/core/images/' . $row['name'] . '">';
        echo '    <img class="img-thumbnail" src="/core/images/' . $row['name'] . '"	alt="Dodatna slika oglasa">';
        echo '	</a>';
        echo '</div>';
      }
    }
  }

  public static function assignToAd($imageid, $oglasid, $main)
  {
    //dodajamo povezave v tabelo mnogo mnogo (ads_images)
    // main = 1 ... predstavitvena slika
    if($main)
      $query = "INSERT INTO `ads_images` (`image_id`, `ad_id`, `main`) VALUES ($imageid, $oglasid, 1)";
    else
      $query = "INSERT INTO `ads_images` (`image_id`, `ad_id`) VALUES ($imageid, $oglasid)";

    App::get('database')->executeCustomQuery($query);
  }

  public static function last()
  {
    //dobim zadnjo uploadano sliko
    $query = "SELECT * FROM images ORDER BY id DESC LIMIT 1;";
    return App::get('database')->executeCustomQuery($query)->fetch_object();
  }

  public static function store($fileName) //filename = timestampName.jpg
  {
    $fullPath = Image::$imagesDir . $fileName; // eg.: /core/images/timestampFILENAME.JPG
    $fileExtension = strtolower(pathinfo($fullPath,PATHINFO_EXTENSION)); // eg.: .jpg

    if(in_array($fileExtension, Image::$extensionsArr))
    {  
      // Insert record into db
      $query = "insert into `images` (name) values('{$fileName}')";
      App::get('database')->executeCustomQuery($query);

      // Upload file
      move_uploaded_file($_FILES['mainimage']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $fullPath);

      $image = Image::last();
      
      //v tabelo vnesemo obvezno sliko ki spada k oglasu
      //Image::assignToAd($image->id, Oglas::last()->id, 1);
    }
    else
    {
      $error = "File extension not supported.";
      return $error;
    }
  }
}