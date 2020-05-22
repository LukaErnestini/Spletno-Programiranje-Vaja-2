<?php require('partials/head.php') ?>

<div class="container">
	<h2>Prijava</h2>
	<form action="/prijava" method="POST">
		<div class="form-group">
			<label for="username">Uporabniško ime</label>
			<input type="text" name="username" class="form-control" placeholder="Vpiši uporabniško ime" id="username"/>
		</div>
		<div class="form-group">
			<label for="password">Geslo</label>
			<input type="password" name="password" id="password" class="form-control" placeholder="Vpiši geslo"/>
		</div>
		<div class="form-group form-check">
			<label class="form-check-label">
				<input class="form-check-input" type="checkbox"> Zapomni si me
			</label>
		</div>
		<button type="submit" class="btn btn-primary" name="poslji">Vpis</button>
		<label><?= $error; ?></label>
	</form>
</div>

<?php require('partials/footer.php') ?>