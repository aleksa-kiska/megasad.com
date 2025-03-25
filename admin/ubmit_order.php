<?php
$servername = "localhost";
$username = "root"; // Укажи своего пользователя MySQL
$password = ""; // Укажи свой пароль
$dbname = "shop_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

$name = $_POST["name"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$order_data = json_encode($_POST["orders"]); // Сохраняем товары в JSON

$sql = "INSERT INTO orders (name, phone, email, order_data) VALUES ('$name', '$phone', '$email', '$order_data')";

if ($conn->query($sql) === TRUE) {
    echo "success";
} else {
    echo "Ошибка: " . $conn->error;
}

$conn->close();
?>
