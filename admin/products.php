<?php
// Подключение к базе
$host = 'localhost';
$dbname = 'shop';
$username = 'root'; // Укажите свои данные
$password = '';     // Укажите пароль, если есть

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения: " . $e->getMessage());
}

// Удаление товара (если нажата кнопка "Удалить")
if (isset($_GET['delete_id'])) {
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = :id");
    $stmt->execute(['id' => (int)$_GET['delete_id']]);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Получаем список категорий
$categories = $pdo->query("SELECT * FROM categories ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);

// Получаем список подкатегорий, сгруппировав их по category_id
$subcategories = $pdo->query("SELECT * FROM subcategories ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);

// Группируем подкатегории по категориям
$groupedSubcategories = [];
foreach ($subcategories as $sub) {
    $groupedSubcategories[$sub['category_id']][] = $sub;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Категории и подкатегории</title>
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
  <style>
  body {
    font-family: Arial, sans-serif;
    background: #f3faf3;
    padding: 30px;
    max-width: 1200px;
    margin: 0 auto;
}
h1 {
    color: #2c5e1a;
    text-align: center;
    margin-bottom: 20px;
}
.category {
    background: #4CAF50;
    color: white;
    padding: 12px;
    border-radius: 15px;
    font-size: 25px;
    font-weight: bold;
    margin-bottom: 10px;
    text-align: center;
    cursor: pointer;
}
.subcategory-list {
    display: none;
    list-style: none;
    padding: 0;
    margin: 0;
    text-align: center;
}
.subcategory-list a {
    display: inline-block;
    padding: 10px 15px;
    background: #66bb6a;
    color: white;
    text-decoration: none;
    border-radius: 10px;
    transition: 0.3s;
    margin: 5px;
}
.subcategory-list a:hover {
    background: #388e3c;
}
.products {
    display: none;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 15px;
    margin-top: 20px;
}
.product {
    background: white;
    padding: 15px;
    border-radius: 10px;
    border: 2px solid #91c791;
    text-align: center;
    box-shadow: 2px 2px 8px rgba(0,0,0,0.1);
}
.product img {
    width: 100%;
    height: auto;
    max-width: 150px;
    object-fit: cover;
    border-radius: 8px;
}
    .buttons {
      display: flex;
      justify-content: space-between;
      margin-top: 10px;
    }
    .edit, .delete {
      padding: 5px 10px;
      color: white;
      border-radius: 5px;
      text-decoration: none;
      font-size: 14px;
    }
    .edit { background: #ffa726; }
    .delete { background: #e57373; }

    /* Стили для кнопок внизу */
    .bottom-buttons-container {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 30px;
    padding-bottom: 30px;
}
.back-button, .add-product-button {
    padding: 12px 25px;
    font-size: 16px;
    background-color: #4CAF50;
    color: white;
    text-decoration: none;
    border-radius: 8px;
    text-align: center;
    cursor: pointer;
    transition: background-color 0.3s;
    flex: 1 1 auto;
    min-width: 150px;
}
.back-button:hover, .add-product-button:hover {
    background-color: #45a049;
}
@media (max-width: 768px) {
      .category {
        font-size: 20px;
        padding: 10px;
      }
      .subcategory-list a {
        padding: 8px 12px;
        font-size: 14px;
      }
      .product {
        padding: 10px;
      }
      .product img {
        max-width: 100px;
      }
    }
  </style>
  <script>
    function toggleSubcategories(categoryId) {
    let subList = document.getElementById('sub-' + categoryId);
    
    if (subList.style.display === 'block') {
        subList.style.display = 'none';
        document.querySelectorAll('.products').forEach(p => p.style.display = 'none');
    } else {
        document.querySelectorAll('.subcategory-list').forEach(list => list.style.display = 'none');
        document.querySelectorAll('.products').forEach(p => p.style.display = 'none');
        
        subList.style.display = 'block';
    }
}

function toggleProducts(subcategoryId) {
    let selectedProducts = document.getElementById('products-' + subcategoryId);
    
    if (selectedProducts.style.display === 'grid') {
        selectedProducts.style.display = 'none';
    } else {
        document.querySelectorAll('.products').forEach(p => p.style.display = 'none');
        selectedProducts.style.display = 'grid';
    }
}

    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('.products').forEach(p => p.style.display = 'none');
    });
</script>
</head>

<body>

<h1>Управление товарами</h1>

<?php foreach ($categories as $category): ?>
    <div class="category" onclick="toggleSubcategories(<?= $category['id'] ?>)"><?= htmlspecialchars($category['name']) ?></div>
    <ul class="subcategory-list" id="sub-<?= $category['id'] ?>">
        <?php if (isset($groupedSubcategories[$category['id']])): ?>
            <?php foreach ($groupedSubcategories[$category['id']] as $sub): ?>
                <li><a href="#" onclick="toggleProducts(<?= $sub['id'] ?>)"><?= htmlspecialchars($sub['name']) ?></a></li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
<?php endforeach; ?>


<?php foreach ($subcategories as $sub): ?>
    <div class="products" id="products-<?= $sub['id'] ?>">
        <?php 
        $products = $pdo->prepare("SELECT * FROM products WHERE subcategory_id = ?");
        $products->execute([$sub['id']]);
        foreach ($products as $product): ?>
            <div class="product">
                <img src="uploads/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                <p><strong><?= htmlspecialchars($product['name']) ?></strong></p>
                <p>Цена: <?= htmlspecialchars($product['price']) ?> Р</p>
                <p> Арктикул: <?= htmlspecialchars($product['article']) ?> </p>
                <p><small><?= htmlspecialchars($product['description']) ?></small></p>
                <div class="buttons">
                    <a href="edit_product.php?id=<?= $product['id'] ?>" class="edit">Изменить</a>
                    <a href="?delete_id=<?= $product['id'] ?>" class="delete" onclick="return confirm('Удалить этот товар?')">Удалить</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endforeach; ?>
<div class="bottom-buttons-container">
    <a href="admin_panel.php" class="back-button">Назад</a>
    <a href="add_product.php" class="add-product-button">Добавить товар</a>
</div>

</body>
</html>