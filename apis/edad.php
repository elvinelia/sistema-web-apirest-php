<?php include '../navbar.php'; ?>
<h2>API de Edad (Agify.io)</h2>
<form method="GET">
  <input type="text" name="name" placeholder="Ingresa un nombre" required>
  <button class="btn btn-primary" type="submit">Consultar</button>
</form>

<?php
if (isset($_GET['name'])) {
  $name = $_GET['name'];

  // Inicializar cURL
  $ch = curl_init();

  // Configurar opciones de cURL
  curl_setopt($ch, CURLOPT_URL, "https://api.agify.io?name=" . urlencode($name));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Para que devuelva la respuesta como string

  // Ejecutar la petición
  $response = curl_exec($ch);

  // Verificar si hubo error
  if ($response === false) {
    echo "<p>Error en la petición cURL: " . curl_error($ch) . "</p>";
  } else {
    // Decodificar JSON y mostrar resultado
    $data = json_decode($response, true);
    echo "<p>Nombre: {$data['name']} - Edad estimada: {$data['age']}</p>";
  }

  // Cerrar cURL
  curl_close($ch);
}
?>
