<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../login.php");
    exit;
}
require "../db_connect.php";

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $sql = "SELECT * FROM product WHERE id_product = :id_product";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id_product' => $product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    echo 'ID สินค้าไม่ถูกต้อง';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Edit Product</title>

    </script>
    <style>
    .body {
        padding-left: 50px;
    }
    </style>
</head>

<body>
    <div class="header_section header_bg">
        <div class="container-fluid">
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
    <div class="container mt-5">
        <h2>แก้ไขข้อมูล</h2>
        <form action="edit_product_update.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id_product']); ?>">

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
                    <option value="เครื่องสำอาง"
                        <?php echo ($product['type_product'] == 'เครื่องสำอาง') ? 'selected' : ''; ?>>เครื่องสำอาง
                    </option>
                    <option value="อาหารเสริม"
                        <?php echo ($product['type_product'] == 'อาหารเสริม') ? 'selected' : ''; ?>>อาหารเสริม</option>
                    <option value="สินค้า" <?php echo ($product['type_product'] == 'สินค้า') ? 'selected' : ''; ?>>
                        สินค้า</option>
                </select>
            </div>

            <div class="form-group-edit">
                <label for="detail_product">Product Details</label>
                <textarea class="form-edit-product" id="detail" name="detail_product"
                    required><?php echo htmlspecialchars($product['detail_product']); ?></textarea>
            </div>

            <div class="form-group-edit">
                <label for="img_detail_product">Product Detail Images</label>
                <input type="file" class="form-edit" id="img_detail_product" name="img_detail_product[]" multiple
                    accept="image/*">

                <?php
    // แปลงข้อมูลจาก serialize กลับมาเป็น array
    $images = unserialize($product['img_detail_product']) ?: [];

    if (!empty($images)) {
        echo '<div class="row">';
        foreach ($images as $img) {
            $img = trim($img);
            if (!empty($img)) {
                $img_path = "../images/" . htmlspecialchars($img);
                
                // ตรวจสอบว่าไฟล์เป็นรูปภาพหรือไม่
                if (file_exists($img_path) && @getimagesize($img_path)) {
                    echo '<div class="col-md-2 col-sm-3 mb-4">';
                    echo '<img src="' . $img_path . '" alt="Product Detail Image" class="img-fluid" style="width: 100%;">';
                    echo '</div>';
                }
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
                <label for="vdo_detail_product">Video Details</label>
                <input type="text" class="form-edit" id="vdo_detail_product" name="vdo_detail_product"
                    value="<?php echo htmlspecialchars($product['vdo_detail_product']); ?>">
                <?php
                $video_id = htmlspecialchars($product['vdo_detail_product']);

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