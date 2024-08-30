<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../login.php");
    exit;
}

require("../db_connect.php");

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    $sql = "SELECT * FROM product WHERE id_product = :id_product";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id_product' => $product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        header("Location: product_list.php");
        exit;
    }

    if (isset($_POST['submit'])) {
        $name_product = $_POST['name_product'];
        $type_product = $_POST['type_product'];
        $dtaill_product = $_POST['dtaill_product'];
        $date_product = $_POST['date_product'];

        $dtaill_vdo_product = preg_replace('/^(https:\/\/(?:www\.)?(?:youtube\.com\/(?:watch\?v=|shorts\/)|youtu\.be\/))/', '', $_POST['dtaill_vdo_product']);

        if (isset($_FILES['img_product']) && $_FILES['img_product']['error'] == UPLOAD_ERR_OK) {
            $img_product = $_FILES['img_product']['name'];
            move_uploaded_file($_FILES['img_product']['tmp_name'], '../images/' . $img_product);
        } else {
            $img_product = $product['img_product'];
        }

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
            $dtaill_img_products = json_decode($product['dtaill_img_product'], true);
        }

        $dtaill_img_product = json_encode($dtaill_img_products);

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
        echo '<p><p><h1><a href="dashboard.php">กลับไปยังหน้าหลัก</a>';
    }
} else {
    echo 'ส่ง ID ไม่สำเร็จ';
}
?>
