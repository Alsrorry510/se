<?php
include "db.php";
include "functions.php";

$msg = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    $name  = clean($_POST['name']);
    $email = clean($_POST['email']);
    $pass  = clean($_POST['password']);

    $sql = "INSERT INTO users(name,email,password) VALUES('$name','$email','$pass')";
    mysqli_query($mysqli, $sql);

    redirect("login.php");
}

include "header.php";
?>

<h3>إنشاء حساب</h3>

<form method="POST" class="card p-3">

  <label>الاسم</label>
  <input type="text" name="name" class="form-control mb-2" required>

  <label>البريد</label>
  <input type="email" name="email" class="form-control mb-2" required>

  <label>كلمة المرور</label>
  <input type="password" name="password" class="form-control mb-2" required>

  <button class="btn btn-success">تسجيل</button>
</form>

<?php include "footer.php"; ?>
