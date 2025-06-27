<?php include '../navbar.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Generador de Imágenes - Unsplash API</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
/* General */
body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background: #f4f6f8;
  margin: 0;
  padding: 0;
}

/* Banner principal */
.banner {
  text-align: center;
  background: linear-gradient(90deg, #0d6efd, #6610f2);
  color: white;
  padding: 30px 20px;
  margin: 0;
  font-size: 2rem;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

/* Contenido */
.content {
  max-width: 1200px;
  margin: 30px auto;
  padding: 0 20px;
}

/* Formulario de búsqueda */
form {
  display: flex;
  justify-content: center;
  gap: 10px;
  flex-wrap: wrap;
  margin-bottom: 30px;
}

input[type="text"] {
  padding: 10px;
  font-size: 1rem;
  border-radius: 8px;
  border: 1px solid #ccc;
  width: 280px;
}

button {
  padding: 10px 20px;
  font-size: 1rem;
  background: #0d6efd;
  border: none;
  color: white;
  border-radius: 8px;
  transition: background 0.3s;
}

button:hover {
  background: #084cdf;
}

/* Mensajes */
.message {
  text-align: center;
  color: #dc3545;
  font-size: 1.2rem;
  margin-top: 20px;
}

/* Imágenes */
.image-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 20px;
}

.image-grid img {
  width: 100%;
  border-radius: 12px;
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
  transition: transform 0.3s, box-shadow 0.3s;
}

.image-grid img:hover {
  transform: scale(1.03);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.25);
}
</style>

</head>
<body>

<h2 class="banner">Generador de Imágenes - Unsplash API</h2>

<div class="content">
  <form method="GET">
    <input type="text" name="query" placeholder="Buscar imágenes..." required
      value="<?= isset($_GET['query']) ? htmlspecialchars($_GET['query']) : '' ?>">
    <button type="submit">Buscar</button>
  </form>

  <?php
  if (isset($_GET['query'])) {
    $query = urlencode($_GET['query']);
    $apiKey = "KuBehSt5n1_L0jTAV2p906IegqmOFi00PCbtLhoC3uw"; // ← Pon aquí tu Access Key de Unsplash

    // Inicializar cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.unsplash.com/search/photos?query=$query&client_id=$apiKey&per_page=24");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
      echo "<p class='message'>Error al conectar con la API: " . curl_error($ch) . "</p>";
    } else {
      $data = json_decode($response, true);
      if (isset($data['results']) && count($data['results']) > 0) {
        echo "<div class='image-grid'>";
        foreach ($data['results'] as $img) {
          $thumb = htmlspecialchars($img['urls']['small']);
          $alt = htmlspecialchars($img['alt_description'] ?? $query);
          echo "<img src='$thumb' alt='$alt'>";
        }
        echo "</div>";
      } else {
        echo "<p class='message'>No se encontraron imágenes para '<strong>" . htmlspecialchars($_GET['query']) . "</strong>'.</p>";
      }
    }
    curl_close($ch);
  }
  ?>
</div>

</body>
</html>
