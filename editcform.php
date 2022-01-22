<?php include 'include/header.php' ?>
<?php include 'include/nav.php' ?>
<?php 
require_once "include/db.php";
$query= $db->prepare('SELECT * from cform where id=:id');
$query->execute(array(
    ':id'=>$_GET['edit']
));
$data= $query->fetch();
?>
<div class="main">
        <div class="myform">
        <form action="editcform_process.php" method="get">
                <p class="formhead">YOUR QUERY:</p>
                <input name='id' value="<?php echo $_GET['edit']; ?>" hidden>
                <?php if (isset($_GET['sucess'])) { ?>
                    <p>Submitted Successfully!</p>
                <?php } ?>
                <?php if (isset($_GET['error'])) { ?>
                    <p class="error">All fields are required!</p>
                <?php } ?>
                <div class="mb-3">
                    <input type="text" value="<?php echo $data[1]; ?>" class="form-control" name="name" placeholder="Name*">
                </div>
                <div class="mb-3">
                    <input type="email" value="<?php echo $data[2]; ?>" class="form-control" name="mail"  placeholder="Email*">
                </div>
                <div class="mb-3">
                    <textarea class="form-control" name="msg" placeholder="Enter Message" rows="3"><?php echo $data[3]; ?></textarea>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
</div>


<?php include 'include/footer.php' ?> 