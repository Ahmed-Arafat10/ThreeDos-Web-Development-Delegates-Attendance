<?php
ob_start();
include('/xampp/htdocs/WebDelegatesAttendanceProject/ConfigDB.php');
include('/xampp/htdocs/WebDelegatesAttendance/NavBar.php');
//echo "Hello World";
$UpdateState = 0;
$MemberString = '';
////
$Name = '';
$Phone = '';
$Email =  '';
$Faculty = '';
$Level =  '';
$Member = '';
$Notes = '';
$IsFired = '';
if (isset($_POST['SignInBtn'])) {
    //EmailPhoneFaculty
    $Name = $_POST['Name'];
    $Phone = $_POST['Phone'];
    $Email = $_POST['Email'];
    $Faculty = $_POST['Faculty'];
    $Level = $_POST['Level'];
    if ($_POST['MemberText'] == '') $Member = 0;
    else $Member = $_POST['MemberText'];
    $Notes = $_POST['Notes'];
    $IsFired = 0;
    $InsertQuery = "INSERT INTO `delegate` VALUES(NULL,'$Name','$Phone','$Email','$Faculty',$Level,'$Member','$Notes',$IsFired)";
    $ExecuteInsertQuery = mysqli_query($ConnectToDatabase, $InsertQuery);
    if ($ExecuteInsertQuery) echo PrintMessage("Done Inserting Into Database", "normal");
    else echo PrintMessage("Failed Inserting Into Database", "danger");
}

if (isset($_GET['Update'])) {
    $UpdateState = 1;
    $ID = $_GET['Update'];
    $SelectQuery = "SELECT * FROM `delegate` WHERE DelegateID =  $ID";
    $ExecuteInsertQuery = mysqli_query($ConnectToDatabase, $SelectQuery);
    $FetchQuery = mysqli_fetch_assoc($ExecuteInsertQuery);
    $Name = $FetchQuery['name'];
    $Phone = $FetchQuery['phone'];
    $Email =  $FetchQuery['email'];
    $Faculty = $FetchQuery['faculty'];
    $Level =  $FetchQuery['level'];
    $MemberString = $FetchQuery['member'];
    $Notes = $FetchQuery['notes'];
    $IsFired = $FetchQuery['IsFired'];
}
if (isset($_POST['UpdateBtn'])) {
    $ID = $_GET['Update'];
    $Name = $_POST['Name'];
    $Phone = $_POST['Phone'];
    $Email = $_POST['Email'];
    $Faculty = $_POST['Faculty'];
    $Level = $_POST['Level'];
    if ($_POST['MemberText'] == '') $Member = 0;
    else $Member = $_POST['MemberText'];
    $Notes = $_POST['Notes'];
    $IsFired = $_POST['Fired'];
    $UpdateQuery = "UPDATE `delegate` SET name = '$Name', phone = '$Phone' , email = '$Email' , faculty = '$Faculty', level = $Level , member = '$Member' , notes = '$Notes' , IsFired =  $IsFired WHERE DelegateID = $ID";
    $ExecuteUpdateQuery = mysqli_query($ConnectToDatabase, $UpdateQuery);
    if ($ExecuteUpdateQuery) echo PrintMessage("Done Updating Data", "normal");
    else echo PrintMessage("Failed Updating Data", "danger");
}
ob_flush();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS.css">
</head>

<body>
    <?php if (!isset($_SESSION['AdminName'])) :
        header("location:/WebDelegatesAttendance/AccessDenied.php");
    ?>
    <?php endif; ?>
    <div class="container col-md-8 mt-5">
        <form method="POST">
            <div class="form-row">
                <div class="form-group col-md">
                    <label for="inputEmail4"> Name</label>
                    <input required type="text" name="Name" value="<?php echo $Name ?>" class="form-control" id="inputEmail4" placeholder="Enter First Name Here">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md">
                    <label for="inputEmail4">E-mail</label>
                    <input type="email" name="Email" value="<?php echo $Email ?>" class="form-control" id="inputEmail4" placeholder="Enter E-mail Name Here">
                </div>
                <div class="form-group col-md">
                    <label for="inputPassword4">Phone</label>
                    <input required type="number" name="Phone" value="<?php echo $Phone ?>" class="form-control" id="inputPassword4" placeholder="Enter Phone Name Here">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md">
                    <label for="inputEmail4">Faculty</label>
                    <input type="text" name="Faculty" value="<?php echo $Faculty ?>" class="form-control" id="inputEmail4" placeholder="Enter Faculty Name Here">
                </div>
                <div class="form-group col-md-5">
                    <label for="">Level</label>
                    <select value="<?php echo $Level ?>" placeholder="Here" class="form-control" name="Level" id="">
                        <option disabled selected hidden>Choose Level</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="">Is He/She A Member</label>
                    <select onchange="HideShow(this);" class="form-control" name="Member" id="">
                        <option disabled selected hidden>Choose Here</option>
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </div>
                <div id="MemberTextID" style="display: none;" class="form-group col-md-5">
                    <label for="inputEmail4">Member</label>
                    <input value="<?php echo $MemberString ?>" type="text" placeholder="Enter Council Here" name="MemberText" class="form-control" id="inputEmail4">
                </div>
                <?php if ($UpdateState) : ?>
                    <div class="form-group col-md">
                        <label for="">Is He/She Fired</label>
                        <select required class="form-control" value="<?php echo $IsFired ?>" name="Fired" id="">
                            <option disabled selected hidden>Choose Here</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                <?php endif; ?>
            </div>
            <div class="form-row">
                <div class="form-group col-md">
                    <label for="">Notes</label>
                    <input type="text" value="<?php echo $Notes ?>" placeholder="If You Have Any Notes About Delegate Enter Here" name="Notes" class="form-control" id="inputPassword4">
                </div>
            </div>
            <input class="btn btn-info" type="reset">
            <div class="text-center">
                <?php if (!$UpdateState) : ?>
                    <button type="submit" name="SignInBtn" class="btn btn-primary">Sign in</button>
                <?php else : ?>
                    <button type="submit" name="UpdateBtn" class="btn btn-primary">Update Data</button>
                <?php endif; ?>
            </div>
        </form>
    </div>

</body>
<script>
    function HideShow(that) {
        if (that.value == "1") {
            document.getElementById("MemberTextID").style.display = "block";
        } else {
            document.getElementById("MemberTextID").style.display = "none";
        }
    }
</script>

</html>