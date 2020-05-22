<?php require('partials/head.php') ?>

<div class="container">
	<form action="" method="GET">

		<label>Prikaži zapadle</label>
    <input type="checkbox" name="skrijZapadle" value="Yes"
      <?php if(isset($_GET['skrijZapadle'])) echo "checked='checked'"; ?>>

		<label>Kategorija</label>
		<select name="category">
      <option value="*" 
        <?php if(isset($_POST['category']) && $_POST['category'] == '*')
          echo "selected='selected'";
        ?>
      >Vse
      </option>
			  <?php App\Models\Category::categoryTree($kategorijaID); ?>
    </select>
    
    <input type="text" name="searchQuery" placeholder="Iskalni niz" 
      <?php if(isset($_GET['searchQuery'])) echo 'value="' . $_GET['searchQuery'] . '"' ?>
    >
    
    <button type="submit" class="btn btn-primary">Potrdi</button>
    
  </form>
</div>

<?php
//Izpiši oglase
//Doda link z GET parametrom id na oglasi.php za gumb 'Preberi več'
foreach($oglasi as $oglas)
{
	//Izpišemo samo tiste oglase, ki so bili osveženi zadnjih trideset dni, če je checkbox ticked
	$skrij = true;
	if (isset($_GET['skrijZapadle']) && $_GET['skrijZapadle'] == 'Yes'){
		$skrij = true;
	}
	else{
		$skrij = false;
  }
  
  if (time() < strtotime($oglas->datum_zapadlosti) || $skrij != false)
  {
		//Base64 koda za sliko (hexadecimalni zapis byte-ov iz datoteke)
		$img_data = base64_encode($oglas->image);
?>

    <div class="container">
			<div class="col-3">	
				<h4>
					<a href="oglas?id=<?= $oglas->id;?>"><?= $oglas->title; ?></a>
				</h4>

				<a href="oglas?id=<?= $oglas->id;?>">
				  <img src="data:image/jpg;base64, <?= $img_data;?>" class="img-fluid" alt="slika oglasa" />	
				</a>
				
				<p>
					<?= $oglas->datum_oddaje?>
					<br />
					Ogledov: <?= $oglas->oglediCount?>
				</p>
			</div>
		</div>

<?php
  }
}

require('partials/footer.php') ?>