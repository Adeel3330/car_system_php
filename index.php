<?php
session_start();
// error_reporting(E_ALL);
if(isset($_POST['submit']))
{
   
    include_once 'include/curl.php';
    $url = "ajaxcontroller/login.php";
    $error = CurlApi($url,$_POST);
    // var_dump($error);exit;
    if($error['status'] == 0)
    {
        $_SESSION['token'] = $error['token'];
        $_SESSION['id'] = $error['id'];
        header("location:dashboard.php");
        exit;
    }
}
$title = "Login System";
include 'include/include.php';
?>

<section class="mt-5">
    <div class="container mt-5">
        <div class="row mt-5">
            <div class="col-md-6 m-auto _card">
            <?php
                if(isset($error['status']) && isset($error['msg']) && $error['status'] == 1)
                {
                    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">'.$error['msg'].' 
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                }
                ?>
                <div class="_card-header">
                    <h3>Login System</h3>
                </div>
                <form action="" method="POST">
                        <div class="form-group mb-3">
                            <label>Email</label>
                            <input type="email" name="email" id="email" placeholder="Enter email for login" value="" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Password</label>
                            <input type="password" name="password" id="password" placeholder="Enter password for login" class="form-control" value="" required>
                        </div>
                        <div class="form-group mb-3">
                            <button class="blue_btn" name="submit" >Login Now</button>
                        </div>
                        <hr>
                        <div class="form-group mt-2 mb-4">
                            <span>Dont have an account ?  <a href="signup.php" class="login-link">Singup Here</span>
                        </div>
                </form>
            </div>
        </div>
    </div>
</section>





<?php
include 'include/footer.php'
?>