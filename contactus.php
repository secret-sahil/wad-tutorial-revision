<?php
include "./include/header.php"; 
session_start();
?>
<body>
    <!-- Navigation Bar start from here -->
    <?php include "./include/nav.php" ?>
    <!-- Nav Bar ended -->
    <!-- Main start -->
    <div class="main">
        <div class="myform">
            <form action="cform_process.php" method="get">
                <p class="formhead">YOUR QUERY:</p>
                <?php if (isset($_GET['sucess'])) { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Submitted Sucessfully!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } ?>
                <?php if (isset($_GET['error'])) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        All fields are required!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } ?>
                <div class="mb-3">
                    <input type="text" class="form-control" name="name" placeholder="Name*">
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" name="mail"  placeholder="Email*">
                </div>
                <div class="mb-3">
                    <textarea class="form-control" name="msg" placeholder="Enter Message" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
    <!-- Footer start -->
    <?php include "./include/footer.php" ?>
</body>

</html>
