<?php
require_once 'include/db.php';
$name= $_GET['name'];
$email= $_GET['mail'];
$msg= $_GET['msg'];

if (empty($name) or empty($email) or empty($msg) ) {
    header("location:contactus.php?error=true");
}
else {
    $query= $db->prepare('INSERT INTO cform (name, email, message) VALUES (?, ?, ?)');
    $query->execute(array(
        $name,
        $email,
        $msg
    ));
    header("location:contactus.php?sucess=true");
}
?>