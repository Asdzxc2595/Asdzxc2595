<?php
require("../db_connect.php");

if (isset($_POST['submit'])) {
    $title = $_POST['banner_title'];
    $description = $_POST['banner_description'];
    $start_date = $_POST['display_start_date'];
    $end_date = $_POST['display_end_date'];
    $is_active = $_POST['is_active'];

    // สร้างไดเรกทอรีสำหรับอัพโหลดถ้ายังไม่มี
    $upload_dir = 'uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }


    $banner_image = '';
    if (isset($_FILES['banner_image']) && $_FILES['banner_image']['error'] == UPLOAD_ERR_OK) {
        $banner_image = $_FILES['banner_image']['name'];
        $target_path = '../images/' . $banner_image;
        if (!move_uploaded_file($_FILES['banner_image']['tmp_name'], $target_path)) {
            echo "เกิดข้อผิดพลาดในการอัปโหลดรูปภาพสินค้า";
            exit;
        }
    }

    // อัพโหลดรูปภาพเพิ่มเติม
    $additional_images = [];
    if (isset($_FILES['additional_images']) && !empty($_FILES['additional_images']['name'][0])) {
        foreach ($_FILES['additional_images']['name'] as $key => $name) {
            if ($_FILES['additional_images']['error'][$key] == 0) {
                $file_path = $upload_dir . basename($name);
                move_uploaded_file($_FILES['additional_images']['tmp_name'][$key], $file_path);
                $additional_images[] = $file_path;
            }
        }
    }

    // แปลงที่อยู่ของรูปภาพเพิ่มเติมเป็น JSON
    $additional_images_json = json_encode($additional_images);

    // เตรียมคำสั่ง SQL
    $sql = "INSERT INTO banner (banner_image, title, description, additional_image, display_start_date, display_end_date, is_active) 
            VALUES (:banner_image, :title, :description, :additional_image, :display_start_date, :display_end_date, :is_active)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':banner_image' => $banner_image,
        ':title' => $title,
        ':description' => $description,
        ':additional_image' => $additional_image_json,
        ':display_start_date' => $start_date,
        ':display_end_date' => $end_date,
        ':is_active' => $is_active
    ]);

    header("Location: list_banner.php");
    exit;
}
?>
