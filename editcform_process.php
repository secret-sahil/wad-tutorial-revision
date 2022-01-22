<?php
require_once 'include/db.php';
$name= $_GET['name'];
$email= $_GET['mail'];
$msg= $_GET['msg'];
$token= $_GET['id'];

if (empty($name) or empty($email) or empty($msg) ) {
    header("location:contactus.php?error=true");
}
else {
    $query= $db->prepare("UPDATE cform SET name=?, email=?, message=? where cform.id=?");
    $query->execute(array(
        $name, 
        $email, 
        $msg, 
        $token
    ));
    header("location:viewcform.php?sucess=true");
}
?>