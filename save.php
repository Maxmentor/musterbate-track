<?php
include("config/db.php");

mysqli_query($conn,
 "INSERT INTO records VALUES(
  NULL,
  ".$_SESSION['uid'].",
  '".$_POST['count']."',
  '".$_POST['date']."'
 )"
);

header("Location: dashboard.php?success=added");
exit;
?>
