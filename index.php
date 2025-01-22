<?php
session_start();

// ตรวจสอบว่า session มีข้อมูล user_email หรือไม่
if (!isset($_SESSION['user_email'])) {
    echo "<p style='color: red; text-align: center;'>กรุณาเข้าสู่ระบบก่อนเข้าหน้านี้</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>it shop</title>

    <link rel="stylesheet" href="style.css">

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="index.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .text-user {
            font-size: 15px;
        }
    </style>
</head>

<body>
    <nav>
        <div class="nav-container">
            <a href="index.html">
                <img src="../ep3/image/image_logo.png" alt="logo" class="logo-nav">
            </a>

            <div class="nav-profile">

                <p class="nav-profile-name">
                <div class="nav-profile-name text-user">
                    <p>ชื่อบัญชี: <?php echo $_SESSION['user_name']; ?></p>
                    
                    <a href="./api/login/logout.php" style="color: red;">ออกจากระบบ</a>
                </div>
                </p>

                <div onclick="openCart()" style="cursor: pointer;" class="nav-profile-cart">
                    <i class="fas fa-cart-shopping"></i>
                    <div id="cartcount" class="cart-count" style="display: none;">
                        0
                    </div>
                </div>

            </div>
        </div>
    </nav>

    <div class="container">
        <div class="sidebar">
            <input onkeyup="search_product(this)" id="txt_search" type="text" class="sidebar-search" placeholder="ค้นหาสินค้า...">
            <a onclick="searchproduct('all')" class="sidebar-items">
                สินค้าทั้งหมด
            </a>
            <a onclick="searchproduct('laptop')" class="sidebar-items">
                laptop
            </a>
            <a onclick="searchproduct('smartphone')" class="sidebar-items">
                smartphone
            </a>
        </div>
        <div id="productlist" class="product">

        </div>
    </div>

    <div id="modalDesc" class="modal" style="display: none;"">
            <div onclick=" closeModal()" class="modal-bg"></div>
    <div class="modal-page">
        <h2>รายละเอียด</h2><br>
        <div class="modal-content">
            <img id="mdd-img" class="modal-img" src="https://images.unsplash.com/photo-1595675024853-0f3ec9098ac7?q=80&w=3087&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="">
            <div class="modal-detail">
                <p id="mdd-name" style="font-size: 1.5vw;">Product name</p>
                <p id="mdd-price" style="font-size: 1.2vw;">500 THB</p>
                <br>
                <p id="mdd-desc" style="color: #adadad;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil eos nulla provident distinctio exercitationem, blanditiis commodi unde ad voluptas, eaque asperiores pariatur. Amet vero hic provident perspiciatis deserunt quas, molestiae repellendus architecto nobis iste reiciendis nesciunt et totam assumenda sed eligendi, quos, recusandae ducimus ratione. Expedita molestias non harum optio.</p>
                <br>
                <div class="btn-control">
                    <button onclick="closeModal()" class="btn">
                        ยกเลิก
                    </button>
                    <button onclick="addtocart()" class="btn btn-buy ">
                        เพิ่มไปยังตระกร้า
                    </button>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div id="modalCart" class="modal" style="display: none;">
        <div onclick="closeModal()" class="modal-bg"></div>
        <div class="modal-page">
            <h2>ตระกร้าของฉัน</h2>
            <br>
            <div id="mycart" class="cartlist">



            </div>

            <div class="btn-control">
                <button onclick="closeModal()" class="btn">
                    ยกเลิก
                </button>
                <button onclick="confirmPurchase()" class="btn btn-buy">
                    ซื้อ
                </button>
            </div>
        </div>
    </div>

</body>

</html>