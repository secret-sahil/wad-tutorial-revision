<?php include 'include/header.php';
session_start();
if ($_SESSION['id']!=1) {
    header('location:index.php');
}
?>
<body>
<?php include 'include/nav.php'?>
<?php 
$msg= new ArrayObject(array());
require_once 'include/db.php';
$query=$db->prepare('SELECT * from admin where id=?');
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
if ($_SERVER['REQUEST_METHOD']=='POST') {
    if (empty($_POST['username']) or empty($_POST['pwd']) or empty($_POST['cpwd'])) {
        $msg->append('All fields are required');
    }
    elseif ($_POST['pwd']!=$_POST['cpwd']) {
        $msg->append('Password do not match');
    }
    else {
        require_once 'include/db.php';
        $query= $db->prepare('UPDATE admin SET username=?, password=? where id=?');
        $query->execute(array(
            $_POST['username'],
            md5($_POST['pwd']),
            $_POST['edit'],
        ));
        $msg->append('User Updated');
    }
}

?>
<div class="myform">
<form action="edit_admin.php" method="post">
    <input type="text" hidden value='<?php echo $data['id'];?>' name='edit' class="form-control">
    <p>Edit Admin</p>
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
        <label class="input-group-text" for="inputGroupSelect01">Username</label>
        <input type="text" value='<?php echo $data['username'];?>' name='username' class="form-control">
    </div>
    <div class="input-group mb-3">
        <label class="input-group-text" for="inputGroupSelect01">Reset Password</label>
        <input type="password" name='pwd' class="form-control" >
    </div>
    <div class="input-group mb-3">
        <label class="input-group-text" for="inputGroupSelect01">Confirm Reset Password</label>
        <input type="password" name='cpwd' class="form-control" >
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
<?php include 'include/footer.php'?>
</body>
</html>