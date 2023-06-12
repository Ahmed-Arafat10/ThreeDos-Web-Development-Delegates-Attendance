<?php
require_once 'php/ConfigDB.php';
session_start();
if (isset($_POST['AdminBtn'])) {
    $Name = $_POST['AdminName'];
    $Pass = $_POST['AdminPass'];
    $AdminQuery = "SELECT * FROM `admin` WHERE `Name` = '$Name' AND `Password` = '$Pass'";
    $ExcuteAdminQuery = mysqli_query($ConnectToDatabase, $AdminQuery);
    $CntAdmin = mysqli_num_rows($ExcuteAdminQuery);
    if ($CntAdmin > 0) {
        $_SESSION['AdminName'] = $Name;
        // Print_Message("You Are Admin","normal");
    } else {
        Print_Message("You Are Not Admin", "danger");
    }
}
if (isset($_POST['AdminLogout'])) {
    session_destroy();
    session_unset();
    header("location:index.php");
}
?>