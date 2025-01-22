<?php
if (password_verify($user_password, $user['password'])) {
    session_start();
    $_SESSION['user_name'] = $user['name'];
    $_SESSION['user_email'] = $user['email'];

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> เข้าสู่ระบบ </title>

    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    <section class="container forms">
        <div class="form login">
            <div class="form-content">
                <header>เข้าสู่ระบบ</header>
                <form action="./check.php" method="post">
                    <div class="field input-field">
                        <input type="email" name="email" placeholder="Email" class="input">
                    </div>

                    <div class="field input-field">
                        <input type="password" placeholder="Password" name="password" class="password">
                        <i class='bx bx-hide eye-icon'></i>
                    </div>

                    <div class="form-link">
                        <a href="#" class="forgot-pass">ลืมรหัสผ่าน?</a>
                    </div>

                    <div class="field button-field">
                        <button>เข้าสู่ระบบ</button>
                    </div>
                </form>

                <div class="form-link">
                    <span>คุณไม่มี บัญชีใช่ไหม? <a href="#" class="link signup-link">สมัครสมาชิก</a></span>
                </div> <br><br>
                <center><a style="font-size: 13px;" href="/ep3/user_product/index.html">กลับไปยังหน้าหลัก🏠</a></center>
            </div>
        </div>

        <!-- Signup Form -->

        <div class="form signup">
            <div class="form-content">
                <header>สมัครสมาชิก</header>
                <form method="POST" action="./ signup_process.php">
                    
                    <div class="field input-field">
                        <input type="text" name="username" placeholder="username" class="input" required>
                    </div>

                    <div class="field input-field">
                        <input type="email" name="email" placeholder="Email" class="input" required>
                    </div>

                    <div class="field input-field">
                        <input type="password" name="password" placeholder="Create password" class="password" required>
                    </div>

                    <div class="field input-field">
                        <input type="password" name="confirm_password" placeholder="Confirm password" class="password" required>
                    </div>

                    <div class="field button-field">
                        <button type="submit">สมัครสมาชิก</button>
                    </div>
                </form>

                <div class="form-link">
                    <span>คุณมีบัญชีแล้ว? <a href="login.php" class="link login-link">เข้าสู่ระบบ</a></span>
                </div>
            </div>
        </div>
    </section>

    <!-- JavaScript -->
    <script src="js/script.js"></script>
</body>

</html>