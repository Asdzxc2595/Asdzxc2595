<?php
include 'db_connect.php';

// ดึงสินค้าขายดี
$sqlBestSellers = "SELECT * FROM product ORDER BY view_count DESC LIMIT 8";
$resultBestSellers = $pdo->query($sqlBestSellers);

// ดึงสินค้าใหม่
$sqlNewProducts = "SELECT id_product, name_product, img_product, dtaill_product 
                    FROM product 
                    WHERE DATE_ADD(date_product, INTERVAL 3 MONTH) >= NOW() LIMIT 5";
$resultNewProducts = $pdo->query($sqlNewProducts);

// ดึงแบนเนอร์ที่แสดงตามวันที่กำหนดและสถานะ
$sqlBanners = "SELECT * FROM banner 
                WHERE (display_start_date <= NOW() AND display_end_date >= NOW()) 
                AND is_active = 1 
                ORDER BY display_start_date DESC";
$resultBanners = $pdo->query($sqlBanners);
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
    <link rel="icon" href="images/cat.jpg" type="image/gif">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
    body {
        padding-top: 40px;
    }

    .carousel-item .col-md-1 {
        display: flex;
        flex-direction: column;
        align-items: center;
        /* จัดตรงกลางในแนวตั้ง */
    }

    .carousel-item .banner_img {
        order: -1;
    }

    .tasty_text {
        margin-top: 10px;
    }

    .ad-banner {
        /* padding-top: 27px; */
        width: 100%;
    }

    .ad-banner li {
        list-style: none;
    }

    .ad-banner i {
        font-size: 50px;
    }

    .carousel-inner-banner {
        padding-top: 28px;
    }

    .carousel-inner img {
        width: 100%;
        height: auto;
        /* ให้ความสูงปรับตามอัตราส่วน */
        object-fit: cover;
        /* ให้ภาพครอบตัดเต็มพื้นที่ */
    }

    .adBannerSlider img {
        width: 100%;
        height: 600px;
    }
    </style>
</head>
<?php include 'nav.php'; ?>

<body>


    <!-- <section class="parallax" id="parallax">
        <img src="images/city2.png" id="city2">
        <div id="text_logo">LOGO</div>
        <img src="images/city1.png" id="city1">
    </section> -->

    <button id="scrollUp" class="scroll-btn">
        <i class="fas fa-chevron-up"></i>
    </button>

    <button id="scrollDown" class="scroll-btn">
        <i class="fas fa-chevron-down"></i>
    </button>
    <!-- แบนเนอร์โฆษณา -->
    <div id="adBannerSlider" class="carousel slide ad-banner" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <?php
        // ดึงข้อมูลแบนเนอร์จากฐานข้อมูล
        $sqlBanners = "SELECT * FROM banner WHERE NOW() BETWEEN display_start_date AND display_end_date AND is_active = 1 ORDER BY display_start_date LIMIT 3";
        $resultBanners = $pdo->query($sqlBanners);
        $bannerCount = $resultBanners->rowCount();
        
        // วนลูปสร้าง indicators สำหรับแต่ละแบนเนอร์
        for ($i = 0; $i < $bannerCount; $i++) {
            echo '<li data-target="#adBannerSlider" data-slide-to="' . $i . '" class="' . ($i === 0 ? 'active' : '') . '"></li>';
        }
        ?>
        </ol>

        <!-- Slides -->
        <div class="carousel-inner-banner">
            <?php
        $first = true;
        while ($row = $resultBanners->fetch(PDO::FETCH_ASSOC)) {
            // ตรวจสอบว่าภาพแรกเป็น active
            $activeClass = $first ? 'active' : '';
            $first = false;

            // แสดงแบนเนอร์และลิงก์ไปยังหน้ารายละเอียด
            echo '<div class="carousel-item ' . $activeClass . '">';
            echo '<a href="banner_detail.php?id_banner=' . htmlspecialchars($row['id_banner']) . '">';
            echo '<img src="images/banner/' . htmlspecialchars($row['id_banner']) . '/' . htmlspecialchars($row['banner_image']) . '" class="d-block w-100" alt="Banner Image" style="max-height: 500px; object-fit: cover;">';
            echo '</a>';
            echo '</div>';
        }
        ?>
        </div>

        <!-- ปุ่มควบคุมการเลื่อนแบนเนอร์ -->
        <a class="carousel-control-prev" href="#adBannerSlider" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#adBannerSlider" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>


    <!-- สินค้าใหม่ -->
    <div id="newProducts" class="banner_section layout_padding client_section">
        <h1 class="text_titer_center">สินค้าใหม่</h1>

        <div class="container">
            <div id="banner_slider" class="carousel slide" data-ride="carousel">
                <!-- carousel ของสินค้าใหม่ -->
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
                        echo '<p>ไม่มีสินค้าหมายใหม่</p>';
                    }
                    ?>
                </div>
                <a class="carousel-control-prev" href="#banner_slider" role="button" data-slide="prev">
                    <i class="fa fa-chevron-left"></i>
                </a>
                <a class="carousel-control-next" href="#banner_slider" role="button" data-slide="next">
                    <i class="fa fa-chevron-right"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- ปิดสินค้าใหม่ -->

    <img class="layout-img" src="images/happy.png" alt="Image">

    <!-- สินค้านิยม -->
    <div id="bestSellers" class="product_section layout_padding body-background">
        <div class="container">
            <div class="row">
                <h1 class="product_taital" ID="hitproduct">สินค้านิยม</h1>
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

                        // เริ่มต้น carousel-item ใหม่
                        echo '<div class="carousel-item ' . ($first ? 'active' : '') . '">';
                        echo '<div class="container-fluid"><div class="row">';
                        
                        while ($row = $resultBestSellers->fetch(PDO::FETCH_ASSOC)) {
                            if ($itemCount % 4 === 0 && $itemCount > 0) {
                                echo '</div></div></div>'; // ปิด carousel-item ก่อนเปิดใหม่
                                echo '<div class="carousel-item">';
                                echo '<div class="container-fluid"><div class="row">';
                            }

                            echo '<div class="col-lg-3 col-md-6 mb-4 ">';
                            echo '<div class="product_img "><img src="images/' . htmlspecialchars($row["img_product"]) . '" alt="Product Image" class="img-thumbnail"></div>';
                            echo '<hr>';
                            echo '<h3 class="types_text">' . htmlspecialchars($row["name_product"]) . '</h3>';
                            echo '<p class="looking_text">' . strip_tags($row["dtaill_product"]) . '</p>';
                            echo '<div class="read_bt"><a href="detailproduct.php?id_product=' . htmlspecialchars($row["id_product"]) . '">Read More</a></div>';
                            echo '</div>';

                            $itemCount++;
                        }

                        // ปิด div สำหรับ carousel-item ที่ยังเปิดอยู่
                        echo '</div></div></div>';
                    } else {
                        echo '<p>ไม่มีสินค้านิยม</p>';
                    }
                    ?>
                </div>
                <a class="carousel-control-prev" href="#main_slider" role="button" data-slide="prev">
                    <i class="fa fa-chevron-left"></i>
                </a>
                <a class="carousel-control-next" href="#main_slider" role="button" data-slide="next">
                    <i class="fa fa-chevron-right"></i>
                </a>
            </div>
        </div>
    </div>

    <img src="images/happpy.png" style="width: 100%;" alt="Image">
    <div class="copyright_section">
        <?php include 'footer.php'; ?>
    </div>


    <!-- Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/plugin.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/updow.js"></script>
    <script src="js/mouse_move.js"></script>

</body>


</html>