<?php include '../navbar.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>API de País - RestCountries</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
  body {
    background: linear-gradient(135deg, #e9eff5, #ffffff);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
  }

  h2 {
    text-align: center;
    margin: 40px 20px 20px;
    font-size: 2rem;
    color: #2c3e50;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
  }

  form {
    max-width: 550px;
    margin: 30px auto;
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    justify-content: center;
    background: #ffffff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
  }

  form input[type="text"] {
    flex: 1 1 250px;
    padding: 10px;
    border: 1px solid #ced4da;
    border-radius: 8px;
    font-size: 1rem;
  }

  form button {
    padding: 10px 20px;
    background-color: #0d6efd;
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.3s ease;
  }

  form button:hover {
    background-color: #084cdf;
  }

  .card {
    max-width: 600px;
    margin: 40px auto;
    border: none;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    background: white;
    animation: fadeIn 0.5s ease;
  }

  .card-header {
    background: linear-gradient(90deg, #0d6efd, #6610f2);
    color: white;
    padding: 15px;
    font-size: 1.3rem;
    font-weight: bold;
    text-align: center;
  }

  .card-body {
    padding: 25px;
  }

  .card-title {
    font-size: 1.2rem;
    margin-bottom: 10px;
    color: #2c3e50;
  }

  .card-text {
    font-size: 1rem;
    color: #495057;
  }

  .card img {
    margin-top: 20px;
    max-width: 100%;
    height: auto;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  }

  .alert {
    max-width: 600px;
    margin: 20px auto;
    text-align: center;
    font-size: 1.1rem;
  }

  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
  }
</style>

</head>
<body>

<h2> Países </h2>

<form method="GET">
  <input type="text" name="pais" class="form-control" placeholder="Ej: Colombia" required
         value="<?= isset($_GET['pais']) ? htmlspecialchars($_GET['pais']) : '' ?>">
  <button class="btn btn-primary">Buscar</button>
</form>

<?php
if (isset($_GET['pais'])) {
  $pais = trim($_GET['pais']);
  $url = "https://restcountries.com/v3.1/name/" . urlencode($pais);

  // Inicializar cURL
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_TIMEOUT, 10);
  $response = curl_exec($ch);

  if (curl_errno($ch)) {
    echo "<div class='alert alert-danger text-center'>Error al conectar con la API: " . curl_error($ch) . "</div>";
  } else {
    $data = json_decode($response, true);
    if (is_array($data) && isset($data[0])) {
      $paisData = $data[0];
      $nombre = $paisData['name']['common'] ?? 'Desconocido';
      $capital = $paisData['capital'][0] ?? 'No disponible';
      $region = $paisData['region'] ?? 'No disponible';
      $bandera = $paisData['flags']['png'] ?? '';

      echo "
      <div class='card'>
        <div class='card-header text-white bg-primary'>
          Información de {$nombre}
        </div>
        <div class='card-body'>
          <h5 class='card-title'>Capital: {$capital}</h5>
          <p class='card-text'>Región: {$region}</p>
          <img src='{$bandera}' alt='Bandera de {$nombre}' class='img-fluid'>
        </div>
      </div>
      ";
    } else {
      echo "<div class='alert alert-warning text-center'>No se encontró información para <strong>" . htmlspecialchars($pais) . "</strong>.</div>";
    }
  }

  curl_close($ch);
}
?>

</body>
</html>
