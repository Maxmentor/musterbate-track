<?php include("config/db.php"); ?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="auth-card card">
<h2>Register</h2>
<form method="post">
<input name="name" placeholder="Name" required>
<input name="email" type="email" placeholder="Email" required>
<input name="password" type="password" placeholder="Password" required>
<button name="register">Create Account</button>
</form>
</div>


<?php
if(isset($_POST['register'])){
$n=$_POST['name'];
$e=$_POST['email'];
$p=password_hash($_POST['password'],PASSWORD_DEFAULT);
mysqli_query($conn,"INSERT INTO users VALUES(NULL,'$n','$e','$p')");
header("Location: login.php");
}
?>

<footer class="site-footer">
  <p>Source By <a href="https://t.me/maxmentor" target="_blank">@maxmentor</a></p>
</footer>

</body>
</html>