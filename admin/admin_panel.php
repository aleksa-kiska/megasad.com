<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель администратора</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 15px 0;
            text-align: center;
            font-size: 24px;
        }

        .nav-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 30px;
        }

        .nav-button {
            display: block;
            width: 90%;
            max-width: 250px;
            background-color: #333;
            color: white;
            text-decoration: none;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            font-size: 18px;
            text-align: center;
            transition: background-color 0.3s;
        }

        .nav-button:hover {
            background-color: #575757;
        }

        .content {
            background-color: white;
            padding: 30px;
            border-radius: 5px;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #333;
        }

        footer {
            text-align: center;
            margin-top: 30px;
            color: #777;
            font-size: 14px;
        }

        footer a {
            color: #4CAF50;
        }

        footer a:hover {
            text-decoration: underline;
        }

        @media (min-width: 600px) {
            .nav-container {
                flex-direction: row;
                justify-content: center;
                gap: 15px;
            }

            .nav-button {
                margin: 0;
            }
        }

        @media (min-width: 1024px) {
            .nav-button {
                width: 200px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            Панель администратора
        </header>

        <div class="nav-container">
            <a href="products.php" class="nav-button">Управление товарами</a>
            <a href="orders.php" class="nav-button">Управление заказами</a>
            <a href="logout.php" class="nav-button">Выйти</a>
        </div>
    </div>
</body>
</html>