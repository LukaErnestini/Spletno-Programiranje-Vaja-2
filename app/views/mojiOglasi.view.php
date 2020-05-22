<?php require('partials/head.php') ?>

<?php foreach($oglasi as $oglas){ ?>

  <div class="container">
    <h4><?= $oglas->title; ?></h4>
    <p><?= $oglas->description; ?></p>
    <p><?= $oglas->datum_zapadlosti; ?></p>
    <a href="oglas?id=<?= $oglas->id; ?>">
      <button class="btn btn-primary">Preberi več</button>
    </a>
    <a href="oglasEdit?id=<?= $oglas->id; ?>">
      <button class="btn btn-primary">Spremeni</button>
    </a>
    <a href="mojiOglasi?deleteId=<?= $oglas->id; ?>">
      <button class="btn btn-danger">Izbriši</button>
    </a>
    <hr/>
  </div>

<?php } ?>

<?php require('partials/footer.php') ?>