<?php
session_start();
if ($_SESSION['email']!='admin@mrsahil.in') {
    header('location:viewcform.php');
}
include "./include/header.php"; 
include "./include/db.php";
$query=$db->prepare('SELECT * from cform where id=?');
$query->execute(array(
    $_GET['edit']
));
$data=$query->fetch();
?>
<body>
    <!-- Navigation Bar start from here -->
    <?php include "./include/nav.php" ?>
    <!-- Nav Bar ended -->
    <!-- Main start -->
    <div class="main">
        <div class="myform">
            <form action="editform_process.php" method="get">
                <p class="formhead">Edit Contact Form:</p>
                <?php if (isset($_GET['error'])) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        All fields are required!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } ?>
                <input name="edit" hidden value='<?php echo $data['id'] ?>'>
                <div class="mb-3">
                    <input type="text" value="<?php echo $data['name'] ?>" class="form-control" name="name" placeholder="Name*">
                </div>
                <div class="mb-3">
                    <input type="email" value="<?php echo $data['email'] ?>" class="form-control" name="mail"  placeholder="Email*">
                </div>
                <div class="mb-3">
                    <textarea class="form-control" name="msg" placeholder="Enter Message" rows="3"><?php echo $data['message'] ?></textarea>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
    <!-- Footer start -->
    <?php include "./include/footer.php" ?>
</body>

</html>
