<!-- Stranica za registraciju korisnika-->
<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Registracija</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .register-container {
            background-color: white;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            width: 350px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-top: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #007BFF;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0069d9;
        }
        .link {
            text-align: center;
            margin-top: 15px;
        }
        .error, .success {
            text-align: center;
            margin-bottom: 10px;
        }
        .error { color: red; }
        .success { color: green; }
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
        <label>Username:</label>
        <input type="text" name="username" value="<?= old('username') ?>" required>

        <label>Email:</label>
        <input type="email" name="email" value="<?= old('email') ?>" required>

        <label>Lozinka:</label>
        <input type="password" name="password" required>

        <button type="submit">Registruj se</button>
    </form>

    <div class="link">
        <p>Imaš nalog? <a href="<?= base_url('login') ?>">Prijavi se</a></p>
    </div>
</div>

</body>
</html>
