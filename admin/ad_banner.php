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
    <title>เพิ่มแบนเนอร์</title>
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
    .tox-promotion-link {
        display: none !important;
    }

    .container {
        max-width: 800px;
        margin-top: 50px;
    }

    .card {
        margin-bottom: 20px;
    }

    .form-group-edit i {
        color: red;
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
        <h1>เพิ่มแบนเนอร์ใหม่</h1>

        <!-- Card for Banner Information -->
        <div class="card">
            <div class="card-body">
                <form action="save_banner.php" method="post" enctype="multipart/form-data">
                    <!-- Banner Title -->
                    <div class="form-group-edit">
                        <label for="name_banner">ชื่อแบนเนอร์</label>
                        <input type="text" class="form-edit" id="name_banner" name="name_banner" required>
                    </div>

                    <!-- Banner Image -->
                    <div class="form-group-edit">
                        <label for="img_banner">รูปภาพแบนเนอร์</label>
                        <input type="file" class="form-edit" id="img_banner" name="img_banner" required>
                    </div>

                    <!-- Banner Description -->
                    <div class="form-group-edit">
                        <label for="detail_banner">รายละเอียดแบนเนอร์ <i class='fas fa-exclamation'> การที่เพิ่มรูปในนี้ควรเป็นรูปที่นำมาจากเว็บ</i></label>
                        <textarea class="form-edit" id="detail" name="detail_banner" rows="3"></textarea>
                    </div>

                    <!-- Additional Images -->
                    <div class="form-group-edit">
                        <label for="img_detail_banner">รูปภาพเพิ่มเติม</label>
                        <input type="file" class="form-edit" id="img_detail_banner" name="img_detail_banner[]" multiple>
                    </div>

                    <!-- Display Dates -->
                    <div class="row">
                        <div class="col">
                            <label for="start_date_banner">วันที่เริ่มแสดง</label>
                            <input type="date" class="form-edit" id="start_date_banner" name="start_date_banner" required>
                        </div>
                        <div class="col">
                            <label for="end_date_banner">วันที่สิ้นสุดการแสดง</label>
                            <input type="date" class="form-edit" id="end_date_banner" name="end_date_banner" required>
                        </div>
                    </div>

                    <!-- Active Status -->
                    <div class="form-group-edit">
                        <label for="active_banner">สถานะการแสดงผล</label>
                        <select class="form-edit" id="active_banner" name="active_banner">
                            <option value="1">แสดง</option>
                            <option value="0">ไม่แสดง</option>
                        </select>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">เพิ่มแบนเนอร์</button>
                </form>
            </div>
        </div>
    </div>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>
