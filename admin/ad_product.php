<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../login.php");
    exit;
}
require("../db_connect.php");

// ดึงข้อมูลประเภทสินค้า
$sql = "SELECT id_type, name_type FROM type";
$stmt = $pdo->query($sql);
$types = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>เพิ่มสินค้า</title>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        tinymce.init({
            selector: 'textarea#detail',
            plugins: 'advlist anchor autolink autosave charmap code codesample directionality emoticons fullscreen help image imagetools insertdatetime link lists media nonbreaking pagebreak paste preview print save searchreplace spellchecker table template textcolor visualblocks visualchars wordcount',
            toolbar: 'undo redo | formatselect | link image | fontselect fontsizeselect | bold italic underline strikethrough | forecolor backcolor removeformat | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table emoticons charmap | preview fullscreen code',
            menubar: 'file edit view insert format tools table',
        });
    });
    </script>
</head>

<body>
    <?php include 'sidebar.php'; ?>
    <div class="container mt-5">
        <h1 class="mt-5">เพิ่มสินค้าใหม่</h1>
        <div class="card card-body">
            <form action="save_product.php" method="post" enctype="multipart/form-data">
                <div class="form-group-edit">
                    <label for="name_product">ชื่อสินค้า</label>
                    <input type="text" class="form-edit" id="name_product" name="name_product" required>
                </div>
                <div class="form-group-edit">
                    <label for="img_product">รูปภาพสินค้า</label>
                    <input type="file" class="form-edit" id="img_product" name="img_product" required>
                </div>
                <div class="form-group-edit">
                    <label for="type_product">ประเภทสินค้า</label>
                    <div class="input-group">
                        <select class="form-edit" id="type_product" name="type_product" required>
                            <?php foreach ($types as $type) : ?>
                            <option value="<?= $type['id_type']; ?>"><?= $type['name_type']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <!-- <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTypeModal">+</button>
                    <button type="button" class="btn btn-danger" id="deleteType">-</button> -->
                    </div>
                </div>
                <div class="form-group-edit">
                    <label for="detail_product">รายละเอียดสินค้า</label>
                    <textarea class="form-edit" id="detail" name="detail_product" rows="3"></textarea>
                </div>
                <div class="form-group-edit">
                    <label for="detail_img_product">ภาพรายละเอียด</label>
                    <input type="file" class="form-edit" id="detail_img_product" name="detail_img_product[]" multiple>
                </div>
                <div class="form-group-edit">
                    <label for="date_product">วันที่</label>
                    <input type="date" class="form-edit" id="date_product" name="date_product">
                </div>
                <div class="form-group-edit">
                    <label for="detail_vdo_product">ลิงก์วิดีโอรายละเอียด YouTube</label>
                    <input type="text" class="form-edit" id="detail_vdo_product" name="detail_vdo_product">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">เพิ่มสินค้า</button>
            </form>

            <!-- Modal สำหรับเพิ่มประเภทสินค้า -->
            <div class="modal fade" id="addTypeModal" tabindex="-1" aria-labelledby="addTypeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addTypeModalLabel">เพิ่มประเภทสินค้า</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="addTypeForm">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="name_type">ชื่อประเภทสินค้า</label>
                                    <input type="text" class="form-control" id="name_type" name="name_type" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                <button type="submit" class="btn btn-primary">บันทึก</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <script>
    $('#addTypeForm').on('submit', function(e) {
        e.preventDefault();
        var newType = $('#name_type').val();
        $.ajax({
            type: 'POST',
            url: 'add_product_type.php',
            data: { name_type: newType },
            success: function(response) {
                if (response === 'success') {
                    location.reload(); // Reload page เพื่ออัปเดต dropdown
                } else if (response === 'exists') {
                    alert('ประเภทสินค้านี้มีอยู่แล้ว');
                } else {
                    alert('Error adding type');
                }
            }
        });
    });
    </script> -->
</body>

</html>
ผ