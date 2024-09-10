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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">

    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">
    <style>
      #google_translate_element {
        display: none; /* ซ่อน Google Translate element */
    }
    
    .goog-te-banner-frame.skiptranslate,.skiptranslate,
    .goog-te-gadget-icon {
        display: none !important; /* ซ่อนแถบ Google Translate */
    }
    
    body {
        top: 0 !important;
    }

    </style>
</head>

<body >
    <div class="header_section header_bg body-background">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg bg-light navbar-light" id="main-navbar">
                <a class="navbar-brand" href="index.php" id="brand-text">HAPPY</a>
                <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php" id="home-text">หน้าหลัก</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="product.php" id="product-text">รายการสินค้า</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                id="product-type-text">
                                ประเภทสินค้า
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="producttype.php?type=เครื่องสำอาง"
                                    id="cosmetics-text">เครื่องสำอาง</a>
                                <a class="dropdown-item" href="producttype.php?type=อาหารเสริม"
                                    id="supplements-text">อาหารเสริม</a>
                                <a class="dropdown-item" href="producttype.php?type=สินค้า" id="goods-text">สินค้า</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about_us.php" id="address-text">เกี่ยวกับเรา</a>
                        </li>
                        <!-- Dropdown สำหรับเปลี่ยนภาษา -->
                        <li class="nav-item dropdown ">
                            <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="false" aria-expanded="true">
                                Change language
                            </a>
                            <div class="dropdown-menu" aria-labelledby="languageDropdown">
                                <a class="dropdown-item"href="" onclick="translateLanguage('th'),showOriginalText()">
                                    <span class="flag-icon flag-icon-th"></span> ภาษาไทย
                                </a>
                                <a class="dropdown-item" onclick="translateLanguage('en')">
                                    <span class="flag-icon flag-icon-us"></span> English
                                </a>
                                <a class="dropdown-item" onclick="translateLanguage('lo')">
                                    <span class="flag-icon flag-icon-la"></span> ພາສາລາວ
                                </a>
                                <a class="dropdown-item" onclick="translateLanguage('km')">
                                    <span class="flag-icon flag-icon-kh"></span> ភាសាខ្មែរ
                                </a>
                                <!-- <a class="dropdown-item" href="" onclick="translateLanguage('th'),showOriginalText()">
                                    แสดงข้อความต้นฉบับ
                                </a> -->
                            </div>
                        </li>
                    </ul>
                    <div id="google_translate_element" style="display:none;"></div>
                </div>
            </nav>
        </div>
    </div>
    <script>window.addEventListener('load', function() {
    // ตรวจสอบและปรับแต่งการตั้งค่าตำแหน่งของ <body>
    document.body.style.top = '0';
});
</script>
    <script src="js/script.js"></script>
    <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>

</html>