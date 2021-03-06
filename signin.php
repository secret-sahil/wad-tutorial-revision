<?php 
session_start();
if (isset($_SESSION['username'])) {
    header('location:viewcform.php');
}
include "include/header.php";
$msg=new ArrayObject(array());
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'include/db.php';
    $query=$db->prepare('SELECT * from users where email=? and password=?');
    $query->execute(array(
        $_POST['email'],
        md5($_POST['pwd'])
    ));
    $data=$query->fetchall();
    $count=sizeof($data);
    if ($count>0) {
        $_SESSION['email']=$data[0]['email'];
        $_SESSION['username']=$data[0]['name'];
        $_SESSION['id']=$data[0]['id'];
        header('location:viewcform.php');
    }
    else {
        $msg->append('Wrong Email or password');
    }
}
?>
	<body>
    <?php  include "include/nav.php"; ?>
    <div class="main">
        <div class="myform">
            <form action="signin.php" method="post">
                <p>Login</p>
                <?php 
                if (isset($msg)) {
                    for ($i=0; $i < sizeof($msg); $i++) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo $msg[$i]; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php }
                }
                ?>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Email</label>
                    <input type="email" name='email' class="form-control">
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Password</label>
                    <input type="password" name='pwd' class="form-control" >
                </div>
                <p class="mb-3">Not registred? <a href="signup.php">Register</a></p>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <?php  include "include/footer.php"; ?>
	</body>
</html>

