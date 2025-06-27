<?php include '../navbar.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Pokédex API</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    :root {
      --gradient-primary: linear-gradient(135deg, #ffcb05 0%, #3b4cca 100%);
      --gradient-success: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
      --shadow-lg: 0 8px 20px rgba(0,0,0,0.15);
      --border-radius: 14px;
      --transition: all 0.3s ease;
    }

    body {
      margin: 0;
      background: #f4f6f9;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: #333;
    }

    .header {
      background: var(--gradient-primary);
      color: white;
      padding: 20px 0;
      text-align: center;
      box-shadow: var(--shadow-lg);
      border-bottom-left-radius: var(--border-radius);
      border-bottom-right-radius: var(--border-radius);
    }

    .header h1 {
      margin: 0;
      font-size: 2.3rem;
      font-weight: bold;
      letter-spacing: 1px;
      text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
    }

    .container {
      padding: 30px 15px;
    }

    .form-inline {
      display: flex;
      max-width: 600px;
      margin: 0 auto 30px;
      gap: 10px;
    }

    .form-control {
      flex: 1;
      border-radius: var(--border-radius);
      border: 2px solid #3b4cca;
    }

    .btn-primary {
      background: var(--gradient-primary);
      border: none;
      color: white;
      font-weight: bold;
      border-radius: var(--border-radius);
      transition: var(--transition);
    }

    .btn-primary:hover {
      background: #3b4cca;
    }

    .result-card {
      background: white;
      border-radius: var(--border-radius);
      padding: 25px;
      max-width: 600px;
      margin: 0 auto 20px;
      text-align: center;
      box-shadow: var(--shadow-lg);
      border: 2px solid #3b4cca;
    }

    .result-card img {
      width: 140px;
      margin-bottom: 15px;
    }

    .result-card h2 {
      font-size: 1.8rem;
      margin-bottom: 15px;
      color: #3b4cca;
      text-transform: capitalize;
    }

    .alert {
      max-width: 600px;
      margin: 20px auto;
    }

    @media (max-width: 768px) {
      .form-inline {
        flex-direction: column;
      }

      .form-control, .btn-primary {
        border-radius: var(--border-radius);
        margin: 5px 0;
      }
    }
  </style>
</head>

<body>

<div class="header">
  <h1>Pokédex</h1>
</div>

<div class="container">
  <form method="GET" class="form-inline">
    <input type="text" name="nombre" class="form-control" placeholder="Ej: pikachu, charizard..." required>
    <button type="submit" class="btn btn-primary">🔍 Buscar</button>
  </form>

  <?php
  if (isset($_GET['nombre'])) {
    $nombre = strtolower(trim($_GET['nombre']));
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://pokeapi.co/api/v2/pokemon/{$nombre}");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $response = curl_exec($ch);

    if ($response === false) {
      echo "<div class='alert alert-danger'>
              <strong>¡Oops!</strong> Error en la consulta: " . curl_error($ch) . "
            </div>";
    } else {
      $data = json_decode($response, true);

      if (isset($data['name'])) {
        echo "<div class='result-card'>
                <h2>" . htmlspecialchars($data['name']) . "</h2>
                <img src='" . htmlspecialchars($data['sprites']['front_default']) . "' alt='Imagen de " . htmlspecialchars($data['name']) . "'>
                <div class='mt-3'>
                  <p><strong>Altura:</strong> " . ($data['height'] / 10) . " m</p>
                  <p><strong>Peso:</strong> " . ($data['weight'] / 10) . " kg</p>
                  <p><strong>ID:</strong> #" . $data['id'] . "</p>
                </div>
              </div>";
      } else {
        echo "<div class='alert alert-warning'>
                <strong>¡Pokémon no encontrado!</strong>
                <br>Intenta con nombres en inglés como 'pikachu', 'bulbasaur', etc.
              </div>";
      }
    }
    curl_close($ch);
  }
  ?>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    form.addEventListener('submit', function() {
      const btn = form.querySelector('button');
      btn.innerHTML = '🔄 Buscando...';
    });
  });
</script>

</body>
</html>
