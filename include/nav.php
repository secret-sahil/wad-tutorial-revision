<div class="nav-bar">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                   WAD
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="./">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="aboutus.php">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="contactus.php">Contact Us</a>
                            
                        </li>
                        <?php 
                        if (isset($_SESSION['username'])) {?>
                            <li class="nav-item">
                                <a class="nav-link active" href="viewcform.php">View Contact Form</a>
                            </li>
                        <?php }?>
                    </ul>
                    <?php 
                    if (empty($_SESSION['username'])) {?>
                        <a href="signup.php"><button class="btn btn-outline-primary" type="submit"><i class="fas fa-user-plus"></i></button></a>
                        <a href="signin.php"><button class="btn btn-outline-success" type="submit"><i class="fas fa-sign-in-alt"></i></button></a>
                    <?php } ?>
                    <?php 
                    if (isset($_SESSION['username'])) {?>
                        <a href="logout.php"><button class="btn btn-outline-danger" type="submit"><i class="fas fa-sign-out-alt"></i></button></a>
                    <?php } ?>
                </div>
            </div>
        </nav>
    </div>