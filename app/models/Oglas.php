<?php

namespace App\Models;

use App\Core\App;
use App\Models\Category;

class Oglas
{
  public static function getAll($category, $searchQuery)
  {
    $category = App::get('database')->sanitizeString($category);
    $searchQuery = App::get('database')->sanitizeString($searchQuery);
    
    $query = "SELECT * FROM ads";
    if ($category != '*'){
      $seznamKategorij = Category::ustvariSeznamPodkategorij($category);
      $query = $query . " INNER JOIN ads_categories ON ads.id=ads_categories.ads_id WHERE (ads_categories.categories_id='$category'";
      foreach ($seznamKategorij as $kat) //enkrat se duplicira kategorija pri poizvedbi, nič hudega
        $query = $query . " OR ads_categories.categories_id='$kat'";
      $query = $query . ')';		
      if ($searchQuery != "") // Za iskalni niz (naslov in opis preiščemo)
        $query = $query . " AND (title LIKE '%$searchQuery%' OR description LIKE '%$searchQuery%')";
    }
    else if ($searchQuery != "")
      $query = $query . " WHERE (title LIKE '%$searchQuery%' OR description LIKE '%$searchQuery%')";
    
    $res = App::get('database')->executeCustomQuery($query);
    $oglasi = array();
    
    while($oglas = $res->fetch_object())
      array_push($oglasi, $oglas);
    return $oglasi;
  }

  public static function getByOwner($user_id)
  {
    $user_id = App::get('database')->sanitizeString($user_id);
    $query   = "SELECT * FROM ads WHERE user_id = '$user_id';";
    $res     = App::get('database')->executeCustomQuery($query);
    $oglasi  = array();
    
    while($oglas = $res->fetch_object()){
      array_push($oglasi, $oglas);
    }
    return $oglasi;
  }

  //Funkcija izbere oglas s podanim ID-jem. Doda tudi uporabnika, ki je objavil oglas.
  public static function get($id)
  {
    $id = App::get('database')->sanitizeString($id);
    $query = "SELECT ads.*, users.username, users.mail FROM ads JOIN users ON users.id = ads.user_id WHERE ads.id = $id;";
    $res = App::get('database')->executeCustomQuery($query);
    if($oglas = $res->fetch_object()){
      $stOgledov = $oglas->oglediCount + 1; // pristejemo en ogled oglasa.
      $query = "UPDATE `ads` SET `oglediCount` = $stOgledov WHERE `ads`.`id` = $id;";
      App::get('database')->executeCustomQuery($query);
      return $oglas;
    }
    return null;
  }

  public static function delete($id)
  {
    //TODO preveri ce je prijavljen uporabnik lastnik oglasa, preden ga zbrises.

    $id = App::get('database')->sanitizeString($id);
    $query = "DELETE FROM ads WHERE id='$id'";
    App::get('database')->executeCustomQuery($query);
  }

  public static function sort($oglasi)
  {
    usort($oglasi, function($b, $a) {
      return strtotime($a->datum_zapadlosti) - strtotime($b->datum_zapadlosti);
    });

    return $oglasi;
  }

  public static function update($newTitle, $id, $newDescription)
  {
    $newDateExpiry = date('Y-m-d H:i:s', strtotime(
      date('Y-m-d H:i:s') . ' + 30 days'
    ));    
    
    $newTitle       = App::get('database')->sanitizeString($newTitle);
    $newDescription = App::get('database')->sanitizeString($newDescription);

    $query = "UPDATE `ads` SET `title` = '$newTitle', description = '$newDescription', `datum_zapadlosti` = '$newDateExpiry' WHERE id='$id'";
    
    App::get('database')->executeCustomQuery($query);
  }

  public static function insert($title, $desc, $img)
  {
    $title = App::get('database')->sanitizeString($title);
    $desc = App::get('database')->sanitizeString($desc);
    $user_id = $_SESSION["USER_ID"];
    $date = date('Y-m-d H:i:s');
    $dateExpiry = date('Y-m-d H:i:s', strtotime($date. ' + 30 days'));

    //Preberemo vsebino (byte array) slike
    $img_file = file_get_contents($img["tmp_name"]);
    //Pripravimo byte array za pisanje v bazo (v polje tipa LONGBLOB)
    $img_file = App::get('database')->sanitizeString($img_file);
    
    $query = "INSERT INTO `ads` (`title`, `description`, `user_id`, `image`, `datum_oddaje`, `datum_zapadlosti`)
          VALUES('{$title}', '{$desc}', '{$user_id}', '{$img_file}', '{$date}', '{$dateExpiry}');";
    App::get('database')->executeCustomQuery($query);
  }

  public static function last()
  {
    //poizvedba, za dobit zadnji oglas dodan v podatkovno bazo
    $query = "SELECT * FROM `ads` ORDER BY id DESC LIMIT 1;";
    return App::get('database')->executeCustomQuery($query)->fetch_object();
  }
}