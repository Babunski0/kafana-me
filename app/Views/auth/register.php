<!DOCTYPE html>
<html lang="sr">
<head>
  <meta charset="UTF-8">
  <title>Registracija</title>
  <style>
    :root {
      /* Paleta boja */
      --bg-page:        #cbd4dc;
      --dark:           #2c3e50;
      --dark-alt:       #34495e;
      --light:          #ecf0f1;
      --accent:         #e67e22;
      --accent-hi:      #d35400;
      --text-body:      #5d6d7e;
      --text-secondary: #7f8c8d;
      --shadow:         rgba(0,0,0,0.15);
    }

    /* Reset & body */
    * { box-sizing: border-box; margin:0; padding:0; }
    body {
      font-family: Arial, sans-serif;
      background: var(--bg-page);
      color: var(--text-body);
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    /* Kontejner */
    .register-container {
      background: var(--light);
      padding: 40px 30px;
      border-radius: 8px;
      box-shadow: 0 4px 12px var(--shadow);
      width: 360px;
      max-width: 90%;
      text-align: center;
    }

    .register-container h2 {
      margin-bottom: 1.5rem;
      color: var(--dark);
      font-size: 1.8rem;
    }

    /* Poruke */
    .register-container .error,
    .register-container .success {
      margin-bottom: 1rem;
      font-weight: bold;
    }
    .register-container .error {
      color: #e74c3c;
    }
    .register-container .success {
      color: #27ae60;
    }

    /* Labela i input */
    .register-container label {
      display: block;
      text-align: left;
      margin-bottom: .25rem;
      font-size: .9rem;
      color: var(--dark-alt);
    }
    .register-container input[type="text"],
    .register-container input[type="email"],
    .register-container input[type="password"] {
      width: 100%;
      padding: 12px;
      margin-bottom: 1.25rem;
      border: 1px solid var(--dark-alt);
      border-radius: 5px;
      background: #fafafa;
      color: var(--dark);
      transition: border-color .2s;
    }
    .register-container input:focus {
      outline: none;
      border-color: var(--accent);
    }

    /* Gumb */
    .register-container button {
      width: 100%;
      padding: 12px;
      background: var(--accent);
      border: none;
      border-radius: 5px;
      color: #fff;
      font-size: 1rem;
      font-weight: bold;
      cursor: pointer;
      transition: background .2s, transform .1s;
    }
    .register-container button:hover {
      background: var(--accent-hi);
      transform: translateY(-1px);
    }

    /* Link na prijavu */
    .register-container .link {
      margin-top: 1rem;
      font-size: .9rem;
    }
    .register-container .link a {
      color: var(--accent);
      text-decoration: none;
      transition: color .2s;
    }
    .register-container .link a:hover {
      color: var(--accent-hi);
    }

    /* Responzivno */
    @media (max-width: 480px) {
      .register-container {
        padding: 30px 20px;
      }
      .register-container h2 {
        font-size: 1.5rem;
      }
    }
  </style>
</head>
<body>

  <div class="register-container">
    <h2>Registracija</h2>

    <?php if (session()->getFlashdata('errors')): ?>
      <?php foreach (session()->getFlashdata('errors') as $error): ?>
        <div class="error"><?= esc($error) ?></div>
      <?php endforeach; ?>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
      <div class="success"><?= esc(session()->getFlashdata('success')) ?></div>
    <?php endif; ?>

    <form method="post" action="<?= base_url('register') ?>">
      <label for="user">Username:</label>
      <input id="user" type="text" name="username" value="<?= old('username') ?>" required>

      <label for="email">Email:</label>
      <input id="email" type="email" name="email" value="<?= old('email') ?>" required>

      <label for="pass">Lozinka:</label>
      <input id="pass" type="password" name="password" required>

      <button type="submit">Registruj se</button>
    </form>

    <div class="link">
      <p>Imaš nalog? <a href="<?= base_url('login') ?>">Prijavi se</a></p>
    </div>
  </div>

</body>
</html>
