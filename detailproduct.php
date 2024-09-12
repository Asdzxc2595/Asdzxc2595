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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.3.0/tinymce.min.js" referrerpolicy="origin"></script>

    <style>
    .img-fluid-detail {
        display: flex;
        margin: 0 auto;
        border-radius: 5px;
        max-width: 100%;
        width: COVER;
    }

    .back-button {
        text-align: center;
    }

    .container {
        position: relative;
    }

    .mySlides {
        display: none;
        text-align: center;
    }

    .mySlides img {
        height: 600px;
        
    }

    .cursor {
        cursor: pointer;
    }

    .prev,
    .next {
        cursor: pointer;
        position: absolute;
        top: 40%;
        width: auto;
        padding: 16px;
        margin-top: -50px;
        color: white;
        font-weight: bold;
        font-size: 20px;
        border-radius: 0 3px 3px 0;
        user-select: none;
        -webkit-user-select: none;
    }

    .next {
        right: 0;
        height: auto;

    }

    .prev:hover,
    .next:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }

    .numbertext {
        color: #f2f2f2;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
    }

    .caption-container {
        display: none;
    }

    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    .column {
        float: left;
        width: 16.66%;
    }

    .demo {
        opacity: 0.6;
    }

    .active,
    .demo:hover {
        opacity: 1;
    }
    </style>
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
                <h1 class="product_title"><?php echo htmlspecialchars($product['name_product']); ?></h1>
                <hr>

                <?php
                // แสดงรายละเอียดของสินค้า
                echo '<p class="dtaill-title">' . ($product['dtaill_product']) . '</p>';
                ?>

                <!-- Slideshow Gallery -->
                <div class="container">
                    <?php
                    if (!empty($img_ids)) {
                        $slideIndex = 1;
                        foreach ($img_ids as $img_id) {
                            $img_id = trim($img_id);
                            if (!empty($img_id)) {
                                echo '<div class="mySlides">';
                                echo '<div class="numbertext">' . $slideIndex . ' / ' . count($img_ids) . '</div>';
                                echo '<img src="images/' . htmlspecialchars($img_id) . '" style="width:auto">';
                                echo '</div>';
                                $slideIndex++;
                            }
                        }
                    }
                    ?>

                    <a class="prev" onclick="plusSlides(-1)">❮</a>
                    <a class="next" onclick="plusSlides(1)">❯</a>

                    <div class="caption-container">
                        <p id="caption"></p>
                    </div>

                    <div class="row">
                        <?php
                        $slideIndex = 1;
                        if (!empty($img_ids)) {
                            foreach ($img_ids as $img_id) {
                                $img_id = trim($img_id);
                                if (!empty($img_id)) {
                                    echo '<div class="column">';
                                    echo '<img class="demo cursor" src="images/' . htmlspecialchars($img_id) . '" style="width:100%" onclick="currentSlide(' . $slideIndex . ')">';
                                    echo '</div>';
                                    $slideIndex++;
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
                <!-- End Slideshow Gallery -->

                <?php 
                $video_id = isset($product['dtaill_vdo_product']) ? htmlspecialchars($product['dtaill_vdo_product']) : '';

                if (!empty($video_id)) {
                    echo '<hr>';
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
            <button class="back-button" onclick="goBack()"><i class='fas fa-reply'></i>ย้อนกลับ</button>
        </div>
    </div>

    <?php include 'address.php'; ?>

    <div class="copyright_section">
        <?php include 'footer.php'; ?>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/plugin.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/script.js"></script>
    <script>
    let slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("demo");
        let captionText = document.getElementById("caption");
        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
        captionText.innerHTML = dots[slideIndex - 1].alt;
    }
    </script>
</body>

</html>