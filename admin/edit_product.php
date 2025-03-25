<?php
// Подключение к базе
$host = 'localhost';
$dbname = 'shop';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения: " . $e->getMessage());
}

// Проверяем, передан ли ID товара
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Некорректный ID товара.");
}

$product_id = (int)$_GET['id'];

// Загружаем данные товара
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
$stmt->execute(['id' => $product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    die("Товар не найден.");
}

// Обновление товара
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $article = $_POST['article'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    $stmt = $pdo->prepare("UPDATE products SET name = ?, article = ?, description = ?, price = ?, image = ? WHERE id = ?");
    $stmt->execute([$name, $article, $description, $price, $image, $product_id]);

    header("Location: products.php"); // Перенаправление на главную страницу
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Изменить товар</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f9f9f9;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input {
            width: 90%;
            padding: 10px;
            margin-top: 10px;
            border: 3px solid #ccc;
            border-radius: 10px;
        }
        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 48%;
        }
        .back {
            background-color: #4CAF50;
            color: white;
        }
        .save {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Изменить товар</h2>
        <form method="POST">
            <label>URL фото:</label>
            <input type="text" name="image" value="<?= htmlspecialchars($product['image']) ?>" required>

            <label>Название:</label>
            <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>

            <label>Артикул:</label>
            <input type="text" name="article" value="<?= htmlspecialchars($product['article']) ?>" required>

            <label>Описание:</label>
            <input type="text" name="description" value="<?= htmlspecialchars($product['description']) ?>" required>

            <label>Цена:</label>
            <input type="number" name="price" value="<?= htmlspecialchars($product['price']) ?>" required>

            <div class="buttons">
                <button type="products.php" class="back">Назад</button>
                <button type="submit" class="save">Сохранить</button>
            </div>
        </form>
    </div>
</body>
</html>