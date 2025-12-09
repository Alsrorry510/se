<?php
include "db.php";
include "functions.php";
if (!logged()) redirect("login.php");
include "header.php";

$uid = intval($_SESSION['user']['id']);
$res = mysqli_query($mysqli, "SELECT * FROM reports WHERE user_id=$uid ORDER BY created_at DESC");
?>
<h4>بلاغاتي</h4>
<div class="row mt-3">
  <?php if (mysqli_num_rows($res) > 0): while($r = mysqli_fetch_assoc($res)): ?>
    <div class="col-md-4 mb-3">
      <div class="card">
        <?php $img = (!empty($r['image']) && file_exists('uploads/'.$r['image'])) ? 'uploads/'.$r['image'] : 'assets/noimg.png'; ?>
        <img src="<?php echo $img; ?>" class="card-img-top">
        <div class="card-body">
          <h5><?php echo htmlspecialchars($r['title'] ?: $r['category']); ?></h5>
          <p class="small text-muted"><?php echo htmlspecialchars(mb_substr($r['description'],0,80)); ?></p>
          <a href="view_report.php?id=<?php echo $r['id']; ?>" class="btn btn-sm btn-primary">عرض</a>
          <a href="edit_report.php?id=<?php echo $r['id']; ?>" class="btn btn-sm btn-secondary">تعديل</a>
          <a href="delete_report.php?id=<?php echo $r['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</a>
        </div>
      </div>
    </div>
  <?php endwhile; else: ?>
    <div class="col-12"><div class="empty-msg">لم تقم بنشر أي بلاغات بعد.</div></div>
  <?php endif; ?>
</div>
<?php include "footer.php"; ?>
