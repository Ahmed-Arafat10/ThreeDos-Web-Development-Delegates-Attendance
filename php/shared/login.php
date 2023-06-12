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