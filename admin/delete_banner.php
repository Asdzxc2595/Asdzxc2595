<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../login.php");
    exit;
}
require "../db_connect.php";

if (isset($_GET['id'])) {
    $id_banner = $_GET['id'];

    // Retrieve the banner information before deletion
    $sql = "SELECT banner_image, additional_image FROM banner WHERE id_banner = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_banner]);
    $banner = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($banner) {
        // Directory path for the banner images
        $upload_dir = "../images/banner/" . $id_banner . "/";

        // Delete main banner image
        if (!empty($banner['banner_image'])) {
            $banner_image_path = $upload_dir . $banner['banner_image'];
            if (file_exists($banner_image_path)) {
                unlink($banner_image_path);
            }
        }

        // Delete additional images
        if (!empty($banner['additional_image'])) {
            $additional_images = unserialize($banner['additional_image']);
            foreach ($additional_images as $image) {
                $additional_image_path = $upload_dir . $image;
                if (file_exists($additional_image_path)) {
                    unlink($additional_image_path);
                }
            }
        }

        // Remove the directory if empty
        if (is_dir($upload_dir) && count(glob($upload_dir . "*")) === 0) {
            rmdir($upload_dir);
        }

        // Delete record from the database
        $sql_delete = "DELETE FROM banner WHERE id_banner = ?";
        $stmt_delete = $pdo->prepare($sql_delete);
        $stmt_delete->execute([$id_banner]);
    }

    // Redirect after deletion
    header("Location: list_banner.php");
    exit;
}
?>
