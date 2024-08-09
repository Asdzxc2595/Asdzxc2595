<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "happy_product";

// สร้างการเชื่อมต่อ
$conn = new mysqli($id_product, $name_product, $img_product, $type_product,$dtaill_product,$dtaill_img_product,$dtaill_vdo_product,$date_product);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}
?>
