<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../login.php");
    exit;
}
require("../db_connect.php");

// ดึงประเภทสินค้าที่เลือกจาก query string
$typeFilter = isset($_GET['type']) ? $_GET['type'] : '';

// สร้าง SQL Query ตามประเภทที่เลือก
$sql = "SELECT * FROM product";
if ($typeFilter) {
    $sql .= " WHERE type_product = :type";
}

// เตรียม statement และ bind parameters
$stmt = $pdo->prepare($sql);
if ($typeFilter) {
    $stmt->bindParam(':type', $typeFilter, PDO::PARAM_STR);
}
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>รายการสินค้า</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">

    <style>
    .container {
        padding: 50px;
        flex-direction: column;
    }

    .dropdown-filter.show {
        display: flex;
    }

    .dropdown-toggle {
        cursor: pointer;
        font-size: 26px;
    }

    .list-product {
        text-align: center;
    }
    </style>
</head>

<body>
    <?php include 'sidebar.php'; ?>

    <div class="container mt-9">
    <div class="list-product"><h2>รายการสินค้า</h2></a>
        </div>
            <!-- <a href="ad_product.php" class="btn btn-primary mb-3">เพิ่มสินค้าใหม่</a> -->
        <table class="table table-striped" id="productTable">
            <thead>
                <tr>
                    <th>รหัสสินค้า</th>
                    <th>ชื่อ</th>
                    <th>รูปสินค้า</th>
                    <th>
                        <span class="dropdown-toggle" onclick="toggleDropdown()">ประเภทสินค้า</span>
                        <div id="typeDropdown" class="dropdown-filter">
                            <form id="filterForm" method="GET" action="">
                                <select id="test" name="type" class="form-control"
                                    onchange="document.getElementById('filterForm').submit()">
                                    <option value="">ประเภท</option>
                                    <option value="เครื่องสำอาง"
                                        <?php echo ($typeFilter === 'เครื่องสำอาง') ? 'selected' : ''; ?>>เครื่องสำอาง
                                    </option>
                                    <option value="อาหารเสริม"
                                        <?php echo ($typeFilter === 'อาหารเสริม') ? 'selected' : ''; ?>>อาหารเสริม
                                    </option>
                                    <option value="สินค้า" <?php echo ($typeFilter === 'สินค้า') ? 'selected' : ''; ?>>
                                        สินค้า
                                    </option>
                                </select>
                            </form>
                        </div>
                    </th>
                    <th>รายละเอียด</th>
                    <th>คลิปรายละเอียดสินค้า</th>
                    <th>วันที่นำเข้า</i></th>
                    <th>ยอดคนดู</i></th>
                    <th>แก้ไข</th>
                    <th>ลบรายการ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo htmlspecialchars($product['id_product']); ?></td>
                    <td><?php echo '<p class="product_text">'.htmlspecialchars($product['name_product']).'</p>'; ?></td>
                    <td>
                        <img src="../images/<?php echo htmlspecialchars($product['img_product']); ?>"
                            alt="Product Image">
                    </td>
                    <td><?php echo htmlspecialchars($product['type_product']); ?></td>
                    <td><?php echo '<p class="product_text">'.strip_tags($product['detail_product']) . '</p>'; ?></td>
                    <td><?php echo htmlspecialchars($product['vdo_detail_product']); ?></td>
                    <td><?php echo htmlspecialchars($product['date_product']); ?></td>
                    <td><?php echo htmlspecialchars($product['view_product']); ?></td>
                    <td>
                        <a href="edit_product.php?id=<?php echo $product['id_product']; ?>" class="edit-button">Edit</a>
                        
                    </td>
                    <td><a href="delete_product.php?id=<?php echo $product['id_product']; ?>" class="delete-button"
                            onclick="return confirm('จะลบรายการนี้ใช่ไหม');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#productTable').DataTable({
            autoFill: false,
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true
        });
    });

    function toggleDropdown() {
        document.getElementById('typeDropdown').classList.toggle('show');
    }
    </script>

</body>

</html>