<?php require('partials/head.php') ?>

<div class="container">
  <h2>Objavi oglas</h2>
  <form action="objavi" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="naslov">Naslov:</label>
      <input type="text" name="title" id="naslov" class="form-control"/>
    </div>
    <div class="form-group">
      <label for="opis">Vsebina</label>
      <textarea name="description" rows="10" cols="50" id="opis" class="form-control" ></textarea>
    </div>
    <div class="form-group">
      <label for="slika">Glavna slika</label>
      <input type="file" name="mainimage" id="slika" class="form-control-file" required />
      <label for="slike">Ostale slike</label>
      <input type="file" name="images[]" id="slike" class="form-control-file" multiple />
    </div>
    <div class="form-group">
      <label for="kategorija">Kategorija</label>
      <select multiple name="categoryMultiple[]" class="form-control" id="kategorijaMulti">
        <?php echo App\Models\Category::categoryTree(); ?>
      </select>
    </div>
    <button type="submit" class="btn btn-primary" name="poslji">Objavi</button>
    <label><?php echo $error; ?></label>
  </form>
<div class="container">

<?php require('partials/footer.php') ?>