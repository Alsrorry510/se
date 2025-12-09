<?php
include "header.php";
?>

<style>
.about-box {
    background: #fff;
    padding: 30px;
    border-radius: 18px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    margin-top: 25px;
    direction: rtl;          /* الكتابة من اليمين */
    text-align: right;       /* محاذاة النص لليمين */
}

.about-title {
    font-size: 30px;
    font-weight: bold;
    margin-bottom: 15px;
}

.about-text {
    font-size: 18px;
    line-height: 2;
    color: #444;
    margin-bottom: 15px;
}

.about-list li {
    font-size: 18px;
    line-height: 2;
    margin-bottom: 8px;
}

body.dark .about-box {
    background: #1f1f1f;
    color: #eee;
}
</style>

<div class="container">

    <div class="about-box">
        
        <h2 class="about-title">ماذا تقدم منصة TaizLost؟</h2>

        <p class="about-text">
            منصة <strong>TaizLost</strong> هي نظام يساعد سكان مدينة تعز على العثور على مفقوداتهم 
            أو تسليم الموجودات التي تم العثور عليها، وذلك من خلال مجموعة من الخدمات 
            التي تسهّل عملية البحث والتواصل بين المستخدمين.
        </p>

        <h3 class="about-title" style="font-size:24px; margin-bottom:10px;">خدمات المنصة:</h3>

        <ul class="about-list">
            <li>إضافة بلاغ عن شيء <strong>مفقود</strong>.</li>
            <li>إضافة بلاغ عن شيء <strong>موجود</strong>.</li>
            <li>عرض البلاغات المنشورة من جميع المستخدمين.</li>
            <li>البحث عن البلاغات حسب الفئة أو نوع البلاغ أو الموقع.</li>
            <li>عرض تفاصيل البلاغ كاملة مع الصور.</li>
            <li>التواصل مع صاحب البلاغ بسهولة عبر رقم الهاتف.</li>
            <li>إدارة بلاغاتك الخاصة (تعديل – حذف).</li>
            <li>واجهة مرتبة وسهلة الاستخدام لجميع الفئات.</li>
        </ul>

        <p class="about-text">
            تهدف المنصة إلى <strong>تسهيل العثور على المفقودات</strong> 
            وتعزيز التعاون بين الناس في المجتمع لمساعدة بعضهم البعض.
        </p>

    </div>

</div>

<?php
include "footer.php";
?>
