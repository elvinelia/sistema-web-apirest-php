<?php include 'includes/header.php'; ?>
<h2>API de Universidades</h2>
<form method="GET">
  <input type="text" name="pais" placeholder="Ej: Mexico" required>
  <button class="btn btn-primary" type="submit">Buscar</button>
</form>

<?php
if (isset($_GET['pais'])) {
  $pais = $_GET['pais'];
  $response = file_get_contents("http://universities.hipolabs.com/search?country=" . urlencode($pais));
  $data = json_decode($response, true);
  foreach ($data as $uni) {
    echo "<li>{$uni['name']} - <a href='{$uni['web_pages'][0]}' target='_blank'>Sitio web</a></li>";
  }
}
?>
<?php include 'includes/footer.php'; ?>
