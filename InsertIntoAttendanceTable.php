<?php
include('/xampp/htdocs/WebDelegatesAttendanceProject/ConfigDB.php');
//echo "Hello World";
for($i = 1; $i<=52;$i++)
{
if ( $i ==1|| $i == 5  || $i == 7 || $i == 8 || $i == 10 || $i == 13 || $i == 15 || $i == 17 || $i == 21 || $i == 22 || $i == 24 || $i == 26  || $i == 27 || $i == 31 || $i == 34 || $i == 36 || $i == 38 || $i == 41 || $i == 43 || $i == 44 || $i == 45|| $i == 49|| $i == 50 || $i == 51) continue;
$insert = "INSERT INTO `attendance` VALUES(9,$i,NULL)";
$query = mysqli_query($ConnectToDatabase,$insert);
if($query)
echo "Done".$i."</br>";
else
echo "Failed".$i."</br>";
}

?>


<?php if (!isset($_SESSION['AdminName'])) :
        header("location:/WebDelegatesAttendance/AccessDenied.php");
    ?>
    <?php endif; ?>