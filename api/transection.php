<?php
session_start();
include './db.php'; // ไฟล์เชื่อมต่อฐานข้อมูล

// ตรวจสอบสิทธิ์ (ต้องล็อกอิน)
if (!isset($_SESSION['user_id'])) {
    echo "กรุณาเข้าสู่ระบบก่อน";
    exit();
}

// ดึงข้อมูล transaction
$sql = "SELECT id, transit, oderlist, amount, shipping, vat, netamount, mil, updated_at
        FROM sp_transaction 
        INNER JOIN users ON id = id
        ORDER BY updated_at DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตาราง Transaction</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>ตาราง Transaction</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>id สินค้า</th>
                <th>รายการสินค้า</th>
                <th>จำนวนเงิน</th>
                <th>ค่าจัดส่ง</th>
                <th>vat</th>
                <th>รวมค่าส่ง</th>
                <th>วันที่ทำรายการ</th>
                
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['transit']) ?></td>
                        <td><?= htmlspecialchars($row['oderlist']) ?></td>
                        <td><?= number_format($row['amount'], 2) ?></td>
                        <td><?= htmlspecialchars($row['shipping']) ?></td>
                        <td><?= htmlspecialchars($row['vat']) ?></td>
                        <td><?= htmlspecialchars($row['updated_at']) ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">ไม่มีข้อมูลการทำรายการ</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>

<?php
$conn->close();
?>