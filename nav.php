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

    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <style>
        .skiptranslate {
            display: none;
        }

        /* ซ่อนตรา Google */
        .goog-logo-link {
            display: none !important;
        }

        /* ปรับขนาดตัวอักษรใน dropdown */
        .goog-te-menu-value span {
            font-size: 14px;
        }

        /* ซ่อนธงชาติ */
        .goog-te-gadget-icon {
            display: none !important;
        }
    </style>
</head>

<body>
    <div class="header_section header_bg body-background">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg bg-light navbar-light" id="main-navbar">
                <a class="navbar-brand" href="index.php" id="brand-text">HAPPY</a>
                <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="product-type-text">
                                ประเภทสินค้า
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="producttype.php?type=เครื่องสำอาง" id="cosmetics-text">เครื่องสำอาง</a>
                                <a class="dropdown-item" href="producttype.php?type=อาหารเสริม" id="supplements-text">อาหารเสริม</a>
                                <a class="dropdown-item" href="producttype.php?type=สินค้า" id="goods-text">สินค้า</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about_us.php" id="address-text">เกี่ยวกับเรา</a>
                        </li>
                        <!-- Dropdown สำหรับเปลี่ยนภาษา -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Change language
                            </a>
                            <div class="dropdown-menu" aria-labelledby="languageDropdown">
                                <a class="dropdown-item" onclick="translateLanguage('th')">
                                    <span class="flag-icon flag-icon-th"></span> ภาษาไทย
                                </a>
                                <a class="dropdown-item"  onclick="translateLanguage('en')">
                                    <span class="flag-icon flag-icon-us"></span> English
                                </a>
                                <a class="dropdown-item"  onclick="translateLanguage('ja')">
                                    <span class="flag-icon flag-icon-jp"></span> 日本語
                                </a>
                                <a class="dropdown-item"  onclick="translateLanguage('ko')">
                                    <span class="flag-icon flag-icon-kr"></span> 한국어
                                </a>
                                <a class="dropdown-item" onclick="translateLanguage('zh-CN')">
                                    <span class="flag-icon flag-icon-cn"></span> 中文
                                </a>
                                <a class="dropdown-item" onclick="translateLanguage('th'),showOriginalText()">
                                    แสดงข้อความต้นฉบับ
                                </a>
                            </div>
                        </li>
                    </ul>
                    <div id="google_translate_element" style="display:none;"></div>
                </div>
            </nav>
        </div>
    </div>

    <!-- Google Translate API -->
    <script>
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'th'
            }, 'google_translate_element');
            
            // Apply the stored language on page load
            var savedLanguage = localStorage.getItem('selectedLanguage');
            if (savedLanguage) {
                translateLanguage(savedLanguage);
            }
        }

        function translateLanguage(language) {
            var selectField = document.querySelector('.goog-te-combo');
            if (selectField) {
                selectField.value = language;
                selectField.dispatchEvent(new Event('change'));

                // Save the selected language to local storage
                localStorage.setItem('selectedLanguage', language);
            }
        }

        function showOriginalText() {
            var selectField = document.querySelector('.goog-te-combo');
            if (selectField) {

                selectField.value = 'auto';
                selectField.dispatchEvent(new Event('change'));

                localStorage.removeItem('selectedLanguage');
            }
        }
    </script>
    <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>

</html>
