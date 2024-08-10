<?php
include 'db_connect.php';

if (isset($_POST['submit'])) {
    echo "test no error";
    // รับข้อมูลจากฟอร์ม
    $id_product = $_POST['id_product'];
    $name_product = $_POST['name_product'];
    $type_product = $_POST['type_product'];
    $dtaill_product = $_POST['dtaill_product'];
    $date_product = $_POST['date_product'];
    $dtaill_vdo_product = $_POST['dtaill_vdo_product'];

    $upload_dir = 'images/';

    $img_product = $_FILES['img_product']['name'];
    $img_product_tmp = $_FILES['img_product']['tmp_name'];
    $dtaill_img_product = $_FILES['dtaill_img_product']['name'];
    $dtaill_img_product_tmp = $_FILES['dtaill_img_product']['tmp_name'];

if (move_uploaded_file($img_product_tmp, $upload_dir . $img_product) &&
    move_uploaded_file($dtaill_img_product_tmp, $upload_dir . $dtaill_img_product)) {

    $stmt = $pdo->prepare("INSERT INTO product (id_product ,name_product, img_product, type_product, dtaill_product, dtaill_img_product, date_product, dtaill_vdo_product) 
                                         VALUES (:id_product,:name_product, :img_product, :type_product, :dtaill_product, :dtaill_img_product, :date_product, :dtaill_vdo_product)");
    
    $result = $stmt->execute([
       ':id_product' => $id_product,
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
        $error = $stmt->errorInfo();
        echo '<p>เกิดข้อผิดพลาดในการเพิ่มสินค้า: ' . $error[2] . '</p>';
    }
} else {
    echo '<p>การอัปโหลดไฟล์ไม่สำเร็จ</p>';
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Add Product</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <div class="container">
        <h1 class="mt-5">เพิ่มสินค้าใหม่</h1>
        <form action="add_product.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name_product">ชื่อสินค้า</label>
                <input type="text" class="form-control" id="name_product" name="name_product" required>
            </div>
            <div class="form-group">
                <label for="img_product">รูปภาพสินค้า</label>
                <input type="file" class="form-control" id="img_product" name="img_product" required>
            </div>
            <div class="form-group">
                <label for="type_product">ประเภทสินค้า</label>
                <input type="text" class="form-control" id="type_product" name="type_product">
            </div>
            <div class="form-group">
                <label for="dtaill_product">รายละเอียดสินค้า</label>
                <textarea class="form-control" id="dtaill_product" name="dtaill_product" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="dtaill_img_product">ภาพรายละเอียด</label>
                <input type="file" class="form-control" id="dtaill_img_product" name="dtaill_img_product">
            </div>
            <div class="form-group">
                <label for="date_product">วันที่</label>
                <input type="date" class="form-control" id="date_product" name="date_product">
            </div>
            <div class="form-group">
                <label for="dtaill_vdo_product">ลิงก์วิดีโอรายละเอียด</label>
                <input type="text" class="form-control" id="dtaill_vdo_product" name="dtaill_vdo_product">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">เพิ่มสินค้า</button>

        </form>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>