<?php
// error_reporting(E_ALL);
if(isset($_POST['submit']))
{
    include_once 'include/curl.php';
    $url = "ajaxcontroller/signup.php";
    $error = CurlApi($url,$_POST);
}
$title = "Signup System";
include 'include/include.php';
?>

<section class="mt-3">
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-6 m-auto _card">
                <?php
                if(isset($error['status']) && isset($error['msg']) && $error['status'] == 1)
                {
                    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">'.$error['msg'].' 
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                }
                else if(isset($error['status']) && isset($error['msg']) && $error['status'] == 0)
                {
                    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">'.$error['msg'].' 
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                }
                ?>
                <div class="_card-header">
                    <h3>Signup System</h3>
                </div>
                <form action="" method="POST">
                        <div class="form-group mb-3">
                            <label>First Name</label>
                            <input type="text" name="fname" id="fname" placeholder="Enter first name for signup" value="<?php if(isset($_POST['fname']) && $error['status'] == 1) { echo $_POST['fname']; } ?>" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Last Name</label>
                            <input type="text" name="lname" id="lname" placeholder="Enter last name for signup" value="<?php if(isset($_POST['lname']) && $error['status'] == 1) { echo $_POST['lname']; } ?>" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Email</label>
                            <input type="email" name="email" id="email" placeholder="Enter email for signup" value="<?php if(isset($_POST['email']) && $error['status'] == 1) { echo $_POST['email']; } ?>" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <button class="blue_btn" name="submit" >Create account</button>
                        </div>
                        <hr>
                        <div class="form-group mt-2 mb-4">
                            <span>Already have an account ?  <a href="index.php" class="login-link">Login here</span>
                        </div>
                </form>
            </div>
        </div>
    </div>
</section>





<?php
include 'include/footer.php'
?>