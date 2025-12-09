<?php
include "header.php";
?>

<style>
.guide-box {
    background: #fff;
    padding: 30px;
    border-radius: 18px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    margin-top: 25px;
    direction: rtl;          /* الكتابة من اليمين */
    text-align: right;       /* محاذاة النص لليمين */
}

.guide-title {
    font-size: 30px;
    font-weight: bold;
    margin-bottom: 15px;
}

.guide-text {
    font-size: 18px;
    line-height: 2;
    color: #444;
    margin-bottom: 15px;
}

.guide-list li {
    font-size: 18px;
    line-height: 2;
    margin-bottom: 10px;
}

body.dark .guide-box {
    background: #1f1f1f;
    color: #eee;
}
</style>

<div class="container">

    <div class="guide-box">
        
        <h2 class="guide-title">إرشاد المستخدم</h2>

        <p class="guide-text">
            تهدف صفحة <strong>إرشاد المستخدم</strong> إلى مساعدتك في استخدام منصة
            <strong>TaizLost</strong> بالطريقة الصحيحة، سواء لإضافة بلاغ، أو البحث،
            أو التواصل مع أصحاب البلاغات.
        </p>

        <h3 class="guide-title" style="font-size:24px;">خطوات استخدام المنصة:</h3>

        <ul class="guide-list">

            <li><strong>١- إنشاء حساب جديد:</strong>  
                قم بإنشاء حساب باستخدام اسمك وبريدك وكلمة مرور، ليتم تسجيل دخولك لاحقاً.</li>

            <li><strong>٢- تسجيل الدخول:</strong>  
                بعد إنشاء الحساب، قم بتسجيل الدخول للوصول إلى جميع خدمات المنصة.</li>

            <li><strong>٣- إضافة بلاغ جديد:</strong>  
                اختر نوع البلاغ (مفقود / موجود)، ثم اختر الفئة، والموقع، والتاريخ، 
                واكتب وصف البلاغ وأرفق صورة إن وجدت، ثم انشر البلاغ.</li>

            <li><strong>٤- البحث عن البلاغات:</strong>  
                يمكنك البحث عن البلاغات من خلال نوع البلاغ، أو الفئة، أو المكان،
                لمعرفة إن كان أحدهم وجد غرضك.</li>

            <li><strong>٥- عرض تفاصيل البلاغ:</strong>  
                عند الضغط على أي بلاغ، تظهر صفحة كاملة تحتوي على الصورة،
                والفئة، والموقع، والتاريخ، والوصف، ورقم التواصل.</li>

            <li><strong>٦- التواصل مع صاحب البلاغ:</strong>  
                يمكنك الاتصال مباشرة بصاحب البلاغ في حال وجدت شيئًا يخصه أو تبحث عن شيء خاص بك.</li>

            <li><strong>٧- إدارة بلاغاتك:</strong>  
                من صفحة "بلاغاتي" تستطيع تعديل البلاغ أو حذفه في أي وقت.</li>

        </ul>

        <p class="guide-text">
            تم تصميم المنصة لتكون <strong>سهلة وبسيطة</strong> لجميع المستخدمين،
            وهدفها الأول هو <strong>مساعدة الناس على إيجاد مفقوداتهم</strong>.
        </p>

    </div>

</div>

<?php
include "footer.php";
?>
