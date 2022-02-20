<?php include 'include/header.php';
session_start();
if (empty($_SESSION['admin'])) {
    header('location:index.php');
}
$msg= new ArrayObject(array());
require_once 'include/db.php';
$query=$db->prepare('SELECT * from users where id=?');
$edit=0;
if (isset($_POST['edit'])) {
    $edit=$_POST['edit'];
}
else{
    $edit=$_GET['edit'];
}
$query->execute(array(
    $edit
));
$data=$query->fetch();

if ($_SERVER['REQUEST_METHOD']==='POST') {
    if (empty($_POST['name']) or empty($_POST['email']) or empty($_POST['dob']) or empty($_POST['gender']) or empty($_POST['pwd']) or empty($_POST['cpwd'])) {
        $msg->append('All fields are required');
    }
    elseif ($_POST['pwd']!=$_POST['cpwd']) {
        $msg->append('Password do not match');
    }
    else {
        require_once 'include/db.php';
        $query= $db->prepare('UPDATE users SET name=?, email=?, dob=?, Gender=?, password=? where id=?');
        $query->execute(array(
            $_POST['name'],
            $_POST['email'],
            $_POST['dob'],
            $_POST['gender'],
            md5($_POST['pwd']),
            $_POST['edit'],
        ));
        $msg->append('User Updated');
        header('location:users.php?msg="User Updated Sucessfully"');
    }
}

?>
<body>
    <?php include 'include/nav.php' ?>
    <div class="main">
        <div class="myform">
        <p>Edit Profile</p>
            <form action="edit_users.php" method="POST">
                <input type="text" value="<?php echo $data['id'] ?>" hidden name='edit' class="form-control">
                <?php
                            for ($i=0; $i < sizeof($msg); $i++) {
                                if ($msg[$i]=='User Updated') { ?>
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
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Reset Password</label>
                    <input type="password"  name='pwd' class="form-control">
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Confirm Reset Password</label>
                    <input type="password"  name='cpwd' class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <?php include 'include/footer.php'; ?>
</body>
</html>