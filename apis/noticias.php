<?php include '../navbar.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Noticias en Vivo - API NewsData.io</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(135deg, #232526 0%, #414345 100%);
      color: #f8f9fa;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    h2 {
      font-weight: bold;
      text-align: center;
      margin: 40px 0 20px;
      font-size: 2.5rem;
      color: #ffc107;
      text-shadow: 1px 1px 4px rgba(0,0,0,0.5);
    }

    .news-card {
      background: rgba(255,255,255,0.05);
      border: 1px solid rgba(255,255,255,0.1);
      border-radius: 12px;
      padding: 20px;
      margin-bottom: 25px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.3);
      transition: all 0.3s ease;
    }

    .news-card:hover {
      background: rgba(255,255,255,0.08);
      transform: translateY(-3px);
    }

    .news-card h5 {
      color: #f1f1f1;
      font-size: 1.3rem;
      margin-bottom: 10px;
    }

    .news-card p {
      color: #ddd;
    }

    .news-card a {
      color: #0dcaf0;
      font-weight: 500;
      text-decoration: none;
      transition: all 0.3s;
    }

    .news-card a:hover {
      color: #ffc107;
    }

    .news-container {
      max-width: 850px;
      margin: 0 auto;
      padding: 20px;
    }

    .error-box {
      background: rgba(220, 53, 69, 0.2);
      padding: 15px;
      border: 1px solid rgba(220,53,69,0.4);
      border-radius: 8px;
      color: #f8d7da;
      margin-bottom: 20px;
    }

    pre {
      background: rgba(0,0,0,0.6);
      padding: 1rem;
      border-radius: 8px;
      color: #eee;
      overflow-x: auto;
    }
  </style>
</head>

<body>

<h2>📰 Últimas Noticias</h2>

<div class="news-container">
<?php
$apiKey = "pub_89508c81f7814b6397c12f2d253f0143";
$url = "https://newsdata.io/api/1/news?apikey=$apiKey&language=es";

// Inicializar cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Ejecutar solicitud
$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo "<div class='error-box'>Error de conexión: " . curl_error($ch) . "</div>";
} else {
    $data = json_decode($response, true);

    if (is_array($data)) {
        if (isset($data['results']) && is_array($data['results'])) {
            foreach ($data['results'] as $news) {
                if (is_array($news)) {
                    echo "<div class='news-card'>";
                    echo "<h5>" . htmlspecialchars($news['title'] ?? 'Sin título') . "</h5>";
                    echo "<p>" . htmlspecialchars($news['description'] ?? 'Sin descripción disponible.') . "</p>";
                    if (!empty($news['link'])) {
                        echo "<a href='" . htmlspecialchars($news['link']) . "' target='_blank'>📎 Leer más</a>";
                    }
                    echo "</div>";
                } else {
                    echo "<div class='error-box'>Noticia inválida: " . htmlspecialchars(json_encode($news)) . "</div>";
                }
            }
        } else {
            echo "<div class='error-box'>No se encontraron noticias válidas. Verifica tu API key o consulta la respuesta:</div>";
            echo "<pre>" . htmlspecialchars($response) . "</pre>";
        }
    } else {
        echo "<div class='error-box'>Respuesta inválida de la API:</div>";
        echo "<pre>" . htmlspecialchars($response) . "</pre>";
    }
}

curl_close($ch);
?>
</div>

</body>
</html>
