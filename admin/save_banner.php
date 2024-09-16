<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../login.php");
    exit;
}
require "../db_connect.php";

if (isset($_POST['submit'])) {
    $title = $_POST['banner_title'];
    $description = $_POST['banner_description'];
    $start_date = $_POST['display_start_date'];
    $end_date = $_POST['display_end_date'];
    $is_active = isset($_POST['is_active']) ? $_POST['is_active'] : 0; // ตรวจสอบค่า is_active

    // เตรียมคำสั่ง SQL สำหรับการแทรกข้อมูลแบนเนอร์
    $sql = "INSERT INTO banner (title, description, display_start_date, display_end_date, is_active) 
            VALUES (:title, :description, :display_start_date, :display_end_date, :is_active)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':title' => $title,
        ':description' => $description,
        ':display_start_date' => $start_date,
        ':display_end_date' => $end_date,
        ':is_active' => $is_active
    ]);

    // ดึง ID ของแบนเนอร์ที่เพิ่งถูกแทรก
    $id_banner = $pdo->lastInsertId();

    // สร้างไดเรกทอรีสำหรับบันทึกรูปภาพ
    $upload_dir = "../images/banner/" . $id_banner . "/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // อัพโหลดรูปภาพหลัก
    $banner_image = '';
    if (isset($_FILES['banner_image']) && $_FILES['banner_image']['error'] == UPLOAD_ERR_OK) {
        $banner_image = basename($_FILES['banner_image']['name']);
        $target_path = $upload_dir . $banner_image;
        if (!move_uploaded_file($_FILES['banner_image']['tmp_name'], $target_path)) {
            echo "เกิดข้อผิดพลาดในการอัปโหลดรูปภาพหลัก";
            exit;
        }
    }

    // จัดการกับรูปภาพรายละเอียด (หลายรูป)
    $additional_images = [];
    if (isset($_FILES['additional_image']) && is_array($_FILES['additional_image']['name'])) {
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
    }
    // แปลงที่อยู่ของรูปภาพเพิ่มเติมเป็นรูปแบบ serialize
    $additional_images_serialized = serialize($additional_images);

    // อัปเดตข้อมูลแบนเนอร์ด้วยชื่อไฟล์รูปภาพ
    $sql_update = "UPDATE banner SET banner_image = :banner_image, additional_image = :additional_image 
                   WHERE id_banner = :id_banner";
    $stmt_update = $pdo->prepare($sql_update);
    $stmt_update->execute([
        ':banner_image' => $banner_image,
        ':additional_image' => $additional_images_serialized,
        ':id_banner' => $id_banner
    ]);

    header("Location: list_banner.php");
    exit;
}
?>
