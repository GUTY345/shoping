<?php
include './login/con_db.php';

// เพิ่มผู้ใช้
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = 'admin';

    $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($checkEmailQuery);

    if ($result->num_rows > 0) {
        echo "<script>alert('Email นี้มีอยู่ในระบบแล้ว');</script>";
    } else {
        $sql = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$password', '$role')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>
                alert('เพิ่มผู้ใช้สำเร็จแล้ว');
                window.location.href = './manage_user.php';
            </script>";
            exit;
        } else {
            echo "<script>
                alert('เกิดข้อผิดพลาด: " . $conn->error . "');
                window.location.href = ' ./meanage_user.php';
            </script>";
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มผู้ใช้</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1a1a2e;
            color: #fff;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background: #16213e;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }
        h1 {
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
        }
        input[type="text"], input[type="email"], input[type="password"], select, button {
            width: 30vw;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            background: #0f3460;
            color: #fff;
        }
        input::placeholder {
            color: #aaa;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
        .btn-cancel {
            display: inline-block;
            text-decoration: none;
            color: #fff;
            background: red;
            text-align: center;
            padding: 6px 14px;
            border-radius: 5px;
            transition: 0.4s;
        }
        .btn-cancel:hover {
            background: #900d0d;
            scale: 1.03;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>เพิ่มผู้ใช้</h1>
        <form action="./add_admin.php" method="POST">
            <label for="username">ชื่อผู้ใช้</label>
            <input type="text" name="username" id="username" required placeholder="ชื่อผู้ใช้">

            <label for="email">อีเมล</label>
            <input type="email" name="email" id="email" required placeholder="อีเมล">

            <label for="password">รหัสผ่าน</label>
            <input type="password" name="password" id="password" required placeholder="รหัสผ่าน">

            <label for="role">จำกัดสิทธิ์ที่ admin</label>
            <select name="role" id="role" required>
                <option value="admin">Admin</option>
            </select>
            <center>
            <button type="submit">เพิ่มผู้ใช้</button>
            </center>
            
            <center>
                <a class="btn-cancel" href="./manage_user.php">ยกเลิก</a>
            </center>
        </form>
    </div>
</body>
</html>