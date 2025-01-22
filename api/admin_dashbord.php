<?php
session_start();
include './login/con_db.php';


$sql = "SELECT COUNT(*) AS total_users FROM users";
$result = $conn->query($sql);
$total_users = 0;

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_users = $row['total_users'];
}
if (!isset($_SESSION['user_email'])) {
    echo "<p style='color: red; text-align: center;'>กรุณาเข้าสู่ระบบก่อนเข้าหน้านี้</p>";
    exit();
}
?>

<?php
session_start();
include './login/con_db.php';

$sql = "SELECT COUNT(*) AS total_products FROM sp_product";
$result = $conn->query($sql);
$total_products = 0;

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_products = $row['total_products'];
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>it shop</title>

    <link rel="stylesheet" href="./style.css">

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="./script.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background: rgb(36, 36, 36);
        }

        .sidebar-items {
            background: #848383;
            border: 1px solid transparent;
            color: #fff;
        }

        .sidebar-items:hover {
            scale: 1.02;
        }

        .item-exit {
            background: rgb(226, 23, 23);
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: 0.4s;
        }

        .item-exit:hover {
            background: rgb(26, 184, 26);
            scale: 1.02;
        }

        .card-data {
            border: 1px solid grey;
            padding: 15px 30px;
            border-radius: 10px;
            color: #fff;
            width: 30vw;
            cursor: pointer;
            transition: 0.4s;
        }

        .card-data:hover {
            scale: 1.04;
        }

        .product {
            margin-left: 60px;
        }
    </style>
</head>

<body>
    <header style="padding:40px;">
        <center>
            <h2 style="margin-bottom:20px; font-size: 3vw; color: #fff;">Admin Dashbord</h2>
        </center>
        <hr>
    </header>

    <div class="container">
        <div class="sidebar">
            <p style="color:#fff;">ชื่อบัญชี: <?php echo $_SESSION['user_name']; ?></p>
            <br>
            <a href="/ep3/api/admin_dashbord.php" class="sidebar-items">
                รีเซ็ตหน้าหลัก
            </a>
            <a href="./colum_product.php" class="sidebar-items">
                จัดการสินค้าในระบบ
            </a>
            <a href="/ep3/api/manage_user.php" class="sidebar-items">
                จัดการผู้ใช้ในระบบ
            </a>
            <a href="./colum_orders.php" class="sidebar-items">
                รายการออเดอร์ลูกค้า
            </a>
            <a href="./colum_orderitems.php" class="sidebar-items">
                รายการออเดอร์สินค้า
            </a>
            <a href="#" class="sidebar-items" id="manageReceipts">
                จัดการใบเสร็จ
            </a>
            <a style="font-size: 1.2vw;" href="./login/logout.php" class="item-exit">
                ออกจากระบบ
            </a>
        </div>
        <div id="product" class="product">
            <div class="card-data">
                <div class="icon">👥</div>
                <h1 style="font-size:1.5vw;"><?= $total_users ?></h1>
                <p style="font-size:1.2vw;">จำนวนผู้ใช้ทั้งหมด</p>
            </div>
            <div class="card-data">
                <div class="icon">🛒</div>
                <h1 style="font-size:1.5vw;"><?= $total_products ?></h1>
                <p style="font-size:1.2vw;">จำนวนสินค้าในระบบ</p>
            </div>
            <div class="card-data">
                <div class="icon">🛒</div>
                <h1 id="totalOrders" style="font-size:1.5vw;">0</h1>
                <p style="font-size:1.2vw;">จำนวนคำสั่งซื้อ</p>
            </div>

            <div class="card-data">
                <div class="icon">💰</div>
                <h1 id="totalSales" style="font-size:1.5vw;">0</h1>
                <p style="font-size:1.2vw;">ยอดขายรวม</p>
            </div>

            
                <div class="card-data" style="width: 85%; height: 200px;  border-radius: 8px; padding: 10px; margin-left:25px;">
                    <canvas id="orderChart"></canvas>
                </div>

                <div class="card-data" style="width: 85%; height: 200px;  border-radius: 8px; padding: 10px;">
                    <canvas id="salesChart"></canvas>
                </div>
           

        </div>



    </div>




    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // เมื่อคลิกที่ลิงก์ "จัดการใบเสร็จ"
        document.getElementById("manageReceipts").addEventListener("click", function(e) {
            e.preventDefault(); // ป้องกันการรีเฟรชหน้าเมื่อคลิกลิงก์

            // ใช้ SweetAlert2 แสดงข้อความ
            Swal.fire({
                title: 'รอปรับปรุง',
                text: 'อัพเดทเร็วๆนี้',
                icon: 'info', // ไอคอนที่แสดง
                confirmButtonText: 'ตกลง'
            });
        });
    </script>

    <script>
        // กราฟจำนวนคำสั่งซื้อ
        var orderChart = new Chart(document.getElementById("orderChart"), {
            type: 'bar', // ประเภทกราฟ
            data: {
                labels: ['วันนี้', 'เมื่อวาน', 'สัปดาห์นี้', 'เดือนนี้'], // ระยะเวลา
                datasets: [{
                    label: 'จำนวนคำสั่งซื้อ',
                    data: [12, 19, 3, 5], // ข้อมูลตัวอย่าง สามารถเปลี่ยนเป็นข้อมูลจริง
                    backgroundColor: 'rgba(54, 162, 235, 0.2)', // สีพื้นหลัง
                    borderColor: 'rgba(54, 162, 235, 1)', // สีเส้นขอบ
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // กราฟยอดขายรวม
        var salesChart = new Chart(document.getElementById("salesChart"), {
            type: 'line', // ประเภทกราฟ
            data: {
                labels: ['วันนี้', 'เมื่อวาน', 'สัปดาห์นี้', 'เดือนนี้'], // ระยะเวลา
                datasets: [{
                    label: 'ยอดขายรวม (บาท)',
                    data: [12000, 15000, 10000, 18000], // ข้อมูลยอดขายตัวอย่าง
                    fill: false,
                    borderColor: 'rgba(75, 192, 192, 1)', // สีเส้น
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // ฟังก์ชันสำหรับอัพเดทกราฟแบบเรียลไทม์
        function updateCharts(newOrderData, newSalesData) {
            orderChart.data.datasets[0].data = newOrderData;
            salesChart.data.datasets[0].data = newSalesData;

            orderChart.update();
            salesChart.update();
        }

        // ตัวอย่างการอัพเดทข้อมูลใหม่ (สามารถใช้ AJAX หรือ WebSocket เพื่อรับข้อมูลจริง)
        setInterval(function() {
            // ดึงข้อมูลใหม่จากฐานข้อมูลหรือ API
            var newOrderData = [Math.floor(Math.random() * 20), Math.floor(Math.random() * 20), Math.floor(Math.random() * 20), Math.floor(Math.random() * 20)];
            var newSalesData = [Math.floor(Math.random() * 20000), Math.floor(Math.random() * 20000), Math.floor(Math.random() * 20000), Math.floor(Math.random() * 20000)];

            // อัพเดทกราฟด้วยข้อมูลใหม่
            updateCharts(newOrderData, newSalesData);
        }, 5000); // ทุกๆ 5 วินาที
    </script>
</body>

</html>