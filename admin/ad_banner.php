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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>เพิ่มแบนเนอร์</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.3.0/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
    tinymce.init({
        selector: 'textarea#banner_description',
        plugins: 'advlist anchor autolink autosave charmap code codesample directionality emoticons fullscreen help image imagetools insertdatetime link lists media nonbreaking pagebreak paste preview print save searchreplace spellchecker table template textcolor visualblocks visualchars wordcount',
        toolbar: 'undo redo | formatselect | link image | fontselect fontsizeselect | bold italic underline strikethrough | forecolor backcolor removeformat | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table emoticons charmap | preview fullscreen code',
        menubar: 'file edit view insert format tools table',
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
                        <label for="banner_title">ชื่อแบนเนอร์</label>
                        <input type="text" class="form-edit" id="banner_title" name="banner_title" required>
                    </div>

                    <!-- Banner Image -->
                    <div class="form-group-edit">
                        <label for="banner_image">รูปภาพแบนเนอร์</label>
                        <input type="file" class="form-edit" id="banner_image" name="banner_image" required>
                    </div>

                    <!-- Banner Description -->
                    <div class="form-group-edit">
                        <label for="banner_description">รายละเอียดแบนเนอร์ <i class='fas fa-exclamation'>
                                การที่เพิ่มรูปในนี้ควรเป็นรูปที่นำมาจากเว็บ</i></label>
                        <textarea class="form-edit" id="banner_description" name="banner_description"
                            rows="3"></textarea>
                    </div>

                    <!-- Additional Images -->
                    <div class="form-group-edit">
                        <label for="additional_images">รูปภาพเพิ่มเติม</label>
                        <input type="file" class="form-edit" id="additional_images" name="additional_images[]" multiple>
                    </div>

                    <!-- Display Dates -->
                    <div class="row">
                        <div class="col">
                            <label for="display_start_date">วันที่เริ่มแสดง</label>
                            <input type="date" class="form-edit" id="display_start_date" name="display_start_date"
                                required>
                        </div>
                        <div class="col">
                            <label for="display_end_date">วันที่สิ้นสุดการแสดง</label>
                            <input type="date" class="form-edit" id="display_end_date" name="display_end_date" required>
                        </div>
                    </div>
                    <div class="form-group-edit">
                        <div>
                            <label for="is_active">สถานะการแสดงผล</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                            <label class="form-check-label" for="flexRadioDefault1">
                                <option value="1">แสดง</option>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"
                                >
                            <label class="form-check-label" for="flexRadioDefault2">
                                <option value="0">ไม่แสดง</option>
                            </label>
                        </div>
                    </div>
                    <!-- <div class="form-group-edit">
                        <label for="is_active">สถานะการแสดงผล</label>
                        <select class="form-edit" id="is_active" name="is_active">
                            <option value="1">แสดง</option>
                            <option value="0">ไม่แสดง</option>
                        </select>
                    </div> -->
                    <button type="submit" name="submit" class="btn btn-primary">เพิ่มแบนเนอร์</button>
                </form>
            </div>
        </div>
    </div>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>