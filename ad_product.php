<?php

require("db_connect.php"); // เชื่อมต่อฐานข้อมูล

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>เพิ่มสินค้า</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1 class="mt-5">เพิ่มสินค้าใหม่</h1>
        <form action="update.php" method="post" enctype="multipart/form-data">
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
                <select class="form-control" id="type_product" name="type_product">
                    <option value="เครื่องสำอาง">เครื่องสำอาง</option>
                    <option value="อาหารเสริม">อาหารเสริม</option>
                    <option value="สินค้า">สินค้า</option>
                </select>
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
                <label for="dtaill_vdo_product">ลิงก์วิดีโอรายละเอียด YouTube </label>
                <input type="text" class="form-control" id="dtaill_vdo_product" name="dtaill_vdo_product">
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