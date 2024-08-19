<?php
require("db_connect.php"); // เชื่อมต่อฐานข้อมูล

// ตรวจสอบว่ามีการส่ง parameter 'type' มาหรือไม่
if (isset($_GET['type'])) {
    $type_product = $_GET['type'];

    // ดึงข้อมูลสินค้าที่ตรงกับประเภทที่เลือก
    $stmt = $pdo->prepare("SELECT * FROM product WHERE type_product = :type_product");
    $stmt->execute(['type_product' => $type_product]);
    $products = $stmt->fetchAll();
} else {
    echo "ไม่มีข้อมูลประเภทสินค้า";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Products : <?php echo htmlspecialchars($type_product); ?></title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <div class="header_section header_bg">
        <div class="container-fluid">
            <?php include 'nav.php'; ?>
        </div>
    </div>

    <!-- Product Section -->
    <div class="product_section layout_padding body-background">
        <div class="container">
            <h1 class="product_title">Products : <?php echo htmlspecialchars($type_product); ?></h1>
            <div class="row">
                <?php if (!empty($products)) : ?>
                <?php foreach ($products as $product) : ?>
                <div class="col-md-4">
                    <div class="card-item-product">
                        <img src="images/<?php echo htmlspecialchars($product['img_product']); ?>"
                            alt="<?php echo htmlspecialchars($product['name_product']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($product['name_product']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($product['dtaill_product']); ?></p>
                            <a href="detailproduct.php?id_product=<?php echo $product['id_product']; ?>"
                                class="card-button">Read More</a>
                        </div>
                        
                    </div><p><p></p>
                </div>
                <?php endforeach; ?>
                <?php else : ?>
                <p>ไม่มีสินค้าที่ตรงกับประเภทนี้</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php include 'address.php'; ?>

    <div class="copyright_section">
        <?php include 'footer.php'; ?>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const cardItems = document.querySelectorAll('.card-item-product');
            cardItems.forEach(function(item) {
                item.classList.add('show');
            });
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