<div class="container">
  <nav class="navbar navbar-expand-sm bg-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="\">Domov</a>
      </li>

      <?php	if(isset($_SESSION["USER_ID"])){ ?>
        <li class="nav-item">
          <a class="nav-link" href="objavi">Objavi oglas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="odjava">Odjava</a>
        </li>
        <li class="nav-item">
          <a class="nav-link"href="mojiOglasi">Moji oglasi</a>
        </li>
      <?php } else{ ?>
        <li class="nav-item">
          <a class="nav-link" href="prijava">Prijava</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="registracija">Registracija</a>
        </li>
      <?php	}	?>

    </ul>
  </nav>
</div>