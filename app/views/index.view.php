<?php require('partials/head.php') ?>

<div class="container">
	<form action="index.php" method="GET">
		<label>Prikaži zapadle</label>
    <input type="checkbox" name="skrijZapadle" value="Yes"
      <?php if(isset($_POST['skrijZapadle'])) echo "checked='checked'"; ?>>
		<label>Kategorija</label>
		<select name="category">
			<option value="*" <?php if(isset($_POST['category']) && $_POST['category'] == '*') echo "selected='selected'"; ?>>Vse</option>
			<?php //echo categoryTree(); ?>
		</select>
		<input type="text" name="searchQuery" placeholder="Iskalni niz" >
		<button type="submit" class="btn btn-primary" name="potrdi">Potrdi</button>
	</form>
</div>

<?php require('partials/footer.php') ?>