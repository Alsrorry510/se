<?php
include "header.php";
?>

<style>
.contact-box {
    background: #fff;
    padding: 30px;
    border-radius: 18px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    margin-top: 25px;
    direction: rtl;          /* الكتابة من اليمين */
    text-align: right;       /* المحاذاة لليمين */
}

.contact-title {
    font-size: 30px;
    font-weight: bold;
    margin-bottom: 15px;
}

.contact-text {
    font-size: 18px;
    line-height: 2;
    color: #444;
    margin-bottom: 15px;
}

.contact-item {
    font-size: 18px;
    margin-bottom: 12px;
    line-height: 1.8;
}

.contact-item strong {
    color: #3b61ff;
}

body.dark .contact-box {
    background: #1f1f1f;
    color: #eee;
}
</style>

<div class="container">

    <div class="contact-box">
        
        <h2 class="contact-title">تواصل معنا</h2>

        <p class="contact-text">
            يسعدنا تواصلك معنا لأي استفسار، أو مشكلة، أو اقتراح لتحسين منصة
            <strong>TaizLost</strong>.
        </p>

        <div class="contact-item">
            <strong>📞 الهاتف:</strong> 777000000
        </div>

        <div class="contact-item">
            <strong>💬 واتساب:</strong> 777000000
        </div>

        <div class="contact-item">
            <strong>📧 البريد الإلكتروني:</strong> support@taizlost.com
        </div>

        <p class="contact-text">
            فريقنا سيقوم بالرد عليك في أقرب وقت ممكن ❤️
        </p>

    </div>

</div>

<?php
include "footer.php";
?>
