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
}