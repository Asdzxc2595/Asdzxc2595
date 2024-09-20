<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../login.php");
    exit;
}
require("../db_connect.php");

// ดึงข้อมูลโฆษณาทั้งหมด
$sql = "SELECT * FROM advert";
$stmt = $pdo->query($sql);
$adverts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>รายการโฆษณา</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        .container {

            flex-direction: column;
        }

        .dropdown-toggle {
            cursor: pointer;
            font-size: 26px;
        }

        .list-product {
            padding-top: 30px;
            text-align: center;
        }

        .table {
            width: 100%;
            max-width: 1200px;
        }

        .table img {
            width: 100px;
           
        }
    </style>
</head>

<body>
    <?php include 'sidebar.php'; ?>

    <div class="container mt-8">
        <div class="list-product">
            <h2>รายการโฆษณา</h2>
        </div>
        <a href="ad_advert.php" class="btn btn-primary mb-3">เพิ่มโฆษณาใหม่</a>

        <table class="table table-striped" id="advertTable">
            <thead>
                <tr>
                    <th>รหัสโฆษณา</th>
                    <th>ชื่อโฆษณา</th>
                    <th>รูปภาพโฆษณา</th>
                    <th>รายละเอียด</th>
                    <th>วันที่เริ่มแสดง</th>
                    <th>วันที่สิ้นสุดการแสดง</th>
                    <th>สถานะการแสดงผล</th>
                    <th>แก้ไข</th>
                    <th>ลบรายการ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($adverts as $advert): ?>
                <tr>
                    <td><?php echo htmlspecialchars($advert['id_advert']); ?></td>
                    <td><?php echo htmlspecialchars($advert['name_advert']); ?></td>
                    <td>
                    <img src="../images/advert/<?php echo htmlspecialchars($advert['id_advert']) . '/' . htmlspecialchars($advert['img_advert']); ?>" alt="advert Image">

                    </td>
                    <td><?php echo '<p class="detail_advert">'.strip_tags($advert['detail_advert']).'</p>'; ?></td>
                    <td><?php echo htmlspecialchars($advert['star_date_advert']); ?></td>
                    <td><?php echo htmlspecialchars($advert['end_date_advert']); ?></td>
                    <td><?php echo ($advert['active_advert']) ? 'แสดง' : 'ไม่แสดง'; ?></td>
                    <td>
                        <a href="edit_advert.php?id=<?php echo $advert['id_advert']; ?>" class="edit-button">Edit</a>
                        
                    </td>
                    <td>
                    <a href="delete_advert.php?id=<?php echo $advert['id_advert']; ?>" class="delete-button "
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
        $('#advertTable').DataTable({
            autoFill: false,
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true
        });
    });
    </script>
</body>

</html>
