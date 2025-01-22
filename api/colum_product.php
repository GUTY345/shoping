<?php
require_once('./db.php');


header('Content-Type: text/html; charset=UTF-8');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'add') {
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $price = isset($_POST['price']) ? floatval($_POST['price']) : 0;
        $stock = isset($_POST['stock']) ? trim($_POST['stock']) : ''; 
        $type = isset($_POST['type']) ? trim($_POST['type']) : '';   
        $img = isset($_POST['img']) ? trim($_POST['img']) : '';     

        if ($name && $price > 0 && $stock !== '' && $type !== '' && $img !== '') {
            $stmt = $db->prepare("INSERT INTO sp_product (name, price, description, type, img) VALUES (?, ?, ?, ?, ?)");
            if ($stmt->execute([$name, $price, $stock, $type, $img])) {
                $message = "เพิ่มสินค้าสำเร็จ!";
            } else {
                $message = "เกิดข้อผิดพลาดในการเพิ่มสินค้า!";
            }
        } else {
            $message = "กรุณากรอกข้อมูลให้ครบถ้วน!";
        }
    }
    if (isset($_POST['action']) && $_POST['action'] === 'delete') {
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        if ($id > 0) {
            $stmt = $db->prepare("DELETE FROM sp_product WHERE id = ?");
            if ($stmt->execute([$id])) {
                $message = "ลบสินค้าสำเร็จ!";
            } else {
                $message = "เกิดข้อผิดพลาดในการลบสินค้า!";
            }
        }
    }
}


$stmt = $db->prepare("SELECT * FROM sp_product ORDER BY id DESC");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        .nav-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
        }

        .button-exit {
            padding: 10px 15px;
            background: rgb(57, 211, 37);
            border-radius: 10px;
            transition: 0.4s;
        }

        .button-exit a {
            color: #fff;
            text-decoration: none;
        }

        .button-exit:hover {
            background: red;
            scale: 1.05;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="nav-header">
            <div class="text-logo">
                <h1>Admin Dashboard</h1>
            </div>
            <div class="button-exit">
                <a href="./admin_dashbord.php">กลับไปยังหน้าแรก</a>
            </div>

        </div>

        <hr>
        <?php if (isset($message)): ?>
            <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

       
        <h2>เพิ่มสินค้าใหม่</h2>
        <br>
        <form method="POST" class="mb-4">
            <input type="hidden" name="action" value="add">
            <div class="mb-3">
                <label for="name" class="form-label">ชื่อสินค้า</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">ราคาสินค้า (บาท)</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">รายละเอียดของสินค้า</label>
                <input type="text" class="form-control" id="stock" name="stock" required>
            </div>
            <div class="mb-3">
                <label for="img" class="form-label">ชื่อไฟล์รูปสินค้า ตัวอย่าง ชื่อไฟล์.นามสกุลไฟล์</label>
                <input type="text" class="form-control" id="img" name="img" required>
            </div>
            
            <div class="mb-3">
                <label for="type">ประเภทสินค้า: </label>
                <select id="type" name="type" required>
                    <option value="laptop">laptop</option>
                    <option value="smartphone">smartphone</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">เพิ่มสินค้า</button>
        </form>

        
        <h2>รายการสินค้า</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ชื่อสินค้า</th>
                    <th>ราคา (บาท)</th>
                    <th>คำอธิบายสินค้า</th>
                    <th>ชื่อไฟล์รูป</th>
                    <th>ประเภท</th>
                    <th>การจัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($products): ?>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?= htmlspecialchars($product['id']) ?></td>
                            <td><?= htmlspecialchars($product['name']) ?></td>
                            <td><?= htmlspecialchars(number_format($product['price'], 2)) ?></td>
                            <td><?= htmlspecialchars($product['description']) ?></td>
                            <td><?= htmlspecialchars($product['img']) ?></td>
                            <td><?= htmlspecialchars($product['type']) ?></td>
                            <td>
                                <!-- ปุ่มแก้ไขสินค้า -->
                                <a href="edit_product.php?id=<?= htmlspecialchars($product['id']) ?>"
                                    class="btn btn-primary btn-sm">แก้ไข</a>
                                <br><br>

                                <!-- ปุ่มลบสินค้า -->
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']) ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">ลบ</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">ไม่มีสินค้าในระบบ</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>