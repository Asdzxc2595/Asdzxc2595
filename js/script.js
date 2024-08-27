document.addEventListener("DOMContentLoaded", function() {
    // ฟังก์ชันที่เพิ่มคลาส 'show' เมื่อส่วนถูกสังเกตเห็น
    function handleIntersection(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('show');
            } else {
                entry.target.classList.remove('show');
            }
        });
    }

    // สร้าง Intersection Observer
    const observer = new IntersectionObserver(handleIntersection, {
        threshold: 0.5 // ปรับค่า threshold ตามความต้องการ
    });

    // เลือกส่วนที่ต้องการใช้อนิเมชัน
    const productSections = document.querySelectorAll('.card-item-product');
    
    // เริ่มการสังเกต
    productSections.forEach(section => {
        observer.observe(section);
    });
});
function show() {
    var cards = document.querySelectorAll('.card-item-product');
    cards.forEach(function(card) {
        card.classList.add('show');
    });
}

document.addEventListener("DOMContentLoaded", function() {
    show(); // เรียกใช้งานฟังก์ชัน show เมื่อโหลดหน้า

    // ฟังก์ชันที่เพิ่มคลาส 'show' เมื่อส่วนถูกสังเกตเห็น
    function handleIntersection(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('show');
            } else {
                entry.target.classList.remove('show');
            }
        });
    }

    // สร้าง Intersection Observer
    const observer = new IntersectionObserver(handleIntersection, {
        threshold: 0.5 // ปรับค่า threshold ตามความต้องการ
    });

    // เลือกส่วนที่ต้องการใช้อนิเมชัน
    const productSections = document.querySelectorAll('.card-item-product');
    
    // เริ่มการสังเกต
    productSections.forEach(section => {
        observer.observe(section);
    });
});
window.addEventListener('scroll', function() {
    const parallaxElements = document.querySelectorAll('.parallax-bg');

    parallaxElements.forEach(function(element) {
        let scrollPosition = window.pageYOffset;
        element.style.transform = 'translateY(' + scrollPosition * 0.5 + 'px)';
    });
});
