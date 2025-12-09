<?php
include "db.php";
include "functions.php";

if (!logged()) redirect("login.php");

$msg = "";

// المعالجة
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // استلام البيانات
    $type = clean($_POST['type'] ?? '');
    $category = clean($_POST['category'] ?? '');
    $custom_category = clean($_POST['custom_category'] ?? '');
    $title = clean($_POST['title'] ?? '');
    $location = clean($_POST['location'] ?? '');
    $date_report = clean($_POST['date_report'] ?? '');
    $description = clean($_POST['description'] ?? '');
    $phone = clean($_POST['phone'] ?? '');

    // إذا الفئة = other استخدم الحقل النصي
    if ($category === "other" && !empty($custom_category)) {
        $category = $custom_category;
    }

    // رفع صورة
    $image = "";
    if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] == 0) {
        $image = upload_img($_FILES['image']);
    }

    // تحقق الحقول
    if (empty($type) || empty($category) || empty($location) || empty($date_report)) {
        $msg = "الرجاء ملء الحقول المطلوبة";
    } else {

        $uid = intval($_SESSION['user']['id']);

        // تأمين البيانات قبل إدخالها
        $type_e = mysqli_real_escape_string($mysqli, $type);
        $cat_e  = mysqli_real_escape_string($mysqli, $category);
        $title_e= mysqli_real_escape_string($mysqli, $title);
        $loc_e  = mysqli_real_escape_string($mysqli, $location);
        $date_e = mysqli_real_escape_string($mysqli, $date_report);
        $desc_e = mysqli_real_escape_string($mysqli, $description);
        $phone_e= mysqli_real_escape_string($mysqli, $phone);
        $img_e  = mysqli_real_escape_string($mysqli, $image);

        // حفظ البلاغ
        $sql = "INSERT INTO reports 
                (user_id, title, `type`, category, location, date_report, description, phone, image)
                VALUES 
                ($uid,'$title_e','$type_e','$cat_e','$loc_e','$date_e','$desc_e','$phone_e','$img_e')";

        if (mysqli_query($mysqli, $sql)) {
            redirect("my_reports.php");
        } else {
            $msg = "خطأ أثناء الحفظ: " . mysqli_error($mysqli);
        }
    }
}

include "header.php";
?>

<h3 class="mb-3">إضافة بلاغ جديد</h3>

<?php if($msg): ?>
<div class="alert alert-danger"><?= $msg ?></div>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data" class="card p-3">

  <div class="row g-2 mb-3">
    <div class="col">
      <label>نوع البلاغ</label>
      <select name="type" class="form-select" required>
        <option value="">اختر</option>
        <option value="mfhwd">مفقود</option>
        <option value="mwgwd">موجود</option>
      </select>
    </div>

    <div class="col">
      <label>الفئة</label>
      <select id="categorySelect" name="category" class="form-select" required>
        <option value="">اختر الفئة</option>
        <option value="ذهب">ذهب</option>
        <option value="مفتاح">مفتاح</option>
        <option value="حقيبة">حقيبة</option>
        <option value="فلوس">فلوس</option>
        <option value="محفظة">محفظة</option>
        <option value="بطاقة">بطاقة</option>

        <!-- الخيار الذي يتيح النص -->
        <option value="other">آخر (اكتب بنفسك)</option>
      </select>

      <!-- الحقل النصي المخفي -->
      <input type="text" 
             id="customCategory" 
             name="custom_category" 
             class="form-control mt-2" 
             placeholder="اكتب الفئة هنا مثل: سماعة – ساعة – جوال..."
             style="display:none;">
    </div>
  </div>

  <div class="mb-2">
    <label>عنوان البلاغ</label>
    <input type="text" name="title" class="form-control">
  </div>

  <div class="mb-2">
    <label>الموقع</label>
    <input type="text" name="location" class="form-control" required>
  </div>

  <div class="mb-2">
    <label>تاريخ البلاغ</label>
    <input type="date" name="date_report" class="form-control" required>
  </div>

  <div class="mb-2">
    <label>رقم الهاتف</label>
    <input type="text" name="phone" class="form-control">
  </div>

  <div class="mb-2">
    <label>الوصف</label>
    <textarea name="description" class="form-control" rows="4"></textarea>
  </div>

  <div class="mb-2">
    <label>صورة (اختياري)</label>
    <input type="file" name="image" class="form-control">
  </div>

  <button class="btn btn-success mt-3">نشر البلاغ</button>

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
