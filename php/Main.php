<?php
include('/xampp/htdocs/WebDelegatesAttendance/ConfigDB.php');
//echo "Hello World";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/index.css">
</head>

<body>
<?php if (!isset($_SESSION['AdminName'])) :
    header("location:../php/AccessDenied.php");
    ?>
<?php endif; ?>
<table class="table table-dark" class="test_table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Faculty</th>
        <th>Level</th>
        <th>Member</th>
        <th>Notes</th>
    </tr>
    </thead>
    <tr>
        <td>fdf</td>
        <td>fdf</td>
        <td>fdf</td>
        <td>fdf</td>
    </tr>
    <tr>
        <td>fdf</td>
        <td>fdf</td>
        <td>fdf</td>
        <td>fdf</td>
    </tr>
</table>


<a href="../php/AddDelegate.php">Click Me</a>


</body>

</html>
