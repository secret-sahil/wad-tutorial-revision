<?php 
include "include/header.php";
session_start();
if (isset($_SESSION['username'])) {
    header('location:viewcform.php');
}
?>
<?php
$msg= new ArrayObject(array());
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name=$_POST['name'];
    $mail=$_POST['email'];
    $gender=$_POST['gender'];
    $pwd=$_POST['pwd'];
    $cpwd=$_POST['cpwd'];
    $dob=$_POST['dob'];
    

    if (empty($name) or empty($mail) or empty($gender) or empty($pwd) or empty($cpwd) or empty($dob)) {
        $msg->append('All fields are required');
    }
    elseif ($pwd != $cpwd) {
        $msg->append('Password do not match');
    } 
    else{
        require_once "include/db.php";
        $query=$db->prepare('INSERT into users(name , gender, dob, email, password) VALUES(?, ?, ?, ?, ?)');
        $query->execute(array(
            $name,
            $gender,
            $dob,
            $mail,
            md5($pwd)
        ));
        $msg->append('Registered Sucessfully! <a href="signin.php">Login</a>');
    }
} ?>
	<body>
    <?php  include "include/nav.php"; ?>
    <div class="main">
        <div class="myform">
        <p>Register Now</p>
            <form action="signup.php" method="post">
                <?php
                            for ($i=0; $i < sizeof($msg); $i++) {
                                if ($msg[$i]=='Registered Sucessfully! <a href="login.php">Login</a>') { ?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <?php echo $msg[$i]; ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php } else { ?>
                                 <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?php echo $msg[$i]; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                <?php }
                            }?>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Full Name</label>
                    <input type="text" name='name' class="form-control">
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Gender</label>
                    <select class="form-select" name="gender">
                        <option value="1" selected>Male</option>
                        <option value="2">Female</option>
                        <option value="3">Other</option>
                    </select>
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Date of Birth</label>
                    <input type="date" name="dob" class="form-control" >
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Email</label>
                    <input type="email" name='email' class="form-control">
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Password</label>
                    <input type="password" name='pwd' class="form-control" >
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Confirm Password</label>
                    <input type="password" name='cpwd' class="form-control">
                </div>
                <p class="mb-3">Already registred? <a href="signin.php">Login</a></p>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <?php  include "include/footer.php"; ?>
	</body>
</html>