<?php
include('/xampp/htdocs/WebDelegatesAttendance/ConfigDB.php');
include('/xampp/htdocs/WebDelegatesAttendance/NavBar.php');
//echo "Hello World";
// if (isset($_POST['SubmitBtn'])) {
//     $name = $_POST['name'];
//     $phone = $_POST['phone'];
//     $email = $_POST['email'];
//     $faculty = $_POST['faculty'];
//     $level = $_POST['level'];
//     $member = $_POST['member'];
//     $notes = $_POST['notes'];

//     $InsertStatment = "INSERT INTO delegate VALUES(NULL,'$name','$phone','$email','$faculty',$level,'$member','$notes')";
//     $ExecuteInsertQuery = mysqli_query($ConnectToDatabase, $InsertStatment);
//     if ($ExecuteInsertQuery) {
//         echo PrintMessage("Done Inserting Into Database", "normal");
//     } else {
//         echo PrintMessage("Failed Inserting Into Database", "danger");
//     }
// }

function PrintMessage($Text, $State)
{
    if ($State == 0) echo "<span style='color:white;' >" . $Text . "</span>";
    else echo "<span style='color:white ;' >" . $Text . "</span>";
}

////////////

if (isset($_GET['Delete'])) {
    $DelegateIDToDelete = $_GET['Delete'];
    $DeleteQuery1 = "DELETE FROM `semiconferencegroups` WHERE DelegateID = $DelegateIDToDelete";
    $DeleteQuery2 = "DELETE FROM `attendance` WHERE DelegateID = $DelegateIDToDelete";
    $DeleteQuery3 = "DELETE FROM `delegate` WHERE DelegateID = $DelegateIDToDelete";
    $Exceute1 = mysqli_query($ConnectToDatabase, $DeleteQuery1);
    $Exceute2 = mysqli_query($ConnectToDatabase, $DeleteQuery2);
    $Exceute3 = mysqli_query($ConnectToDatabase, $DeleteQuery3);
    if ($Exceute3) Print_Message("Done Deleting From Database", "normal");
    // else  Print_Message("Failed Deleting From Database", "danger");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>List Delegates</title>
       <link rel="stylesheet" href="CSS.css?v=<?php echo time(); ?>">
</head>

<body>
<?php if (!isset($_SESSION['AdminName'])) :
        header("location:/WebDelegatesAttendance/AccessDenied.php");
    ?>
    <?php endif; ?>
  
        <nav class="MYNAV">
            <div class="container col-md-4 nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">List Delegate</a>
                <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">List Attendance</a>
                <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">List Groups</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <input class="form-control mr-sm-2" id="myInput" type="search" placeholder="Search Delegate Here !" aria-label="Search">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                <table id="ListTable" class="table table-sm table-dark table-striped table-hover table-responsive text-center" class="ViewDelegatesTable">
                    <thead>
                        <tr class="table-active">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Faculty</th>
                            <th>Level</th>
                            <th>Member</th>
                            <th>Notes</th>
                            <th>Delete</th>
                            <th>Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $SelectFromDelegates = "SELECT * FROM `delegate`";
                        $ExecuteSelectQuery = mysqli_query($ConnectToDatabase, $SelectFromDelegates);

                        foreach ($ExecuteSelectQuery as $DelegateData) {

                            //$data_row = mysqli_fetch_assoc($query);
                            $FiredState = $DelegateData['IsFired'];
                            if ($FiredState == 1) : ?>
                                <tr class="bg-danger">
                                <?php else : ?>
                                <tr>
                                <?php endif; ?>

                                <td> <?php PrintMessage($DelegateData['DelegateID'], $FiredState); ?> </td>
                                <td> <?php PrintMessage($DelegateData['name'], $FiredState); ?> </td>
                                <td> <?php PrintMessage($DelegateData['phone'], $FiredState); ?> </td>
                                <td> <?php PrintMessage($DelegateData['email'], $FiredState); ?> </td>
                                <td> <?php PrintMessage($DelegateData['faculty'], $FiredState); ?> </td>
                                <td> <?php PrintMessage($DelegateData['level'], $FiredState); ?> </td>
                                <td> <?php if ($DelegateData['member'] == '0') PrintMessage("Not Member", $FiredState);
                                        else echo "<span style='color:purple;' >" . $DelegateData['member'] . "</span>"; ?> </td>
                                <td style="width: auto;"> <?php PrintMessage($DelegateData['notes'], $FiredState);  ?> </td>

                                <td class="bg-dark"> <a href="AddDelegate.php?Update=<?php echo $DelegateData['DelegateID']; ?>"> <button class="btn btn-info my-2 my-sm-0" type="submit" name="UpdateBtn">Update</button> </a> </td>
                                <td class="bg-dark"> <a onclick="confirm('Are You Sure You Want To Delete This Delegate')" href="ViewDelegates.phpelete=<?php echo $DelegateData['DelegateID']; ?>"> <button class="btn btn-danger my-2 my-sm-0" type="submit" name="DeleteBtn">Delete</button> </a> </td>

                            <?php } ?>

                                </tr>
                    </tbody>
                </table>

            </div>
            <!-- Second Table -->
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

                <table id="ListTable" class="table table-dark table-striped table-hover table-responsive text-center" class="ViewDelegatesTable">
                    <!-- <caption>dasdas</caption> -->
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Session #1</th>
                            <th>Session #2</th>
                            <th>Session #3</th>
                            <th>Session #4</th>
                            <th>Online #1</th>
                            <th>Online #2</th>
                            <th>Training #1</th>
                            <th>Training #2</th>
                            <th>Training #3</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <?php
                    $SelectFromDelegates = "SELECT * FROM `delegate`";
                    $ExecuteSelectQuery = mysqli_query($ConnectToDatabase, $SelectFromDelegates);
                    foreach ($ExecuteSelectQuery as $DelegateData) {
                    ?>
                        <tr>
                            <td> <?php echo $DelegateData['DelegateID']; ?> </td>
                            <td> <?php echo $DelegateData['name']; ?> </td>
                            <?php
                            $DelegateID = $DelegateData['DelegateID'];
                            $SearchAttendanceTable = "SELECT * FROM `attendance` WHERE DelgateID = $DelegateID ORDER BY SessionID";
                            $ExecuteSelectAttendanceQuery = mysqli_query($ConnectToDatabase, $SearchAttendanceTable);
                            ///COUNT
                            $COUNTNoOfAttendance = "SELECT COUNT(*) AS CNT FROM `attendance` WHERE DelgateID = $DelegateID ";
                            $ExecuteCOUNTQuery = mysqli_query($ConnectToDatabase, $COUNTNoOfAttendance);
                            $FetchCount = mysqli_fetch_assoc($ExecuteCOUNTQuery);
                            $CountTotalAttendance = $FetchCount['CNT'];
                            $cnt = 0;
                            $i = 1;
                            foreach ($ExecuteSelectAttendanceQuery as $AttendanceData) {
                            ?>
                                <?php for ($j = $i; $j < $AttendanceData['SessionID']; $j++, $i++, $cnt++) { ?>
                                    <td> <?php echo  "<span style='color:red' >" . "Absent" . "</span>";
                                        } ?> </td>

                                    <td> <?php echo   "<span style='color:green' >" . "Attend" . "</span>";
                                            $cnt++;
                                            $i++; ?> </td>
                                <?php }
                            if ($cnt != 9) for ($j = $cnt; $cnt < 9; $cnt++) { ?>
                                    <td> <?php echo  "<span style='color:red' >" . "Absent" . "</span>";
                                        } ?> </td>
                                    <td><?php echo  "<span style='color:white' >" . $CountTotalAttendance . "</span>";  ?></td>
                                <?php } ?>
                        </tr>
                </table>

            </div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">

                <!-- Third Table -->
                <div class="container col-md-10">
                    <table id="ListTable" class="table table-striped table-dark table-hover table-responsive text-center" class="ViewDelegatesTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Group Name</th>
                                <th>Worked Or Not</th>
                                <th>Comment</th>
                                <th>Update</th>
                            </tr>
                        </thead>
                        <?php
                        $SelectFromDelegates = "SELECT * FROM `semiconferencegroups` ORDER BY `GroupName`";
                        $ExecuteSelectQuery = mysqli_query($ConnectToDatabase, $SelectFromDelegates);
                        foreach ($ExecuteSelectQuery as $DelegateData) {
                            $DelegateID = $DelegateData['DelegateID'];
                            $SearchName = "SELECT * FROM `delegate` WHERE DelegateID = $DelegateID";
                            $ExecuteSearchName = mysqli_query($ConnectToDatabase, $SearchName);
                            // if($ExecuteSearchName) echo "done";
                            // else echo "failed";
                            $FetchQuery = mysqli_fetch_assoc($ExecuteSearchName);
                            $DelegateName = $FetchQuery['name'];
                        ?>
                            <tr>
                                <td> <?php echo $DelegateData['DelegateID']; ?> </td>
                                <td> <?php echo $DelegateName; ?> </td>
                                <td> <?php echo $DelegateData['GroupName']; ?> </td>
                                <?php if ($DelegateData['HasWorked']) : ?>
                                    <td> <?php echo "<span style='color:green;' >" . "Worked"  . "</span>"; ?> </td>
                                <?php else : ?>
                                    <td> <?php echo "<span style='color:red;' >" . "Didn't Work"   . "</span>"; ?> </td>
                                <?php endif; ?>
                                <?php if ($DelegateData['Comment'] != '') : ?>
                                    <td> <?php echo $DelegateData['Comment']; ?> </td>
                                <?php else : ?>
                                    <td> <?php echo "<span style='color:red;' >" . "N/A"   . "</span>"; ?> </td>
                                <?php endif; ?>
                                <td > <a href="AddGroupData.php?DelID=<?php echo $DelegateData['DelegateID']; ?>"> <button class="btn btn-info" type="submit" name="UpdateBtn">Update</button> </a> </td>

                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>

 

    <!-- <h3 style="text-align: center;">Attendance List</h3> -->


</body>
<script>
    $(document).ready(function() {
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#ListTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>

</html>