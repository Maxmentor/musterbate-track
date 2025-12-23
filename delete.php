<?php
include("config/db.php");
if(!isset($_SESSION['uid'])) header("Location: login.php");

$id = (int)$_GET['id'];
$uid = $_SESSION['uid'];

mysqli_query($conn,"DELETE FROM records WHERE id=$id AND user_id=$uid");

header("Location: dashboard.php?success=deleted");
exit;
?>
