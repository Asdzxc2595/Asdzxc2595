<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>สินค้าทั้งหมด</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
    .search-from {
        text-align: right;
    }
    </style>
</head>

<body>
    <div class="header_section header_bg ">
        <div class="container-fluid">
            <?php include 'nav.php'; ?>
        </div>
    </div>

    <div class="product_section layout_padding body-background">
        <h1 class="product_hard_title">รายการสินค้า</h1>
        <form method="GET" class="search-from">
            <input type="text" name="search" class="form-control-search-lis" placeholder="ค้นหาสินค้า">
            <button type="submit" class="btn btn-primary mt-2">ค้นหา</button>
        </form>

        <div class="container_product_lits">
            <?php
            require 'db_connect.php';
            $search = isset($_GET['search']) ? $_GET['search'] : '';

            if (!empty($search)) {
                $stmt = $pdo->prepare("SELECT * FROM product WHERE name_product LIKE ?");
                $stmt->execute(['%' . $search . '%']);
            } else {
                $stmt = $pdo->query("SELECT * FROM product");
            }

            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($products as $product) {
        ?>
            <div class="card-item-product">
                <img src="images/<?php echo htmlspecialchars($product['img_product']); ?>" class="card-img-top"
                    alt="<?php echo htmlspecialchars($product['name_product']); ?>">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($product['name_product']); ?></h5>
                    <p class="card-text"><?php echo strip_tags($product['dtaill_product']); ?></p>
                    <a href="detailproduct.php?id_product=<?php echo htmlspecialchars($product['id_product']); ?>"
                        class="card-button">เพิ่มเติม</a>
                </div>
            </div>
            <?php
            }
        ?>
        </div>
    </div>


    <div class="copyright_section">
        <?php include 'footer.php'; ?>
    </div>

    <script src="js/script.js"> </script>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/plugin.js"></script>
</body>

</html>