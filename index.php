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
        <img class="img-fluid" src="./assets/img/featued-image.jpg" alt="featured image">
        <div class="card">
            <div class="card-header">
                Quote
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <p>For the things we have to learn before we can do them, we learn by doing them.</p>
                    <footer class="blockquote-footer">Someone famous no <cite title="Source Title">Google</cite>
                    </footer>
                </blockquote>
            </div>
        </div>
    </div>
    <!-- Footer start -->
    <?php include "./include/footer.php" ?>
</body>

</html>