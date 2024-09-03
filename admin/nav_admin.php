<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .body{
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
            top: 30px; /* Account for the topbar */
            left: 0;
            background-color: #343a40;
            color: #fff;
            padding-top: 20px;
            z-index: 999;
            overflow-y: auto;
            transition: transform 0.4s ease;
            padding-left:20px;
        }

        .sidevar a{
            display: flex;
            justify-content: space-around;
        }
        @media (min-width: 1199px) {
            .sidebar {
                
                transform: translateX(0);
            }
            .sidebar.active {
                
                transform: translateX(-100%);
            }
        }

        @media (max-width: 1200px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }
        }

        .sidebar a {
            padding: 15px 20px;

            font-size: 18px;
            color: #fff;
            display: block;
            transition: background 0.3s;
            justify-content: space-between;
        }

        .sidebar a:hover {
            background-color: #575757;
        }
    </style>
</head>

<body>
    <div class="topbar">
        <span class="menu-btn" id="menuToggle"><i class="fas fa-bars"></i></span>
        <div class="admin-name">Admin : <?php echo $_SESSION['username']; ?></div>
    </div>

    <div class="sidebar" id="sidebar">
        <h1 class="adminicon">Admin</h1>
        <a href="dashboard.php"><i class="fas fa-chart-pie"></i> Dashboard</a>
        <a href="ad_product.php"><i class="fas fa-plus-circle"></i> เพิ่มสินค้า</a>
        <a href="product_list.php"><i class="fas fa-list"></i> รายการสินค้า</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> ล็อกเอาต์</a>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/plugin.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
    <script>
        document.getElementById('menuToggle').addEventListener('click', function () {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        });
    </script>
</body>

</html>
