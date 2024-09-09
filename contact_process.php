<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // เก็บข้อมูลจากฟอร์ม
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // ตรวจสอบการป้อนข้อมูล
    if (!empty($name) && !empty($email) && !empty($message) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // กำหนดปลายทางอีเมล
        $to = "panudech@happympm.com"; // เปลี่ยนที่อยู่อีเมลของคุณ
        $subject = "ข้อความใหม่จาก: $name";

        // สร้างเนื้อหาอีเมล
        $body = "
        <html>
        <head>
            <title>ข้อความจากแบบฟอร์มติดต่อ</title>
        </head>
        <body>
            <h2>รายละเอียดการติดต่อ</h2>
            <p><strong>ชื่อ:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>ข้อความ:</strong></p>
            <p>$message</p>
        </body>
        </html>";

        // กำหนดส่วนหัวของอีเมล
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: <$email>" . "\r\n";

        // ส่งอีเมล
        if (mail($to, $subject, $body, $headers)) {
            echo "ส่งข้อความสำเร็จ!";
        } else {
            echo "มีปัญหาในการส่งข้อความ กรุณาลองใหม่อีกครั้ง";
        }
    } else {
        echo "กรุณากรอกข้อมูลให้ครบถ้วนและถูกต้อง";
    }
} else {
    echo "ไม่พบการร้องขอจากฟอร์ม";
}
?>
