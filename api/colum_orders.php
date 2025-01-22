<?php
// เชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$database = "shoping";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
}

// ดึงข้อมูลออเดอร์จากฐานข้อมูล
$sql = "SELECT * FROM orders ORDER BY order_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายการออเดอร์</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .button-exit {
            text-decoration: none;
            background: green;
            color: white;
            border-radius: 5px;
            padding: 10px 20px;
            transition: 0.4s;
            margin-bottom: 20px;
        }
        .button-exit:hover {
            background: red;
            scale: 1.03;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">รายการออเดอร์</h1>
        <div class="table-responsive">
            <a class="button-exit" href="./admin_dashbord.php">กลับไปยังหน้าหลัก</a><br><br>
            <table class="table table-striped table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th>รหัสออเดอร์</th>
                        <th>ชื่อลูกค้า</th>
                        <th>ที่อยู่จัดส่ง</th>
                        <th>วันที่สั่งซื้อ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['customer_name'] ?></td>
                                <td><?= $row['shipping_address'] ?></td>
                                <td><?= date("d/m/Y H:i", strtotime($row['order_date'])) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">ไม่มีข้อมูลออเดอร์</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>