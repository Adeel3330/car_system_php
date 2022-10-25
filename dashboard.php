<?php
session_start();
// var_dump($_SESSION);exit;
include_once 'include/curl.php';
$url = "ajaxcontroller/getrecords.php?purpose=getcategories";
$categories = CurlApiget($url,false);
$url = "ajaxcontroller/getrecords.php?purpose=getcars";
$cars = CurlApiget($url,false);
$url = "ajaxcontroller/getrecords.php?purpose=getusers";
$users = CurlApiget($url,false);
$title = "Dashboard";
include 'include/include.php';
include 'include/header.php';
$data = checktoken($_SESSION['token'],$_SESSION['id']);
if($data != true)
{
    header("location:index.php");
}

?>

<section class="mt-5">
    <div class="container mt-5">
        <div class="row mt-5">
            <div class="col-md-4 text-center">
                <div class="_card">
                    <div class="card-header">
                        <h5>Registered Cars</h5>
                        <div class="text">
                            <span><?php if(count($cars) > 0) { echo count($cars); } else { echo 0; } ?></span>
                        </div>
                    </div>
                </div>
                    
            </div>
            <div class="col-md-4 text-center">
                <div class="_card">
                    <div class="card-header">
                        <h5>Registered Categories</h5>
                        <div class="text">
                        <span><?php if(count($categories) > 0) { echo count($categories); } else { echo 0; } ?></span>

                        </div>
                    </div>
                </div>
                    
            </div>
            <div class="col-md-4 text-center">
                <div class="_card">
                    <div class="card-header">
                        <h5>Registered Users</h5>
                        <div class="text">
                        <span><?php if(count($users) > 0) { echo count($users); } else { echo 0; } ?></span>

                        </div>
                    </div>
                </div>
                    
            </div>
        </div>
    </div>
</section>





<?php
include 'include/footer.php'
?>