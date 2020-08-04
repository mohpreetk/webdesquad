<?php
session_start();
if(empty($_SESSION['id'])){
    $msg = "You are not logged in!!! or Something went wrong.";
    include'../view/display_messages.php';
    exit();
}
?>