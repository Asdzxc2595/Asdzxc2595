<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../login.php");
    exit;
}
require("../db_connect.php");

// ดึงข้อมูลจากฐานข้อมูล
$sql = "SELECT * FROM product";
$stmt = $pdo->query($sql);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>เพิ่มสินค้า</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.3.0/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#dtaill_product',
            plugins: 'advlist autolink lists link image charmap preview anchor textcolor',
            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
            menubar: false
        });
    </script>
</head>

<body>
<div class="header_section header_bg">
        <div class="container-fluid">
            <?php include 'nav_admin.php'; ?>
        </div>
    </div>
    <div class="container">
        <h1 class="mt-5">เพิ่มสินค้าใหม่</h1>
        <form action="update.php" method="post" enctype="multipart/form-data">
            <div class="form-group-edit">
                <label for="name_product">ชื่อสินค้า</label>
            </div>
            <div class="form-group-edit">
                <input type="text" class="form-edit" id="name_product" name="name_product" required>
            </div>
            <div class="form-group-edit">
                <label for="img_product">รูปภาพสินค้า</label>
                <input type="file" class="form-edit" id="img_product" name="img_product" required>
            </div>
            <div class="form-group-edit">
                <label for="type_product">ประเภทสินค้า</label>
                <select class="form-edit" id="type_product" name="type_product">
                    <option value="เครื่องสำอาง">เครื่องสำอาง</option>
                    <option value="อาหารเสริม">อาหารเสริม</option>
                    <option value="สินค้า">สินค้า</option>
                </select>
            </div>
            <div class="form-group-edit">
                <label for="dtaill_product">รายละเอียดสินค้า</label>
                <textarea class="form-edit" id="dtaill_product" name="dtaill_product" rows="3"></textarea>
            </div>
            <div class="form-group-edit">
    <label for="dtaill_img_product">ภาพรายละเอียด</label>
    <input type="file" class="form-edit" id="dtaill_img_product" name="dtaill_img_product[]" multiple>
</div>
            <div class="form-group-edit">
                <label for="date_product">วันที่</label>
                <input type="date" class="form-edit" id="date_product" name="date_product">
            </div>
            <div class="form-group-edit">
                <label for="dtaill_vdo_product">ลิงก์วิดีโอรายละเอียด YouTube </label>
                <input type="text" class="form-edit" id="dtaill_vdo_product" name="dtaill_vdo_product">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">เพิ่มสินค้า</button>
        </form>

        </form>

        </form>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>