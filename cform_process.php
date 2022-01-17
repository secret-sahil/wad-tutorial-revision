<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname= "wad";
try {
$db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// echo "Connected successfully";
} catch(PDOException $e) {
// echo "Connection failed: " . $e->getMessage();
}

$name= $_GET['name'];
$email= $_GET['mail'];
$msg= $_GET['msg'];

if (empty($name) or empty($email) or empty($msg) ) {
    header("location:contactus.php?error=true");
}
else {
    $query= $db->prepare('INSERT INTO cform (name, email, message) VALUES (:name, :email, :message)');
    $query->execute(array(
        ':name'=>$name,
        ':email'=>$email,
        ':message'=>$msg
    ));
    header("location:contactus.php?sucess=true");
}
?>