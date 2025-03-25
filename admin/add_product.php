<?php
// Подключение к базе данных
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

// Получаем все категории
$categories = $pdo->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);

// Обработка формы добавления товара
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $article = $_POST['article'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $subcategory_id = $_POST['subcategory_id']; // Подкатегория товара

    // Подготовка SQL запроса на добавление товара
    $stmt = $pdo->prepare("INSERT INTO products (name, article, description, price, image, subcategory_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $article, $description, $price, $image, $subcategory_id]);

    header("Location: products.php"); // Перенаправление на страницу с товарами
    exit;
}

// Получаем подкатегории по выбранной категории
$subcategories = [];
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $stmt = $pdo->prepare("SELECT * FROM subcategories WHERE category_id = ?");
    $stmt->execute([$category_id]);
    $subcategories = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить товар</title>
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
        input, select {
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
     <script>
        function goBack() {
            window.location.href = 'products.php';
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Добавить товар</h2>
        <form method="POST">

        <label>Категория:</label>
            <select name="category_id" onchange="location = this.value;">
                <option value="">Выберите категорию</option>
                <?php foreach ($categories as $category): ?>
                          <option value="?category_id=<?= $category['id'] ?>" <?= isset($_GET['category_id']) && $_GET['category_id'] == $category['id'] ? 'selected' : '' ?>>
                    <?= $category['name'] ?>
               </option>
                   <?php endforeach; ?>
            </select>

            <?php if (!empty($subcategories)): ?>
                <label>Подкатегория:</label>
                <select name="subcategory_id" required>
                    <option value="">Выберите подкатегорию</option>
                    <?php foreach ($subcategories as $subcategory): ?>
                        <option value="<?= $subcategory['id'] ?>"><?= $subcategory['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            <?php endif; ?>
            
            <label>URL фото:</label>
            <input type="text" name="image" required>

            <label>Название:</label>
            <input type="text" name="name" required>

            <label>Артикул:</label>
            <input type="text" name="article" required>

            <label>Описание:</label>
            <input type="text" name="description" required>

            <label>Цена:</label>
            <input type="number" name="price" required>

            <div class="buttons">
            <button type="button" class="back" onclick="goBack()">Назад</button>
            <button type="submit" class="save">Сохранить</button>
            </div>
        </form>
    </div>
</body>
</html>