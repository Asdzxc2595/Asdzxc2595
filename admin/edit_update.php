<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../login.php");
    exit;
}
require "../db_connect.php";

if (isset($_POST['submit'])) {
    $product_id = $_POST['product_id'];
    $name_product = $_POST['name_product'];
    $type_product = $_POST['type_product'];
    $dtaill_product = $_POST['dtaill_product'];
    $date_product = $_POST['date_product'];
    $dtaill_vdo_product = $_POST['dtaill_vdo_product'];

    // การจัดการการอัปโหลดไฟล์
    $img_product_sql = "";
    $params = [
        'name_product' => $name_product,
        'type_product' => $type_product,
        'dtaill_product' => $dtaill_product,
        'date_product' => $date_product,
        'dtaill_vdo_product' => $dtaill_vdo_product,
        'id_product' => $product_id
    ];

    if (isset($_FILES['img_product']) && $_FILES['img_product']['error'] == UPLOAD_ERR_OK) {
        $img_product = $_FILES['img_product']['name'];
        move_uploaded_file($_FILES['img_product']['tmp_name'], "../images/" . $img_product);
        $img_product_sql = "img_product = :img_product,";
        $params['img_product'] = $img_product;
    }

    // การจัดการไฟล์หลายไฟล์
    $dtaill_img_product_sql = "";
    if (isset($_FILES['dtaill_img_product']) && !empty($_FILES['dtaill_img_product']['name'][0])) {
        $images = [];
        foreach ($_FILES['dtaill_img_product']['name'] as $key => $name) {
            if ($_FILES['dtaill_img_product']['error'][$key] == UPLOAD_ERR_OK) {
                $image = $name;
                move_uploaded_file($_FILES['dtaill_img_product']['tmp_name'][$key], "../images/" . $image);
                $images[] = $image;
            }
        }
        $dtaill_img_product = serialize($images);
        $dtaill_img_product_sql = "dtaill_img_product = :dtaill_img_product,";
        $params['dtaill_img_product'] = $dtaill_img_product;
    }

    // สร้าง SQL Query ที่ไม่มีคอมม่าสำหรับคอลัมน์ที่ไม่ได้ใช้
    $sql = "UPDATE product SET
        name_product = :name_product,
        type_product = :type_product,
        dtaill_product = :dtaill_product,
        date_product = :date_product,
        dtaill_vdo_product = :dtaill_vdo_product"
        . ($img_product_sql ? ", $img_product_sql" : "")
        . ($dtaill_img_product_sql ? ", $dtaill_img_product_sql" : "") .
        " WHERE id_product = :id_product";

    $stmt = $pdo->prepare($sql);

    if ($stmt->execute($params)) {
        header("Location: product_list.php");
        exit;
    } else {
        echo "เกิดข้อผิดพลาดในการอัปเดตข้อมูลสินค้า";
    }
} else {
    echo "Invalid request";
    exit;
}
?>
