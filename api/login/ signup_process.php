<?php
session_start();
include './con_db.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    
    if ($password !== $confirm_password) {
        echo "<script>alert('รหัสผ่านไม่ตรงกัน'); window.history.back();</script>";
        exit();
    }

    
    $check_sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($check_sql);
    if (!$stmt) {
        die("การเตรียมคำสั่งล้มเหลว: " . $conn->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('อีเมลนี้มีผู้ใช้งานแล้ว'); window.history.back();</script>";
        exit();
    }

    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    
    $role = 'user';
    $insert_sql = "INSERT INTO users (email, username, password, role) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_sql);
    if (!$stmt) {
        die("การเตรียมคำสั่งล้มเหลว: " . $conn->error);
    }
    $stmt->bind_param("ssss", $email, $username, $hashed_password, $role);

    if ($stmt->execute()) {
        echo "<script>alert('สมัครสมาชิกสำเร็จ'); window.location.href = 'login.php';</script>";
    } else {
        echo "เกิดข้อผิดพลาด: " . $conn->error;
    }
}

$conn->close();
?>