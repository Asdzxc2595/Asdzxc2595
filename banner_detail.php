<?php
include 'db_connect.php'; // เชื่อมต่อฐานข้อมูล

// ตรวจสอบว่ามีการส่ง id_banner มาหรือไม่
if (isset($_GET['id_banner'])) {
    $id_banner = $_GET['id_banner'];

    // ดึงข้อมูล banner ตาม id_banner ที่ได้รับ
    $sql = "SELECT * FROM banner WHERE id_banner = :id_banner";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_banner', $id_banner, PDO::PARAM_INT);
    $stmt->execute();

    // ตรวจสอบว่ามีข้อมูลหรือไม่
    if ($stmt->rowCount() > 0) {
        $banner = $stmt->fetch(PDO::FETCH_ASSOC); // ดึงข้อมูล banner ออกมา
    } else {
        echo "ไม่พบข้อมูล Banner";
        exit;
    }
} else {
    echo "ไม่พบ ID ของ Banner";
    exit;
}

$img_ids = [];
if (isset($banner['additional_image'])) {
    $img_data = $banner['additional_image'];

    // ลอง unserialize ก่อน ถ้าล้มเหลวให้ถือว่าเป็น string ธรรมดา
    $unserialized_data = @unserialize($img_data);
    if ($unserialized_data !== false && is_array($unserialized_data)) {
        $img_ids = $unserialized_data;
    } else {
        // ถ้าไม่สามารถ unserialize ได้ ให้ถือว่าเป็น string ธรรมดาและเพิ่มใน array
        $img_ids[] = $img_data;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียด Banner</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

    <style>
    .about-banner img {
        width: 100%;
        max-height: 600px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .about-banner img:hover {
        transform: scale(1.05);
    }

    .banner-details {
        margin-top: 20px;
    }

    .banner-title {
        font-size: 32px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
    }

    .banner-description {
        font-size: 18px;
        text-align: justify;
        margin-bottom: 20px;
    }

    .additional-images img {
        width: 100%;
        max-width: 300px;
        height: auto;
        margin-bottom: 10px;
        border: 1px solid #ddd;
        padding: 5px;
    }

    </style>
</head>

<body>
    <?php include 'nav.php'; ?>

    <!-- แสดงข้อมูล Banner -->
    <div class="about-banner">
        <img src="images/banner/<?php echo htmlspecialchars($banner['id_banner']); ?>/<?php echo htmlspecialchars($banner['banner_image']); ?>" alt="Banner Image">
    </div>
    <div class="container">
        <h1 class="banner-title"><?php echo htmlspecialchars($banner['title']); ?></h1>
        <div class="banner-details">
            <?php echo '<p class="banner-description">' . ($banner['description']) . '</p>';?>
        </div>
        <!-- แสดงรูปภาพเพิ่มเติม -->
        <div class="additional-images">
            <?php
            if (!empty($img_ids) && is_array($img_ids)) {
                foreach ($img_ids as $image) {
                    $imagePath = 'images/banner/' . htmlspecialchars($id_banner) . '/' . htmlspecialchars($image);
                    if (file_exists($imagePath)) {
                        echo '<img src="' . $imagePath . '" alt="Additional Image">';
                    } else {
                        echo '<p>Image not found: ' . htmlspecialchars($image) . '</p>';
                    }
                }
            } else {
                echo '<p>No additional images available.</p>';
            }
            ?>
        </div>
    </div>

    <!-- Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
