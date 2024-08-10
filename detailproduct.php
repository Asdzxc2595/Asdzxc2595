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
    <?php
    include 'db_connect.php';

    // Fetch product details from the database
    $stmt = $pdo->prepare("SELECT * FROM product WHERE id_product = :id_product");
    $stmt->execute(['id_product' => 1]); // Replace 1 with the desired product ID
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>

    <div class="header_section header_bg">
        <div class="container-fluid">
            <?php include 'nav.php';?>
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
                <p class="product_description"><?php echo htmlspecialchars($product['dtaill_product']); ?></p>
                <hr>
                <img src="images/<?php echo htmlspecialchars($product['dtaill_img_product']); ?>" class="img-fluid"
                    alt="Product Detail Image">
                <hr>
            </div>
        </div>
    </div>

    <div id="address" class="footer_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="address_text">Address</h1>
                    <p class="footer_text">i not know</p>
                    <div class="location_text">
                        <ul>
                            <li>
                                <a>
                                    <i class="fa fa-phone" aria-hidden="true"></i><a
                                        class="padding_left_10">09999999</a>
                                </a>
                            </li>
                            <li>
                                <a>
                                    <i class="fa fa-envelope"></i><a class="padding_left_10">eee</a>
                                </a>
                            </li>
                            <li>
                                <a>
                                    <i class="fas fa-map-marker-alt"></i><span class="padding_left_10">map</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

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