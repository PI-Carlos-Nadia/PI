<!-- http://localhost:8080/formulario.php -->

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario de Contacto</title>
</head>

<body>

  <h1>Formulario de Contacto</h1>

  <?php
  if (!empty($_SESSION['errores'])) {
    echo "<h4>Errores encontrados:</h4><ul style='color:red;'>";
    foreach ($_SESSION['errores'] as $error) {
      echo "<li>" . htmlspecialchars($error) . "</li>";
    }
    echo "</ul>";
    unset($_SESSION['errores']);
  }
  ?>
<section id="form">
  <form action="procesar.php" method="POST" novalidate>
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre"
      value="<?php echo htmlspecialchars($_SESSION['datos']['nombre'] ?? ''); ?>" minlength="4" required />
      <span class="error"></span>
    <br><br>

    <label for="correo">Correo electrónico:</label>
    <input type="text" id="correo" name="correo"
      value="<?php echo htmlspecialchars($_SESSION['datos']['correo'] ?? ''); ?>" required/>
    <span class="error"></span>
      <br><br>

    <label for="ciclo">Ciclo:</label>
    <select id="ciclo" name="ciclo" required>
      <option value="">Selecciona un ciclo</option>
      <option value="DAW" <?php if (($_SESSION['datos']['ciclo'] ?? '') == 'DAW') echo 'selected'; ?>>DAW</option>
      <option value="DAM" <?php if (($_SESSION['datos']['ciclo'] ?? '') == 'DAM') echo 'selected'; ?>>DAM</option>
      <option value="ASIX" <?php if (($_SESSION['datos']['ciclo'] ?? '') == 'ASIX') echo 'selected'; ?>>ASIX</option>
    </select>
    <span class="error"></span>
    <br><br>

    <label for="telefono">Teléfono:</label>
    <input type="text" id="telefono" name="telefono"
      value="<?php echo htmlspecialchars($_SESSION['datos']['telefono'] ?? ''); ?>" minlength="9" step="1"/>
    <span class="error"></span>
      <br><br>

    <input type="checkbox" id="consent" name="consent" value="1"
      <?php if (!empty($_SESSION['datos']['consent'])) echo 'checked'; ?> required/>
    <label for="consent">Consentimiento del tratamiento de datos</label>
    <span class="error"></span>
    <br><br>

    <button type="submit">Enviar</button>
  </form>

</section>
<script src="/js/validacion.js" defer></script>
</body>

</html>