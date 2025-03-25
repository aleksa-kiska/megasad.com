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

// Получаем товары из базы
$query = $pdo->query("SELECT * FROM products ORDER BY id DESC");
$products = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Удобрения</title>
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
  <style>
    body {
      font-family: 'Arial', sans-serif;
      text-align: center;
      background: linear-gradient(to bottom, #f3faf3, #dff6df);
      margin: 0;
      padding: 30px;
      min-height: 100vh; 
    }
    h1 {
      color: #2c5e1a;
      font-size: 32px;
      margin-bottom: 25px;
      text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
    }
    .subcategory {
      background: linear-gradient(135deg, #91c791, #5a915a);
      padding: 20px;
      border-radius: 15px;
      cursor: pointer;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 20px;
      max-width: 500px;
      margin: 15px auto;
      box-shadow: 4px 4px 12px rgba(0, 0, 0, 0.15);
      color: white;
    }
    .subcategory:hover {
      background: linear-gradient(135deg, #7dbb7d, #4c7f4c);
      transform: scale(1.05);
    }
    .subcategory img {
      width: 80px;
      height: 80px;
      border-radius: 10px;
      border: 2px solid white;
    }
    .products {
      display: none;
      margin-top: 15px;
    }
    .product-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
      justify-items: center;
      padding-top: 15px;
    }
    .product {
      background: white;
      padding: 18px;
      border-radius: 12px;
      border: 3px solid #91c791;
      text-align: center;
      box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
      max-width: 230px;
    }
    .product:hover {
      transform: scale(1.08);
      background: #e8fbe8;
      box-shadow: 6px 6px 12px rgba(0, 0, 0, 0.15);
    }
    .product img {
      width: 140px;
      height: 140px;
      object-fit: cover;
      border-radius: 10px;
      margin-bottom: 10px;
      transition: transform 0.3s ease;
    }
    .product:hover img {
      transform: scale(1.1);
    }
    .product p {
      font-size: 16px;
      margin: 5px 0;
    }
    .product p:nth-child(4) {
  font-weight: bold;
  font-size: 18px;
  color:rgb(0, 0, 0);
}
    .buttons-container {
      display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 30px;
    padding-bottom: 30px;
    }
    .button {
      display: inline-block;
      padding: 15px 30px;
      font-size: 18px;
      font-weight: bold;
      color: white;
      border-radius: 10px;
      text-decoration: none;
      transition: 0.3s ease;
      text-align: center;
    }
    .order-button {
      background-color: #5a915a;
    }
    .order-button:hover {
      background-color: #4c7f4c;
      transform: scale(1.05);
    }
    .back-button {
      background-color: #d9534f;
    }
    .back-button:hover {
      background-color: #c9302c;
      transform: scale(1.05);
    }
  </style>
</head>
<body>

  <h1>Удобрения</h1>

  <!-- Подкатегории -->
  <div class="subcategory" onclick="toggleProducts('organic')">
   <p style="text-align: center; width: 100%;"><strong>Органические</strong></p>
  </div>
  <div id="organic" class="products">
    <div class="product-container">
      <?php foreach ($products as $product): ?>
        <?php if ($product['subcategory_id'] == 5): ?>
          <div class="product">
            <img src="uploads/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
            <p><strong><?php echo htmlspecialchars($product['name']); ?></strong></p>
            <p>Артикул: <?php echo htmlspecialchars($product['article']); ?></p>
            <p>Цена: <?php echo htmlspecialchars($product['price']); ?> руб</p>
            <p><?php echo htmlspecialchars($product['description']); ?></p>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="subcategory" onclick="toggleProducts('mineral')">
   <p style="text-align: center; width: 100%;"><strong>Минеральные</strong></p>
  </div>
  <div id="mineral" class="products">
    <div class="product-container">
      <?php foreach ($products as $product): ?>
        <?php if ($product['subcategory_id'] == 6): ?>
          <div class="product">
            <img src="uploads/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
            <p><strong><?php echo htmlspecialchars($product['name']); ?></strong></p>
            <p>Артикул: <?php echo htmlspecialchars($product['article']); ?></p>
            <p>Цена: <?php echo htmlspecialchars($product['price']); ?> руб</p>
            <p><?php echo htmlspecialchars($product['description']); ?></p>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="subcategory" onclick="toggleProducts('seedlings')">
    <p style="text-align: center; width: 100%;"><strong>Для рассады</strong></p>
  </div>
  <div id="seedlings" class="products">
    <div class="product-container">
      <?php foreach ($products as $product): ?>
        <?php if ($product['subcategory_id'] == 7): ?>
          <div class="product">
            <img src="uploads/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
            <p><strong><?php echo htmlspecialchars($product['name']); ?></strong></p>
            <p>Артикул: <?php echo htmlspecialchars($product['article']); ?></p>
            <p>Цена: <?php echo htmlspecialchars($product['price']); ?> руб</p>
            <p><?php echo htmlspecialchars($product['description']); ?></p>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="subcategory" onclick="toggleProducts('universal')">
  <p style="text-align: center; width: 100%;"><strong>Универсальные</strong></p>
  </div>
  <div id="universal" class="products">
    <div class="product-container">
      <?php foreach ($products as $product): ?>
        <?php if ($product['subcategory_id'] == 8): ?>
          <div class="product">
            <img src="uploads/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
            <p><strong><?php echo htmlspecialchars($product['name']); ?></strong></p>
            <p>Артикул: <?php echo htmlspecialchars($product['article']); ?></p>
            <p>Цена: <?php echo htmlspecialchars($product['price']); ?> руб</p>
            <p><?php echo htmlspecialchars($product['description']); ?></p>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>
<div class="buttons-container">
    <a href="javascript:history.back()" class="button back-button">Назад</a>
    <a href="order_form.html" class="button order-button" target="_blank">Оформить заказ</a>
</div>
<script>
  function toggleProducts(category) {
    let element = document.getElementById(category);
    element.style.display = (element.style.display === 'block') ? 'none' : 'block';
  }
</script>

</body>
</html>