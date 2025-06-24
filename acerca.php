<?php
  // acerca.php
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Acerca de</title>
  <!-- Bootstrap CSS -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet"
  >
  <!-- Tu CSS externo con todas las reglas (incluye aquí las de .about-section, variables, resets, etc.) -->
  <link rel="stylesheet" href="css/estilos.css">

  <style>
    :root {
  --primary-color: #0d6efd;
  --secondary-color: #6c757d;
  --success-color: #198754;
  --danger-color: #dc3545;
  --warning-color: #ffc107;
  --info-color: #0dcaf0;
  --light-color: #f8f9fa;
  --dark-color: #212529;
  --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  --gradient-secondary: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
  --gradient-success: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
  --shadow-sm: 0 2px 4px rgba(0,0,0,0.1);
  --shadow-md: 0 4px 6px rgba(0,0,0,0.1);
  --shadow-lg: 0 10px 15px rgba(0,0,0,0.1);
  --shadow-xl: 0 20px 25px rgba(0,0,0,0.1);
  --border-radius: 12px;
  --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* ===== RESET Y BASE ===== */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  line-height: 1.6;
  color: var(--dark-color);
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  min-height: 100vh;
  position: relative;
}

body::before {
  content: '';
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: 
    radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
    radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.3) 0%, transparent 50%),
    radial-gradient(circle at 40% 40%, rgba(120, 219, 255, 0.2) 0%, transparent 50%);
  z-index: -1;
  animation: backgroundShift 20s ease-in-out infinite;
}

@keyframes backgroundShift {
  0%, 100% { opacity: 1; }
  50% { opacity: 0.8; }
}

/* ===== NAVBAR MEJORADO ===== */
.navbar {
  background: rgba(13, 110, 253, 0.95) !important;
  backdrop-filter: blur(10px);
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  box-shadow: var(--shadow-lg);
  transition: var(--transition);
  position: relative;
  overflow: hidden;
}

.navbar::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
  transition: left 0.5s;
}

.navbar:hover::before {
  left: 100%;
}

.navbar-brand {
  font-weight: 700;
  font-size: 1.5rem;
  color: white !important;
  text-decoration: none;
  position: relative;
  transition: var(--transition);
}

.navbar-brand::after {
  content: '';
  position: absolute;
  bottom: -2px;
  left: 0;
  width: 0;
  height: 2px;
  background: var(--gradient-success);
  transition: width 0.3s ease;
}

.navbar-brand:hover::after {
  width: 100%;
}

.nav-link {
  color: rgba(255, 255, 255, 0.9) !important;
  font-weight: 500;
  padding: 0.75rem 1rem !important;
  border-radius: 8px;
  transition: var(--transition);
  position: relative;
  overflow: hidden;
}

.nav-link::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: rgba(255, 255, 255, 0.1);
  transition: left 0.3s ease;
  z-index: -1;
}

.nav-link:hover {
  color: white !important;
  transform: translateY(-2px);
}

.nav-link:hover::before {
  left: 0;
}

/* ===== CONTENEDOR PRINCIPAL ===== */
.container {
  position: relative;
  z-index: 2;
}

/* ===== PERFIL Y PRESENTACIÓN ===== */
.text-center {
  animation: fadeInUp 1s ease-out;
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.rounded-circle {
  border: 4px solid rgba(255, 255, 255, 0.3);
  box-shadow: var(--shadow-xl);
  transition: var(--transition);
  animation: float 6s ease-in-out infinite;
  position: relative;
  z-index: 1;
}

.rounded-circle::before {
  content: '';
  position: absolute;
  top: -4px;
  left: -4px;
  right: -4px;
  bottom: -4px;
  border-radius: 50%;
  background: var(--gradient-primary);
  z-index: -1;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.rounded-circle:hover {
  transform: scale(1.1);
  box-shadow: var(--shadow-xl);
}

.rounded-circle:hover::before {
  opacity: 1;
}

@keyframes float {
  0%, 100% {
    transform: translateY(0px);
  }
  50% {
    transform: translateY(-10px);
  }
}

/* ===== TÍTULOS Y TEXTO ===== */
h1 {
  color: white;
  font-weight: 700;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
  margin-bottom: 1rem;
  position: relative;
  display: inline-block;
}

h1::after {
  content: '';
  position: absolute;
  bottom: -10px;
  left: 50%;
  transform: translateX(-50%);
  width: 80px;
  height: 3px;
  background: var(--gradient-success);
  border-radius: 2px;
}

.lead {
  color: rgba(255, 255, 255, 0.9);
  font-size: 1.25rem;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
  max-width: 600px;
  margin: 0 auto;
  line-height: 1.5;
}

/* ===== TARJETAS DE API (para futuras secciones) ===== */
.api-card {
  background: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.2);
  border-radius: var(--border-radius);
  padding: 2rem;
  margin: 1rem 0;
  transition: var(--transition);
  position: relative;
  overflow: hidden;
}

.api-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 2px;
  background: var(--gradient-primary);
  transform: scaleX(0);
  transition: transform 0.3s ease;
}

.api-card:hover {
  transform: translateY(-5px);
  box-shadow: var(--shadow-xl);
  background: rgba(255, 255, 255, 0.15);
}

.api-card:hover::before {
  transform: scaleX(1);
}

/* ===== BOTONES MEJORADOS ===== */
.btn {
  border-radius: 25px;
  padding: 0.75rem 2rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  transition: var(--transition);
  position: relative;
  overflow: hidden;
  border: none;
  cursor: pointer;
}

.btn::before {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  width: 0;
  height: 0;
  background: rgba(255, 255, 255, 0.2);
  border-radius: 50%;
  transform: translate(-50%, -50%);
  transition: width 0.3s ease, height 0.3s ease;
}

.btn:hover::before {
  width: 300px;
  height: 300px;
}

.btn-primary {
  background: var(--gradient-primary);
  color: white;
}

.btn-success {
  background: var(--gradient-success);
  color: white;
}

.btn:hover {
  transform: translateY(-2px);
  box-shadow: var(--shadow-lg);
}

/* ===== EFECTOS DE SCROLL ===== */
.fade-in {
  opacity: 0;
  transform: translateY(30px);
  transition: opacity 0.6s ease, transform 0.6s ease;
}

.fade-in.visible {
  opacity: 1;
  transform: translateY(0);
}

/* ===== UTILIDADES ===== */
.glass-effect {
  background: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.2);
  border-radius: var(--border-radius);
}

.text-gradient {
  background: var(--gradient-primary);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

/* ===== ANIMACIONES DE ENTRADA ===== */
.animate-slide-in-left {
  animation: slideInLeft 0.8s ease-out;
}

.animate-slide-in-right {
  animation: slideInRight 0.8s ease-out;
}

@keyframes slideInLeft {
  from {
    opacity: 0;
    transform: translateX(-50px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

@keyframes slideInRight {
  from {
    opacity: 0;
    transform: translateX(50px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
  .navbar-brand {
    font-size: 1.25rem;
  }
  
  h1 {
    font-size: 2rem;
  }
  
  .lead {
    font-size: 1.1rem;
  }
  
  .container {
    padding: 0 1rem;
  }
  
  .api-card {
    padding: 1.5rem;
  }
}

@media (max-width: 576px) {
  .rounded-circle {
    width: 120px !important;
    height: 120px !important;
  }
  
  h1 {
    font-size: 1.75rem;
  }
  
  .lead {
    font-size: 1rem;
  }
}

/* ===== PARTÍCULAS FLOTANTES (OPCIONAL) ===== */
.floating-particles {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  pointer-events: none;
  z-index: 1;
}

.particle {
  position: absolute;
  width: 4px;
  height: 4px;
  background: rgba(255, 255, 255, 0.5);
  border-radius: 50%;
  animation: float-particle 20s infinite linear;
}

@keyframes float-particle {
  0% {
    transform: translateY(100vh) rotate(0deg);
    opacity: 0;
  }
  10% {
    opacity: 1;
  }
  90% {
    opacity: 1;
  }
  100% {
    transform: translateY(-10vh) rotate(360deg);
    opacity: 0;
  }
}

/* ===== EFECTOS DE HOVER PARA ENLACES ===== */
a {
  transition: var(--transition);
}

a:hover {
  text-decoration: none;
}

/* ===== SECCIÓN ACERCA DEL PROYECTO ===== */
.about-section {
  background: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(15px);
  border: 1px solid rgba(255, 255, 255, 0.2);
  border-radius: var(--border-radius);
  padding: 3rem 2.5rem;
  margin: 3rem 0;
  position: relative;
  overflow: hidden;
  transition: var(--transition);
  animation: fadeInUp 1s ease-out 0.3s both;
}

.about-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 3px;
  background: var(--gradient-success);
  border-radius: 2px 2px 0 0;
}

.about-section::after {
  content: '';
  position: absolute;
  top: -50%;
  left: -50%;
  width: 200%;
  height: 200%;
  background: radial-gradient(circle, rgba(255, 255, 255, 0.05) 0%, transparent 70%);
  opacity: 0;
  transition: opacity 0.3s ease;
  pointer-events: none;
}

.about-section:hover {
  transform: translateY(-5px);
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
  background: rgba(255, 255, 255, 0.15);
}

.about-section:hover::after {
  opacity: 1;
}

.about-section h2 {
  color: white;
  font-weight: 700;
  font-size: 2.5rem;
  margin-bottom: 2rem;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
  position: relative;
  display: inline-block;
}

.about-section h2::before {
  content: '';
  position: absolute;
  left: -50px;
  top: 50%;
  transform: translateY(-50%);
  font-size: 2rem;
  animation: bounce 2s infinite;
}

.about-section h2::after {
  content: '';
  position: absolute;
  bottom: -15px;
  left: 0;
  width: 100%;
  height: 3px;
  background: var(--gradient-primary);
  border-radius: 2px;
  transform: scaleX(0);
  transform-origin: left;
  animation: expandLine 1s ease-out 0.8s both;
}

@keyframes expandLine {
  to {
    transform: scaleX(1);
  }
}

@keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    transform: translateY(-50%);
  }
  40% {
    transform: translateY(-60%);
  }
  60% {
    transform: translateY(-55%);
  }
}

.about-section p {
  color: rgba(255, 255, 255, 0.9);
  font-size: 1.1rem;
  line-height: 1.8;
  margin-bottom: 1.5rem;
  text-align: justify;
  position: relative;
  padding-left: 20px;
  border-left: 3px solid transparent;
  transition: var(--transition);
}

.about-section p:hover {
  border-left-color: var(--info-color);
  transform: translateX(5px);
  background: rgba(255, 255, 255, 0.05);
  padding: 1rem 1rem 1rem 20px;
  border-radius: 8px;
}

.about-section p::before {
  content: '';
  position: absolute;
  left: -3px;
  top: 0;
  width: 3px;
  height: 100%;
  background: var(--gradient-success);
  transform: scaleY(0);
  transform-origin: top;
  transition: transform 0.3s ease;
}

.about-section p:hover::before {
  transform: scaleY(1);
}

.about-section strong {
  color: var(--info-color);
  font-weight: 700;
  position: relative;
  padding: 2px 4px;
  border-radius: 4px;
  background: rgba(13, 202, 240, 0.1);
  transition: var(--transition);
}

.about-section strong:hover {
  background: rgba(13, 202, 240, 0.2);
  transform: scale(1.05);
}

/* ===== VERSIÓN COMPACTA PARA MÓVILES ===== */
@media (max-width: 768px) {
  .about-section {
    padding: 2rem 1.5rem;
    margin: 2rem 0;
  }
  
  .about-section h2 {
    font-size: 2rem;
  }
  
  .about-section h2::before {
    left: -35px;
    font-size: 1.5rem;
  }
  
  .about-section p {
    font-size: 1rem;
    text-align: left;
  }
}

@media (max-width: 576px) {
  .about-section h2::before {
    position: relative;
    left: 0;
    display: block;
    margin-bottom: 1rem;
  }
  
  .about-section h2 {
    text-align: center;
  }
}

/* ===== SCROLLBAR PERSONALIZADA ===== */
::-webkit-scrollbar {
  width: 8px;
}

::-webkit-scrollbar-track {
  background: rgba(255, 255, 255, 0.1);
}

::-webkit-scrollbar-thumb {
  background: var(--gradient-primary);
  border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
  background: var(--gradient-secondary);
}
   
 
  </style>
</head>
<body class="bg-light">

  <!-- Incluimos la barra de navegación compartida -->
  <?php include 'navbar.php'; ?>

  <!-- Aquí va tu sección “Acerca del proyecto” -->
  <div class="container mt-5">
    <div class="about-section">
      <h2>Acerca del proyecto</h2>

      <p>
        Este portal web fue desarrollado utilizando <strong>Bootstrap 5</strong> como framework CSS. 
        Elegí Bootstrap porque ofrece un sistema de diseño responsive fácil de usar, 
        componentes predefinidos (como botones, formularios y tarjetas), y una documentación muy completa 
        que acelera el desarrollo de interfaces atractivas y funcionales.
      </p>
      <p>
        Además, su integración con PHP es sencilla y permite mantener una apariencia profesional 
        sin necesidad de escribir CSS desde cero.
      </p>
    </div>
  </div>

  <!-- Bootstrap JS Bundle -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
  ></script>
</body>
</html>
