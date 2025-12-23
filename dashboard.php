<?php
include("config/db.php");
if(!isset($_SESSION['uid'])) header("Location: login.php");

$msg = "";

/* ✅ DELETE LOGIC (ADDED) */
if(isset($_GET['delete'])){
  $del_id = (int)$_GET['delete'];
  $uid = $_SESSION['uid'];
  mysqli_query($conn,"DELETE FROM records WHERE id=$del_id AND user_id=$uid");
  header("Location: dashboard.php?success=deleted");
  exit;
}

/* ✅ SUCCESS MESSAGES */
if(isset($_GET['success'])){
  if($_GET['success']=="added")   $msg="✅ Data successfully added!";
  if($_GET['success']=="updated") $msg="✏️ Data successfully updated!";
  if($_GET['success']=="deleted") $msg="🗑️ Data successfully deleted!";
}

$where = "user_id=".$_SESSION['uid'];

if(isset($_GET['from']) && isset($_GET['to'])){
  $from = $_GET['from'];
  $to   = $_GET['to'];
  $where .= " AND record_date BETWEEN '$from' AND '$to'";
}

$q = mysqli_query($conn,
 "SELECT * FROM records
  WHERE $where
  ORDER BY record_date DESC, id DESC"
);
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="header">
<h1>Dashboard</h1>
<div class="nav">
<a href="logout.php">Logout</a>
</div>
</div>

<div class="container">

<?php if($msg!=""){ ?>
<div class="card" style="background:#e8f8f0;border-left:6px solid #2ecc71;">
<strong><?=$msg?></strong>
</div>
<?php } ?>

<div class="card">
<h2>Add Record</h2>
<form action="save.php" method="post">
<select name="count">
<option>NO</option>
<?php for($i=1;$i<=10;$i++) echo "<option>$i Time</option>"; ?>
</select>
<input type="date" name="date" value="<?=date('Y-m-d')?>">
<button>Save</button>
</form>
</div>

<div class="card">
<h2>Search Records</h2>
<form method="get">
<input type="date" name="from" required>
<input type="date" name="to" required>
<button>Search</button>
</form>
</div>

<div class="card">
<h2>Records</h2>
<a class="edit-btn"
   style="float:right;margin-top:-3rem;"
   href="report.php?from=<?= $_GET['from'] ?? '' ?>&to=<?= $_GET['to'] ?? '' ?>">
   📄 Download Report
</a>



<table>
<tr>
  <th>Date</th>
  <th>Count</th>
  <th>Edit</th>
  <th>Delete</th>
</tr>

<?php
while($r = mysqli_fetch_assoc($q)){
  echo "
  <tr>
    <td>{$r['record_date']}</td>
    <td>{$r['count_value']}</td>
    <td><a class='edit-btn' href='edit.php?id={$r['id']}'>Edit</a></td>
    <td>
      <a class='delete-btn'
         href='dashboard.php?delete={$r['id']}'
         onclick=\"return confirm('Are you sure you want to delete?')\">
         Delete
      </a>
    </td>
  </tr>
  ";
}
?>
</table>
</div>

</div>
<br><br><br>
<footer class="site-footer">
  <p>Source By <a href="https://t.me/maxmentor" target="_blank">@maxmentor</a></p>
</footer>

</body>
</html>
