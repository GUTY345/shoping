<?php
session_start();
include 'con_db.php';

$U_name_P = $_POST["email"];
$U_pwd_P = $_POST["password"];


$sql = "SELECT * FROM users WHERE email = '$U_name_P' AND password = '$U_pwd_P'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $rs = $result->fetch_assoc();


    $_SESSION['user_id'] = $rs['id'];
    $_SESSION['user_name'] = $rs['username'];
    $_SESSION['user_email'] = $rs['email']; // เก็บอีเมลของผู้ใช้ใน session
    $_SESSION['user_role'] = $rs['role'];

    if ($rs["role"] === "admin") {
        header("Location:/ep3/api/admin_dashbord.php");
    } elseif ($rs["role"] === "user") {
        header("Location: /ep3/index.php");
    }
    exit();
} else {
    echo "<p style='color: red; text-align: center;'>อีเมลหรือรหัสผ่านไม่ถูกต้อง</p>";
}
$conn->close();
?>