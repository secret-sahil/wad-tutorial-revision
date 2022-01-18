<?php include 'include/header.php' ?>
<body>
    <script>
        function dele(id){
            if (confirm('Do you really want to delete!')){
                window.location.href="viewcform.php?delete=" + id;
            }
        }
    </script>
    <!-- nav bar start -->
    <?php include 'include/nav.php' ?>
    <!-- main start -->
    <div class="main">
        <div class="cftable">
            <p>All Forms</p>
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
                $query= $db->query('SELECT * FROM cform');                
                while ($data=$query->fetch()) { ?>
                    <tr>
                        <td><?php echo $data['id']; ?></td>
                        <td><?php echo $data['name']; ?></td>
                        <td><?php echo $data['email']; ?></td>
                        <td><?php echo $data['message']; ?></td>
                        <td><button class="btn btn-primary"><i class="fas fa-edit"></i></button>
                        <button onclick=dele(<?php echo $data['id']; ?>) class="btn btn-danger"><i class="fas fa-trash-alt"></i></button></td>
                    </tr>
                <?php } ?>
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
        $query= $db->prepare('DELETE FROM cform where id=:id');
        $query->execute(array(
            ':id'=>$_GET['delete']
        ));
        header('location:viewcform.php');
    }
?>