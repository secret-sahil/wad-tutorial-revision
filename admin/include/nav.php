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
                        <?php 
                        if (isset($_SESSION['admin'])) {?>
                            <li class="nav-item">
                                <a class="nav-link active" href="./">Dashboard</a>
                            </li>
                        <?php }?>
                        <?php 
                        if (isset($_SESSION['admin'])) {?>
                            <li class="nav-item">
                                <a class="nav-link active" href="users.php">View Users</a>
                            </li>
                        <?php }?>
                        <?php 
                        if (isset($_SESSION['admin'])) {?>
                            <li class="nav-item">
                                <a class="nav-link active" href="admin.php">View admin</a>
                            </li>
                        <?php }?>
                        <?php 
                        if (isset($_SESSION['admin'])) {?>
                            <li class="nav-item">
                                <a class="nav-link active" href="changepwd.php">Change Password</a>
                            </li>
                        <?php }?>
                    </ul>
                    <?php 
                    if (isset($_SESSION['admin'])) {?>
                        <a href="logout.php"><button class="btn btn-outline-danger" type="submit"><i class="fas fa-sign-out-alt"></i></button></a>
                    <?php } ?>
                </div>
            </div>
        </nav>
    </div>