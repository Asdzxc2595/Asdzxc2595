<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
    .body {
        padding-left: 300px;
    }

    .menu-btn {
        margin-right: 10px;
        cursor: pointer;
    }

    .adminicon {
        text-align: center;
        margin-top: 20px;
    }

    .admin-name {
        text-align: right;
        padding-right: 10px;
    }

    .topbar {
        position: fixed;
        top: 0;
        width: 100%;
        height: 50px;
        background-color: #343a40;
        color: #fff;
        padding: 10px;
        z-index: 1000;
        justify-content: space-between;
        font-size: 20px;
    }

    .sidebar {
        width: 230px;
        height: 100%;
        position: fixed;
        top: 30px;
        left: 0;
        background-color: #343a40;
        color: #fff;
        padding-top: 20px;
        z-index: 999;
        overflow-y: auto;
        transition: transform 0.4s ease, opacity 0.4s ease;
        /* เพิ่มการเคลื่อนไหว */
        padding-left: 20px;
        opacity: 1;
        padding-bottom: 35px;
    }

    .sidebar a {
        padding: 15px 20px;
        font-size: 18px;
        color: #fff;
        display: flex;
        justify-content: space-between;
        flex-direction: row;
        transition: background 0.3s;
    }

    .sidebar a:hover {
        background-color: #575757;
    }

    .menu-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        padding-right: 10px;
        font-size: 20px;
    }.menu-item .fa-plus{
        transform: rotate(180deg);
        transition: 1s;
    }

    .submenu {
        display: none;
        padding-left: 20px;

    }

    .submenu a {
        font-size: 20px;
        
    }

    .sidebar.active {
        transform: translateX(-100%);
    }

    .menu-btn .fa-times {
        transform: rotate(180deg);
        /* หมุนไอคอน 180 องศาเมื่อเป็น X */
        transition: 1s;
    }

    @media (min-width: 1549px) {
        .sidebar {
            transform: translateX(0);
        }

        .sidebar.active {
            transform: translateX(-100%);
        }
    }

    @media (max-width: 1550px) {
        .sidebar {
            transform: translateX(-100%);
        }

        .sidebar.active {
            transform: translateX(0);
        }
    }
    </style>
</head>

<body>
    <div class="topbar">
        <span class="menu-btn" id="menuToggle"><i class="fas fa-bars" id="menuIcon"></i></span>

        <div class="admin-name">Admin : <?php echo $_SESSION['username']; ?></div>
    </div>

    <div class="sidebar" id="sidebar">
        <h1 class="adminicon">Admin</h1>

        <!-- เมนู รายการ -->
        <a href="dashboard.php">dashboard <i class="fas fa-chart-pie"></i></a>
        <a class="menu-item" id="menu-item-list">
            <span>รายการ</span>
            <i class="fas fa-plus" id="toggle-list"></i>
        </a>
        <div class="submenu" id="submenu-list">
            <a href="product_list.php">สินค้า <i class="fas fa-box"></i></a>
            <a href="list_banner.php">Banner <i class="fas fa-image"></i></a>
            <a href="list_advert.php">Advert <i class="fas fa-bullhorn"></i></a>
        </div>

        <!-- เมนู เพิ่มรายการ -->
        <a class="menu-item" id="menu-item-add">
            <span>เพิ่มรายการ</span>
            <i class="fas fa-plus" id="toggle-add"></i>
        </a>
        <div class="submenu" id="submenu-add">
            <a href="ad_product.php">สินค้า <i class="fas fa-box"></i></a>
            <a href="ad_banner.php">Banner <i class="fas fa-image"></i></a>
            <a href="ad_advert.php">Advert <i class="fas fa-bullhorn"></i></a>
        </div>

        <a href="logout.php"> ล็อกเอาต์ <i class="fas fa-sign-out-alt"></i></a>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/plugin.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.3.0/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script>
    document.getElementById('menuToggle').addEventListener('click', function() {
        var sidebar = document.getElementById('sidebar');
        var menuIcon = document.getElementById('menuIcon');

        // สลับคลาส active สำหรับ sidebar
        sidebar.classList.toggle('active');

        // ตรวจสอบขนาดหน้าจอและปรับไอคอนตามสถานะเมนูด้านข้าง
        if (window.innerWidth >= 1549) {
            if (sidebar.classList.contains('active')) {
                menuIcon.classList.remove('fa-times');
                menuIcon.classList.add('fa-bars');
            } else {
                menuIcon.classList.remove('fa-bars');
                menuIcon.classList.add('fa-times');
            }
        } else {
            if (sidebar.classList.contains('active')) {
                menuIcon.classList.remove('fa-bars');
                menuIcon.classList.add('fa-times');
            } else {
                menuIcon.classList.remove('fa-times');
                menuIcon.classList.add('fa-bars');
            }
        }
    });

    // ฟังก์ชันสำหรับเปลี่ยนไอคอนเมื่อเปลี่ยนขนาดหน้าจอ
    window.addEventListener('resize', function() {
        var sidebar = document.getElementById('sidebar');
        var menuIcon = document.getElementById('menuIcon');

        // ตรวจสอบขนาดหน้าจอและตั้งค่าไอคอนตามสถานะเมนูด้านข้าง
        if (window.innerWidth >= 1549) {
            if (!sidebar.classList.contains('active')) {
                menuIcon.classList.remove('fa-bars');
                menuIcon.classList.add('fa-times');
            } else {
                menuIcon.classList.remove('fa-times');
                menuIcon.classList.add('fa-bars');
            }
        } else {
            if (sidebar.classList.contains('active')) {
                menuIcon.classList.remove('fa-bars');
                menuIcon.classList.add('fa-times');
            } else {
                menuIcon.classList.remove('fa-times');
                menuIcon.classList.add('fa-bars');
            }
        }
    });


    // ฟังก์ชันสลับการแสดงเมนูย่อย
    function toggleSubmenu(toggleIconId, submenuId) {
        var submenu = document.getElementById(submenuId);
        var icon = document.getElementById(toggleIconId);
        if (submenu.style.display === 'block') {
            submenu.style.display = 'none';
            icon.classList.remove('fa-minus');
            icon.classList.add('fa-plus');
        } else {
            submenu.style.display = 'block';
            icon.classList.remove('fa-plus');
            icon.classList.add('fa-minus');
        }
    }

    // คลิกเมนูรายการ
    document.getElementById('menu-item-list').addEventListener('click', function() {
        toggleSubmenu('toggle-list', 'submenu-list');
    });

    // คลิกเมนูเพิ่มรายการ
    document.getElementById('menu-item-add').addEventListener('click', function() {
        toggleSubmenu('toggle-add', 'submenu-add');
    });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        tinymce.init({
            selector: 'textarea#detail',
            plugins: 'advlist anchor autolink autosave charmap code codesample directionality emoticons fullscreen help image imagetools insertdatetime link lists media nonbreaking pagebreak paste preview print save searchreplace spellchecker table template textcolor visualblocks visualchars wordcount',
            toolbar: 'undo redo | formatselect | link image | fontselect fontsizeselect | bold italic underline strikethrough | forecolor backcolor removeformat | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table emoticons charmap | preview fullscreen code',
            menubar: 'file edit view insert format tools table',
        });
    });
    </script>
</body>

</html>