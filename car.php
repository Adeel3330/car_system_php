<?php
session_start();
include_once 'include/curl.php';
if(isset($_GET['delete']) && $_GET['id'] > 0)
{
    $url = "ajaxcontroller/getrecords.php?purpose=deletecar&id=".$_GET['id'];
}
else
{
$url = "ajaxcontroller/getrecords.php?purpose=getcars";
}
$cars = CurlApiget($url,false);

$title = "Cars";
include 'include/include.php';
include 'include/header.php';
$data = checktoken($_SESSION['token'],$_SESSION['id']);
if(isset($_GET['delete']) && $cars['status'])
{
        $_SESSION['status'] = $cars['status'];
        $_SESSION['msg'] = $cars['msg'];
        header("location:car.php");
}
// var_dump($_SESSION);exit;

?>

<section class="mt-5">
    <div class="container mt-5">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="_card">
                <?php
                if(isset($_SESSION['status']) && isset($_SESSION['msg']) && $_SESSION['status'] == 2)
                {
                    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">'.$_SESSION['msg'].' 
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                    // unset($_SESSION['msg']);
                    // unset($_SESSION['status']);
                }
                else if(isset($_SESSION['status']) && isset($_SESSION['msg']) && $_SESSION['status'] == 3)
                {
                    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">'.$_SESSION['msg'].' 
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                            
                    
                }
                ?>
                <div class="d-flex mb-4">
                    <a href="create_car.php" class="btn btn-primary ms-auto" >Create Car</a href="category_post.php">
                </div>
                    <div class="table-responsive">
                        <table class="table table-hovered" id="datatable">
                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Car Name</td>
                                    <td>Car Category</td>
                                    <td>Color</td>
                                    <td>Model</td>
                                    <td>Registration No</td>
                                    <td>Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if(isset($cars['status']) && $cars['status'] == 0)
                                {
                                    echo '<tr><td colspan="7">No Records found</td></tr>';
                                }
                                else if(isset($cars['status']) && $cars['status'] == 1)
                                {
                                    echo '<tr><td colspan="7">'.$cars['msg'].'</td></tr>';
                                }
                                else
                                {
                                    foreach($cars as $car)
                                    {
                                        // var_dump($car['status']);exit;
                                ?>
                                <tr>
                                    <td><?php echo $car['id'] ?></td>
                                    <td width="4"><?php echo $car['name'] ?></td>
                                    <td><?php echo $car['car_categories'] ?></td>
                                    <td width="4"><?php echo $car['color'] ?></td>
                                    <td width="4"><?php echo $car['model'] ?></td>
                                    <td><?php echo $car['registration_no'] ?></td>
                                    <td><a href="create_car.php?id=<?php echo $car['id'] ?>" class="btn btn-small rounded-circle btn-primary"><i class="fa fa-edit"></i></a>  <a href="car.php?delete=true&id=<?php echo $car['id'] ?>" class="btn btn-small rounded-circle btn-danger"><i class="fa fa-trash"></i></a></td>
                                    <!-- <td></td> -->
                                </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
                
        </div>
    </div>
</section>





<?php
include 'include/footer.php';



unset($_SESSION['msg']);
unset($_SESSION['status']);
?>