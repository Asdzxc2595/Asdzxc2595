<?php
require 'db_connect.php'; 

// ตรวจสอบค่า id_product จาก URL
$id_product = isset($_GET['id_product']) ? (int)$_GET['id_product'] : 0;

if ($id_product > 0) {
    // อัปเดตการเข้าชมสินค้า
    $updateStmt = $pdo->prepare("UPDATE product SET view_count = view_count + 1 WHERE id_product = :id_product");
    $updateStmt->execute(['id_product' => $id_product]);

    // ดึงข้อมูลสินค้าจากฐานข้อมูล
    $stmt = $pdo->prepare("SELECT * FROM product WHERE id_product = :id_product");
    $stmt->execute(['id_product' => $id_product]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        echo "<p>Product not found.</p>";
        exit();
    }
} else {
    echo "<p>Invalid product ID.</p>";
    exit();
}

// Unserialize the image data from the database
$img_ids = [];
if (isset($product['dtaill_img_product'])) {
    $img_data = $product['dtaill_img_product'];

    // ลอง unserialize ก่อน ถ้าล้มเหลวให้ถือว่าเป็น string ธรรมดา
    $unserialized_data = @unserialize($img_data);
    if ($unserialized_data !== false && is_array($unserialized_data)) {
        $img_ids = $unserialized_data;
    } else {
        // ถ้าไม่สามารถ unserialize ได้ ให้ถือว่าเป็น string ธรรมดาและเพิ่มใน array
        $img_ids[] = $img_data;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Happy</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;200;300;400;500;600;700;800;900&family=Prompt:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <div class="header_section header_bg">
        <div class="container-fluid">
            <?php include 'nav.php'; ?>
        </div>
    </div>
    <div class="product_details_section layout_padding body-background">
        <div class="container">
            <div class="row">
                <div class="product-image-detaill">
                    <img src="images/<?php echo htmlspecialchars($product['img_product']); ?>" class="img-fluid"
                        alt="Product Image">
                </div>
            </div>
            <div class="detill-text">
                <h1 class="product_title "><?php echo htmlspecialchars($product['name_product']); ?></h1>
                <hr>
                <div>
                    <?php echo $product['dtaill_product']; // แสดง HTML ตามที่เก็บในฐานข้อมูล ?>
                </div>

                <hr>
                <?php  
                if ($img_ids !== false && !empty($img_ids)) {
                    echo '<hr>';
                    foreach ($img_ids as $img_id) {
                        $img_id = trim($img_id);
                        if (!empty($img_id)) {
                            echo '<img src="images/' . htmlspecialchars($img_id) . '" class="img-fluid" alt="Product Detail Image" style="margin-bottom: 10px;">';
                        }
                    }
                } else {
                    echo '<p>No additional images available.</p>';
                }
            ?>

                <hr>
                <?php 
                $video_id = isset($product['dtaill_vdo_product']) ? htmlspecialchars($product['dtaill_vdo_product']) : '';

                if (!empty($video_id)) {
                    ?>
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo $video_id; ?>"
                        allowfullscreen></iframe>
                </div>
                <?php
                } else {
                    // Optional: Display a message if no video is available
                    // echo '<p>Video not available.</p>';
                }
            ?>
            </div>
        </div>
    </div>

    <?php include 'address.php'; ?>

    <div class="copyright_section">
        <?php include 'footer.php'; ?>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/plugin.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>