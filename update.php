<?php

require("db_connect.php"); // เชื่อมต่อฐานข้อมูล

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
    if (isset($_FILES['img_product']) && $_FILES['img_product']['error'] == UPLOAD_ERR_OK) {
        $img_product = $_FILES['img_product']['name'];
        move_uploaded_file($_FILES['img_product']['tmp_name'], 'images/' . $img_product);
    } else {
        $img_product = null;
    }

    if (isset($_FILES['dtaill_img_product']) && $_FILES['dtaill_img_product']['error'] == UPLOAD_ERR_OK) {
        $dtaill_img_product = $_FILES['dtaill_img_product']['name'];
        move_uploaded_file($_FILES['dtaill_img_product']['tmp_name'], 'images/' . $dtaill_img_product);
    } else {
        $dtaill_img_product = null;
    }

    // สร้างคำสั่ง SQL เพื่อเพิ่มข้อมูล
    $sql = "INSERT INTO product (name_product, img_product, type_product, dtaill_product, dtaill_img_product, date_product, dtaill_vdo_product) VALUES (:name_product, :img_product, :type_product, :dtaill_product, :dtaill_img_product, :date_product, :dtaill_vdo_product)";

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
