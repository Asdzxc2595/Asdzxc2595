<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../login.php");
    exit;
}
require("../db_connect.php");

// ดึงข้อมูลแบนเนอร์ทั้งหมด
$sql = "SELECT * FROM banner";
$stmt = $pdo->query($sql);
$banners = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>รายการแบนเนอร์</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        .container {
            padding: 40px;
            flex-direction: column;
        }

        .dropdown-toggle {
            cursor: pointer;
            font-size: 26px;
        }

        .list-product {
            text-align: center;
        }

        .table {
            width: 100%;
            max-width: 1200px;
        }

        .table img {
            width: 100px;
            margin: 5px;
        }
    </style>
</head>

<body>
    <?php include 'sidebar.php'; ?>

    <div class="container mt-8">
        <div class="list-product">
            <h2>รายการแบนเนอร์</h2>
        </div>
        <a href="ad_banner.php" class="btn btn-primary mb-3">เพิ่มแบนเนอร์ใหม่</a>

        <table class="table table-striped" id="bannerTable">
            <thead>
                <tr>
                    <th>รหัสแบนเนอร์</th>
                    <th>ชื่อแบนเนอร์</th>
                    <th>รูปภาพแบนเนอร์</th>
                    <th>รายละเอียด</th>
                    <th>วันที่เริ่มแสดง</th>
                    <th>วันที่สิ้นสุดการแสดง</th>
                    <th>สถานะการแสดงผล</th>
                    <th>แก้ไข</th>
                    <th>ลบรายการ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($banners as $banner): ?>
                <tr>
                    <td><?php echo htmlspecialchars($banner['id_banner']); ?></td>
                    <td><?php echo htmlspecialchars($banner['title']); ?></td>
                    <td>
                    <img src="../images/banner/<?php echo htmlspecialchars($banner['id_banner']) . '/' . htmlspecialchars($banner['banner_image']); ?>" alt="Banner Image">

                    </td>
                    <td><?php echo '<p>'.strip_tags($banner['description']).'</p>'; ?></td>
                    <td><?php echo htmlspecialchars($banner['display_start_date']); ?></td>
                    <td><?php echo htmlspecialchars($banner['display_end_date']); ?></td>
                    <td><?php echo ($banner['is_active']) ? 'แสดง' : 'ไม่แสดง'; ?></td>
                    <td>
                        <a href="edit_banner.php?id=<?php echo $banner['id_banner']; ?>" class="edit-button">Edit</a>
                        
                    </td>
                    <td>
                    <a href="delete_banner.php?id=<?php echo $banner['id_banner']; ?>" class="delete-button "
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
        $('#bannerTable').DataTable({
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
