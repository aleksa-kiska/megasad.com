<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление заказами</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
    <style>
        body { margin: 0; padding: 20px; background-color: #f4f4f9; font-family: Arial, sans-serif; text-align: center; }
        h2 { font-size: 28px; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: center; font-size: 16px; }
        th { background-color: #4CAF50; color: white; }
        .btn { padding: 8px 12px; border: none; cursor: pointer; border-radius: 5px; font-size: 14px; color: white; }
        .btn-view { background-color: #007bff; }
        .btn-delete { background-color: #dc3545; }
        .btn-back { background-color: #7dbb7d; }
        .btn:hover { opacity: 0.8; }
        .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); }
        .modal-content { background: white; padding: 20px; margin: 10% auto; width: 90%; max-width: 500px; text-align: center; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); border-radius: 5px; }
        .close { float: right; font-size: 24px; cursor: pointer; }
        .back-container { text-align: center; margin-top: 20px; }
        @media (max-width: 768px) {
            table, th, td { font-size: 14px; padding: 8px; }
            .btn { font-size: 12px; padding: 6px 10px; }
        }
        @media (max-width: 480px) {
            body { padding: 10px; }
            h2 { font-size: 22px; }
            table, th, td { font-size: 12px; padding: 6px; }
            .btn { font-size: 10px; padding: 5px 8px; }
            .modal-content { width: 95%; }
        }
    </style>
</head>
<body>
<h2>Управление заказами</h2>
<table>
    <tr>
        <th>№</th>
        <th>Дата</th>
        <th>Имя</th>
        <th>Телефон</th>
        <th>Email</th>
        <th>Действие</th>
    </tr>
    <tbody id="orders-list"></tbody>
</table>
<div id="orderModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h3>Детали заказа</h3>
        <table id="orderDetails">
            <tr>
                <th>№</th>
                <th>Артикул</th>
                <th>Количество</th>
            </tr>
        </table>
    </div>
</div>
<script>
    function loadOrders() {
        let ordersList = document.getElementById("orders-list");
        let orders = JSON.parse(localStorage.getItem("orders")) || [];
        ordersList.innerHTML = "";
        orders.forEach((order, index) => {
            let row = document.createElement("tr");
            row.innerHTML = `
                <td>${index + 1}</td>
                <td>${order.date}</td>
                <td>${order.name}</td>
                <td>${order.phone}</td>
                <td>${order.email}</td>
                <td>
                    <button class="btn btn-view" onclick="viewOrder(${order.id})">Посмотреть заказы</button>
                    <button class="btn btn-delete" onclick="deleteOrder(${order.id})">Удалить</button>
                </td>
            `;
            ordersList.appendChild(row);
        });
    }
    function viewOrder(orderId) {
        let orders = JSON.parse(localStorage.getItem("orders")) || [];
        let order = orders.find(order => order.id === orderId);
        let orderDetails = document.getElementById("orderDetails");
        orderDetails.innerHTML = `<tr><th>№</th><th>Артикул</th><th>Количество</th></tr>`;
        if (order && order.orders && order.orders.length > 0) {
            order.orders.forEach((item, index) => {
                let row = document.createElement("tr");
                row.innerHTML = `<td>${index + 1}</td><td>${item.article}</td><td>${item.quantity}</td>`;
                orderDetails.appendChild(row);
            });
            document.getElementById("orderModal").style.display = "block";
        } else {
            alert("Этот заказ не содержит товаров!");
        }
    }
    function closeModal() {
        document.getElementById("orderModal").style.display = "none";
    }
    function deleteOrder(orderId) {
        let orders = JSON.parse(localStorage.getItem("orders")) || [];
        orders = orders.filter(order => order.id !== orderId);
        localStorage.setItem("orders", JSON.stringify(orders));
        loadOrders();
    }
    loadOrders();
</script>
<div class="back-container">
    <button class="btn btn-back" onclick="history.back()">Назад</button>
</div>
</body>
</html>