<?php include 'include/header.php';
session_start();
if (empty($_SESSION['admin'])) {
    header('location:index.php');
}
$msg= new ArrayObject(array());
require_once 'include/db.php';
$query=$db->prepare('SELECT * from users where id=?');
$query->execute(array(
    $_GET['edit']
));
$data=$query->fetch();

if ($_SERVER['REQUEST_METHOD']==='GET') {
    if (empty($_GET['name']) or empty($_GET['email']) or empty($_GET['dob']) or empty($_GET['gender']) or empty($_GET['pwd']) or empty($_GET['cpwd'])) {
        $msg->append('All fields are required');
    }
    elseif ($_GET['pwd']!=$_GET['cpwd']) {
        $msg->append('Password do not match');
    }
    else {
        require_once 'include/db.php';
        $query= $db->prepare('UPDATE users SET name=?, email=?, dob=?, Gender=?, password=? where id=?');
        $query->execute(array(
            $_GET['name'],
            $_GET['email'],
            $_GET['dob'],
            $_GET['gender'],
            md5($_GET['pwd']),
            $_GET['edit'],
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
            <form action="edit_users.php" method="GET">
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