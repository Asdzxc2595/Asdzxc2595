<?php

require("db_connect.php"); // เชื่อมต่อฐานข้อมูล

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
                    <option value="ยา">ยา</option>
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