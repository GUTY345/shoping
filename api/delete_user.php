<?php
session_start();
include './login/con_db.php';


if (!isset($_GET['id'])) {
    echo "ไม่พบผู้ใช้ที่ต้องการลบ";
    exit();
}

$user_id = $_GET['id'];


$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "ไม่พบผู้ใช้ที่ต้องการลบ";
    exit();
}

$user = $result->fetch_assoc();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $delete_sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        echo "<script>alert('ลบผู้ใช้เรียบร้อยแล้ว'); window.location.href = 'manage_user.php';</script>";
    } else {
        echo "เกิดข้อผิดพลาดในการลบผู้ใช้: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลบผู้ใช้</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: #242424;
            color: #fff;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 500px;
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

        p {
            text-align: center;
            font-size: 1.1em;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-top: 20px;
        }

        button {
            background: linear-gradient(135deg, #ff6b6b, #d32f2f);
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

        .cancel {
            background: #6c757d;
        }

        .cancel:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>ลบผู้ใช้</h1>
        <p>คุณต้องการลบผู้ใช้ <strong><?= htmlspecialchars($user['username']) ?></strong> ใช่หรือไม่?</p>
        <form method="POST" action="">
            <button type="submit">ยืนยันการลบ</button>
            <a href="manage_user.php" class="cancel" style="text-decoration: none; display: block; text-align: center; padding: 10px 0; background: #6c757d; border-radius: 5px; color: #fff; margin-top: 10px;">ยกเลิก</a>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>