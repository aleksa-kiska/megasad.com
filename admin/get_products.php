<?php
header('Content-Type: application/json');
require 'db.php'; // Подключаем файл с соединением к БД

$sql = "SELECT 
            p.id AS product_id, p.name AS product_name, p.article, p.price, p.description, p.image, 
            s.id AS subcategory_id, s.name AS subcategory_name, 
            c.id AS category_id, c.name AS category_name
        FROM products p
        JOIN subcategories s ON p.subcategory_id = s.id
        JOIN categories c ON s.category_id = c.id";
        
$result = $conn->query($sql);

$categories = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categoryName = $row['category_name'];
        $subcategoryName = $row['subcategory_name'];

        if (!isset($categories[$categoryName])) {
            $categories[$categoryName] = [];
        }
        if (!isset($categories[$categoryName][$subcategoryName])) {
            $categories[$categoryName][$subcategoryName] = [];
        }

        $categories[$categoryName][$subcategoryName][] = [
            'id' => $row['product_id'],
            'name' => $row['product_name'],
            'article' => $row['article'],
            'price' => $row['price'],
            'description' => $row['description'],
            'image' => $row['image']
        ];
    }
}

echo json_encode($categories, JSON_UNESCAPED_UNICODE);
?>
