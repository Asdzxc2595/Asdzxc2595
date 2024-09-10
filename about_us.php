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
    .contact-info {
        display: flex;
        flex-wrap: wrap;
        /* ให้รายการใน contact-info ห่อเมื่อเกินพื้นที่ */
        justify-content: space-around;
        /* กระจายช่องว่างระหว่างรายการ */
        gap: 20px;
        /* เพิ่มระยะห่างระหว่างแต่ละรายการ */
    }

    .contact-info p {
        width: 30%;
        /* กำหนดความกว้างของแต่ละรายการให้ประมาณ 1 ใน 3 ของแถว */
        text-align: left;
        /* จัดข้อความให้อยู่ตรงกลาง */
    }

    .contact-info {
        display: flex;
        flex-direction: column;
        /* เรียงข้อมูลในแนวตั้ง */
        gap: 15px;
        /* เพิ่มระยะห่างระหว่างข้อมูลแต่ละบรรทัด */
    }

    .contact-info p {
        display: flex;
        align-items: left;
        /* จัดไอคอนและข้อความให้อยู่ในแนวเดียวกัน */
        font-size: 14px;
        margin: 0;
    }

    .contact-info p i {
        margin-right: 10px;
        /* เว้นช่องว่างระหว่างไอคอนและข้อความ */
    }

    .contact-info a {
        text-decoration: none;
        color: inherit;
        /* ใช้สีของข้อความปัจจุบัน */
    }

    .contact-info a:hover {
        color: #007bff;
        /* เปลี่ยนสีเมื่อ hover */
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
            <p class="thai-distributed">
                บริษัท แฮ็ปปี้ เอ็มพีเอ็ม จำกัด ก่อตั้งขึ้นเมื่อวันที่ 10 มิถุนายน 2542 โดยมี คุณสุกิจ สัตย์เพริศพราย
                เป็นประธานและกรรมการผู้จัดการ
                โดยบริษัทก่อกำเนิดมาจากปณิธานอันมุ่งมั่นและแน่วแน่ของประธานกรรมการและคณะผู้บริหารที่ต้องการจะนำเสนอผลิตภัณฑ์ที่ดีและมีประโยชน์<br>
            </p>

            <p class="thai-distributed">
                ตลอดจนเจตนารมณ์ที่จะนำธุรกิจขายตรงในรูปแบบเครือข่ายที่มีประสิทธิภาพมาสู่ผู้คนในอาเซียน
                โดยทางบริษัทมีนโยบายมุ่งเน้นการทำธุรกิจในระยะยาวและมุ่งเน้นในการพัฒนาผลิตภัณฑ์ให้ดีและมีคุณภาพเป็นหลัก<br>
            </p>

            <p class="thai-distributed">การร่วมมือกับคู่ค้าและลูกค้าของเราเป็นสิ่งสำคัญที่สุดในการสร้างสรรค์สิ่งใหม่ ๆ
                ที่มีคุณค่า
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
                <div class="col-sm-6">
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
                <div class="col-md-3">
                    <div class="contact-info">
                        <p><i class="fas fa-phone"></i> โทร: 02-642-5425</p>
                        <p><i class="fas fa-envelope"></i> อีเมล: info@happympm.com</p>
                        <p><i class="fas fa-map-marker-alt"></i> ที่อยู่: โนเบิลเฮ้าส์พญาไท คอนโดมิเนียม 35/30 อาคาร ถ.
                            พญาไท แขวงถนนพญาไท เขตราชเทวี กรุงเทพมหานคร 10400</p>
                        <a href="https://www.facebook.com/happympmofficial/?_rdc=2&_rdr">
                            <p><i class="fab fa-facebook-f"></i> facebook: Happy MPM </p>
                        </a>
                        <a href="https://www.tiktok.com/@happympm.official">
                            <p><i class="fab fa-tiktok"></i> tiktok: happympm.official</p>
                        </a>
                        <a href="https://www.youtube.com/@happympmofficial/featured">
                            <p><i class="fab fa-youtube"></i> youtube: Happy MPM Official</p>
                        </a>
                        <a href="https://page.line.me/happympm?openQrModal=true">
                            <p><i class="fab fa-line"></i> LINE : @happympm</p>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4864.352046048093!2d100.53505!3d13.758695999999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29eb5e0814139%3A0xfa73f7aeb1dd7276!2zSGFwcHkgTVBNIOC5geC4ruC5h-C4m-C4m-C4teC5iSDguYDguK3guYfguKHguJ7guLXguYDguK3guYfguKEg4Liq4Liz4LiZ4Lix4LiB4LiH4Liy4LiZ4LmD4Lir4LiN4LmI!5e1!3m2!1sth!2sth!4v1725940736225!5m2!1sth!2sth"
                        width="auto" height="100%" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

            </div>
        </div>
    </div>
    <div class="copyright_section">
        <?php include 'footer.php'; ?>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>