<?php include '../navbar.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>API de Edad (Agify.io)</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
      max-width: 500px;
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
      transition: background 0.3s ease;
    }

    .btn-gradient:hover {
      background: linear-gradient(135deg, #8ec5fc 0%, #e0c3fc 100%);
    }

    .result {
      background-color: rgba(255, 255, 255, 0.5);
      padding: 20px;
      margin-top: 20px;
      border-radius: 15px;
      text-align: center;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    h2 {
      color: #333;
      font-weight: bold;
      text-shadow: 1px 1px 2px rgba(255,255,255,0.4);
    }

    input::placeholder {
      color: #999;
      font-style: italic;
    }
  </style>
</head>
<body>

<div class="container content">
  <h2 class="mb-4">🔍 Estima tu Edad con Agify.io</h2>

  <div class="glass-card">
    <form method="GET">
      <div class="input-group mb-3">
        <input type="text" name="name" class="form-control" placeholder="Ingresa un nombre" required>
        <button class="btn btn-gradient" type="submit">Consultar</button>
      </div>
    </form>

    <?php
    if (isset($_GET['name'])) {
      $name = htmlspecialchars($_GET['name']);

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, "https://api.agify.io?name=" . urlencode($name));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($ch);

      if ($response === false) {
        echo "<div class='alert alert-danger mt-3'>❌ Error en la petición: " . curl_error($ch) . "</div>";
      } else {
        $data = json_decode($response, true);
        if (isset($data['age'])) {
          echo "
            <div class='result'>
              <h5>📛 Nombre: <strong>{$data['name']}</strong></h5>
              <h5>🎂 Edad estimada: <strong>{$data['age']} años</strong></h5>
            </div>
          ";
        } else {
          echo "<div class='alert alert-warning mt-3'>⚠️ No se pudo estimar la edad.</div>";
        }
      }

      curl_close($ch);
    }
    ?>
  </div>
</div>

</body>
</html>
