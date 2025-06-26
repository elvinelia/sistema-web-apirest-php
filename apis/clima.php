<?php include 'includes/header.php'; ?>
<h2>API del Clima (OpenWeatherMap)</h2>
<form method="GET">
  <input type="text" name="ciudad" placeholder="Ciudad" required>
  <button class="btn btn-primary" type="submit">Consultar</button>
</form>

<?php
if (isset($_GET['ciudad'])) {
  $ciudad = $_GET['ciudad'];
  $apiKey = "TU_API_KEY"; // Reemplaza esto con tu clave real
  $url = "https://api.openweathermap.org/data/2.5/weather?q=" . urlencode($ciudad) . "&appid=$apiKey&units=metric&lang=es";
  $response = file_get_contents($url);
  $data = json_decode($response, true);
  echo "<p>Clima en {$data['name']}: {$data['weather'][0]['description']}, Temp: {$data['main']['temp']}°C</p>";
}
?>
<?php include 'includes/footer.php'; ?>
