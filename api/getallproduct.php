<?php 

require_once('./db.php');

header('Content-Type: application/json; charset=UTF-8');

try {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $object = new stdClass();
        $object->Result = array();
        $object->RespCode = 400; 
        $object->RespMessage = 'Bad Request';

        $db->exec("SET NAMES utf8mb4");

        $stmt = $db->prepare("SELECT * FROM sp_product ORDER BY id DESC");

        if ($stmt->execute()) {
            $num = $stmt->rowCount();
            if ($num > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    array_push($object->Result, $row);
                }

                $object->RespCode = 200;
                $object->RespMessage = 'สำเร็จ'; 
                http_response_code(200);
            } else {
                $object->RespCode = 404;
                $object->RespMessage = 'ไม่พบข้อมูล';
                http_response_code(404);
            }
        } else {
            $object->RespCode = 500;
            $object->RespMessage = 'ข้อผิดพลาดในการรัน SQL';
            http_response_code(500);
        }

        echo json_encode($object, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    } else {
        http_response_code(405);
        echo json_encode([
            "RespCode" => 405,
            "RespMessage" => "Method ไม่รองรับ: ใช้ GET เท่านั้น",
        ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        "RespCode" => 500,
        "RespMessage" => "ข้อผิดพลาดภายในเซิร์ฟเวอร์",
        "Error" => $e->getMessage(),
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}
?>