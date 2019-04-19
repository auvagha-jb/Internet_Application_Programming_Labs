<!--Navigation bar-->
<nav class="black">
    <div class="nav-wrapper">
        <a href="#!" class="brand-logo" id="brand-name" style="padding-left: 3%;">Labs</a>
        <a href="#!" data-target="mobile-nav" class="sidenav-trigger">Menu</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down" style="padding-right: 2% ">
            <li><a href="lab1.php">Add User</a></li>
            <li><a href="login.php">Login</a></li>
            <?php toggle_links();?>
        </ul>
    </div>
</nav>
<ul id="mobile-nav" class="sidenav">
    <li class="sidenav-close"><a href="#!">&times;</a></li>
    <li><a href="lab1.php">Add User</a></li>
    <li><a href="login.php">Login</a></li>
    <?php toggle_links();?>
</ul>

<?php
function toggle_links()
{
    if (isset($_SESSION['username'])) {
        show_logout();
    }
}

function show_logout()
{
    echo '
        <li><a href="helpers/logout.php" class="btn red darken-1 text-white">Logout</a></li>
    ';
}