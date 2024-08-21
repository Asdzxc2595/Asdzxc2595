<?php
include 'db_connect.php'; 

// ดึงสินค้าขายดี
$sqlBestSellers = "SELECT * FROM product ORDER BY view_count DESC LIMIT 8";
$resultBestSellers = $pdo->query($sqlBestSellers);

// ดึงสินค้าใหม่
$sqlNewProducts = "SELECT id_product, name_product, img_product, dtaill_product 
                    FROM product 
                    WHERE DATE_ADD(date_product, INTERVAL 3 MONTH) >= NOW() LIMIT 5 ";
$resultNewProducts = $pdo->query($sqlNewProducts);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Happy</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="icon" href="images/cat.jpg" type="image/gif" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
    .product_section {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.5s ease, transform 0.5s ease;
    }

    .product_section.show {
        opacity: 1;
        transform: translateY(0);
    }
    </style>
</head>
<div class="header_section header_bg">
    <div class="container-fluid">
        <?php include 'nav.php'; ?>
    </div>
</div>
<body>
<!-- สินค้าใหม่ -->
<div class="banner_section layout_padding client_section">
    <h6 class="text_titer_center">สินค้าใหม่</h6>
    <div class="container">
        <div id="banner_slider" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
                <?php
                    if ($resultNewProducts->rowCount() > 0) {
                        $first = true;
                        while ($row = $resultNewProducts->fetch(PDO::FETCH_ASSOC)) {
                            $activeClass = $first ? 'active' : '';
                            $first = false;
                            echo '<div class="carousel-item ' . $activeClass . '">';
                            echo '<div class="row">';
                            echo '<div class="col-md-6">';
                            echo '<div class="banner_img"><img src="images/' . htmlspecialchars($row["img_product"]) . '" alt="Product Image"></div>';
                            echo '</div>';
                            echo '<div class="col-md-6">';
                            echo '<div class="banner_taital_main">';
                            echo '<h5 class="tasty_text">' . htmlspecialchars($row["name_product"]) . '</h5>';
                            echo '<p class="banner_text">' . strip_tags($row["dtaill_product"]) . '</p>';
                            echo '<div class="btn_main">';
                            echo '<div class="about_bt"><a href="detailproduct.php?id_product=' . htmlspecialchars($row["id_product"]) . '">About Us</a></div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No new products available</p>';
                    }
                    ?>
            </div>
            <a class="carousel-control-prev" href="#banner_slider" role="button" data-slide="prev">
                <i class="fa fa-arrow-left"></i>
            </a>
            <a class="carousel-control-next" href="#banner_slider" role="button" data-slide="next">
                <i class="fa fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>
<!-- ปิดสินค้าใหม่ -->

<img src="images/happy.png" style="width: 100%;" alt="Image">



<!-- สินค้านิยม -->
<div class="product_section layout_padding body-background">
    <div class="container">
        <div class="row">
            <h1 class="product_taital">สินค้านิยม</h1>
            <div class="bulit_icon"><img src="images/bulit-icon.png" alt="Bulit Icon"></div>
        </div>
    </div>
    <div class="product_section_2">
        <div id="main_slider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php
                    if ($resultBestSellers->rowCount() > 0) {
                        $first = true;
                        $itemCount = 0;

                        // Start a new carousel item
                        echo '<div class="carousel-item ' . ($first ? 'active' : '') . '">';
                        echo '<div class="container-fluid"><div class="row">';
                        
                        while ($row = $resultBestSellers->fetch(PDO::FETCH_ASSOC)) {
                            if ($itemCount % 4 === 0 && $itemCount > 0) {
                                echo '</div></div></div>'; // ปิด carousel-item ก่อนเปิดใหม่
                                echo '<div class="carousel-item">';
                                echo '<div class="container-fluid"><div class="row">';
                            }

                            echo '<div class="col-lg-3 col-md-6 card_oder">';
                            echo '<div class="product_img"><img src="images/' . htmlspecialchars($row["img_product"]) . '" alt="Product Image"></div>';
                            echo '<hr>';
                            echo '<h3 class="types_text">' . htmlspecialchars($row["name_product"]) . '</h3>';
                            echo '<p class="looking_text">' . strip_tags($row["dtaill_product"]) . '</p>';
                            echo '<div class="read_bt"><a href="detailproduct.php?id_product=' . htmlspecialchars($row["id_product"]) . '">Read More</a></div>';
                            echo '<p><p></div>';

                            $itemCount++;
                        }

                        // ปิด div สำหรับ carousel-item ที่ยังเปิดอยู่
                        echo '</div></div></div>';
                    } else {
                        echo '<p>No best-selling products found.</p>';
                    }
                    ?>
            </div>
            <a class="carousel-control-prev" href="#main_slider" role="button" data-slide="prev">
                <i class="fa fa-arrow-left"></i>
            </a>
            <a class="carousel-control-next" href="#main_slider" role="button" data-slide="next">
                <i class="fa fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>
<img src="images/happpy.png" style="width: 100%;" alt="Image">
<?php include 'address.php'; ?>
<div class="copyright_section">
    <?php include 'footer.php'; ?>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const productSection = document.querySelector('.product_section');

    // ตรวจสอบว่า productSection เข้าสู่ viewport แล้วหรือยัง
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('show'); // เพิ่มคลาส .show เพื่อเริ่มอนิเมชัน
            }
        });
    });

    // เริ่มตรวจสอบส่วนที่ต้องการ
    observer.observe(productSection);
});
</script>
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/jquery-3.0.0.min.js"></script>
<script src="js/plugin.js"></script>
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="js/custom.js"></script>
</body>

</html>