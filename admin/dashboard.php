<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit;
}
require("../db_connect.php");

// ดึงข้อมูลยอดเข้าชมแยกตามประเภทสินค้า
$sql = "SELECT type_product, name_product, view_count FROM product";
$result = $pdo->query($sql);

$types = [];
$total_views = 0;
$total_products = 0; // จำนวนรายการทั้งหมด
$view_by_type = ['เครื่องสำอาง' => 0, 'อาหารเสริม' => 0, 'สินค้า' => 0];
$product_count_by_type = ['เครื่องสำอาง' => 0, 'อาหารเสริม' => 0, 'สินค้า' => 0];

// เก็บข้อมูลตามประเภทสินค้า
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $type = $row['type_product'];
    $name = $row['name_product'];
    $views = $row['view_count'];

    if ($views > 0) {  // ตรวจสอบเฉพาะสินค้าที่มีการเข้าชม
        $total_views += $views;
        $view_by_type[$type] += $views;
        $product_count_by_type[$type]++;
        $total_products++; // เพิ่มจำนวนรายการทั้งหมด

        if (!isset($types[$type])) {
            $types[$type] = ['total' => 0, 'products' => []];
        }
        $types[$type]['total'] += $views;
        $types[$type]['products'][] = [
            'name' => $name,
            'views' => $views
        ];
    }
}

// คำนวณเปอร์เซ็นต์ยอดเข้าชมสำหรับแต่ละประเภทสินค้า และจัดเรียงสินค้าตามยอดเข้าชม
foreach ($types as $type => &$data) {
    // เรียงลำดับสินค้าตามจำนวนการเข้าชมจากมากไปน้อย
    usort($data['products'], function($a, $b) {
        return $b['views'] - $a['views'];
    });
    $data['percentage'] = round(($data['total'] / $total_views) * 100, 2);
}
unset($data); // Unset reference to avoid issues
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <style>
        .body{
            padding-left: 290px;
            padding-top: 130px;
        }
        .chart-container {
            position: relative;
            width: 100%;
            height: 400px;
            margin: auto;
        }

        @media (min-width: 768px) {
            .chart-container {
                width: 80%;
            }
        }
        .card-body {
            padding: 20px;
        }
        
    </style>
</head>
<body>

<?php include 'nav_admin.php'; ?> 
    <div class="container mt-5">
        <h2>Dashboard: ยอดคนดู</h2>

        <div class="row card-container">
            <!-- แสดงข้อมูลยอดเข้าชมรวมทั้งหมด -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">ยอดคนดูรวมทั้งหมด</h5>
                        <p class="card-text"><?php echo number_format($total_views); ?> เข้าชม</p>
                        <p class="card-text">จำนวนรายการทั้งหมด: <?php echo number_format($total_products); ?> รายการ</p>
                    </div>
                </div>
            </div>

            <!-- แสดงข้อมูลยอดเข้าชมตามประเภทสินค้า -->
            <?php foreach ($view_by_type as $type => $views): ?>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($type); ?></h5>
                            <p class="card-text">จำนวนยอดคนดู: <?php echo number_format($views); ?> เข้าชม</p>
                            <p class="card-text">จำนวนรายการ: <?php echo $product_count_by_type[$type]; ?> รายการ</p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="row">
            <?php foreach ($types as $type => $data): ?>
                <div class="col-md-6 mb-5">
                    <h3><?php echo htmlspecialchars($type); ?> (<?php echo $data['percentage']; ?>%)</h3>
                    <div class="chart-container">
                        <canvas id="chart-<?php echo htmlspecialchars($type); ?>"></canvas>
                    </div>
                    <h4>รายละเอียดสินค้า:</h4>
                    <ul>
                        <?php foreach ($data['products'] as $product): ?>
                            <li>
                                <?php echo htmlspecialchars($product['name']); ?> - <?php echo $product['views']; ?> เข้าชม
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const ctx<?php echo htmlspecialchars($type); ?> = document.getElementById('chart-<?php echo htmlspecialchars($type); ?>').getContext('2d');
                        
                        const productNames = <?php echo json_encode(array_column($data['products'], 'name')); ?>;
                        const productViews = <?php echo json_encode(array_column($data['products'], 'views')); ?>;
                        const maxProductsToShow = 3;  // แสดงสินค้ามากสุด 3 รายการ

                        let topProducts = productNames.slice(0, maxProductsToShow);
                        let topViews = productViews.slice(0, maxProductsToShow);
                        let otherViews = productViews.slice(maxProductsToShow).reduce((sum, views) => sum + views, 0);

                        if (otherViews > 0) {
                            topProducts.push('อื่นๆ');
                            topViews.push(otherViews);
                        }

                        new Chart(ctx<?php echo htmlspecialchars($type); ?>, {
                            type: 'pie',
                            data: {
                                labels: topProducts,
                                datasets: [{
                                    data: topViews,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 206, 86, 0.2)',
                                        'rgba(201, 203, 207, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(201, 203, 207, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    tooltip: {
                                        callbacks: {
                                            label: function(context) {
                                                let label = context.label || '';
                                                if (context.parsed > 0) {
                                                    label += ': ' + context.raw + ' เข้าชม (' + Math.round(context.raw / <?php echo $data['total']; ?> * 100) + '%)';
                                                }
                                                return label;
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    });
                </script>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
