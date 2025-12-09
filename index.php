<?php
include "db.php";
include "functions.php";

// إذا المستخدم مسجل دخول → عرض الصفحة الرئيسية
$logged = logged();

include "header.php";
?>

<style>
/* صندوق رئيسي */
.hero-box {
    background: linear-gradient(135deg, #4d79ff, #6a99ff);
    color: white;
    padding: 40px;
    border-radius: 18px;
    box-shadow: 0 4px 14px rgba(0,0,0,0.15);
    text-align: center;
}

/* صندوق خدمة */
.home-card {
    background: #fff;
    padding: 25px;
    border-radius: 18px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.10);
    text-align: center;
    transition: 0.3s;
    cursor: pointer;
}
.home-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.15);
}
.home-card h3 { margin-top: 15px; font-weight: bold; }
.home-card p { color: #666; }

/* إحصائيات */
.stats-box {
    background: #fff;
    padding: 22px;
    border-radius: 16px;
    text-align: center;
    box-shadow: 0 3px 10px rgba(0,0,0,0.08);
}
.stats-number {
    font-size: 32px;
    font-weight: bold;
    color: #3a69ff;
}
.stats-title {
    font-size: 18px;
    color: #444;
}
</style>

<div class="container mt-4">

    <!-- صندوق ترحيب -->
    <div class="hero-box mb-4">
        <h1>مرحباً بك في منصة TaizLost</h1>
        <p style="font-size:18px;margin-top:10px;">
            منصة تساعدك على الإبلاغ عن المفقودات والموجودات في مدينة تعز بسهولة.
        </p>

        <?php if(!$logged): ?>
            <div class="mt-3">
                <a href="login.php" class="btn btn-light">تسجيل الدخول</a>
                <a href="register.php" class="btn btn-dark">إنشاء حساب</a>
            </div>
        <?php endif; ?>
    </div>


    <!-- صناديق الخدمات -->
    <div class="row g-4">

        <div class="col-md-4">
            <div class="home-card" onclick="window.location='guide.php'">
                <img src="assets/guide.png" width="70">
                <h3>إرشاد المستخدم</h3>
                <p>شرح نظام TaizLost وكيفية استخدامه.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="home-card" onclick="window.location='about.php'">
                <img src="assets/about.png" width="70">
                <h3>ماذا تقدم المنصة؟</h3>
                <p>تعرف على خدمات المنصة بالتفصيل.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="home-card" onclick="window.location='latest_reports.php'">
                <img src="assets/latest.png" width="70">
                <h3>آخر البلاغات</h3>
                <p>عرض أحدث البلاغات المضافة للمنصة.</p>
            </div>
        </div>

        

        <div class="col-md-4 offset-md-4">
               <div class="home-card" onclick="window.location='contact.php'">
                   <img src="assets/contact.png" width="80">
                   <h3>تواصل معنا</h3>
                   <p>للملاحظات أو تقديم بلاغ دعم.</p>
            </div>
        </div>


    </div>


    <!-- الإحصائيات -->
    <hr class="my-4">

    <h3 class="mb-3">إحصائيات المنصة</h3>

    <?php
    $users = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT COUNT(*) AS c FROM users"))['c'];
    $reports = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT COUNT(*) AS c FROM reports"))['c'];
    $today = date("Y-m-d");
    $reports_today = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT COUNT(*) AS c FROM reports WHERE date_report='$today'"))['c'];
    ?>

    <div class="row g-3">

        <div class="col-md-4">
            <div class="stats-box">
                <div class="stats-number"><?= $users ?></div>
                <div class="stats-title">عدد المستخدمين</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stats-box">
                <div class="stats-number"><?= $reports ?></div>
                <div class="stats-title">إجمالي البلاغات</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stats-box">
                <div class="stats-number"><?= $reports_today ?></div>
                <div class="stats-title">بلاغات اليوم</div>
            </div>
        </div>

    </div>

</div>

<?php include "footer.php"; ?>
