<?php
include("config/db.php");

if(!isset($_SESSION['uid'])){
  header("Location: login.php");
  exit;
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

/* record fetch */
$q = mysqli_query($conn,
 "SELECT * FROM records 
  WHERE id = $id AND user_id = ".$_SESSION['uid']
);

if(mysqli_num_rows($q)==0){
  die("Invalid Record");
}

$r = mysqli_fetch_assoc($q);

/* UPDATE ONLY WHEN FORM SUBMITTED */
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])){
  
  $count = $_POST['count'];

  mysqli_query($conn,
   "UPDATE records 
    SET count_value='$count' 
    WHERE id=$id AND user_id=".$_SESSION['uid']
  );

  header("Location: dashboard.php?success=updated");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Record</title>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="header">
  <h1>Edit Record</h1>
  <div class="nav">
    <a href="dashboard.php">Back</a>
    <a href="logout.php">Logout</a>
  </div>
</div>

<div class="container">
  <div class="card">
    <h2>Update Entry</h2>

    <form method="post">
      <select name="count" required>
        <option value="<?=$r['count_value']?>"><?=$r['count_value']?></option>
        <option>NO</option>
        <?php
          for($i=1;$i<=10;$i++){
            echo "<option>$i Time</option>";
          }
        ?>
      </select>

      <button type="submit" name="update">Update</button>
    </form>

  </div>
</div>


<footer class="site-footer">
  <p>Source By <a href="https://t.me/maxmentor" target="_blank">@maxmentor</a></p>
</footer>

</body>
</html>
