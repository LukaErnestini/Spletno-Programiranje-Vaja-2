<?php

namespace App\Models;

use App\Core\App;
use App\Models\Category;

class Oglas
{
  public static function get_oglasi($kategorija, $searchQuery)
  {
    $kategorija = App::get('database')->sanitizeString($kategorija);
    $searchQuery = App::get('database')->sanitizeString($searchQuery);
    
    $query = "SELECT * FROM ads";
    if ($kategorija != '*'){
      $seznamKategorij = Category::ustvariSeznamPodkategorij($kategorija);
      $query = $query . " INNER JOIN ads_categories ON ads.id=ads_categories.ads_id WHERE (ads_categories.categories_id='$kategorija'";
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

  //Funkcija izbere oglas s podanim ID-jem. Doda tudi uporabnika, ki je objavil oglas.
  public static function get_oglas($id)
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
}