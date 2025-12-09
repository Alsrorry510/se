<?php
include "db.php";
include "functions.php";

if (logged()) redirect("index.php");

$msg = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $email = clean($_POST['email']);
    $pass  = clean($_POST['password']);

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$pass' LIMIT 1";
    $q = mysqli_query($mysqli, $sql);

    if (mysqli_num_rows($q) == 1){
        $_SESSION['user'] = mysqli_fetch_assoc($q);
        redirect("index.php");
    } else {
        $msg = "البيانات غير صحيحة";
    }
}

include "header.php";
?>

<h3>تسجيل الدخول</h3>

<?php if($msg): ?>
<div class="alert alert-danger"><?= $msg ?></div>
<?php endif; ?>

<form method="POST" class="card p-3">

  <label>البريد الإلكتروني</label>
  <input type="email" name="email" class="form-control mb-2" required>

  <label>كلمة المرور</label>
  <input type="password" name="password" class="form-control mb-2" required>

  <button class="btn btn-primary">دخول</button>
</form>

<?php include "footer.php"; ?>
