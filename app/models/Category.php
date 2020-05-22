<?php

namespace App\Models;

use App\Core\App;

class Category
{

  protected $kategorija;
                      
  //generiranje drevesa za kategorije
  public static function categoryTree($kategorija, $parent = 0, $sub_mark = '')
  {

    $query = App::get('database')->executeCustomQuery("SELECT * FROM categories WHERE parent = $parent ORDER BY name ASC");

    if ($query->num_rows > 0){
      while ($row = $query->fetch_assoc()){
        echo '<option value="' . $row['category_id'] . '"';
        if($kategorija == $row['category_id']) echo " selected='selected'";
        echo '>' . $sub_mark.$row['name'] . '</option>';
        Category::categoryTree($kategorija, $row['category_id'], $sub_mark.'-');
      }
    }
  }

  public static function ustvariSeznamPodkategorij($rootKategorija)
  {

    $seznamPodkategorij = [];
  
    $querySeznam = "SELECT root.category_id  AS root_id,
                      down1.category_id AS down1_id,
                      down2.category_id AS down2_id
                    FROM categories AS root
                    LEFT OUTER JOIN categories AS down1 ON down1.parent = root.category_id
                    LEFT OUTER JOIN categories AS down2 ON down2.parent = down1.category_id
                    WHERE root.parent = 0
                    ORDER BY root_id, down1_id, down2_id";
    $tabelaKategorij = App::get('database')->executeCustomQuery($querySeznam);
  
    if ($tabelaKategorij->num_rows > 0){
      //Gledamo root kategorij
      while ($row = $tabelaKategorij->fetch_assoc()){
        if ($row['root_id'] == $rootKategorija){
          array_push($seznamPodkategorij, $row['root_id']);
          if ($row['down1_id'] != NULL)
            array_push($seznamPodkategorij, $row['down1_id']);
          if ($row['down2_id'] != NULL)
            array_push($seznamPodkategorij, $row['down2_id']);
        }
      }
  
      //Gledamo prvi nivo podkategorij če še ni blo zadetkov
      if (empty($seznamPodkategorij)){
        $tabelaKategorij->data_seek(0);
        while ($row = $tabelaKategorij->fetch_assoc()){
          //echo print_r($row) . "</br>";
          //echo "down1_id: " . $row['down1_id'] . " primerjamo z: " . $rootKategorija . "</br>";
          if ($row['down1_id'] == $rootKategorija){
            array_push($seznamPodkategorij, $row['down1_id']);
            //echo "PUSHALI SMO: " . $row['down1_id'] . "</br>";
            if ($row['down2_id'] != NULL)
              array_push($seznamPodkategorij, $row['down2_id']);
          }
        }
      }
  
      //Gledamo drugi nivo podkategorij, če še ni blo zadetkov
      if (empty($seznamPodkategorij)){
        $tabelaKategorij->data_seek(0);
        while ($row = $tabelaKategorij->fetch_assoc()){
          if ($row['down2_id'] == $rootKategorija){
            array_push($seznamPodkategorij, $row['down2_id']);
          }
        }
      }
    }
  
    return array_unique($seznamPodkategorij);
  }
}