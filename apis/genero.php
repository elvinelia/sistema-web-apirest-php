<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>API de Género (Genderize.io)</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
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

/* Reset y base */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  line-height: 1.6;
  color: var(--dark-color);
  background: linear-gradient(135deg,rgb(38, 45, 78) 0%,rgb(158, 160, 241) 100%);
  min-height: 100vh;
  position: relative;
}

/* Navbar */
.navbar {
  background: rgba(13, 110, 253, 0.95) !important;
  backdrop-filter: blur(10px);
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  box-shadow: var(--shadow-lg);
  transition: var(--transition);
  position: relative;
  overflow: hidden;
}

.navbar::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
  transition: left 0.5s;
}

.navbar:hover::before {
  left: 100%;
}

.navbar-brand {
  font-weight: 700;
  font-size: 1.5rem;
  color: white !important;
  text-decoration: none;
  position: relative;
  transition: var(--transition);
}

.navbar-brand::after {
  content: '';
  position: absolute;
  bottom: -2px;
  left: 0;
  width: 0;
  height: 2px;
  background: var(--gradient-success);
  transition: width 0.3s ease;
}

.navbar-brand:hover::after {
  width: 100%;
}

.nav-link {
  color: rgba(255, 255, 255, 0.9) !important;
  font-weight: 500;
  padding: 0.75rem 1rem !important;
  border-radius: 8px;
  transition: var(--transition);
  position: relative;
  overflow: hidden;
}

.nav-link::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: rgba(255, 255, 255, 0.1);
  transition: left 0.3s ease;
  z-index: -1;
}

.nav-link:hover {
  color: white !important;
  transform: translateY(-2px);
}

.nav-link:hover::before {
  left: 0;
}


  </style>
</head>
<body>


<?php include '../navbar.php'; ?>
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
      $response = @file_get_contents($url);
      if ($response === FALSE) {
          return null;
      }
      return json_decode($response, true);
  }

  if (isset($_GET['name'])) {
    $name = trim($_GET['name']);
    $data = getGenderizeData($name);

    if ($data && isset($data['gender']) && $data['gender'] !== null) {
      echo "<div class='alert alert-info'>";
      echo "<p><strong>Nombre:</strong> " . htmlspecialchars($data['name']) . "</p>";
      echo "<p><strong>Género:</strong> " . htmlspecialchars($data['gender']) . "</p>";
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
