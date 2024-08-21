<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../login.php");
    exit;
}
require("../db_connect.php");

// ดึงข้อมูลจากฐานข้อมูล
$sql = "SELECT * FROM product";
$stmt = $pdo->query($sql);
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
        /* เพิ่มขนาดฟอนต์ในตาราง */
    }

    #productTable img {
        width: 150px;
        /* ปรับขนาดของภาพในตาราง */
    }

    #productTable td,
    #productTable th {
        padding: 12px;
        /* เพิ่ม padding ในแต่ละ cell */
    }
    </style>
</head>

<body>
    <?php include 'nav_admin.php'; ?>

    <div class="container mt-5">
        <h2>Product List</h2>
        <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Search for products..."
            class="form-control mb-3">

        <table class="table table-striped" id="productTable">
            <thead>
                <tr>
                    <th>ID<i class="fa fa-filter" onclick="sortTable(0)"></i></th>
                    <th>Name<i class="fa fa-filter" onclick="sortTable(1)"></i></th>
                    <th>Image</th>
                    <th>Type<i class="fa fa-filter" onclick="sortTable(3)"></i></th>
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
                        <img src="../images/<?php echo htmlspecialchars($product['img_product']); ?>"
                            alt="Product Image">
                    </td>
                    <td><?php echo htmlspecialchars($product['type_product']); ?></td>
                    <td><?php  echo '<p class="banner_text">'.strip_tags($product['dtaill_product']) . '</p>'; ?></td>
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
                        <a href="edit_product.php?id=<?php echo $product['id_product']; ?>"
                            class="active">Edit</a>
                        <a href="delete_product.php?id=<?php echo $product['id_product']; ?>"
                            class="active"
                            onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
    function filterTable() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toLowerCase();
        table = document.getElementById("productTable");
        tr = table.getElementsByTagName("tr");


        for (i = 1; i < tr.length; i++) {
            tr[i].style.display = "none"; // ซ่อนแถวเป็นค่าเริ่มต้น
            td = tr[i].getElementsByTagName("td");

            // หาชื่อ
            if (td[1]) { 
                txtValue = td[1].textContent || td[1].innerText;
                if (txtValue.toLowerCase().indexOf(filter) > -1) {
                    tr[i].style.display = ""; /
                }
            }
            //หาไอดี
            if (td[0]) { 
                txtValue = td[0].textContent || td[0].innerText;
                if (txtValue.toLowerCase().indexOf(filter) > -1) {
                    tr[i].style.display = ""; 
                }
            }
        }
        
    }

    function sortTable(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("productTable");
        switching = true;

        dir = "asc";
        while (switching) {

            switching = false;
            rows = table.rows;

            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;

                x = rows[i].getElementsByTagName("TD")[n];
                y = rows[i + 1].getElementsByTagName("TD")[n];

                var xValue = x.innerHTML.toLowerCase();
                var yValue = y.innerHTML.toLowerCase();
                if (n === 0 || n === 8) { 
                    xValue = parseFloat(x.innerHTML) || 0;
                    yValue = parseFloat(y.innerHTML) || 0;
                } else if (n === 7) { 
                    xValue = new Date(x.innerHTML);
                    yValue = new Date(y.innerHTML);
                }

                if (dir === "asc") {
                    if (xValue > yValue) {
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir === "desc") {
                    if (xValue < yValue) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {

                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                // Each time a switch is done, increase this count by 1:
                switchcount++;
            } else {

                if (switchcount === 0 && dir === "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }
    </script>
</body>

</html>