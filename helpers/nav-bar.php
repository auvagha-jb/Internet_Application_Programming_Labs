<!--Navigation bar-->
<nav class="black">
    <div class="nav-wrapper">
        <a href="#!" class="brand-logo" id="brand-name" style="padding-left: 3%;">Labs</a>
        <a href="#!" data-target="mobile-nav" class="sidenav-trigger">
            <i class="material-icons">menu</i>
        </a>
        <ul id="nav-mobile" class="right hide-on-med-and-down" style="padding-right: 2% ">
            <li><a href="lab1.php">Add User</a></li>
            <li><a href="login.php">Login</a></li>
            <?php toggle_links();?>
        </ul>
    </div>
</nav>


<!-- Mobile menu -->
<ul id="mobile-nav" class="sidenav black">
    <li class="sidenav-close"><a href="#!" class="white-text">&times;</a></li>
    <li><a href="lab1.php" class="white-text">Add User</a></li>
    <li><a href="login.php" class="white-text">Login</a></li>
    <?php toggle_links();?>
</ul>

<?php
function toggle_links()
{
    if (isset($_SESSION['username'])) {
        show_links();
    }

}

function show_links()
{
    echo '
    <li><a href="index.php">Order</a></li>
    <li><a href="#!" class="btn-small white black-text">' . $_SESSION['username'] . '</a></li>
    <li><a href="helpers/logout.php" class="btn red darken-1 text-white">Logout</a></li>
    ';
}