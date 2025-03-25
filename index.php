<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мегасад</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f8f8f8;
            margin: 0;
            padding: 20px;
        }

        .header {
    font-size: 48px;
    font-weight: bold;
    color: #008000;
    margin-bottom: 10px;
    text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.3); 
}

h2 {
    font-size: 22px;
    color: #006400;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2); 
    padding: 10px;
    border: 2px solid #008000;
    border-radius: 10px;
    display: inline-block;
    background: rgba(255, 255, 255, 0.8);
}

        .btn {
            display: inline-block;
            background: #008000;
            color: white;
            padding: 12px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 18px;
            transition: 0.3s;
            margin-top: 20px;
        }

        .btn:hover {
            background: #006400;
        }

        .catalog {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            max-width: 1000px;
            margin: 30px auto;
            padding: 10px;
        }

        .category {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .category:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .category a {
            text-decoration: none;
            color: black;
        }

        .category img {
            width: 100%;
            max-width: 200px;
            height: auto;
            border-radius: 10px;
            object-fit: cover;
        }

        .category p {
            margin-top: 10px;
            font-size: 16px;
            font-weight: bold;
        }

        .footer {
            background-color: #008000;
            color: white;
            padding: 30px 20px;
            text-align: center;
            margin-top: 50px;
        }

        .footer a {
            color: white;
            text-decoration: none;
        }

        .footer p {
            margin: 5px 0;
        }
    </style>
</head>
<body>

    <div class="header">Мегасад</div>
    <h2>Добро пожаловать в каталог садово-огородных товаров!<br>
    Здесь вы можете заказать товар оптом и в розницу.<br>
    Работаем с физическими и юридическими лицами.</h2>

    <div class="catalog">
        <div class="category">
            <a href="category_garden_tools.php">
                <img src="uploads/garden_tools.jpg" alt="Садовый инвентарь">
                <p>Садовый инвентарь</p>
            </a>
        </div>
        <div class="category">
            <a href="category_fertilizers.php">
                <img src="uploads/fertilizers.jpg" alt="Удобрения">
                <p>Удобрения</p>
            </a>
        </div>
        <div class="category">
            <a href="category_soil.php">
                <img src="uploads/soil.jpg" alt="Почвогрунты">
                <p>Почвогрунты</p>
            </a>
        </div>
        <div class="category">
            <a href="category_seeds.php">
                <img src="uploads/seeds.jpg" alt="Семена">
                <p>Семена</p>
            </a>
        </div>
        <div class="category">
            <a href="category_protection.php">
                <img src="uploads/protection.jpg" alt="Средства защиты растений">
                <p>Средства защиты растений</p>
            </a>
        </div>
        <div class="category">
            <a href="category_pots.php">
                <img src="uploads/pots.jpg" alt="Горшки">
                <p>Горшки</p>
            </a>
        </div>
    </div>

    <a href="admin/admin_login.php" class="btn">Вход для администратора</a>
    
    <div class="footer">
        <p>Наш адрес: Наб. Челны, ул. Машиностроительная, 75</p>
        <p>Наш режим работы: ежедневно, 07:00–22:00</p>
        <p>Наш телефон: 8 (8552) 78-30-20</p>
        <p>Наш интернет-магазин: <a href="http://megastroy.com" target="_blank">megastroy.com</a></p>
        <p style="font-size: 12px; opacity: 0.7;">&copy; 2025 Моськина Александра Александровна | ЧПОУ «Международный Открытый Колледж»</p>
    </div>

</body>
</html>