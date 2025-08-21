<?php
session_start();

if(isset($_SESSION['user_id'])){
    unset($_SESSION['user_id']);
    session_destroy();
}

session_start();
$_SESSION['message'] = 'Ciao, ritorna presto';
header('location: login.php');
die;