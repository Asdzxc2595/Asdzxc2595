<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../login.php");
    exit;
}

require("../db_connect.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>เพิ่มโฆษณา</title>

    
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
    <style>
    .container {
        max-width: 1200px;
        margin-top: 50px;
    }

    .card {
        margin-bottom: 20px;
    }

    .form-edit {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
    }

    label {
        font-weight: bold;
    }
    </style>
</head>

<body>
    <div class="header_section header_bg">
        <div class="container-fluid">
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
    <div class="container">
        <h1>เพิ่มโฆษณาใหม่</h1>

        <!-- Card for Advert Form -->
        <div class="card">
            <div class="card-body">
                <form action="save_advert.php" method="post" enctype="multipart/form-data">
                    <!-- Advert Title -->
                    <div class="form-group-edit">
                        <label for="name_advert">ชื่อโฆษณา</label>
                        <input type="text" class="form-edit" id="name_advert" name="name_advert" required>
                    </div>

                    <!-- Advert Image -->
                    <div class="form-group-edit">
                        <label for="img_advert">รูปภาพโฆษณา</label>
                        <input type="file" class="form-edit" id="img_advert" name="img_advert" required>
                    </div>

                    <!-- Advert Description -->
                    <div class="form-group-edit">
                        <label for="detail_advert">รายละเอียดโฆษณา</label>
                        <textarea class="form-edit" id="detail" name="detail_advert" rows="3"></textarea>

                    </div>

                    <!-- Additional Images -->
                    <div class="form-group-edit">
                        <label for="img_detail_advert">รูปภาพเพิ่มเติม</label>
                        <input type="file" class="form-edit" id="img_detail_advert" name="img_detail_advert[]" multiple>
                    </div>

                    <!-- Display Dates -->
                    <div class="row">
                        <div class="col">
                            <label for="start_date_advert">วันที่เริ่มแสดง</label>
                            <input type="date" class="form-edit" id="start_date_advert" name="start_date_advert" required>
                        </div>
                        <div class="col">
                            <label for="end_date_advert">วันที่สิ้นสุดการแสดง</label>
                            <input type="date" class="form-edit" id="end_date_advert" name="end_date_advert" required>
                        </div>
                    </div>

                    <!-- Active Status -->
                    <div class="form-group-edit">
                        <label for="active_advert">สถานะการแสดงผล</label>
                        <select class="form-edit" id="active_advert" name="active_advert">
                            <option value="1">แสดง</option>
                            <option value="0">ไม่แสดง</option>
                        </select>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">เพิ่มโฆษณา</button>
                </form>
            </div>
        </div>
    </div>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>
