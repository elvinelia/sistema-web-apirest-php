<?php include '../navbar.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>API de Género (Genderize.io)</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
   /* Tu CSS aquí */
   :root {
    --primary-color: #0d6efd;
    --secondary-color: #6c757d;
    --success-color: #198754;
    --danger-color: #dc3545;
    --warning-color: #ffc107;
    --info-color: #0dcaf0;
    --light-color: #f8f9fa;
    --dark-color: #212529;
    --gradient-primary: linear-gradient(135deg,rgb(48, 62, 124) 0%,rgb(37, 39, 107) 100%);
    --gradient-secondary: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    --gradient-success: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    --shadow-sm: 0 2px 4px rgba(0,0,0,0.1);
    --shadow-md: 0 4px 6px rgba(0,0,0,0.1);
    --shadow-lg: 0 10px 15px rgba(0,0,0,0.1);
    --shadow-xl: 0 20px 25px rgba(0,0,0,0.1);
    --border-radius: 12px;
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  }
    body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  line-height: 1.6;
  color: var(--dark-color);
  background: linear-gradient(135deg, rgba(74, 144, 226, 0.3), rgba(233, 78, 119, 0.3)), 
              radial-gradient(circle at 20% 80%, rgba(55, 53, 126, 0.2), transparent 50%),
              radial-gradient(circle at 80% 20%, rgba(255, 192, 203, 0.2), transparent 50%);
  background-blend-mode: screen;
  background-attachment: fixed;
  min-height: 100vh;
  padding-top: 80px; /* deja espacio si el navbar es fijo */
  margin: 0;
  position: relative;
}


  </style>
</head>
<body>

<div class="container mt-4">
  <h2 class="mb-3">API de Género (Genderize.io)</h2>

  <form method="GET" class="mb-3">
    <div class="input-group w-50">
      <input type="text" name="name" class="form-control" placeholder="Ingresa un nombre" required />
      <button class="btn btn-primary" type="submit">Consultar</button>
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

      // Para pruebas rápidas sin SSL (no recomendado en producción)
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

  if (isset($_GET['name'])) {
    $name = trim($_GET['name']);
    $data = getGenderizeData($name);

    if (isset($data['error'])) {
      echo "<div class='alert alert-danger'>Error en la consulta: " . htmlspecialchars($data['error']) . "</div>";
    } elseif ($data && isset($data['gender']) && $data['gender'] !== null) {
      echo "<div class='alert alert-info'>";
      echo "<p><strong>Nombre:</strong> " . htmlspecialchars($data['name']) . "</p>";

      // Mostrar "Es hombre" o "Es mujer"
      if ($data['gender'] === 'male') {
        echo "<p><strong>Género:</strong> Es hombre 💙</p>";
      } elseif ($data['gender'] === 'female') {
        echo "<p><strong>Género:</strong> Es mujer 💖 </p>";
      } else {
        echo "<p><strong>Género:</strong> " . htmlspecialchars($data['gender']) . "</p>";
      }

      echo "<p><strong>Probabilidad:</strong> " . htmlspecialchars($data['probability']) . "</p>";
      echo "</div>";
    } else {
      echo "<div class='alert alert-warning'>No se pudo determinar el género para el nombre ingresado.</div>";
    }
  }
  ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
