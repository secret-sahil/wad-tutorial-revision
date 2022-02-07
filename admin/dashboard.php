<?php
session_start();
include "include/header.php";
?>
<?php 
include "include/db.php";
// to count no of users
$query=$db->query('SELECT * from users');
$data=$query->fetchall();
$user_cont=sizeof($data);
// to count no of contact forms
$query=$db->query('SELECT * from cform');
$data=$query->fetchall();
$form_cont=sizeof($data);
// to count no of admins
$query=$db->query('SELECT * from admin');
$data=$query->fetchall();
$admin_cont=sizeof($data);
?>
<body>
<?php include "include/nav.php"; ?>
<div class="row">
  <div class="col-sm-6 col-lg-4">
    <div class="card">
        <a href="#">
            <div class="card-body">
                <h5 class="card-title">Total Contact Forms</h5>
                <p class="card-text"><?php echo $form_cont; ?></p>
            </div>
        </a>
    </div>
  </div>
  <div class="col-sm-6 col-lg-4">
    <div class="card">
        <a href="users.php">
            <div class="card-body">
                <h5 class="card-title">Total Users</h5>
                <p class="card-text"><?php echo $user_cont; ?></p>
            </div>
        </a>
    </div>
  </div>
  <div class="col-sm-6 col-lg-4">
    <div class="card">
        <a href="admin.php">
            <div class="card-body">
                <h5 class="card-title">Total Admins</h5>
                <p class="card-text"><?php echo $admin_cont; ?></p>
            </div>
        </a>
    </div>
  </div>
</div>
<?php include "include/footer.php"; ?>
</body>
</html>
