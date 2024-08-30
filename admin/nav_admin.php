<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <button class="menu-btn" id="menuToggle"><i class="fas fa-bars"></i></button>

    <div class="sidebar" id="sidebar">
        <a ><h1 class ="adminicon">Admin</h1></a>
        <a href="#"><?php echo $_SESSION['username'];?><i class ="fas fa-user-circle"></i></a> 
        <a href="dashboard.php"><i class="fas fa-chart-pie"></i>Dashboard</a>

        <a href="product_list.php"><i class="fas fa-list"></i>รายการสินค้า</a>
        <a href="ad_product.php"><i class="fas fa-plus-circle"></i>เพิ่มสินค้า</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i>ล็อกเอาต์</a>
    </div>


    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/plugin.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
    <script>
    document.getElementById('menuToggle').addEventListener('click', function() {
        var sidebar = document.getElementById('sidebar');
        var content = document.getElementById('content');
        sidebar.classList.toggle('active');
        content.classList.toggle('shift');
    });
    </script>
</body>

</html>