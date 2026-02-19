<!-- http://localhost:8080/formulario.php -->
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario de Contacto</title>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'Segoe UI', system-ui, sans-serif;
      background: #f5f5f5;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem;
    }

    .formulario-wrapper {
      background: #fff;
      border-radius: 14px;
      box-shadow: 0 4px 24px rgba(0,0,0,0.1);
      padding: 2.5rem;
      width: 100%;
      max-width: 520px;
    }

    h1 {
      font-size: 1.6rem;
      font-weight: 700;
      color: #1a1a2e;
      margin-bottom: 1.75rem;
      padding-bottom: 0.75rem;
      border-bottom: 3px solid #4f46e5;
    }

    /* Errores PHP */
    .errores-servidor {
      background: #fee2e2;
      border: 1px solid #fca5a5;
      border-radius: 8px;
      padding: 1rem 1.25rem;
      margin-bottom: 1.5rem;
      color: #991b1b;
      font-size: 0.9rem;
    }

    .errores-servidor h4 {
      margin-bottom: 0.5rem;
      font-size: 0.95rem;
    }

    .errores-servidor ul { padding-left: 1.25rem; }
    .errores-servidor li { margin-bottom: 0.25rem; }

    .campo {
      display: flex;
      flex-direction: column;
      gap: 0.4rem;
      margin-bottom: 1.25rem;
    }

    .campo label {
      font-size: 0.88rem;
      font-weight: 600;
      color: #374151;
    }

    .campo input,
    .campo select {
      border: 1.5px solid #d1d5db;
      border-radius: 8px;
      padding: 0.7rem 1rem;
      font-size: 0.92rem;
      color: #1a1a2e;
      background: #f9fafb;
      outline: none;
      transition: border-color 0.2s, box-shadow 0.2s;
      width: 100%;
    }

    .campo input:focus,
    .campo select:focus {
      border-color: #4f46e5;
      box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
      background: #fff;
    }

    .campo--error input,
    .campo--error select {
      border-color: #ef4444;
      background: #fff5f5;
    }

    .campo--error input:focus,
    .campo--error select:focus {
      box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.15);
    }

    .campo--ok input,
    .campo--ok select {
      border-color: #22c55e;
      background: #f0fdf4;
    }

    .error {
      font-size: 0.8rem;
      color: #ef4444;
      font-weight: 500;
      min-height: 1rem;
    }

    .campo--checkbox {
      flex-direction: row;
      align-items: flex-start;
      gap: 0.6rem;
    }

    .campo--checkbox input[type="checkbox"] {
      width: 18px;
      height: 18px;
      margin-top: 2px;
      flex-shrink: 0;
      accent-color: #4f46e5;
    }

    .campo--checkbox label {
      font-size: 0.85rem;
      font-weight: 400;
      color: #6b7280;
      cursor: pointer;
    }

    .campo--checkbox .error {
      display: block;
      width: 100%;
    }

    button[type="submit"] {
      width: 100%;
      background: #4f46e5;
      color: #fff;
      border: none;
      border-radius: 8px;
      padding: 0.85rem;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.2s, transform 0.1s;
      margin-top: 0.5rem;
    }

    button[type="submit"]:hover {
      background: #4338ca;
      transform: translateY(-1px);
    }

    button[type="submit"]:active { transform: translateY(0); }
  </style>
</head>

<body>
  <div class="formulario-wrapper">
    <h1>Formulario de Contacto</h1>

    <?php if (!empty($_SESSION['errores'])): ?>
      <div class="errores-servidor">
        <h4>Errores encontrados:</h4>
        <ul>
          <?php foreach ($_SESSION['errores'] as $error): ?>
            <li><?php echo htmlspecialchars($error); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <?php unset($_SESSION['errores']); ?>
    <?php endif; ?>

    <section id="form">
      <form action="procesar.php" method="POST" novalidate>

        <div class="campo">
          <label for="nombre">Nombre</label>
          <input type="text" id="nombre" name="nombre"
            value="<?php echo htmlspecialchars($_SESSION['datos']['nombre'] ?? ''); ?>"
            minlength="4" required />
          <span class="error"></span>
        </div>

        <div class="campo">
          <label for="correo">Correo electrónico</label>
          <input type="email" id="correo" name="correo"
            value="<?php echo htmlspecialchars($_SESSION['datos']['correo'] ?? ''); ?>"
            required />
          <span class="error"></span>
        </div>

        <div class="campo">
          <label for="ciclo">Ciclo</label>
          <select id="ciclo" name="ciclo" required>
            <option value="">Selecciona un ciclo</option>
            <option value="DAW" <?php if (($_SESSION['datos']['ciclo'] ?? '') == 'DAW') echo 'selected'; ?>>DAW</option>
            <option value="DAM" <?php if (($_SESSION['datos']['ciclo'] ?? '') == 'DAM') echo 'selected'; ?>>DAM</option>
            <option value="ASIX" <?php if (($_SESSION['datos']['ciclo'] ?? '') == 'ASIX') echo 'selected'; ?>>ASIX</option>
          </select>
          <span class="error"></span>
        </div>

        <div class="campo">
          <label for="telefono">Teléfono</label>
          <input type="text" id="telefono" name="telefono"
            value="<?php echo htmlspecialchars($_SESSION['datos']['telefono'] ?? ''); ?>"
            minlength="9" />
          <span class="error"></span>
        </div>

        <div class="campo campo--checkbox">
          <input type="checkbox" id="consent" name="consent" value="1"
            <?php if (!empty($_SESSION['datos']['consent'])) echo 'checked'; ?> required />
          <label for="consent">Acepto el tratamiento de mis datos personales</label>
          <span class="error"></span>
        </div>

        <button type="submit">Enviar formulario</button>

      </form>
    </section>
  </div>

  <script src="/js/validacion.js" defer></script>
</body>
</html>