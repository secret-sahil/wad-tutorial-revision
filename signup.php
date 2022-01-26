<?php 
include "include/header.php";
?>
	<body>
    <?php  include "include/nav.php"; ?>
    <div class="main">
        <div class="myform">
            <form action="signup_process.php" method="post">
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Full Name</label>
                    <input type="text" name='fullname' class="form-control">
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Gender</label>
                    <select class="form-select" name="gender">
                        <option value="1" selected>Male</option>
                        <option value="2">Female</option>
                        <option value="3">Other</option>
                    </select>
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Date of Birth</label>
                    <input type="date" name="dob" class="form-control" >
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Email</label>
                    <input type="email" name='email' class="form-control">
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Password</label>
                    <input type="password" name='pwd' class="form-control" >
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Confirm Password</label>
                    <input type="password" name='cpwd' class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <?php  include "include/footer.php"; ?>
	</body>
</html>

