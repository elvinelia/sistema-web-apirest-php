<?php include '../navbar.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>API de Universidades</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    :root {
      --glass-bg: rgba(255, 255, 255, 0.15);
      --glass-border: rgba(255, 255, 255, 0.25);
      --accent-color: #00b4d8;
      --gradient: linear-gradient(135deg, #a1c4fd 0%, #c2e9fb 100%);
    }

    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: radial-gradient(circle at 10% 20%, rgba(0, 183, 255, 0.1), transparent 60%),
                  radial-gradient(circle at 90% 80%, rgba(255, 0, 150, 0.1), transparent 60%),
                  linear-gradient(135deg, #fdfcfb 0%, #e2d1c3 100%);
      background-attachment: fixed;
      min-height: 100vh;
    }

    .navbar {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      z-index: 1000;
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

    .btn-gradient {
      background: var(--gradient);
      border: none;
      color: #000;
      font-weight: bold;
    }

    .btn-gradient:hover {
      background: linear-gradient(135deg, #8ec5fc 0%, #e0c3fc 100%);
    }

    h2 {
      color: #333;
      font-weight: bold;
      text-shadow: 1px 1px 2px rgba(255,255,255,0.4);
      margin-bottom: 25px;
    }

    .result {
      background-color: rgba(255, 255, 255, 0.8);
      padding: 20px;
      margin-top: 20px;
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .university {
      margin-bottom: 10px;
      padding: 10px;
      background: #f8f9fa;
      border-radius: 12px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .university a {
      text-decoration: none;
      font-weight: bold;
      color: #0d6efd;
    }

    .university a:hover {
      color: #6610f2;
    }
  </style>
</head>
<body>

<div class="container content">
  <h2>🎓 Universidades por País</h2>

  <div class="glass-card">
    <form method="GET">
      <div class="input-group mb-3">
        <input type="text" name="pais" class="form-control" placeholder="Ej: Argentina, México, España..." required />
        <button class="btn btn-gradient" type="submit">Buscar</button>
      </div>
    </form>

    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    function getUniversidadesPorPais($pais) {
      $url = "http://universities.hipolabs.com/search?country=" . urlencode($pais);
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($ch);

      if ($response === false) {
        return ['error' => curl_error($ch)];
      }

      curl_close($ch);
      return json_decode($response, true);
    }

    if (isset($_GET['pais'])) {
      $pais = trim($_GET['pais']);
      $data = getUniversidadesPorPais($pais);

      if (isset($data['error'])) {
        echo "<div class='alert alert-danger mt-3'>❌ Error al consultar la API: " . htmlspecialchars($data['error']) . "</div>";
      } elseif (is_array($data) && count($data) > 0) {
        echo "<div class='result'>";
        echo "<h5>🔍 Universidades encontradas en <strong>" . htmlspecialchars($pais) . "</strong>:</h5><hr>";
        foreach ($data as $uni) {
          $nombre = htmlspecialchars($uni['name']);
          $url = htmlspecialchars($uni['web_pages'][0]);
          echo "<div class='university'>🏫 $nombre <br><a href='$url' target='_blank'>🌐 Visitar sitio web</a></div>";
        }
        echo "</div>";
      } else {
        echo "<div class='alert alert-warning mt-3'>⚠️ No se encontraron universidades para el país ingresado.</div>";
      }
    }
    ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
