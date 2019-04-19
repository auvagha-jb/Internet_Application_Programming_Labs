<?php
include '../user.php';
session_start();

if (isset($_SESSION['username'])) {
    $user = User::create();
    $user->logout();
}