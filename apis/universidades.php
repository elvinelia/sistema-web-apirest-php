<?php include '../navbar.php'; ?>
<h2>API de Universidades</h2>

<form method="GET" class="mb-3">
  <input type="text" name="pais" placeholder="Ej: Mexico" required class="form-control w-50 d-inline-block" />
  <button class="btn btn-primary" type="submit">Buscar</button>
</form>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

function getUniversidadesPorPais($pais) {
  $url = "http://universities.hipolabs.com/search?country=" . urlencode($pais);

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  // Si usas HTTPS y no tienes certificado válido, puedes agregar:
  // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

  $response = curl_exec($ch);

  if ($response === false) {
    $error = curl_error($ch);
    curl_close($ch);
    return ['error' => $error];
  }

  curl_close($ch);
  return json_decode($response, true);
}

if (isset($_GET['pais'])) {
  $pais = trim($_GET['pais']);
  $data = getUniversidadesPorPais($pais);

  if (isset($data['error'])) {
    echo "<div class='alert alert-danger'>Error al consultar la API: " . htmlspecialchars($data['error']) . "</div>";
  } elseif (is_array($data) && count($data) > 0) {
    echo "<ul class='list-group'>";
    foreach ($data as $uni) {
      $nombre = htmlspecialchars($uni['name']);
      $url = htmlspecialchars($uni['web_pages'][0]);
      echo "<li class='list-group-item'>$nombre - <a href='$url' target='_blank'>Sitio web</a></li>";
    }
    echo "</ul>";
  } else {
    echo "<div class='alert alert-warning'>No se encontraron universidades para el país ingresado.</div>";
  }
}
?>

