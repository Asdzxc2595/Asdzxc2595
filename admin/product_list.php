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
    <title>Product List</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">

    <style>
    #productTable {
        width: 100%;
        font-size: 1.2em;
    }

    #productTable img {
        width: 150px;
    }

    #productTable td,
    #productTable th {
        padding: 12px;
    }

    .dropdown-filter {
        display: none;
        position: absolute;
        background-color: white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        width: 100%;
        padding: 0;
        margin: 0;
    }

    .dropdown-filter.show {
        display: block;
    }

    .dropdown-toggle {
        cursor: pointer;
        font-size: 1.5em;
    }

    .dropdown-filter select {
        width: 100%;
    }
    </style>
</head>

<body>
    <?php include 'nav_admin.php'; ?>

    <div class="container mt-5">
        <h2>Product List</h2>

        <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Search for products..." class="form-control mb-3">

        <table class="table table-striped" id="productTable">
            <thead>
                <tr>
                    <th>ID<i class="fa fa-filter" onclick="sortTable(0)"></i></th>
                    <th>Name<i class="fa fa-filter" onclick="sortTable(1)"></i></th>
                    <th>Image</th>
                    <th>
                        <span class="dropdown-toggle h3" onclick="toggleDropdown()">Type</span>
                        <div id="typeDropdown" class="dropdown-filter">
                            <form id="filterForm" method="GET" action="">
                                <select id="test" name="type" class="form-control" onchange="document.getElementById('filterForm').submit()">
                                    <option value="">Select Type</option>
                                    <option value="เครื่องสำอาง" <?php echo ($typeFilter === 'เครื่องสำอาง') ? 'selected' : ''; ?>>เครื่องสำอาง</option>
                                    <option value="อาหารเสริม" <?php echo ($typeFilter === 'อาหารเสริม') ? 'selected' : ''; ?>>อาหารเสริม</option>
                                    <option value="สินค้า" <?php echo ($typeFilter === 'สินค้า') ? 'selected' : ''; ?>>สินค้า</option>
                                </select>
                            </form>
                        </div>
                    </th>
                    <th>Details</th>
                    <th>Details Image</th>
                    <th>Details Video</th>
                    <th>Date<i class="fa fa-filter" onclick="sortTable(7)"></i></th>
                    <th>View Count<i class="fa fa-filter" onclick="sortTable(8)"></i></th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo htmlspecialchars($product['id_product']); ?></td>
                    <td><?php echo '<p class="banner_text">'.htmlspecialchars($product['name_product']).'</p>'; ?></td>
                    <td>
                        <img src="../images/<?php echo htmlspecialchars($product['img_product']); ?>" alt="Product Image">
                    </td>
                    <td><?php echo htmlspecialchars($product['type_product']); ?></td>
                    <td><?php echo '<p class="banner_text">'.strip_tags($product['dtaill_product']) . '</p>'; ?></td>
                    <td>
                        <?php
                        $detailsImages = json_decode($product['dtaill_img_product']);
                        if (is_array($detailsImages) && !empty($detailsImages)) {
                            foreach ($detailsImages as $image) {
                                if (!empty($image)) {
                                    echo '<img src="../images/' . htmlspecialchars($image) . '" alt="Detail Image" style="width: 150px; margin-right: 5px;">';
                                }
                            }
                        } else {
                            echo "No images available";
                        }
                        ?>
                    </td>
                    <td><?php echo htmlspecialchars($product['dtaill_vdo_product']); ?></td>
                    <td><?php echo htmlspecialchars($product['date_product']); ?></td>
                    <td><?php echo htmlspecialchars($product['view_count']); ?></td>
                    <td>
                        <a href="edit_product.php?id=<?php echo $product['id_product']; ?>" class="active">Edit</a>
                        <a href="delete_product.php?id=<?php echo $product['id_product']; ?>" class="active" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="../js/filtertable.js"></script>
    <script>
function toggleDropdown() {
    var dropdown = document.getElementById('typeDropdown');
    if (dropdown.classList.contains('show')) {
        dropdown.classList.remove('show');
    } else {
        dropdown.classList.add('show');
    }
}

// Close dropdown if clicked outside
window.onclick = function(event) {
    if (!event.target.matches('.dropdown-toggle') && !event.target.closest('#typeDropdown')) {
        var dropdowns = document.getElementsByClassName('dropdown-filter');
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}

// Prevent the dropdown from closing when clicking inside it
document.getElementById('typeDropdown').addEventListener('click', function(event) {
    event.stopPropagation();
});
</script>

</body>

</html>
