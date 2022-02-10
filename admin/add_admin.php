<?php 
session_start();
if (empty($_SESSION['admin']) or ($_SESSION['id']!=1)) {
    header('location:index.php');
}
include 'include/header.php' ?>
<body>
<?php
$msg= new ArrayObject(array());
if ($_SERVER['REQUEST_METHOD']==='POST') {
    if (empty($_POST['username']) or empty($_POST['pwd']) or empty($_POST['cpwd'])) {
        $msg->append('All fierls are required');
    }
    elseif ($_POST['pwd']!=$_POST['cpwd']) {
        $msg->append('Password do not match');
    }
    else {
        require_once 'include/db.php';
        $query=$db->prepare('INSERT into admin(username, password) VALUES(?,?)');
        $query->execute(array(
            $_POST['username'],
            md5($_POST['pwd'])
        ));
        $msg->append('New Admin Account Added Sucessfully');
    }
}
?>
<?php include 'include/nav.php' ?>
<div class="main">
    <div class="myform">
        <form action='add_admin.php' method='post'>
            <p>Add new admin account</p>
            <?php
                for ($i=0; $i < sizeof($msg); $i++) {
                    if ($msg[$i]=='New Admin Account Added Sucessfully') { ?>
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
                <label class="input-group-text" for="inputGroupSelect01">Username</label>
                <input type="text"  name='username' class="form-control">
            </div>
            <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01">Password</label>
                <input type="password"  name='pwd' class="form-control">
            </div>
            <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01">Confirm Pasword</label>
                <input type="password"  name='cpwd' class="form-control">
            </div>
            <button type='submit' class='btn btn-primary'>Submit</button>
        </from>
    </div>
</div>
<?php include 'include/footer.php' ?>
</body>
</html>