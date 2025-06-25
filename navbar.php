<?php
  // Obtiene el nombre del archivo actual, p.ej. 'acerca.php'
$current = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand <?= $current == 'index.php' ? 'active' : '' ?>" href="index.php">Mi Portal Web</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false"
            aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link <?= $current == 'acerca.php' ? 'active' : '' ?>" href="acerca.php">Acerca de</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $current == 'contacto.php' ? 'active' : '' ?>" href="contacto.php">Contacto</a>
        </li>
        <li class="nav-item">
  <a class="nav-link <?= $current == 'genero.php' ? 'active' : '' ?>" href="api/genero.php">Género</a>
</li>
<li class="nav-item">
  <a class="nav-link <?= $current == 'edad.php' ? 'active' : '' ?>" href="api/edad.php">Edad</a>
</li>
<li class="nav-item">
  <a class="nav-link <?= $current == 'universidades.php' ? 'active' : '' ?>" href="api/universidades.php">Universidades</a>
</li>
<li class="nav-item">
  <a class="nav-link <?= $current == 'clima.php' ? 'active' : '' ?>" href="api/clima.php">Clima</a>
</li>
<li class="nav-item">
  <a class="nav-link <?= $current == 'pokemon.php' ? 'active' : '' ?>" href="api/pokemon.php">Pokémon</a>
</li>
<li class="nav-item">
  <a class="nav-link <?= $current == 'noticias.php' ? 'active' : '' ?>" href="api/noticias.php">Noticias</a>
</li>
<li class="nav-item">
  <a class="nav-link <?= $current == 'monedas.php' ? 'active' : '' ?>" href="api/monedas.php">Monedas</a>
</li>
<li class="nav-item">
  <a class="nav-link <?= $current == 'imagenes.php' ? 'active' : '' ?>" href="api/imagenes.php">Imágenes</a>
</li>
<li class="nav-item">
  <a class="nav-link <?= $current == 'pais.php' ? 'active' : '' ?>" href="api/pais.php">País</a>
</li>
<li class="nav-item">
  <a class="nav-link <?= $current == 'chistes.php' ? 'active' : '' ?>" href="api/chistes.php">Chistes</a>
</li>

      </ul>
    </div>
  </div>
</nav>
