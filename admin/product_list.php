<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: loginadmin.php");
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
</head>

<body>
    <?php include 'nav_admin.php'; ?>

    <div class="container mt-5">
        <h2>Product List</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Type</th>
                    <th>Details</th>
                    <th>Details Image</th>
                    <th>Details Video</th>
                    <th>Date</th>
                    <th>View Count</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo htmlspecialchars($product['id_product']); ?></td>
                    <td><?php echo htmlspecialchars($product['name_product']); ?></td>
                    <td><img src="../images/<?php echo htmlspecialchars($product['img_product']); ?>"
                            alt="Product Image" style="width: 100px;"></td>
                    <td><?php echo htmlspecialchars($product['type_product']); ?></td>
                    <td><?php echo htmlspecialchars($product['dtaill_product']); ?></td>
                    <td>
                        <?php
    $detailsImages = json_decode($product['dtaill_img_product']);
    if (is_array($detailsImages)) {
        foreach ($detailsImages as $image): ?>
                        <img src="../images/<?php echo htmlspecialchars($image); ?>" alt="Detail Image"
                            style="width: 100px; margin-right: 5px;">
                        <?php endforeach; 
    } else {
        echo "No images available";
    }
    ?>
                    </td>
                    >
                    <td><?php echo htmlspecialchars($product['dtaill_vdo_product']); ?></td>
                    <td><?php echo htmlspecialchars($product['date_product']); ?></td>
                    <td><?php echo htmlspecialchars($product['view_count']); ?></td>
                    <td>
                        <a href="edit_product.php?id=<?php echo $product['id_product']; ?>"
                            class="btn btn-primary btn-sm">Edit</a>
                        <a href="delete_product.php?id=<?php echo $product['id_product']; ?>"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>