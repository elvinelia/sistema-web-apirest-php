<?php include '../navbar.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>API de Chistes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #fdfbfb, #ebedee);
      font-family: 'Comic Sans MS', cursive, sans-serif;
      padding: 0;
      margin: 0;
    }

    h2 {
      text-align: center;
      margin: 40px 20px 20px;
      font-size: 2.5rem;
      color: #ff5733;
      text-shadow: 1px 1px 3px rgba(0,0,0,0.1);
    }

    .joke-card {
      max-width: 600px;
      margin: 40px auto;
      background: #fff9c4;
      border: 2px dashed #f39c12;
      border-radius: 20px;
      padding: 30px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      animation: bounceIn 0.6s ease-out;
    }

    .joke-card p {
      font-size: 1.4rem;
      text-align: center;
      color: #2c3e50;
    }

    .joke-card strong {
      display: block;
      margin-bottom: 15px;
      font-size: 1.6rem;
      color: #d35400;
    }

    @keyframes bounceIn {
      from {
        opacity: 0;
        transform: scale(0.8);
      }
      to {
        opacity: 1;
        transform: scale(1);
      }
    }

    .refresh-button {
      display: block;
      margin: 20px auto;
      text-align: center;
    }

    .refresh-button a {
      text-decoration: none;
      background-color: #f39c12;
      color: white;
      padding: 10px 20px;
      font-weight: bold;
      border-radius: 10px;
      transition: background 0.3s ease;
    }

    .refresh-button a:hover {
      background-color: #e67e22;
    }
  </style>
</head>
<body>

<h2>Chistes</h2>

<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://official-joke-api.appspot.com/random_joke");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);

$response = curl_exec($ch);

if (curl_errno($ch)) {
  echo "<div class='text-center text-danger'>Error al conectar con la API: " . curl_error($ch) . "</div>";
} else {
  $data = json_decode($response, true);
  if (isset($data['setup']) && isset($data['punchline'])) {
    echo "<div class='joke-card'>";
    echo "<p><strong>{$data['setup']}</strong></p>";
    echo "<p>{$data['punchline']}</p>";
    echo "</div>";
  } else {
    echo "<div class='text-center text-muted'>No se pudo obtener el chiste. 😞</div>";
  }
}

curl_close($ch);
?>

<div class="refresh-button">
  <a href="">Contar otro chiste 😄</a>
</div>

</body>
</html>
