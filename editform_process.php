<?php
session_start();
require_once 'include/db.php';
$name= $_GET['name'];
$email= $_GET['mail'];
$msg= $_GET['msg'];
if ($_SESSION['email']=='admin@mrsahil.in') {
    if (empty($name) or empty($email) or empty($msg) ) {
        header("location:editcform.php?error=true&edit=".$_GET['edit']);
    }
    else {
        $query= $db->prepare('UPDATE cform SET name=?, email=?, message=? WHERE id=?');
        $query->execute(array(
            $name,
            $email,
            $msg,
            $_GET['edit']
        ));
        header("location:viewcform.php?sucess=true");
    }
}
?>

