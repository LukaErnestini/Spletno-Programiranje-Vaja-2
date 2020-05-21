<div class="container">
  <nav class="navbar navbar-expand-sm bg-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="">Domov</a>
      </li>

      <?php	if(isset($_SESSION["USER_ID"])){ ?>
        <li class="nav-item">
          <a class="nav-link" href="objavi.php">Objavi oglas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="odjava.php">Odjava</a>
        </li>
        <li class="nav-item">
          <a class="nav-link"href="mojiOglasi.php">Moji oglasi</a>
        </li>
      <?php } else{ ?>
        <li class="nav-item">
          <a class="nav-link" href="prijava.php">Prijava</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="registracija.php">Registracija</a>
        </li>
      <?php	}	?>

    </ul>
  </nav>
</div>