<?php include '../navbar.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Conversión de Monedas - Profesional</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
  html, body {
  margin: 0;
  padding: 0;
  height: 100%;
}

h2.banner {
  margin: 0;
  padding: 1rem 0;
  background: #fff;
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
  position: fixed; /* fijo arriba */
  top: 0;
  left: 0;
  right: 0;
  z-index: 9999;
  text-align: center;
  font-weight: 700;
  color: #2c3e50;
}

/* Para que el contenido no quede oculto debajo del banner */
.content {
  padding-top: 60px; /* igual a la altura del banner */
  max-width: 700px;
  margin: 0 auto;
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 8px 20px rgba(44,62,80,0.12);
  padding: 2rem;
}

    .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 12px 30px rgba(44, 62, 80, 0.18);
    }
    ul.conversion-list {
      list-style: none;
      padding-left: 0;
      max-height: 400px;
      overflow-y: auto;
    }
    ul.conversion-list li {
      padding: 10px 15px;
      border-bottom: 1px solid #e3e6ea;
      font-size: 1.1rem;
      color: #34495e;
      display: flex;
      justify-content: space-between;
    }
    ul.conversion-list li:nth-child(even) {
      background: #f8f9fa;
    }
    ul.conversion-list li span.currency {
      font-weight: 700;
      color: #2980b9;
    }
    .footer-note {
      text-align: center;
      margin-top: 3rem;
      color: #7f8c8d;
      font-size: 0.9rem;
    }
    @media (max-width: 576px) {
      .card {
        padding: 1rem;
      }
      ul.conversion-list li {
        font-size: 1rem;
      }
    }
  </style>
</head>
<body>

  <h2>Conversión de Monedas (USD Base)</h2>

  <div class="card shadow-sm">
    <?php
    $url = "https://open.er-api.com/v6/latest/USD";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo "<p class='text-danger'>Error al conectar con la API: " . curl_error($ch) . "</p>";
    } else {
        $data = json_decode($response, true);

        if ($data && isset($data['result']) && $data['result'] === 'success' && isset($data['rates'])) {
            echo "<ul class='conversion-list'>";
            foreach ($data['rates'] as $currency => $rate) {
                echo "<li><span class='currency'>1 USD</span> = <strong>" . number_format($rate, 4) . "</strong> <span class='currency'>$currency</span></li>";
            }
            echo "</ul>";
        } else {
            echo "<p class='text-warning'>No se pudieron obtener las tasas de conversión. Intenta más tarde.</p>";
        }
    }
    curl_close($ch);
    ?>
  </div>

  <div class="footer-note">
    Datos obtenidos de <a href="https://www.exchangerate-api.com/" target="_blank" rel="noopener noreferrer">ExchangeRate-API</a> (API pública gratuita).
  </div>

</body>
</html>

