<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../login.php");
    exit;
}
require "../db_connect.php";

// ตรวจสอบว่ามีการส่ง `id_banner` มาหรือไม่
if (!isset($_POST['id_banner'])) {
    header("Location: list_banner.php");
    exit;
}

$id_banner = $_POST['id_banner'];

// ดึงข้อมูลแบนเนอร์ที่ต้องการแก้ไข
$sql = "SELECT * FROM banner WHERE id_banner = :id_banner";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id_banner' => $id_banner]);
$banner = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$banner) {
    header("Location: list_banner.php");
    exit;
}

$title = $_POST['banner_title'];
$description = $_POST['banner_description'];
$start_date = $_POST['display_start_date'];
$end_date = $_POST['display_end_date'];
$is_active = isset($_POST['is_active']) ? $_POST['is_active'] : 0;

// สร้างไดเรกทอรีสำหรับอัพโหลดถ้ายังไม่มี
$upload_dir = "../images/banner/" . $id_banner . "/";
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// อัพโหลดรูปภาพหลัก
$banner_image = $banner['banner_image']; // รักษาค่าเดิมหากไม่มีการอัพโหลดรูปใหม่
if (isset($_FILES['banner_image']) && $_FILES['banner_image']['error'] == UPLOAD_ERR_OK) {
    $banner_image = basename($_FILES['banner_image']['name']);
    $target_path = $upload_dir . $banner_image;
    if (!move_uploaded_file($_FILES['banner_image']['tmp_name'], $target_path)) {
        echo "เกิดข้อผิดพลาดในการอัปโหลดรูปภาพหลัก";
        exit;
    }
    // ลบภาพเก่าหากมี
    if ($banner['banner_image'] && file_exists($upload_dir . $banner['banner_image'])) {
        unlink($upload_dir . $banner['banner_image']);
    }
}

// จัดการกับรูปภาพรายละเอียด (หลายรูป)
$additional_images = [];
$old_additional_images = unserialize($banner['additional_image']); // รูปภาพเก่า

if (isset($_FILES['additional_image']) && !empty($_FILES['additional_image']['name'][0])) {
    $file_count = count($_FILES['additional_image']['name']);
    for ($i = 0; $i < $file_count; $i++) {
        if ($_FILES['additional_image']['error'][$i] === UPLOAD_ERR_OK) {
            $file_name = basename($_FILES['additional_image']['name'][$i]);
            $target_path = $upload_dir . $file_name;
            if (move_uploaded_file($_FILES['additional_image']['tmp_name'][$i], $target_path)) {
                $additional_images[] = $file_name; // เก็บชื่อไฟล์ใน array หากอัปโหลดสำเร็จ
            } else {
                echo "การย้ายไฟล์ล้มเหลว: " . $file_name;
                exit;
            }
        } else {
            echo "เกิดข้อผิดพลาดในการอัปโหลดไฟล์: " . $_FILES['additional_image']['name'][$i];
            exit;
        }
    }
} else {
    $additional_images = $old_additional_images; // ใช้ข้อมูลเดิมหากไม่มีการอัปโหลดใหม่
}

// ลบรูปภาพเก่า
foreach ($old_additional_images as $old_image) {
    $old_image_path = $upload_dir . $old_image;
    if (!in_array($old_image, $additional_images) && file_exists($old_image_path)) {
        unlink($old_image_path);
    }
}

// แปลงที่อยู่ของรูปภาพเพิ่มเติมเป็นรูปแบบ serialize
$additional_images_serialized = serialize($additional_images);

// เตรียมคำสั่ง SQL สำหรับการอัพเดท
$sql_update = "UPDATE banner 
               SET banner_image = :banner_image, 
                   title = :title, 
                   description = :description, 
                   additional_image = :additional_image, 
                   display_start_date = :display_start_date, 
                   display_end_date = :display_end_date, 
                   is_active = :is_active 
               WHERE id_banner = :id_banner";

$stmt_update = $pdo->prepare($sql_update);
$stmt_update->execute([
    ':banner_image' => $banner_image,
    ':title' => $title,
    ':description' => $description,
    ':additional_image' => $additional_images_serialized,
    ':display_start_date' => $start_date,
    ':display_end_date' => $end_date,
    ':is_active' => $is_active,
    ':id_banner' => $id_banner
]);

header("Location: list_banner.php");
exit;
?>
