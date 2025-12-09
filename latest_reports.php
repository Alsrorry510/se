<?php
include "db.php";
include "functions.php";
include "header.php";

// جلب آخر 9 بلاغات
$res = mysqli_query($mysqli, "SELECT * FROM reports ORDER BY id DESC LIMIT 9");
?>

<style>
.grid-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
    margin-top: 25px;
}

.report-box {
    background: #fff;
    padding: 15px;
    border-radius: 18px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.10);
    text-align: center;
    transition: 0.3s;
}

.report-box:hover {
    transform: translateY(-6px);
    box-shadow: 0 6px 18px rgba(0,0,0,0.15);
}

.report-img {
    width: 100%;
    height: 200px;
    border-radius: 14px;
    object-fit: cover;
    margin-bottom: 15px;
}

.report-title {
    font-size: 19px;
    font-weight: bold;
    margin-bottom: 6px;
}

.report-cat,
.report-date {
    font-size: 15px;
    color: #555;
}

body.dark .report-box { background: #1f1f1f; color: #eee; }
body.dark .report-cat,
body.dark .report-date { color: #ccc; }
</style>

<div class="container mt-4">

    <h2 class="mb-3">آخر البلاغات</h2>

    <div class="grid-container">

        <?php while($r = mysqli_fetch_assoc($res)): ?>

            <?php
                $img = (!empty($r['image']) && file_exists("uploads/".$r['image']))
                        ? "uploads/".$r['image']
                        : "assets/noimg.png";
            ?>

            <div class="report-box">

                <!-- صورة -->
                <img src="<?= $img ?>" class="report-img">

                <!-- عنوان -->
                <div class="report-title">
                    <?= htmlspecialchars($r['title'] ?: $r['category']) ?>
                </div>

                <!-- الفئة -->
                <div class="report-cat">
                    <strong>الفئة:</strong> <?= htmlspecialchars($r['category']) ?>
                </div>

                <!-- التاريخ -->
                <div class="report-date">
                    <strong>التاريخ:</strong> <?= htmlspecialchars($r['date_report']) ?>
                </div>

                <a href="view_report.php?id=<?= $r['id'] ?>" 
                   class="btn btn-primary btn-sm mt-2">
                    عرض التفاصيل
                </a>

            </div>

        <?php endwhile; ?>

    </div>

</div>

<?php include "footer.php"; ?>
