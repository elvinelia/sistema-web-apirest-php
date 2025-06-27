<?php include '../navbar.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>API del Clima - OpenWeatherMap</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    :root {
      --glass-bg: rgba(255, 255, 255, 0.15);
      --glass-border: rgba(255, 255, 255, 0.25);
      --gradient: linear-gradient(135deg, #89f7fe 0%, #66a6ff 100%);
    }

    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #c3ecfd, #a7bfe8),
                  radial-gradient(circle at 10% 80%, rgba(255,255,255,0.2), transparent 60%),
                  radial-gradient(circle at 90% 20%, rgba(255,255,255,0.2), transparent 60%);
      background-attachment: fixed;
      min-height: 100vh;
    }

    .content {
      margin-top: 100px;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      padding: 30px;
    }

    .glass-card {
      background: var(--glass-bg);
      border: 1px solid var(--glass-border);
      backdrop-filter: blur(12px);
      border-radius: 20px;
      padding: 30px;
      max-width: 600px;
      width: 100%;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
      transition: transform 0.3s ease;
    }

    .glass-card:hover {
      transform: scale(1.02);
    }

    h2 {
      color: #1d3557;
      font-weight: bold;
      margin-bottom: 25px;
    }

    .btn-gradient {
      background: var(--gradient);
      border: none;
      color: #000;
      font-weight: bold;
    }

    .btn-gradient:hover {
      background: linear-gradient(135deg, #8ec5fc 0%, #e0c3fc 100%);
    }

    .weather-result {
      background-color: rgba(255,255,255,0.8);
      padding: 20px;
      margin-top: 20px;
      border-radius: 15px;
      text-align: center;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .weather-icon {
      font-size: 3rem;
    }
  </style>
</head>
<body>

<div class="container content">
  <h2>🌤️ Consulta el Clima</h2>

  <div class="glass-card">
    <form method="GET">
      <div class="input-group mb-3">
        <input type="text" name="ciudad" class="form-control" placeholder="Ej: Santo Domingo, Madrid..." required />
        <button class="btn btn-gradient" type="submit">Consultar</button>
      </div>
    </form>

    <?php
    if (isset($_GET['ciudad'])) {
      $ciudad = trim($_GET['ciudad']);
      $apiKey = "6c77c0380cd1f0afe908b08ff350740d"; 
      $url = "https://api.openweathermap.org/data/2.5/weather?q=" . urlencode($ciudad) . "&appid=$apiKey&units=metric&lang=es";

      // Usar cURL
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($ch);

      if ($response === false) {
        echo "<div class='alert alert-danger mt-3'>❌ Error en la consulta: " . curl_error($ch) . "</div>";
      } else {
        $data = json_decode($response, true);

        // Mostrar datos devueltos (opcional para depurar)
        // echo "<pre>"; print_r($data); echo "</pre>";

        if (isset($data['cod']) && $data['cod'] == 200) {
          $nombre = $data['name'];
          $temp = $data['main']['temp'];
          $descripcion = ucfirst($data['weather'][0]['description']);
          $icono = $data['weather'][0]['icon'];
          $iconURL = "https://openweathermap.org/img/wn/{$icono}@2x.png";

          echo "
            <div class='weather-result'>
              <h4>📍 Clima en <strong>$nombre</strong></h4>
              <img src='$iconURL' alt='icono clima' class='weather-icon'>
              <p><strong>🌡️ Temperatura:</strong> $temp °C</p>
              <p><strong>⛅ Estado:</strong> $descripcion</p>
            </div>
          ";
        } else {
          $errorMensaje = isset($data['message']) ? htmlspecialchars($data['message']) : 'Respuesta inválida';
          echo "<div class='alert alert-warning mt-3'>⚠️ Error: $errorMensaje</div>";
        }
      }

      curl_close($ch);
    }
    ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
