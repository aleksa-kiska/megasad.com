<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Проверка введённых данных
    if ($username === 'admin' && $password === 'HxK1pDXw') {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_panel.php");
        exit();
    } else {
        $error = "Неверные данные!";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход для администратора</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        label {
            display: block;
            color: #333;
            font-weight: bold;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 5px;
        }

        input[type="text"]:focus, input[type="password"]:focus {
            outline-color: #4CAF50;
        }

        .error {
            color: red;
            margin-bottom: 15px;
        }

        .button-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 15px;
        }

        .btn {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
        }

        .btn-green {
            background-color: #4CAF50;
            color: white;
        }

        .btn-green:hover {
            background-color: #45a049;
        }

        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }

        @media (min-width: 480px) {
            .button-container {
                flex-direction: row;
            }

            .btn {
                width: 48%;
            }
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Вход для администратора</h2>

    <?php if (isset($error)): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label for="username">Логин:</label>
            <input type="text" name="username" id="username" required>
        </div>

        <div class="form-group">
            <label for="password">Пароль:</label>
            <input type="password" name="password" id="password" required>
        </div>

        <div class="button-container">
            <a href="../index.php" class="btn btn-green">Назад</a>
            <button type="submit" class="btn btn-green">Войти</button>
        </div>
    </form>

</div>

</body>
</html>