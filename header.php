<?php if (session_status() == PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<title>TaizLost</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="assets/style.css">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">

    <a class="navbar-brand d-flex align-items-center" href="index.php">
      <img src="assets/logo.png" style="width:40px;height:40px;border-radius:5px" class="me-2">
      TaizLost
    </a>

    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#main">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="main">

      <ul class="navbar-nav ms-auto">

        <li class="nav-item">
            <a href="index.php" class="nav-link">الصفحة الرئيسية</a>
        </li>

        <li class="nav-item">
            <a href="search.php" class="nav-link">بحث عن بلاغ</a>
        </li>

        <?php if(isset($_SESSION['user'])): ?>

          <li class="nav-item">
            <a href="add_report.php" class="nav-link">إضافة بلاغ</a>
          </li>

          <li class="nav-item">
            <a href="my_reports.php" class="nav-link">بلاغاتي</a>
          </li>

          <li class="nav-item">
            <a href="logout.php" class="nav-link text-danger">خروج</a>
          </li>

        <?php else: ?>

          <li class="nav-item">
            <a href="login.php" class="nav-link">تسجيل الدخول</a>
          </li>

          <li class="nav-item">
            <a href="register.php" class="nav-link">إنشاء حساب</a>
          </li>

        <?php endif; ?>

      </ul>

    </div>

  </div>
</nav>

<div class="container my-4">
