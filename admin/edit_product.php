<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../login.php");
    exit;
}
require "../db_connect.php";

// ตรวจสอบว่ามีการส่งค่า ID มาหรือไม่
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // ดึงข้อมูลสินค้าจากฐานข้อมูล
    $sql = "SELECT * FROM product WHERE id_product = :id_product";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id_product' => $product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    // ถ้าไม่พบสินค้า ให้ redirect กลับไปหน้ารายการสินค้า
    if (!$product) {
        header("Location: product_list.php");
        exit;
    }

    // ตรวจสอบว่ามีการส่งข้อมูลมาจากฟอร์มหรือไม่
    if (isset($_POST['submit'])) {
        $name_product = $_POST['name_product'];
        $type_product = $_POST['type_product'];
        $dtaill_product = $_POST['dtaill_product'];
        $date_product = $_POST['date_product'];
        $dtaill_vdo_product = $_POST['dtaill_vdo_product'];

        // จัดการกับรูปภาพสินค้า
        if (isset($_FILES['img_product']) && $_FILES['img_product']['error'] == UPLOAD_ERR_OK) {
            $img_product = $_FILES['img_product']['name'];
            move_uploaded_file($_FILES['img_product']['tmp_name'], '../images/' . $img_product);
        } else {
            $img_product = $product['img_product']; // ถ้าไม่มีการอัปโหลดรูปใหม่ ให้ใช้รูปเก่า
        }

        // จัดการกับรูปภาพรายละเอียด (หลายรูป)
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
            $dtaill_img_products = json_decode($product['dtaill_img_product'], true); // ใช้รูปเดิม
        }

        // ทำการเข้ารหัส (serialize) array เพื่อเก็บในฐานข้อมูล
        $dtaill_img_product = serialize($dtaill_img_products);

        // อัปเดตข้อมูลในฐานข้อมูล
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
            'id_product' => $product_id,
        ]);

        // Redirect กลับไปหน้ารายการสินค้า
        header("Location: product_list.php");
        exit;
    }
} else {
    // ถ้าไม่มีการส่ง ID มาจะ redirect กลับไปหน้ารายการสินค้า
    header("Location: product_list.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
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
           plugins: 'advlist anchor autolink autosave charmap code codesample directionality emoticons fullscreen help image imagetools insertdatetime link lists media nonbreaking pagebreak paste preview print save searchreplace spellchecker table template textcolor visualblocks visualchars wordcount',
            toolbar: 'undo redo | formatselect | fontselect fontsizeselect | bold italic underline strikethrough | forecolor backcolor removeformat | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent  | table emoticons charmap | preview fullscreen code',
            menubar: 'file edit view insert format tools table ',
        });
    </script>
</head>

<body>
    <div class="header_section header_bg">
        <div class="container-fluid">
            <?php include 'nav_admin.php'; ?>
        </div>
    </div>
    <div class="container mt-5">
        <h2>แก้ไขข้อมูล</h2>
        <form method="post" enctype="multipart/form-data">

            <div class="form-group-edit">
                <label for="img_product">Product Image</label>
                <input type="file" class="form-edit" id="img_product" name="img_product">
                <?php if (!empty($product['img_product'])): ?>
                    <img src="../images/<?php echo htmlspecialchars($product['img_product']); ?>" alt="Product Image"
                        style="width: 100px; margin-top: 10px;">
                <?php endif; ?>
            </div>

            <div class="form-group-edit">
                <label for="name_product">Product Name</label>
                <input type="text" class="form-edit" id="name_product" name="name_product"
                    value="<?php echo htmlspecialchars($product['name_product']); ?>" required>
            </div>

            <div class="form-group-edit">
                <label for="type_product">Product Type</label>
                <select class="form-edit" id="type_product" name="type_product" required>
                    <option value="เครื่องสำอาง" <?php echo ($product['type_product'] == 'เครื่องสำอาง') ? 'selected' : ''; ?>>เครื่องสำอาง
                    </option>
                    <option value="อาหารเสริม" <?php echo ($product['type_product'] == 'อาหารเสริม') ? 'selected' : ''; ?>>อาหารเสริม</option>
                    <option value="สินค้า" <?php echo ($product['type_product'] == 'สินค้า') ? 'selected' : ''; ?>>
                        สินค้า</option>
                </select>
            </div>


            <div class="form-group-edit">
                <label for="dtaill_product">Product Details</label>
                <textarea class="form-edit-product" id="dtaill_product" name="dtaill_product"
                    required><?php echo htmlspecialchars($product['dtaill_product']); ?></textarea>
            </div>

            <div class="form-group-edit">
                <label for="dtaill_img_product">Product Detail Images</label>
                <input type="file" class="form-edit" id="dtaill_img_product" name="dtaill_img_product[]" multiple>

                <?php
                $img_data = $product['dtaill_img_product'];
                $unserialized_data = @unserialize($img_data);
                $images = [];

                if ($unserialized_data !== false && is_array($unserialized_data)) {
                    $images = $unserialized_data;
                } elseif (!empty($img_data)) {
                    $images[] = $img_data;
                }

                if (!empty($images)) {
                    echo '<div class="row mt-3">';
                    foreach ($images as $img) {
                        $img = trim($img);
                        if (!empty($img)) {
                            echo '<div class="col-md-3 mb-3">';
                            echo '<img src="../images/' . htmlspecialchars($img) . '" alt="Product Detail Image" class="img-fluid" style="width: 100%;">';
                            echo '</div>';
                        }
                    }
                    echo '</div>';
                } else {
                    echo '<p>No images available.</p>';
                }
                ?>
            </div>



            <div class="form-group-edit">
                <label for="date_product">Date</label>
                <input type="date" class="form-edit" id="date_product" name="date_product"
                    value="<?php echo htmlspecialchars($product['date_product']); ?>" required>
            </div>

            <div class="form-group-edit">
                <label for="dtaill_vdo_product">Video Details</label>
                <input type="text" class="form-edit" id="dtaill_vdo_product" name="dtaill_vdo_product"
                    value="<?php echo htmlspecialchars($product['dtaill_vdo_product']); ?>">
                <?php
                $video_id = htmlspecialchars($product['dtaill_vdo_product']);

                if (!empty($video_id)) {
                    echo '<div class="embed-responsive embed-responsive-16by9" style="margin-top: 10px;">';
                    echo '<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/' . $video_id . '" allowfullscreen></iframe>';
                    echo '</div>';
                }
                ?>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
            <button type="button" class="save-button" onclick="goBack()">ย้อนกลับ</button> <!-- ใช้ type="button" -->
        </form>
    </div>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>

</html>