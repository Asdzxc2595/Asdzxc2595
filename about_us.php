<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เกี่ยวกับเรา</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <style>
        .about-section {
            padding: 60px 0;
            background-color: #f8f9fa;
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
            font-weight: bold;
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
    </style>
</head>

<body>
    <!-- Include Navigation -->
    <?php include 'nav.php'; ?>

    <!-- About Us Section -->
    <div class="about-section">
        <div class="container">
            <h1 class="about-title">เกี่ยวกับเรา</h1>
            <p class="about-content">
                บริษัทของเราเริ่มต้นด้วยความมุ่งมั่นที่จะสร้างสรรค์นวัตกรรมใหม่ ๆ ในวงการธุรกิจ เราเป็นกลุ่มผู้เชี่ยวชาญที่มีประสบการณ์ยาวนานในหลากหลายด้าน เช่น การพัฒนาซอฟต์แวร์ การตลาด การจัดการโครงการ และการให้บริการลูกค้าด้วยความเป็นมืออาชีพ ตลอดหลายปีที่ผ่านมา เราได้สร้างผลิตภัณฑ์และบริการที่ตอบสนองต่อความต้องการของตลาดที่เปลี่ยนแปลงไปอย่างรวดเร็ว
                <br><br>
                เป้าหมายของเราคือการเป็นผู้นำในตลาดที่เราให้บริการ โดยเน้นการพัฒนาผลิตภัณฑ์ที่มีคุณภาพสูง และการให้บริการที่ยอดเยี่ยมเพื่อให้ลูกค้าได้รับประสบการณ์ที่ดีที่สุด นอกจากนี้ เรายังให้ความสำคัญกับการเติบโตอย่างยั่งยืนและความรับผิดชอบต่อสังคม ด้วยการใช้ทรัพยากรอย่างมีประสิทธิภาพและลดผลกระทบต่อสิ่งแวดล้อม
                <br><br>
                การร่วมมือกับคู่ค้าและลูกค้าของเราเป็นสิ่งสำคัญที่สุดในการสร้างสรรค์สิ่งใหม่ ๆ ที่มีคุณค่า เรามีความยินดีที่ได้ทำงานร่วมกับบริษัทและองค์กรต่าง ๆ ทั่วโลกเพื่อสร้างเครือข่ายที่เข้มแข็งและส่งเสริมการพัฒนาธุรกิจในทุกระดับ บริษัทของเรามีความเชื่อว่า ความสำเร็จของเราไม่ได้มาจากเพียงการทำงานอย่างหนัก แต่ยังมาจากการสร้างความสัมพันธ์ที่แน่นแฟ้นกับลูกค้าและคู่ค้าทุกคน
            </p>
        </div>
    </div>

    <!-- Team Section -->
    <div class="team-section">
        <div class="container">
            <h2 class="team-title">ทีมงานของเรา</h2>
            <div class="row">
                <!-- Team Member 1 -->
                <div class="col-md-4 team-card">
                    <img src="images/team1.jpg" alt="สมาชิกทีม 1">
                    <h5>จอห์น โด</h5>
                    <p>ผู้ก่อตั้งและประธานกรรมการบริหาร</p>
                </div>
                <!-- Team Member 2 -->
                <div class="col-md-4 team-card">
                    <img src="images/team2.jpg" alt="สมาชิกทีม 2">
                    <h5>เจน สมิธ</h5>
                    <p>ประธานฝ่ายการตลาด</p>
                </div>
                <!-- Team Member 3 -->
                <div class="col-md-4 team-card">
                    <img src="images/team3.jpg" alt="สมาชิกทีม 3">
                    <h5>ไมเคิล ลี</h5>
                    <p>หัวหน้าฝ่ายพัฒนา</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Footer -->
    <?php include 'footer.php'; ?>

    <!-- Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
