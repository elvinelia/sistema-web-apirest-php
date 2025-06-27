<?php include '../navbar.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>API de Género (Genderize.io)</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    :root {
      --glass-bg: rgba(255, 255, 255, 0.15);
      --glass-border: rgba(255, 255, 255, 0.3);
      --accent-color: #f093fb;
      --gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }

    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, rgba(64, 136, 218, 0.94), rgb(163, 69, 135)),
                  radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.1), transparent 50%),
                  radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1), transparent 50%);
      background-blend-mode: screen;
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
      flex-direction: column;
      align-items: center;
      padding: 30px;
    }

    .glass-card {
      background: var(--glass-bg);
      border: 1px solid var(--glass-border);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      padding: 30px;
      max-width: 600px;
      width: 100%;
      box-shadow: 0 8px 24px rgba(0,0,0,0.2);
      transition: transform 0.3s ease;
    }

    .glass-card:hover {
      transform: scale(1.02);
    }

    .btn-gradient {
      background: var(--gradient);
      border: none;
      color: #fff;
      font-weight: bold;
    }

    .btn-gradient:hover {
      background: linear-gradient(135deg, #c471ed 0%, #f64f59 100%);
    }

    h2 {
      color: #fff;
      font-weight: bold;
      margin-bottom: 25px;
      text-shadow: 1px 1px 5px rgba(0,0,0,0.3);
    }

    .result-box {
      background-color: rgba(255,255,255,0.8);
      padding: 20px;
      margin-top: 20px;
      border-radius: 16px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .emoji {
      font-size: 1.5rem;
    }
  </style>
</head>
<body>

<div class="container content">
  <h2>🔎 Descubre el Género </h2>

  <div class="glass-card">
    <form method="GET">
      <div class="input-group mb-3">
        <input type="text" name="name" class="form-control" placeholder="Ingresa un nombre" required />
        <button class="btn btn-gradient" type="submit">Consultar</button>
      </div>
    </form>

    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    function getGenderizeData($name) {
        $url = "https://api.genderize.io/?name=" . urlencode($name);
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

    if (isset($_GET['name'])) {
      $name = trim($_GET['name']);
      $data = getGenderizeData($name);

      if (isset($data['error'])) {
        echo "<div class='alert alert-danger mt-3'>❌ Error en la consulta: " . htmlspecialchars($data['error']) . "</div>";
      } elseif ($data && isset($data['gender']) && $data['gender'] !== null) {
        echo "<div class='result-box'>";
        echo "<p><strong>📛 Nombre:</strong> " . htmlspecialchars($data['name']) . "</p>";

        if ($data['gender'] === 'male') {
          echo "<p><strong>🧑 Género:</strong> Es hombre <span class='emoji'>💙</span></p>";
        } elseif ($data['gender'] === 'female') {
          echo "<p><strong>👩 Género:</strong> Es mujer <span class='emoji'>💖</span></p>";
        } else {
          echo "<p><strong>Género:</strong> " . htmlspecialchars($data['gender']) . "</p>";
        }

        echo "<p><strong>📊 Probabilidad:</strong> " . htmlspecialchars($data['probability']) . "</p>";
        echo "</div>";
      } else {
        echo "<div class='alert alert-warning mt-3'>⚠️ No se pudo determinar el género para el nombre ingresado.</div>";
      }
    }
    ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
