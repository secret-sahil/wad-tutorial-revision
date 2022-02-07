<?php include 'include/header.php';
session_start();
if (empty($_SESSION['username'])) {
    header('location:signin.php');
}
$msg= new ArrayObject(array());
require_once 'include/db.php';
$query=$db->prepare('SELECT * from users where id=?');
$query->execute(array(
    $_SESSION['id']
));
$data=$query->fetch();

if ($_SERVER['REQUEST_METHOD']==='POST') {
    if (empty($_POST['name']) or empty($_POST['email']) or empty($_POST['dob']) or empty($_POST['gender'])) {
        $msg->append('All fields are required');
    }
    else {
        require_once 'include/db.php';
        $query= $db->prepare('UPDATE users SET name=?, email=?, dob=?, Gender=? where id=?');
        $query->execute(array(
            $_POST['name'],
            $_POST['email'],
            $_POST['dob'],
            $_POST['gender'],
            $_SESSION['id'],
        ));
        $msg->append('Profile Updated');
        header('location:edituser.php');
    }
}

?>
<body>
    <?php include 'include/nav.php' ?>
    <div class="main">
        <div class="myform">
        <p>Edit Profile</p>
            <form action="edituser.php" method="post">
                <?php
                            for ($i=0; $i < sizeof($msg); $i++) {
                                if ($msg[$i]=='Profile Updated') { ?>
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
                    <input type="text" value="<?php echo $data['name'] ?>" name='name' class="form-control">
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Gender</label>
                    <select class="form-select" name="gender">
                        <?php if ($data['gender']==1) { ?>
                            <option value="1" selected>Male</option>
                            <option value="2">Female</option>
                            <option value="3">Other</option>
                        <?php }?>
                        <?php if ($data['gender']==2) { ?>
                            <option value="2" selected>Female</option>
                            <option value="1">Male</option>
                            <option value="3">Other</option>
                        <?php }?>
                        <?php if ($data['gender']==3) { ?>
                            <option value="3" selected>Other</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        <?php }?>
                    </select>
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Date of Birth</label>
                    <input type="date" value='<?php echo $data['dob'] ?>' name="dob" class="form-control" >
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Email</label>
                    <input type="email" value='<?php echo $data['email'] ?>' name='email' class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <?php include 'include/footer.php'; ?>
</body>
</html>