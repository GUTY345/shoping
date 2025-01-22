<?php
session_start();
include './login/con_db.php';

if (!isset($_GET['id'])) {
    echo "ไม่พบผู้ใช้ที่ต้องการแก้ไข";
    exit();
}

$user_id = $_GET['id'];


$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "ไม่พบผู้ใช้ที่ต้องการแก้ไข";
    exit();
}

$user = $result->fetch_assoc();

// อัปเดตข้อมูลผู้ใช้
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // ตรวจสอบว่ามีการเปลี่ยนรหัสผ่านหรือไม่
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // เข้ารหัสรหัสผ่านใหม่
        $update_sql = "UPDATE users SET username = ?, email = ?, password = ?, role = ? WHERE id = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("ssssi", $name, $email, $hashed_password, $role, $user_id);
    } else {
        $update_sql = "UPDATE users SET username = ?, email = ?, role = ? WHERE id = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("sssi", $name, $email, $role, $user_id);
    }

    if ($stmt->execute()) {
        echo "<script>alert('อัปเดตข้อมูลผู้ใช้เรียบร้อย'); window.location.href = 'manage_user.php';</script>";
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
    <title>แก้ไขข้อมูลผู้ใช้</title>
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

        input, select {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            margin-top: 5px;
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
        <h1>แก้ไขข้อมูลผู้ใช้</h1>
        <form method="POST" action="">
            <div>
                <label for="name">ชื่อผู้ใช้</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['username']) ?>" required>
            </div>
            <div>
                <label for="email">อีเมล</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
            </div>
            <div>
                <label for="password">รหัสผ่านใหม่ (ปล่อยว่างหากไม่ต้องการเปลี่ยน)</label>
                <input type="text" id="password" name="password" placeholder="กรอกรหัสผ่านใหม่">
            </div>
            <div>
                <label for="role">สิทธิ์</label>
                <select id="role" name="role" required>
                    <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                </select>
            </div>
            <button type="submit">บันทึกการเปลี่ยนแปลง</button>
            <a class="btn-cencle" href="manage_user.php">ยกเลิก</a>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>