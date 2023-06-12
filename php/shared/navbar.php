<nav class="navbar navbar-expand-lg navbar-light" id="TESTT">
    <!-- Image and text -->
    <nav class="navbar navbar-light">
        <a class="navbar-brand" href="index.php">
            <img src="assets/img/WebDevPic.jpg" width="50" height="50" class="d-inline-block align-top" alt="N/A">
            <h4 class="WebText">Web Development '21</h4>
        </a>
    </nav>

    <div class="nav navbar-collapse navbar-collapse" id="navbarSupportedContent">
        <ul id="ULL" class="navbar list-inline">
            <li id="MyNav" class="nav-item active">
                <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
            </li>

            <li id="MyNav" class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Delegates
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="php/ViewDelegates.php">View Delegates</a>
                    <a class="dropdown-item" href="php/AddDelegate.php">Add Delegate</a>
                    <a class="dropdown-item" href="php/AddGroupData.php">Add Group Data</a>
                </div>
            </li>
            <li id="MyNav" class="nav-item">
                <a class="nav-link" href="php/ContactUs.php">Contact Us</a>
            </li>
            <li id="MyNav" class="nav-item active">
                <a class="nav-link" href="php/AboutUs.php">About Us <span class="sr-only">(current)</span></a>
            </li>
        </ul>
        <?php require_once "php/shared/login.php" ?>
    </div>
</nav>