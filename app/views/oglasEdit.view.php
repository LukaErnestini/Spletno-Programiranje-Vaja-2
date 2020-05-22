<?php require('partials/head.php') ?>

<div class="container">
  <form action="oglasEdit" method="POST">
    <div class="form-group">
      <label for="naslov">Naslov:</label>
      <input class="form-control" id="naslov" type="text" name="newTitle" value="<?php echo $oglas->title;?>"/> <br/>
    </div>
    <div class="form-group">
      <label for="vsebina">Vsebina:</label>
      <textarea class="form-control" name="newDescription" rows="10" cols="50"><?php echo $oglas->description;?></textarea> <br/>
    </div>
    <button id="vsebina" type="submit" class="btn btn-primary" name="spremeni">Spremeni</button>
    <input name="id" type="hidden" readonly="readonly" value="<?php echo $oglas->id; ?>"/> <br>
  </form>
</div>

<?php require('partials/footer.php') ?>