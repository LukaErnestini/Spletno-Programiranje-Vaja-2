<?php require('partials/head.php') ?>

<div class="container">
	<h4><?= $oglas->title;?></h4>
	<p><?= $oglas->description;?></p>
	<p>Datum objave: <?= $oglas->datum_oddaje;?></p>
	<img src="data:image/jpg;base64, <?= base64_encode($oglas->image);?>" class="img-fluid" alt="slika oglasa" />

	<div class="container">
		<div class="row">
			<div class="row">
				<?php \App\Models\Image::getAll($oglasID);?>
			</div>
		</div>
	</div>

	<p>Objavil: <?= $oglas->username; ?></p>
	<p>Email: <?= $oglas->mail; ?></p>
	<p>Ogledov: <?= $oglas->oglediCount; ?></p>
	<a href="\">
		<button class="btn btn-primary">Nazaj</button>
	</a>
</div>

<?php require('partials/footer.php') ?>