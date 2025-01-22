<?php
// ตรวจสอบว่าได้รับข้อมูลจาก POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // ดึงข้อมูลจาก POST
    $customer_name = $_POST['customer_name'];
    $shipping_address = $_POST['shipping_address'];
    $cart_items = json_decode($_POST['cart_items'], true);  // แปลง JSON เป็น array

    // เชื่อมต่อฐานข้อมูล (เปลี่ยนตามค่าของคุณ)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "shoping";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // ตรวจสอบการเชื่อมต่อ
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // สร้างคำสั่ง SQL สำหรับบันทึกการสั่งซื้อ
    $sql = "INSERT INTO orders (customer_name, shipping_address, order_date) VALUES ('$customer_name', '$shipping_address', NOW())";
    
    if ($conn->query($sql) === TRUE) {
        // รับ ID ของการสั่งซื้อที่สร้างขึ้น
        $order_id = $conn->insert_id;

        // บันทึกสินค้าในตะกร้าลงในฐานข้อมูล (หลายสินค้าจะใช้ LOOP)
        foreach ($cart_items as $item) {
            $product_name = $item['product_name'];
            $price = $item['price'];

            $sql_item = "INSERT INTO order_items (order_id, product_name, price) VALUES ('$order_id', '$product_name', '$price')";
            $conn->query($sql_item);
        }

        // ส่งการตอบกลับสำเร็จ
        echo "สั่งซื้อสำเร็จ";
    } else {
        echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . $conn->error;
    }

    // ปิดการเชื่อมต่อฐานข้อมูล
    $conn->close();
}
?>