<?php
include 'db_connect.php';

if (isset($_POST['submit'])) {
    // รับข้อมูลจากฟอร์ม
    $name_product = $_POST['name_product'];
    $type_product = $_POST['type_product'];
    $dtaill_product = $_POST['dtaill_product'];
    $date_product = $_POST['date_product'];
    $dtaill_vdo_product = $_POST['dtaill_vdo_product'];

    // จัดการการอัปโหลดไฟล์
    $upload_dir = 'images/';

    $img_product = $_FILES['img_product']['name'];
    $img_product_tmp = $_FILES['img_product']['tmp_name'];
    $dtaill_img_product = $_FILES['dtaill_img_product']['name'];
    $dtaill_img_product_tmp = $_FILES['dtaill_img_product']['tmp_name'];

    // ตรวจสอบการอัปโหลดไฟล์
    if (move_uploaded_file($img_product_tmp, $upload_dir . $img_product) &&
        move_uploaded_file($dtaill_img_product_tmp, $upload_dir . $dtaill_img_product)) {
        
        // เพิ่มข้อมูลลงในฐานข้อมูล
        $stmt = $pdo->prepare("INSERT INTO product (name_product, img_product, type_product, dtaill_product, dtaill_img_product, date_product, dtaill_vdo_product) VALUES (:name_product, :img_product, :type_product, :dtaill_product, :dtaill_img_product, :date_product, :dtaill_vdo_product)");
        
        $result = $stmt->execute([
            ':name_product' => $name_product,
            ':img_product' => $img_product,
            ':type_product' => $type_product,
            ':dtaill_product' => $dtaill_product,
            ':dtaill_img_product' => $dtaill_img_product,
            ':date_product' => $date_product,
            ':dtaill_vdo_product' => $dtaill_vdo_product,
        ]);

        if ($result) {
            echo '<p>เพิ่มสินค้าสำเร็จ!</p>';
        } else {
            echo '<p>เกิดข้อผิดพลาดในการเพิ่มสินค้า.</p>';
        }
    } else {
        echo '<p>เกิดข้อผิดพลาดในการอัปโหลดไฟล์.</p>';
    }
}
?>