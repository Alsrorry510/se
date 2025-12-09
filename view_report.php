<?php
include "db.php";
include "functions.php";
include "header.php";

$id = intval($_GET['id'] ?? 0);

// جلب البلاغ + بيانات صاحب البلاغ
$sql = "SELECT r.*, u.name 
        FROM reports r 
        JOIN users u ON r.user_id = u.id 
        WHERE r.id = $id LIMIT 1";

$res = mysqli_query($mysqli, $sql);
$report = mysqli_fetch_assoc($res);

if (!$report) {
    echo "<div class='alert alert-warning'>البلاغ غير موجود</div>";
    include "footer.php";
    exit;
}

// تجهيز الصورة
$image = (!empty($report['image']) && file_exists("uploads/".$report['image']))
        ? "uploads/".$report['image']
        : "assets/noimg.png";
?>

<style>
/* تصميم الصفحة */
.report-card {
    background: #ffffffb7;
    border-radius: 16px;
    padding: 20px;
    box-shadow: 0 4px 14px rgba(0,0,0,0.1);
}

/* الصورة مربعة */
.report-image {
    width: 100%;
    max-width: 330px;
    height: 330px;
    border-radius: 14px;
    object-fit: cover;
    display: block;
    margin: auto;
    box-shadow: 0 3px 12px rgba(0,0,0,0.1);
}

/* عنوان البلاغ */
.report-title {
    font-weight: bold;
    font-size: 26px;
}

/* الصف */
.report-info {
    margin-bottom: 12px;
    padding: 12px;
    border-radius: 12px;
    background: #f7f8fa;
    font-size: 17px;
}

body.dark .report-card { background: #1f1f1f; }
body.dark .report-info { background: #252a31; color: #ddd; }
</style>

<div class="report-card">

  
    <div class="text-center mb-4">
        <img src="<?= $image ?>" class="report-image">
    </div>

    <!-- عنوان -->
    <h2 class="report-title text-center mb-4">
        <?= htmlspecialchars($report['title'] ?: $report['category']) ?>
    </h2>

    <!-- تفاصيل البلاغ -->
    <div class="report-info">
        <strong>نوع البلاغ:</strong>
        <?= ($report['type'] == 'mfhwd') ? "مفقود" : "موجود" ?>
    </div>

    <div class="report-info">
        <strong>الفئة:</strong>
        <?= htmlspecialchars($report['category']) ?>
    </div>

    <div class="report-info">
        <strong>الموقع:</strong>
        <?= htmlspecialchars($report['location']) ?>
    </div>

    <div class="report-info">
        <strong>تاريخ البلاغ:</strong>
        <?= htmlspecialchars($report['date_report']) ?>
    </div>

    <div class="report-info">
        <strong>وصف البلاغ:</strong><br>
        <?= nl2br(htmlspecialchars($report['description'])) ?>
    </div>

    <div class="report-info">
        <strong>رقم التواصل:</strong>
        <?= htmlspecialchars($report['phone']) ?>
    </div>

    <div class="report-info">
        <strong>صاحب البلاغ:</strong>
        <?= htmlspecialchars($report['name']) ?>
    </div>

</div>

<?php include "footer.php"; ?>
