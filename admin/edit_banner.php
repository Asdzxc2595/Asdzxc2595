<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../login.php");
    exit;
}
require "../db_connect.php";

// ตรวจสอบว่ามีการส่ง `id` มาหรือไม่
if (!isset($_GET['id'])) {
    header("Location: list_banner.php");
    exit;
}

$id_banner = $_GET['id'];

// ดึงข้อมูลแบนเนอร์ที่ต้องการแก้ไข
$sql = "SELECT * FROM banner WHERE id_banner = :id_banner";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id_banner' => $id_banner]);
$banner = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$banner) {
    header("Location: list_banner.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>แก้ไขแบนเนอร์</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
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
        <h1>แก้ไขแบนเนอร์</h1>

        <!-- Card for Banner Information -->
        <div class="card">
            <div class="card-body">
                <form action="edit_banner_update.php" method="post" enctype="multipart/form-data">
                    <!-- Hidden ID Field -->
                    <input type="hidden" name="id_banner" value="<?php echo htmlspecialchars($banner['id_banner']); ?>">

                    <!-- Banner Title -->
                    <div class="form-group-edit">
                        <label for="banner_title">ชื่อแบนเนอร์</label>
                        <input type="text" class="form-edit" id="banner_title" name="banner_title" value="<?php echo htmlspecialchars($banner['title']); ?>" required>
                    </div>

                    <!-- Banner Image -->
                    <div class="form-group-edit">
                        <label for="banner_image">รูปภาพแบนเนอร์</label>
                        <input type="file" class="form-edit" id="banner_image" name="banner_image">
                        <?php if ($banner['banner_image']): ?>
                        <img src="../images/banner/<?php echo htmlspecialchars($banner['id_banner']); ?>/<?php echo htmlspecialchars($banner['banner_image']); ?>" alt="Banner Image" width="200">
                        <?php endif; ?>
                    </div>

                    <!-- Banner Description -->
                    <div class="form-group-edit">
                        <label for="banner_description">รายละเอียดแบนเนอร์</label>
                        <textarea class="form-edit" id="banner_description" name="banner_description" rows="3"><?php echo htmlspecialchars($banner['description']); ?></textarea>
                    </div>
                    <!-- Additional Images -->
                    <div class="form-group-edit">
                        <label for="additional_images">รูปภาพเพิ่มเติม</label>
                        <input type="file" class="form-edit" id="additional_images" name="additional_image[]" multiple>
                        <?php
                        $additional_images = unserialize($banner['additional_image']); // ใช้ unserialize เพื่อถอดรหัสข้อมูล
                        if (!empty($additional_images) && is_array($additional_images)): // ตรวจสอบว่าเป็น array ที่ถูกต้อง
                            echo '<div class="row">'; // เริ่มต้นการใช้ Bootstrap grid row
                            foreach ($additional_images as $image):
                                if (!empty($image)): // ตรวจสอบว่ารูปภาพไม่ใช่ค่าว่าง
                                    echo '<div class="col-md-2 col-sm-3 mb-4">'; // ใช้ col สำหรับขนาดหน้าจอใหญ่และเล็ก
                                    echo '<img src="../images/banner/'. htmlspecialchars($banner['id_banner']) .'/'. htmlspecialchars($image).'" alt="Additional Image" class="img-fluid" style="width: 100%;">'; // ใช้ img-fluid เพื่อให้รูปภาพตอบสนองต่อขนาดหน้าจอ
                                    echo '</div>'; // ปิด col
                                endif;
                            endforeach;
                            echo '</div>'; // ปิด row
                        endif;
                        ?>
                    </div>
                    <!-- Display Dates -->
                    <div class="row">
                        <div class="col">
                            <label for="display_start_date">วันที่เริ่มแสดง</label>
                            <input type="date" class="form-edit" id="display_start_date" name="display_start_date" value="<?php echo htmlspecialchars($banner['display_start_date']); ?>" required>
                        </div>
                        <div class="col">
                            <label for="display_end_date">วันที่สิ้นสุดการแสดง</label>
                            <input type="date" class="form-edit" id="display_end_date" name="display_end_date" value="<?php echo htmlspecialchars($banner['display_end_date']); ?>" required>
                        </div>
                    </div>

                    <!-- Active Status -->
                    <div class="form-group-edit">
                        <label for="is_active">สถานะการแสดงผล</label>
                        <select class="form-edit" id="is_active" name="is_active">
                            <option value="1" <?php echo $banner['is_active'] ? 'selected' : ''; ?>>แสดง</option>
                            <option value="0" <?php echo !$banner['is_active'] ? 'selected' : ''; ?>>ไม่แสดง</option>
                        </select>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">บันทึกการแก้ไข</button>
                </form>
            </div>
        </div>
    </div>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>
