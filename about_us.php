<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เกี่ยวกับเรา</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
    .about-section {
        padding: 60px 0;
        background-color: #f8f9fa;
        padding-top: 120px;
    }

    .about-title {
        font-size: 36px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
    }

    .about-content {
        text-align: center;
        font-size: 18px;
        line-height: 1.8;
        color: #333;
    }

    .team-section {
        padding: 60px 0;
        background-color: #fff;
    }

    .team-title {
        font-size: 30px;
        font-weight: center;
        text-align: center;
        margin-bottom: 40px;
    }

    .team-card {
        text-align: center;
        margin-bottom: 30px;
    }

    .team-card img {
        border-radius: 50%;
        width: 150px;
        height: 150px;
    }

    .team-card h5 {
        font-size: 20px;
        margin-top: 15px;
    }

    .team-card p {
        color: #777;
    }

    .about-banner {
        padding-top: 70px;
    }

    .about-banner img {
        width: 100%;
    }

    .form-group-contact {
        padding: 3px;
        width: 100%;
    }

    .form-control-contact {
        width: 100%;
        border-radius: 8;

    }
    </style>
</head>
<?php include 'nav.php'; ?>

<body>



    <div class="about-banner">
        <img src="images/aboutus.jpg">
    </div>
    <div class="about-section">
        <div class="container">
            <h1 class="about-title">เกี่ยวกับเรา</h1>
            <p class="about-content">
                บริษัทของเราเริ่มต้นด้วยความมุ่งมั่นที่จะสร้างสรรค์นวัตกรรมใหม่ ๆ ในวงการธุรกิจ
                เราเป็นกลุ่มผู้เชี่ยวชาญที่มีประสบการณ์ยาวนานในหลากหลายด้าน เช่น การพัฒนาซอฟต์แวร์ การตลาด
                การจัดการโครงการ และการให้บริการลูกค้าด้วยความเป็นมืออาชีพ ตลอดหลายปีที่ผ่านมา
                เราได้สร้างผลิตภัณฑ์และบริการที่ตอบสนองต่อความต้องการของตลาดที่เปลี่ยนแปลงไปอย่างรวดเร็ว
                <br><br>
                เป้าหมายของเราคือการเป็นผู้นำในตลาดที่เราให้บริการ โดยเน้นการพัฒนาผลิตภัณฑ์ที่มีคุณภาพสูง
                และการให้บริการที่ยอดเยี่ยมเพื่อให้ลูกค้าได้รับประสบการณ์ที่ดีที่สุด นอกจากนี้
                เรายังให้ความสำคัญกับการเติบโตอย่างยั่งยืนและความรับผิดชอบต่อสังคม
                ด้วยการใช้ทรัพยากรอย่างมีประสิทธิภาพและลดผลกระทบต่อสิ่งแวดล้อม
                <br><br>
                การร่วมมือกับคู่ค้าและลูกค้าของเราเป็นสิ่งสำคัญที่สุดในการสร้างสรรค์สิ่งใหม่ ๆ ที่มีคุณค่า
                เรามีความยินดีที่ได้ทำงานร่วมกับบริษัทและองค์กรต่าง ๆ
                ทั่วโลกเพื่อสร้างเครือข่ายที่เข้มแข็งและส่งเสริมการพัฒนาธุรกิจในทุกระดับ บริษัทของเรามีความเชื่อว่า
                ความสำเร็จของเราไม่ได้มาจากเพียงการทำงานอย่างหนัก
                แต่ยังมาจากการสร้างความสัมพันธ์ที่แน่นแฟ้นกับลูกค้าและคู่ค้าทุกคน
            </p>
        </div>
    </div>

    <div class="team-section">
        <div class="container">
            <h2 class="team-title">ทีมงานของเรา</h2>
            <div class="row">
                <!-- Team Member 1 -->
                <div class="col-md-4 team-card">
                    <img src="images/cat.jpg" alt="สมาชิกทีม 1">
                    <h5>จอห์น โด</h5>
                    <p>ผู้ก่อตั้งและประธานกรรมการบริหาร</p>
                </div>
                <!-- Team Member 2 -->
                <div class="col-md-4 team-card">
                    <img src="images/cat.jpg" alt="สมาชิกทีม 2">
                    <h5>เจน สมิธ</h5>
                    <p>ประธานฝ่ายการตลาด</p>
                </div>
                <!-- Team Member 3 -->
                <div class="col-md-4 team-card">
                    <img src="images/cat.jpg" alt="สมาชิกทีม 3">
                    <h5>ไมเคิล ลี</h5>
                    <p>หัวหน้าฝ่ายพัฒนา</p>
                </div>
            </div>
        </div>
    </div>
    <div class="contact-section">
        <div class="container">
            <h2 class="contact-title">ติดต่อเรา</h2>
            <div class="row g-3">
                <!-- Left side: Contact Form -->
                <div class="col-sm-7">
                    <div class="contact-form">
                        <form action="contact_process.php" method="POST">
                            <div class="form-group-contact">
                                <h4>ชื่อ</h4>
                                <input type="text" class="form-control-contact" name="name" placeholder="ชื่อของคุณ"
                                    required>
                            </div>
                            <div class="form-group-contact">
                                <h4>Email</h4>
                                <input type="email" class="form-control-contact" name="email" placeholder="อีเมลของคุณ"
                                    required>
                            </div>
                            <div class="form-group-contact">
                                <h4>ข้อความของคุณ</h4>
                                <textarea class="form-control-contact" name="message" rows="5"
                                    placeholder="ข้อความของคุณ" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">ส่งข้อความ</button>
                        </form>

                    </div>
                </div>

                <!-- Right side: Contact Info -->
                <div class="col-sd">
                    <div class="contact-info">
                        <p><i class="fas fa-phone"></i> โทร: 123-456-7890</p>
                        <p><i class="fas fa-envelope"></i> อีเมล: email@email.com</p>
                        <p><i class="fas fa-map-marker-alt"></i> ที่อยู่: 123 ถนนธุรกิจ กรุงเทพมหานคร, ประเทศไทย</p>
                        <p><i class="fab fa-facebook-f"></i> facebook: facebook</p>
                        <p><i class="fab fa-tiktok"></i> tiktok: tiktok</p>
                        <p><i class="fab fa-youtube"></i> youtube: youtube</p>
                        <p><i class="fab fa-instagram"></i> instagram: instagram</p>
                    </div>
                </div>
                <div class="col-sd">
                <iframe src="https://www.google.com/maps/embed?pb=YOUR_GOOGLE_MAP_EMBED_CODE" >
    </iframe>
                </div>
            </div>
        </div>
    </div>




    <div class="copyright_section">
        <?php include 'footer.php'; ?>
    </div>

    <!-- Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>