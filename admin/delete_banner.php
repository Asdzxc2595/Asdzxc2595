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
    $sql = "DELETE FROM banner WHERE id_banner = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    // Redirect หลังจากลบ
    header("Location: list_banner.php");
    exit;
}
?>
