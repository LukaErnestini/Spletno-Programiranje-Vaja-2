<?php require('partials/head.php') ?>

<div class="container">
	<h2>Registracija</h2>
	<form action="registracija" method="POST">
		<div class="form-group">
			<label for="username">Uporabniško ime*</label>
			<input class="form-control" type="text" name="username" id="username" required/>
		</div>
		<div class="form-group">
			<label for="password">Geslo*</label>
			<input class="form-control" type="password" name="password" id="password" required/>
		</div>
		<div class="form-group">
			<label for="passwordRepeat" >Ponovi geslo*</label>
			<input class="form-control" type="password" name="repeat_password" id="passwordRepeat" required/>
		</div>
		<div class="form-group">	
			<label for="email">Elektronski naslov*</label>
			<input class="form-control" type="text" name="email" id="email" required/>
		</div>
		<div class="form-group">
			<label for="name">Ime*</label>
			<input class="form-control" type="text" name="ime" id="name" required/>
		</div>
		<div class="form-group">
			<label for="surname">Priimek*</label>
			<input class="form-control" type="text" name="priimek" id="surname" required/>
		</div>

		<!-- neobvezni podatki -->
		<div class="form-group">
			<label for="naslov">Naslov</label>
			<input class="form-control" type="text" name="naslov" id="naslov" />
		</div>
		<div class="form-group">
			<label for="posta">Pošta</label>
			<input class="form-control" type="text" name="posta" id="posta" />
		</div>
		<div class="form-group">
			<label for="tel">Telefonska številka</label>
			<input class="form-control" type="text" name="tel" id="tel" />
		</div>
		<div class="form-group">
			<label for="starost">Starost</label>
			<input class="form-control" type="number" name="starost" id="starost" /> <br/>
		</div>
		<div class="form-group">
			<label>Spol</label><br>
			<div class="form-check">			
				<input class="form-check-input" type="radio" name="spol" value="m"/> Moški<br/>
				<input class="form-check-input" type="radio" name="spol" value="f"/> Ženska<br/>
				<input class="form-check-input" type="radio" name="spol" value="x" checked/> Ne želim povedati<br/>
			</div>
		</div>
		<button type="submit" class="btn btn-primary" name="poslji">Potrdi</button>
		
		<label><?php echo $error; ?></label>
	</form>
</div>

<?php require('partials/footer.php') ?>