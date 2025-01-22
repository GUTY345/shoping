<?php
$host = "localhost";
$dbname = "shoping"; 
$username = "root"; 
$password = ""; 


$conn = new mysqli($host, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT COUNT(*) AS total_orders, SUM(price) AS total_sales FROM orders INNER JOIN order_items ON orders.id = order_items.order_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo json_encode(array("total_orders" => 0, "total_sales" => 0));
}

$conn->close();
?>