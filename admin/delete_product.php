<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../login.php");
    exit;
}
require("../db_connect.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // ลบข้อมูลจากฐานข้อมูล
    $sql = "DELETE FROM product WHERE id_product = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    // Redirect หลังจากลบ
    header("Location: product_list.php");
    exit;
}
?>
