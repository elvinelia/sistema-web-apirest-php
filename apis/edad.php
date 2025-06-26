<?php include 'includes/header.php'; ?>
<h2>API de Edad (Agify.io)</h2>
<form method="GET">
  <input type="text" name="name" placeholder="Ingresa un nombre" required>
  <button class="btn btn-primary" type="submit">Consultar</button>
</form>

<?php
if (isset($_GET['name'])) {
  $name = $_GET['name'];
  $response = file_get_contents("https://api.agify.io?name=" . urlencode($name));
  $data = json_decode($response, true);
  echo "<p>Nombre: {$data['name']} - Edad estimada: {$data['age']}</p>";
}
?>
<?php include 'includes/footer.php'; ?>
