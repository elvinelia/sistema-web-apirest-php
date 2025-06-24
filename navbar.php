<?php
  // Obtengo el nombre del archivo actual, p.ej. 'acerca.php'
  $current = basename($_SERVER['PHP_SELF']);
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand <?= $current=='index.php' ? 'active' : '' ?>" href="index.php">Mi Portal Web</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false"
            aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link <?= $current=='acerca.php' ? 'active' : '' ?>"
             href="acerca.php">Acerca de</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $current=='contacto.php' ? 'active' : '' ?>"
             href="contacto.php">Contacto</a>
        </li>
        <!-- Añade aquí tus otros 8 links -->
      </ul>
    </div>
  </div>
</nav>
