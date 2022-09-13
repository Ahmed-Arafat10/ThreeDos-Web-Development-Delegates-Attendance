<?php
ob_start();
include('/xampp/htdocs/WebDelegatesAttendanceProject/ConfigDB.php');
include('/xampp/htdocs/WebDelegatesAttendance/NavBar.php');
$UpdateState = 0;
////
$Name = '';
$GroupName = '';
$HasWorked = '';
$Comment = '';
if (isset($_POST['AddBtn'])) {
    //EmailPhoneFaculty
    $ID = $_POST['NameSelect'];
    $GroupName = $_POST['GroupName'];
    $HasWorked = $_POST['Worked'];
    $Comment = $_POST['Comment'];
    // if ($_POST['MemberText'] == '') $Member = 0;
    // else $Member = $_POST['MemberText'];
    // $Notes = $_POST['Notes'];
    // $IsFired = $_POST['Fired'];;
    $InsertQuery = "INSERT INTO `semiconferencegroups`VALUES ($ID ,'$GroupName',$HasWorked,'$Comment')";
    $ExecuteInsertQuery = mysqli_query($ConnectToDatabase, $InsertQuery);
    if ($ExecuteInsertQuery) echo PrintMessage("Done Updating Data", "normal");
    else echo PrintMessage("Failed Updating Data", "danger");
}

if (isset($_GET['DelID'])) {
    $UpdateState = 1;
    $ID = $_GET['DelID'];
    $JoinQuery = "SELECT delegate.name AS DName , semiconferencegroups.GroupName AS Gname , semiconferencegroups.HasWorked AS HWorked  , semiconferencegroups.Comment AS Comment  FROM `delegate` JOIN `semiconferencegroups` ON delegate.DelegateID = semiconferencegroups.DelegateID  AND delegate.DelegateID = $ID";
    $ExecuteJoinQuery = mysqli_query($ConnectToDatabase, $JoinQuery);
    $FetchJoinQuery = mysqli_fetch_assoc($ExecuteJoinQuery);
    $Name = $FetchJoinQuery['DName'];
    $GroupName = $FetchJoinQuery['Gname'];
    $HasWorked = $FetchJoinQuery['HWorked'];
    $Comment = $FetchJoinQuery['Comment'];
}
if (isset($_POST['UpdateBtn'])) {
    $ID = $_GET['DelID'];
    $GroupName = $_POST['GroupName'];
    $HasWorked = $_POST['Worked'];
    $Comment = $_POST['Comment'];
    // if ($_POST['MemberText'] == '') $Member = 0;
    // else $Member = $_POST['MemberText'];
    // $Notes = $_POST['Notes'];
    // $IsFired = $_POST['Fired'];;
    ///////
    $UpdateQuery = "UPDATE `semiconferencegroups` SET GroupName = '$GroupName', HasWorked = $HasWorked , Comment = '$Comment' WHERE DelegateID = $ID";
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
            <?php if ($UpdateState) : ?>
                <div class="form-row">
                    <div class="form-group col-md">
                        <label for="inputEmail4">Name</label>
                        <input disabled type="text" name="Name" value="<?php echo $Name ?>" class="form-control" id="inputEmail4" placeholder="Enter First Name Here">
                    </div>
                </div>
            <?php else : ?>
                <label for="">Name</label>
                <select style="display: block;margin:0 0 20px 0;" name="NameSelect" id="">
                    <?php
                    $JoinQuery = "SELECT delegate.DelegateID AS DID ,delegate.name AS DName , semiconferencegroups.GroupName FROM `delegate` LEFT JOIN `semiconferencegroups` ON delegate.DelegateID =  semiconferencegroups.DelegateID AND semiconferencegroups.GroupName IS NULL";
                    $ExecuteJoinQuery = mysqli_query($ConnectToDatabase, $JoinQuery);
                    // $FetchQuery = mysqli_fetch_assoc($ExecuteJoinQuery);
                    foreach ($ExecuteJoinQuery as $DelegateData) {
                    ?>
                        <option value="<?php echo $DelegateData['DID'] ?>"> <?php echo $DelegateData['DName'] ?> </option>

                    <?php } ?>
                </select>
            <?php endif; ?>
            <div class="form-row">
                <div class="form-group col-md">
                    <label for="inputEmail4">Group Name</label>
                    <input type="text" name="GroupName" value="<?php echo $GroupName ?>" class="form-control" id="inputEmail4" placeholder="Enter Group Name Here">
                </div>
                <div class="form-group col-md">
                    <label for="inputPassword4">Worked Or Not</label>
                    <input required type="number" min="0" max="1" name="Worked" value="<?php echo $HasWorked ?>" class="form-control" id="inputPassword4" placeholder="Enter 1 For True / 0 For False Name Here">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md">
                    <label for="">Comment</label>
                    <input type="text" value="<?php echo $Comment ?>" placeholder="If You Have Any Comment About Delegate Enter Here" name="Comment" class="form-control" id="inputPassword4">
                </div>
            </div>
            <input class="btn btn-info" type="reset">
            <div class="text-center">
                <?php if (!$UpdateState) : ?>
                    <button type="submit" name="AddBtn" class="btn btn-primary">Add Data</button>
                <?php else : ?>
                    <button type="submit" name="UpdateBtn" class="btn btn-primary">Update Data</button>
                <?php endif; ?>
            </div>
        </form>
    </div>

</body>

</html>