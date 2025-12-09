<?php
include "db.php";
include "functions.php";
include "header.php";

// استلام كلمة البحث
$q = clean($_GET['q'] ?? '');

// SQL: البحث في الأشياء الموجودة فقط
$sql = "
    SELECT * FROM reports
    WHERE type = 'mwgwd'
    AND (
        category LIKE '%$q%'
        OR description LIKE '%$q%'
    )
    ORDER BY id DESC
    LIMIT 30
";

$res = mysqli_query($mysqli, $sql);
?>

<style>
.search-box {
    background: #fff;
    padding: 20px;
    border-radius: 14px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    margin-bottom: 25px;
    direction: rtl;
    text-align: right;
}

.grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
}

.result-card {
    background: #fff;
    padding: 15px;
    border-radius: 14px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    text-align: center;
    direction: rtl;
}

.result-img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 12px;
    margin-bottom: 10px;
}

.no-result {
    background: #fff;
    padding: 20px;
    border-radius: 14px;
    text-align: center;
    font-size: 20px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}
</style>

<div class="container mt-4">

    <h2 class="mb-3" style="direction:rtl; text-align:right;">البحث في الأشياء الموجودة</h2>

    <!-- صندوق البحث -->
    <div class="search-box">
        <form method="GET">
            <label>اكتب الفئة أو وصف الشيء:</label>
            <input type="text" name="q" value="<?= htmlspecialchars($q) ?>"
                   class="form-control"
                   placeholder="مثال: مفتاح – ذهب – شنطة – هاتف">
            <button class="btn btn-primary mt-2">بحث</button>
        </form>
    </div>

    <?php if ($q != ""): ?>

        <?php if (mysqli_num_rows($res) == 0): ?>

            <!-- لا توجد نتائج -->
            <div class="no-result">
                لا توجد نتائج مطابقة لبحثك 😢
            </div>

        <?php else: ?>

            <div class="grid">

                <?php while($r = mysqli_fetch_assoc($res)): ?>

                    <?php
                        // الصورة
                        if (!empty($r['image']) && file_exists("uploads/" . $r['image'])) {
                            $img = "uploads/" . $r['image'];
                        } else {
                            $img = "assets/noimg.png";
                        }
                    ?>

                    <div class="result-card">

                        <img src="<?= $img ?>" class="result-img">

                        <h4><?= htmlspecialchars($r['title'] ?: $r['category']) ?></h4>

                        <p><strong>الفئة:</strong> <?= htmlspecialchars($r['category']) ?></p>

                        <p><strong>التاريخ:</strong> <?= htmlspecialchars($r['date_report']) ?></p>

                        <a href="view_report.php?id=<?= $r['id'] ?>" 
                           class="btn btn-success btn-sm">
                           عرض التفاصيل
                        </a>

                    </div>

                <?php endwhile; ?>

            </div>

        <?php endif; ?>

    <?php endif; ?>

</div>

<?php include "footer.php"; ?>
