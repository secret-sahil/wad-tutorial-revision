<?php 
session_start();
if (empty($_SESSION['username'])) {
    header('location:signin.php');
}
include 'include/header.php' ?>
<body>
<script>
    function del(id) {
        if (confirm('Do you really want to delete?')) {
            window.location.href='viewcform.php?delete='+id;
        }
        
    }
    function edit(id) {
        window.location.href='editcform.php?edit='+id;
    }
</script>
    <!-- nav bar start -->
    <?php include 'include/nav.php' ?>
    <!-- main start -->
    <div class="main">
        <div class="cftable">
            <span><?php echo 'Welcome '.$_SESSION['username'].' !'; ?></span>
            <p>All Forms</p>
            <?php if (isset($_GET['sucess'])) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Updated Successfully!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Action</th> 
                    
                </tr>
                <?php 
                require_once 'include/db.php';
                $sno=1;
                $query= $db->query('SELECT * FROM cform');                
                while ($data=$query->fetch()) { ?>
                    <tr>
                        <td><?php echo $sno; ?></td>
                        <td><?php echo $data['name']; ?></td>
                        <td><?php echo $data['email']; ?></td>
                        <td><?php echo $data['message']; ?></td>
                        <td><button onclick=edit(<?php echo $data['id']; ?>) class="btn btn-primary"><i class="fas fa-edit"></i></button>
                        <button onclick=del(<?php echo $data['id']; ?>) class="btn btn-danger"><i class="fas fa-trash-alt"></i></button></td>
                    </tr>
                <?php $sno=$sno+1;} ?>
            </table>
        </div>
    </div>
    <!-- footer start -->
    <?php include 'include/footer.php' ?> 
</body>
</html>
<?php
    if (isset($_GET['delete'])) {
        require_once 'include/db.php';
        $query=$db->prepare('DELETE from cform where id=?');
        $query->execute(array($_GET['delete']));
        header('location:viewcform.php');
    }
?>