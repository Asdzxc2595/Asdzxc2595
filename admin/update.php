<?php
if (!isset($_SESSION['loggedin'])) {
    header("Location: loginadmin.php");
    exit;
}
require("../db_connect.php"); // เชื่อมต่อฐานข้อมูล

if (isset($_POST['submit'])) {
    // รับข้อมูลจากฟอร์ม
    $name_product = $_POST['name_product'];
    $type_product = $_POST['type_product'];
    $dtaill_product = $_POST['dtaill_product'];
    $date_product = $_POST['date_product'];
    $dtaill_vdo_product = $_POST['dtaill_vdo_product'];

    // ลบ https://www.youtube.com/watch/?v= และ https://youtu.be/ ออกจากลิงก์
    $dtaill_vdo_product = preg_replace('/^https:\/\/(www\.youtube\.com\/(watch\?v=|shorts\/)|youtu\.be\/)/', '', $dtaill_vdo_product);

    // จัดการกับรูปภาพสินค้า
    $img_product = null;
    if (isset($_FILES['img_product']) && $_FILES['img_product']['error'] == UPLOAD_ERR_OK) {
        $img_product = $_FILES['img_product']['name'];
        move_uploaded_file($_FILES['img_product']['tmp_name'], 'images/' . $img_product);
    }

    // จัดการกับรูปภาพรายละเอียด (หลายรูป)
    $dtaill_img_products = [];
    if (isset($_FILES['dtaill_img_product'])) {
        $file_count = count($_FILES['dtaill_img_product']['name']);
        for ($i = 0; $i < $file_count; $i++) {
            if ($_FILES['dtaill_img_product']['error'][$i] === UPLOAD_ERR_OK) {
                $file_name = $_FILES['dtaill_img_product']['name'][$i];
                move_uploaded_file($_FILES['dtaill_img_product']['tmp_name'][$i], 'images/' . $file_name);
                $dtaill_img_products[] = $file_name; // เก็บชื่อไฟล์ใน array
            }
        }
    }

    // ทำการเข้ารหัส (serialize) array เพื่อเก็บในฐานข้อมูล
    $dtaill_img_product = serialize($dtaill_img_products);

    // สร้างคำสั่ง SQL เพื่อเพิ่มข้อมูล
    $sql = "INSERT INTO product (name_product, img_product, type_product, dtaill_product, dtaill_img_product, date_product, dtaill_vdo_product) 
            VALUES (:name_product, :img_product, :type_product, :dtaill_product, :dtaill_img_product, :date_product, :dtaill_vdo_product)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'name_product' => $name_product,
        'img_product' => $img_product,
        'type_product' => $type_product,
        'dtaill_product' => $dtaill_product,
        'dtaill_img_product' => $dtaill_img_product,
        'date_product' => $date_product,
        'dtaill_vdo_product' => $dtaill_vdo_product
    ]);

    echo "เพิ่มสินค้าเรียบร้อยแล้ว";
}
?>
