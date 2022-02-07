<?php 
session_start();
if (empty($_SESSION['username'])) {
    header('location:signin.php');
}
$msg= new ArrayObject(array());
include 'include/header.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $oldpwd= $_POST['oldpwd'];
    $pwd= $_POST['pwd'];
    $cpwd= $_POST['cpwd'];
    require_once 'include/db.php';
    $query= $db->prepare('SELECT * from users where password=? and id=?');
    $query->execute(array(
        md5($oldpwd),
        $_SESSION['id']
    ));
    $data=$query->fetchall();
    $count=sizeof($data);
    if (empty($oldpwd) or empty($pwd) or empty($cpwd)) {
        $msg->append('All fields are required');
    }
    elseif ($count==0) {
        $msg->append('Old Password you entered is wrong');
    }
    elseif ($pwd!=$cpwd) {
        $msg->append('New Password and Confirm Password Do not match');
    }
    else {
        require_once 'include/db.php';
        $query= $db->prepare('UPDATE users SET password=? where password=? and id=?');
        $query->execute(array(
            md5($pwd),
            md5($oldpwd),
            $_SESSION['id']
        ));
        $msg->append('Password Changed Sucessfully');
    }
}

?>
<body>
    <?php  include "include/nav.php"; ?>
    <div class="main">
        <div class="myform">
            <form action="changepwd.php" method="post">
                <p>Change Password</p>
                <?php 
                for ($i=0; $i < sizeof($msg); $i++) {
                    if ($msg[$i]=='Password Changed Sucessfully') { ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo $msg[$i]; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                   <?php }
                    else { ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo $msg[$i]; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                   <?php }
                 }?>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Old Password</label>
                    <input type="password" name='oldpwd' class="form-control" >
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">New Password</label>
                    <input type="password" name='pwd' class="form-control" >
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Confirm Password</label>
                    <input type="password" name='cpwd' class="form-control" >
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <?php  include "include/footer.php"; ?>
	</body>
</html>w