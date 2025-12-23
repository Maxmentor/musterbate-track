<?php include("config/db.php"); ?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="auth-card card">
<h2>Login</h2>
<form method="post">
<input name="email" type="email" placeholder="Email" required>
<input name="password" type="password" placeholder="Password" required>
<button name="login">Login</button>
</form>
</div>


<?php
if(isset($_POST['login'])){
$e=$_POST['email'];
$p=$_POST['password'];
$q=mysqli_query($conn,"SELECT * FROM users WHERE email='$e'");
$u=mysqli_fetch_assoc($q);
if($u && password_verify($p,$u['password'])){
$_SESSION['uid']=$u['id'];
$_SESSION['name']=$u['name'];
header("Location: dashboard.php");
}
}
?>

<footer class="site-footer">
  <p>Source By <a href="https://t.me/maxmentor" target="_blank">@maxmentor</a></p>
</footer>

</body>
</html>