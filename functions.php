<?php
if (session_status() == PHP_SESSION_NONE) session_start();

// تنقية النصوص
function clean($x){
    return htmlspecialchars(trim($x));
}

// التوجيه
function redirect($page){
    header("Location: $page");
    exit;
}

// التحقق من تسجيل الدخول
function logged(){
    return isset($_SESSION['user']);
}

// رفع صورة
function upload_img($file){
    if ($file['error'] == 0){
        $name = time() . "_" . basename($file['name']);
        move_uploaded_file($file['tmp_name'], "uploads/" . $name);
        return $name;
    }
    return "";
}
?>
