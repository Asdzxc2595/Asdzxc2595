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
        href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>
<body>
    <div class="header_section header_bg body-background">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg  bg-light navbar-light ">
                <a class="navbar-brand" href="index.php" id="brand-text">HAPPY</a>
                <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php" id="home-text">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="product.php" id="product-text">Product</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="product-type-text">
                                Product type
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="producttype.php?type=เครื่องสำอาง" id="cosmetics-text">เครื่องสำอาง</a>
                                <a class="dropdown-item" href="producttype.php?type=อาหารเสริม" id="supplements-text">อาหารเสริม</a>
                                <a class="dropdown-item" href="producttype.php?type=สินค้า" id="goods-text">สินค้า</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#address" id="address-text">address</a>
                        </li>
                    </ul>
                    <!-- <div class="nav-item dropdown ml-3">
                        <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Language
                        </a>
                        <div class="dropdown-menu" aria-labelledby="languageDropdown">
                            <a class="dropdown-item" href="#" onclick="changeLanguage('en')">English</a>
                            <a class="dropdown-item" href="#" onclick="changeLanguage('th')">ไทย</a>
                            <a class="dropdown-item" href="#" onclick="changeLanguage('zh')">中文</a>
                        </div>
                    </div> -->
                </div>
            </nav>
        </div>
    </div>

    <!-- Include i18next and i18next-browser-languagedetector -->
    <script src="https://unpkg.com/i18next@21.6.15/i18next.min.js"></script>
    <script src="https://unpkg.com/i18next-browser-languagedetector@6.1.3/i18nextBrowserLanguageDetector.min.js"></script>

    <script>
        // Initialize i18next
        i18next.use(i18nextBrowserLanguageDetector).init({
            debug: true,
            fallbackLng: 'en',
            resources: {
                en: {
                    translation: {
                        "brand": "HAPPY",
                        "home": "Home",
                        "product": "Product",
                        "product_type": "Product type",
                        "cosmetics": "Cosmetics",
                        "supplements": "Supplements",
                        "goods": "Goods",
                        "address": "Address"
                    }
                },
                th: {
                    translation: {
                        "brand": "HAPPY",
                        "home": "หน้าหลัก",
                        "product": "สินค้า",
                        "product_type": "ประเภทสินค้า",
                        "cosmetics": "เครื่องสำอาง",
                        "supplements": "อาหารเสริม",
                        "goods": "สินค้า",
                        "address": "ที่อยู่"
                    }
                },
                zh: {
                    translation: {
                        "brand": "HAPPY",
                        "home": "首页",
                        "product": "产品",
                        "product_type": "产品类型",
                        "cosmetics": "化妆品",
                        "supplements": "保健品",
                        "goods": "商品",
                        "address": "地址"
                    }
                }
            }
        }, function(err, t) {
            // Update the text content after initialization
            updateContent();
        });

        // Function to update content based on the selected language
        function updateContent() {
            document.getElementById('brand-text').textContent = i18next.t('brand');
            document.getElementById('home-text').textContent = i18next.t('home');
            document.getElementById('product-text').textContent = i18next.t('product');
            document.getElementById('product-type-text').textContent = i18next.t('product_type');
            document.getElementById('cosmetics-text').textContent = i18next.t('cosmetics');
            document.getElementById('supplements-text').textContent = i18next.t('supplements');
            document.getElementById('goods-text').textContent = i18next.t('goods');
            document.getElementById('address-text').textContent = i18next.t('address');
        }

        // Function to change language
        function changeLanguage(language) {
            i18next.changeLanguage(language, updateContent);
        }
    </script>
</body>
</html>
