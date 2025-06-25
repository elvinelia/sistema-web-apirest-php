<?php
  // contacto.php
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Contacto</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Estilos personalizados -->
  <style>
    :root {
      --gradient-primary: linear-gradient(135deg,rgb(77, 102, 216) 0%,rgb(77, 55, 99) 100%);
      --gradient-success: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
      --border-radius: 16px;
      --transition-fast: all 0.2s ease;
    }
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f1f3f5;
      color: #333;
    }
    /* Navbar elegante */
    .navbar {
      background: var(--gradient-primary) !important;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .nav-link, .navbar-brand {
      color: #fff !important;
      font-weight: 600;
      transition: var(--transition-fast);
    }
    .nav-link:hover, .navbar-brand:hover {
      opacity: 0.85;
    }
    /* Sección de contacto */
    .contact-card {
      background: #fff;
      border-radius: var(--border-radius);
      max-width: 800px;
      margin: 4rem auto;
      padding: 3rem;
      box-shadow: 0 8px 16px rgba(0,0,0,0.05);
      position: relative;
      overflow: hidden;
    }
    .contact-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 60px;
      height: 6px;
      background: var(--gradient-success);
    }
    .contact-card h2 {
      font-size: 2.5rem;
      margin-bottom: 1rem;
      color: #222;
    }
    .contact-card p {
      font-size: 1.1rem;
      line-height: 1.6;
      margin-bottom: 2rem;
    }
    .btn-contact {
      border-radius: 30px;
      padding: 0.75rem 2.5rem;
      font-size: 1rem;
      font-weight: 600;
      transition: var(--transition-fast);
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .btn-contact.primary {
      background: var(--gradient-primary);
      color: #fff;
      border: none;
    }
    .btn-contact.primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(0,0,0,0.15);
    }
    .btn-contact.success {
      background: var(--gradient-success);
      color: #fff;
      border: none;
    }
    .btn-contact.success:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(0,0,0,0.15);
    }
    @media (max-width: 576px) {
      .contact-card { padding: 2rem; margin: 2rem 1rem; }
      .contact-card h2 { font-size: 2rem; }
    }
  </style>
</head>
<body>
  <?php include 'navbar.php'; ?>

  <div class="contact-card">
    <h2>Contáctame</h2>
    <p>Si deseas colaborar, tienes preguntas o me quieres contratar, encuéntrame en mis redes:</p>
    <div class="text-center">
      <a href="https://www.linkedin.com/in/elvin-elias-vinicio-lugo-1925692b4/" target="_blank" class="btn-contact primary me-3">LinkedIn</a>
      <a href="https://github.com/elvinelia" target="_blank" class="btn-contact success">GitHub</a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
