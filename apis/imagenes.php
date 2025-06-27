<?php include '../navbar.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Conversión de Monedas - ExchangeRate API</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    html, body {
      margin: 0; padding: 0; height: 100%;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
      color: white;
    }
    h2.banner {
      margin: 0;
      padding: 1rem 0;
      background: linear-gradient(90deg, #0052d4, #4364f7);
      position: fixed;
      top: 0; left: 0; right: 0;
      text-align: center;
      font-weight: 700;
      font-size: 1.75rem;
      box-shadow: 0 3px 10px rgba(0,0,0,0.3);
      z-index: 9999;
      letter-spacing: 2px;
    }
    .content {
      padding: 90px 20px 40px;
      max-width: 900px;
      margin: 0 auto;
    }
    ul {
      list-style: none;
      padding: 0;
      max-height: 500px;
      overflow-y: auto;
      border-radius: 12px;
      background: rgba(255, 255, 255, 0.1);
      box-shadow: 0 4px 12px rgba(67, 100, 247, 0.5);
    }
    li {
      padding: 12px 20px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.2);
      font-size: 1.2rem;
      transition: background 0.3s ease;
      cursor: default;
    }
    li:hover {
      background: rgba(67, 100, 247, 0.3);
    }
    .message {
      text-align: center;
      font-size: 1.2rem;
      color: #cce0ff;
      margin-top: 20px;
    }
    pre {
      background: rgba(0,0,0,0.4);
      padding: 1rem;
      border-radius: 8px;
      overflow-x: auto;
      color: #a6c8ff;
      font-size: 0.9rem;
    }
  </style>
</head>
<body>

<h2 class="banner">Conversión de Monedas - ExchangeRate API</h2>

<div class="content">
<?php
$apiKey = "TU_API_KEY"; // Cambia aquí por tu API key válida
$base = "USD";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://v6.exchangerate-api.com/v6/$apiKey/latest/$base");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
$response = curl_exec($ch);

if (curl_errno($ch)) {
  echo "<p class='message'>Error al conectar con la API: " . curl_error($ch) . "</p>";
} else {
  $data = json_decode($response, true);
  if (isset($data['conversion_rates']) && is_array($data['conversion_rates'])) {
    echo "<ul>";
    foreach ($data['conversion_rates'] as $currency => $rate) {
      echo "<li>1 $base = $rate $currency</li>";
    }
    echo "</ul>";
  } else {
    echo "<p class='message'>No se pudieron obtener las tasas de conversión.</p>";
    echo "<pre>" . htmlspecialchars($response) . "</pre>";
  }
}

curl_close($ch);
?>
</div>

</body>
</html>
