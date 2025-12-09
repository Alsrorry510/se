<?php
include "db.php";
include "functions.php";

if (!logged()) redirect("login.php");

$id = intval($_GET['id'] ?? 0);
$uid = intval($_SESSION['user']['id']);

// جلب البلاغ
$res = mysqli_query($mysqli, "SELECT * FROM reports WHERE id=$id AND user_id=$uid LIMIT 1");
if (mysqli_num_rows($res) == 0) {
    redirect("my_reports.php");
}
$report = mysqli_fetch_assoc($res);

$msg = "";

// عند حفظ التعديل
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $type = clean($_POST['type'] ?? '');
    $category = clean($_POST['category'] ?? '');
    $custom_category = clean($_POST['custom_category'] ?? '');
    $title = clean($_POST['title'] ?? '');
    $location = clean($_POST['location'] ?? '');
    $date_report = clean($_POST['date_report'] ?? '');
    $description = clean($_POST['description'] ?? '');
    $phone = clean($_POST['phone'] ?? '');

    // لو اختار "آخر"
    if ($category === "other" && !empty($custom_category)) {
        $category = $custom_category;
    }

    // رفع صورة جديدة إن وجدت
    $final_image = $report['image'];
    if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] == 0) {
        // حذف القديمة
        if (!empty($report['image']) && file_exists("uploads/" . $report['image'])) {
            @unlink("uploads/" . $report['image']);
        }
        $final_image = upload_img($_FILES['image']);
    }

    if (empty($type) || empty($category) || empty($location)) {
        $msg = "يرجى ملء الحقول المطلوبة";
    } else {

        // تأمين البيانات
        $type_e = mysqli_real_escape_string($mysqli, $type);
        $cat_e  = mysqli_real_escape_string($mysqli, $category);
        $title_e= mysqli_real_escape_string($mysqli, $title);
        $loc_e  = mysqli_real_escape_string($mysqli, $location);
        $date_e = mysqli_real_escape_string($mysqli, $date_report);
        $desc_e = mysqli_real_escape_string($mysqli, $description);
        $phone_e= mysqli_real_escape_string($mysqli, $phone);
        $img_e  = mysqli_real_escape_string($mysqli, $final_image);

        // تحديث البيانات
        $sql = "UPDATE reports SET
                    title='$title_e',
                    `type`='$type_e',
                    category='$cat_e',
                    location='$loc_e',
                    date_report='$date_e',
                    description='$desc_e',
                    phone='$phone_e',
                    image='$img_e'
                WHERE id=$id AND user_id=$uid";

        if (mysqli_query($mysqli, $sql)) {
            redirect("my_reports.php");
        } else {
            $msg = "خطأ أثناء التعديل: " . mysqli_error($mysqli);
        }
    }
}

include "header.php";
?>

<h3 class="mb-3">تعديل البلاغ</h3>

<?php if($msg): ?>
<div class="alert alert-danger"><?= $msg ?></div>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data" class="card p-3">

  <div class="row g-2 mb-3">

    <div class="col">
      <label>نوع البلاغ</label>
      <select name="type" class="form-select">
        <option value="mfhwd" <?= ($report['type']=='mfhwd')?'selected':''; ?>>مفقود</option>
        <option value="mwgwd" <?= ($report['type']=='mwgwd')?'selected':''; ?>>موجود</option>
      </select>
    </div>

    <div class="col">
      <label>الفئة</label>

      <?php
        // إذا كانت الفئة ليست من القائمة الأساسية → تعتبر مخصصة
        $basic = ["ذهب","مفتاح","حقيبة","فلوس","محفظة","بطاقة"];
        $is_custom = !in_array($report['category'], $basic);
      ?>

      <select id="categorySelect" name="category" class="form-select" required>
        <?php foreach($basic as $c): ?>
          <option value="<?= $c ?>" <?= ($report['category']==$c)?'selected':''; ?>><?= $c ?></option>
        <?php endforeach; ?>

        <option value="other" <?= $is_custom?'selected':''; ?>>آخر (اكتب بنفسك)</option>
      </select>

      <input type="text" 
             id="customCategory" 
             name="custom_category"
             class="form-control mt-2"
             placeholder="اكتب الفئة"
             value="<?= $is_custom ? htmlspecialchars($report['category']) : '' ?>"
             style="display: <?= $is_custom ? 'block' : 'none' ?>;">
    </div>

  </div>

  <div class="mb-2">
    <label>عنوان البلاغ</label>
    <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($report['title']) ?>">
  </div>

  <div class="mb-2">
    <label>الموقع</label>
    <input type="text" name="location" class="form-control" value="<?= htmlspecialchars($report['location']) ?>" required>
  </div>

  <div class="mb-2">
    <label>تاريخ البلاغ</label>
    <input type="date" name="date_report" class="form-control" value="<?= htmlspecialchars($report['date_report']) ?>" required>
  </div>

  <div class="mb-2">
    <label>رقم الهاتف</label>
    <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($report['phone']) ?>">
  </div>

  <div class="mb-2">
    <label>الوصف</label>
    <textarea name="description" class="form-control" rows="4"><?= htmlspecialchars($report['description']) ?></textarea>
  </div>

  <div class="mb-2">
    <label>الصورة الحالية</label><br>

    <?php 
      $img = (!empty($report['image']) && file_exists("uploads/".$report['image'])) 
              ? "uploads/".$report['image'] 
              : "assets/noimg.png"; 
    ?>

    <img src="<?= $img ?>" width="150" class="rounded mb-2">

    <input type="file" name="image" class="form-control">
  </div>

  <button class="btn btn-primary mt-3">حفظ التعديل</button>

</form>

<?php include "footer.php"; ?>

<!-- JavaScript لإظهار/إخفاء حقل الفئة -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    let select = document.getElementById('categorySelect');
    let custom = document.getElementById('customCategory');

    function toggleCustom() {
        if (select.value === 'other') {
            custom.style.display = 'block';
            custom.required = true;
        } else {
            custom.style.display = 'none';
            custom.required = false;
        }
    }

    select.addEventListener('change', toggleCustom);
});
</script>
