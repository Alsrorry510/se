<?php
include "db.php";
include "functions.php";
if (!logged()) redirect("login.php");

$id = intval($_GET['id'] ?? 0);
$uid = intval($_SESSION['user']['id']);

$res = mysqli_query($mysqli, "SELECT image FROM reports WHERE id=$id AND user_id=$uid LIMIT 1");
if ($row = mysqli_fetch_assoc($res)) {
    if (!empty($row['image']) && file_exists("uploads/".$row['image'])) @unlink("uploads/".$row['image']);
}

mysqli_query($mysqli, "DELETE FROM reports WHERE id=$id AND user_id=$uid");
redirect("my_reports.php");
