<?php 
session_start();
if (empty($_SESSION['admin'])) {
    header('location:index.php');
}
include 'include/header.php' ?>
<body>
<script>
    function del(id) {
        if (confirm('Do you really want to delete?')) {
            window.location.href='users.php?delete='+id;
        }
        
    }
    function edit(id) {
        window.location.href='edit_users.php?edit='+id;
    }
</script>
    <!-- nav bar start -->
    <?php include 'include/nav.php' ?>
    <!-- main start -->
    <div class="main">
        <div class="cftable">
            <p>All Users</p>
            <?php if (isset($_GET['msg'])) { ?>
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
                    <th>DOB</th>
                    <th>Gender</th>
                    <th>Action</th> 
                    
                </tr>
                <?php 
                require_once 'include/db.php';
                $sno=1;
                $query= $db->query('SELECT * FROM users');                
                while ($data=$query->fetch()) { ?>
                    <tr>
                        <td><?php echo $sno; ?></td>
                        <td><?php echo $data['name']; ?></td>
                        <td><?php echo $data['email']; ?></td>
                        <td><?php echo $data['dob']; ?></td>
                        <td>
                            <?php 
                            if ($data['gender']==1) {
                                echo 'Male';
                            }
                            elseif ($data['gender']==2) {
                                echo 'Female';
                            }
                            else{
                                echo 'Other';
                            }
                            ?>
                        </td>
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
        $query=$db->prepare('DELETE from users where id=?');
        $query->execute(array($_GET['delete']));
        header('location:users.php');
    }
?>