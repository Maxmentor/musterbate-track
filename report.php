<?php
include("config/db.php");
if(!isset($_SESSION['uid'])) die("Login Required");

$uid = $_SESSION['uid'];

/* WHERE condition */
$where = "user_id=$uid";

/* Date range filter */
if(!empty($_GET['from']) && !empty($_GET['to'])){
    $from = $_GET['from'];
    $to   = $_GET['to'];
    $where .= " AND record_date BETWEEN '$from' AND '$to'";
}

/* FETCH DATA */
$q = mysqli_query($conn,
    "SELECT * FROM records 
     WHERE $where 
     ORDER BY record_date DESC, id DESC"
);

/* PREPARE TEXT CONTENT */
$content = "[Date]\t[Count]\n";

$totalDays = 0;
$totalTimes = 0;

if(mysqli_num_rows($q)>0){
    while($r = mysqli_fetch_assoc($q)){
        $content .= $r['record_date']."\t".$r['count_value']."\n";
        $totalDays++;

        if(preg_match('/(\d+)/', $r['count_value'], $m)){
            $totalTimes += (int)$m[1];
        }
    }
}else{
    $content .= "No data found\n";
}

/* SUMMARY */
$content .= "\n[Total Days]\t[Total Time]\n";
$content .= $totalDays."\t\t".$totalTimes." TIMES\n";

/* DOWNLOAD HEADERS */
$filename = "report_".date("Ymd_His").".txt";
header("Content-Type: text/plain");
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Length: ".strlen($content));

echo $content;
exit;
?>
