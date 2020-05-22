<?php

namespace App\Models;

use App\Core\App;

class Image
{
  //Ta funkcija prikaže dodatne slike
  public static function getImages($adID) {
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
}