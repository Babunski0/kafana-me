<!DOCTYPE html>
<html lang="sr">
<head>
  <meta charset="UTF-8">
  <title>Prijava</title>
  <style>
    :root {
      /* Paleta boja iz ostatka sajta */
      --bg-page:       #cbd4dc;  /* zadana pozadina */
      --dark:          #2c3e50;  /* header/footer tamno-plava */
      --dark-alt:      #34495e;  /* sekundarna tamna */
      --light:         #ecf0f1;  /* svijetlo-siva */
      --accent:        #e67e22;  /* glavni akcent */
      --accent-hi:     #d35400;  /* hover akcent */
      --text-body:     #5d6d7e;  /* osnovni tekst */
      --text-secondary:#7f8c8d;  /* pomoćni tekst */
      --shadow:        rgba(0,0,0,0.15);
    }

    /* Full-screen centriranje */
    body {
      margin: 0;
      padding: 0;
      height: 100vh;
      background: var(--bg-page);
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: Arial, sans-serif;
      color: var(--text-body);
    }

    .login-container {
      background: var(--light);
      padding: 40px 30px;
      border-radius: 8px;
      box-shadow: 0 4px 12px var(--shadow);
      width: 360px;
      max-width: 90%;
      text-align: center;
    }

    .login-container h2 {
      margin: 0 0 1.5rem;
      color: var(--dark);
      font-size: 1.8rem;
    }

    .login-container .error,
    .login-container .success {
      margin-bottom: 1rem;
      font-weight: bold;
    }
    .login-container .error {
      color: #e74c3c; /* ili varijabla akcent crvene */
    }
    .login-container .success {
      color: #27ae60; /* zeleni ton za uspjeh */
    }

    .login-container label {
      display: block;
      text-align: left;
      font-size: 0.9rem;
      margin-bottom: 0.25rem;
      color: var(--dark-alt);
    }

    .login-container input[type="text"],
    .login-container input[type="password"] {
      width: 100%;
      padding: 12px;
      margin-bottom: 1.25rem;
      border: 1px solid var(--dark-alt);
      border-radius: 5px;
      background: #fafafa;
      color: var(--dark);
      transition: border-color 0.2s;
    }
    .login-container input:focus {
      outline: none;
      border-color: var(--accent);
    }

    .login-container button {
      width: 100%;
      padding: 12px;
      background: var(--accent);
      border: none;
      border-radius: 5px;
      color: #fff;
      font-size: 1rem;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.2s, transform 0.1s;
    }
    .login-container button:hover {
      background: var(--accent-hi);
      transform: translateY(-1px);
    }

    .login-container .link {
      margin-top: 1rem;
      font-size: 0.9rem;
    }
    .login-container .link a {
      color: var(--accent);
      text-decoration: none;
      transition: color 0.2s;
    }
    .login-container .link a:hover {
      color: var(--accent-hi);
    }

    @media (max-width: 480px) {
      .login-container {
        padding: 30px 20px;
      }
      .login-container h2 {
        font-size: 1.5rem;
      }
    }
  </style>
</head>
<body>

  <div class="login-container">
    <h2>Prijava</h2>

    <?php if (session()->getFlashdata('error')): ?>
      <div class="error"><?= esc(session()->getFlashdata('error')) ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
      <div class="success"><?= esc(session()->getFlashdata('success')) ?></div>
    <?php endif; ?>

    <form method="post" action="<?= base_url('login') ?>">
      <label for="user">Username:</label>
      <input id="user" type="text" name="username" value="<?= old('username') ?>" required>

      <label for="pass">Lozinka:</label>
      <input id="pass" type="password" name="password" required>

      <button type="submit">Prijavi se</button>
    </form>

    <div class="link">
      <p>Nemaš nalog? <a href="<?= base_url('register') ?>">Registruj se</a></p>
    </div>
  </div>

</body>
</html>
