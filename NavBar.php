<?php
session_start();
if (isset($_POST['AdminBtn'])) {
    $Name = $_POST['AdminName'];
    $Pass = $_POST['AdminPass'];
    $AdminQuery = "SELECT * FROM `admin` WHERE Name = '$Name' AND Password = '$Pass'";
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
    header("location:/WebDelegatesAttendance/index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light" id="TESTT">
        <!-- Image and text -->
        <nav class="navbar navbar-light">
            <a class="navbar-brand" href="./index.php">
                <img src="./WebDevPic.jpg" width="50" height="50" class="d-inline-block align-top" alt="N/A">
                <h4 class="WebText">Web Development '21</h4>
            </a>
        </nav>

        <div class="nav navbar-collapse navbar-collapse" id="navbarSupportedContent">
            <ul id="ULL" class="navbar list-inline">
                <li id="MyNav" class="nav-item active">
                    <a class="nav-link" href="./index.php">Home<span class="sr-only">(current)</span></a>
                </li>

                <li id="MyNav" class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Delegates
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="./ViewDelegates.php">View Delegates</a>
                        <a class="dropdown-item" href="./AddDelegate.php">Add Delegate</a>
                        <a class="dropdown-item" href="./AddGroupData.php">Add Group Data</a>
                    </div>
                </li>
                <li id="MyNav" class="nav-item">
                    <a class="nav-link" href="./ContactUs.php">Contact Us</a>
                </li>
                <li id="MyNav" class="nav-item active">
                    <a class="nav-link" href="./AboutUs.php">About Us <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <form method="POST" class="form-inline my-2 my-lg-0">
                <?php if (!isset($_SESSION['AdminName'])) : ?>
                    <input id="IN" required name="AdminName" class="form-control mr-sm-2" type="password" placeholder="Enter Admin Name" aria-label="Search">
                    <input id="IN" required name="AdminPass" class="form-control mr-sm-2" type="password" placeholder="Enter Password" aria-label="Search">
                <?php endif; ?>
                <?php if (isset($_SESSION['AdminName'])) : ?>
                    <button id="LBTN" name="AdminLogout" class="btn btn-outline-danger my-2 my-sm-0" type="submit">Logout</button>
                <?php else : ?>
                    <button id="LBTN" name="AdminBtn" class="btn btn-outline-success my-2 my-sm-0" type="submit">Login</button>
                <?php endif; ?>
            </form>
        </div>
    </nav>
    </nav>
</body>

</html>