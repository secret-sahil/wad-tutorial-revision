<?php 
session_start();
if (empty($_SESSION['admin']) or ($_SESSION['id']!=1)) {
    header('location:index.php');
}
include 'include/header.php' ?>
<body>
<?php include 'include/nav.php' ?>
<?php include 'include/footer.php' ?>
</body>
</html>