<?php
session_start();
include './login/con_db.php';

// ตรวจสอบว่าสินค้ามีอยู่หรือไม่
if (!isset($_GET['id'])) {
    echo "ไม่พบสินค้าที่ต้องการแก้ไข";
    exit();
}

$product_id = $_GET['id'];


$sql = "SELECT * FROM sp_product WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "ไม่พบสินค้าที่ต้องการแก้ไข";
    exit();
}

$product = $result->fetch_assoc();

// อัปเดตข้อมูลสินค้า
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $file_name = $_POST['img'];
    $category = $_POST['type'];
    $description = $_POST['description'];

    $update_sql = "UPDATE sp_product SET name = ?, price = ?, img = ?, type = ?, description = ? WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("sdsssi", $name, $price, $file_name, $category, $description, $product_id);

    if ($stmt->execute()) {
        echo "<script>alert('อัปเดตข้อมูลสินค้าเรียบร้อย'); window.location.href = 'colum_product.php';</script>";
    } else {
        echo "เกิดข้อผิดพลาดในการอัปเดตข้อมูล: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขสินค้า</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: #242424;
            color: #fff;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #333;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-size: 1.1em;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            margin-top: 5px;
        }

        textarea {
            height: 100px;
        }

        button {
            background: linear-gradient(135deg, #6c63ff, #3f3d9e);
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
        }
        .btn-cencle {
            text-decoration: none;
            color: #fff;
            background: red;
            text-align: center;
            padding: 10px 20px;
            border-radius: 5px;
            transition: 0.4s;
        }
        .btn-cencle:hover {
            background: #3f3d9e;
            scale: 1.03;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>แก้ไขสินค้า</h1>
        <form method="POST" action="">
    <div>
        <label for="name">ชื่อสินค้า</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
    </div>
    <div>
        <label for="price">ราคา (บาท)</label>
        <input type="number" id="price" name="price" value="<?= htmlspecialchars($product['price']) ?>" step="0.01" required>
    </div>
    <div>
        <label for="file_name">ชื่อไฟล์รูป</label>
        <input type="text" id="file_name" name="img" value="<?= htmlspecialchars($product['img']) ?>" required>
    </div>
    <div>
        <label for="category">ประเภทสินค้า</label>
        <select id="type" name="type" required>
            <option value="laptop" <?= $product['type'] === 'laptop' ? 'selected' : '' ?>>laptop</option>
            <option value="smartphone" <?= $product['type'] === 'smartphone' ? 'selected' : '' ?>>smartphone</option>
        </select>
    </div>
    <div>
        <label for="description">รายละเอียดสินค้า</label>
        <textarea id="description" name="description" required><?= htmlspecialchars($product['description']) ?></textarea>
    </div>
    <button type="submit">บันทึกการเปลี่ยนแปลง</button>
     <a class="btn-cencle" href="colum_product.php">ยกเลิก</a>
</form>
    </div>
</body>
</html>

<?php
$conn->close();
?>