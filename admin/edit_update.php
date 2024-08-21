<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../login.php");
    exit;
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require("../db_connect.php");

// ตรวจสอบว่ามีการส่งค่า ID มาหรือไม่
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    echo "ได้รับ ID สินค้า: " . htmlspecialchars($product_id) . "<br>"; // แสดงข้อความเมื่อได้รับ ID

    // ดึงข้อมูลสินค้าจากฐานข้อมูล
    $sql = "SELECT * FROM product WHERE id_product = :id_product";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id_product' => $product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    // ถ้าไม่พบสินค้า ให้ redirect กลับไปหน้ารายการสินค้า
    if (!$product) {
        header("Location: product_list.php");
        exit;
    }

    // ตรวจสอบว่ามีการส่งข้อมูลมาจากฟอร์มหรือไม่
    if (isset($_POST['submit'])) {
        $name_product = $_POST['name_product'];
        $type_product = $_POST['type_product'];
        $dtaill_product = $_POST['dtaill_product'];
        $date_product = $_POST['date_product'];
        $dtaill_vdo_product = $_POST['dtaill_vdo_product'];
        
        // จัดการกับรูปภาพสินค้า
        if (isset($_FILES['img_product']) && $_FILES['img_product']['error'] == UPLOAD_ERR_OK) {
            $img_product = $_FILES['img_product']['name'];
            move_uploaded_file($_FILES['img_product']['tmp_name'], '../images/' . $img_product);
        } else {
            $img_product = $product['img_product']; // ถ้าไม่มีการอัปโหลดรูปใหม่ ให้ใช้รูปเก่า
        }

        // จัดการกับรูปภาพรายละเอียด (หลายรูป)
        $dtaill_img_products = [];
        if (isset($_FILES['dtaill_img_product'])) {
            $file_count = count($_FILES['dtaill_img_product']['name']);
            for ($i = 0; $i < $file_count; $i++) {
                if ($_FILES['dtaill_img_product']['error'][$i] === UPLOAD_ERR_OK) {
                    $file_name = $_FILES['dtaill_img_product']['name'][$i];
                    move_uploaded_file($_FILES['dtaill_img_product']['tmp_name'][$i], '../images/' . $file_name);
                    $dtaill_img_products[] = $file_name;
                }
            }
        } else {
            $dtaill_img_products = json_decode($product['dtaill_img_product'], true); // ใช้รูปเดิม
        }

        // ทำการเข้ารหัส (serialize) array เพื่อเก็บในฐานข้อมูล
        $dtaill_img_product = serialize($dtaill_img_products);

        // อัปเดตข้อมูลในฐานข้อมูล
        $sql = "UPDATE product SET name_product = :name_product, img_product = :img_product, type_product = :type_product, dtaill_product = :dtaill_product, dtaill_img_product = :dtaill_img_product, date_product = :date_product, dtaill_vdo_product = :dtaill_vdo_product WHERE id_product = :id_product";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'name_product' => $name_product,
            'img_product' => $img_product,
            'type_product' => $type_product,
            'dtaill_product' => $dtaill_product,
            'dtaill_img_product' => $dtaill_img_product,
            'date_product' => $date_product,
            'dtaill_vdo_product' => $dtaill_vdo_product,
            'id_product' => $product_id
        ]);

        echo "อัปเดตข้อมูลสินค้าเรียบร้อยแล้ว";
        exit;
    }

} else {
    
    echo 'ส่ง ID ไม่สำเร็จ';
    exit;
}
?>
