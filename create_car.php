<?php
session_start();

include_once 'include/curl.php';
$url = "ajaxcontroller/getrecords.php?purpose=getcategories";
$categories = CurlApiget($url,false);
// var_dump($categories);exit;
if(isset($_POST['submit']))
{
    if(isset($_GET['id']) && $_GET['id'] > 0)
{
    $url = "ajaxcontroller/car_post.php?purpose=update&id=".$_GET['id'];
}
else
{
$url = "ajaxcontroller/car_post.php?purpose=insert";
}
// session_start();
$cars = CurlApi($url,$_POST);
// var_dump($cars);exit;
if($cars['status'] != 1)
{
    $_SESSION['msg'] = $cars['msg'];
    $_SESSION['status'] = $cars['status'];
    header("location:car.php");
}

// var_dump($_SESSION);exit;
}
if(isset($_GET['id']) && $_GET['id'] > 0)
{
$url2 = "ajaxcontroller/getrecords.php?purpose=get_single_car&id=".$_GET['id'];
$getsingle = CurlApiget($url2);
// var_dump($getsingle[0]['name']);exit;
$title = "Update Car";
if(isset($getsingle['msg']))
{
    $_SESSION['msg'] = $getsingle['msg'];
    $_SESSION['status'] = $getsingle['status'];
    header("location:categories.php");
}
}
else
{
   
    $title = "Create Car";
}
include 'include/include.php';
include 'include/header.php';
$data = checktoken($_SESSION['token'],$_SESSION['id']);
if($data != true)
{
    // header("location:index.php");
}

?>
<section class="mt-3">
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-6 m-auto _card">
                <?php
                if(isset($categories['status']) && isset($categories['msg']) && $categories['status'] == 1)
                {
                    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">'.$categories['msg'].' 
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                }
                else if(isset($categories['status']) && isset($categories['msg']) && $categories['status'] == 0)
                {
                    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">'.$categories['msg'].' 
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                }
                ?>
                <div class="_card-header">
                    <h3><?php echo $title ?></h3>
                </div>
                <form action="" method="POST">
                <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" required>
                <input type="hidden" name="uid" value="<?php echo $_SESSION['id']; ?>" required>
                        <div class="form-group mb-3">
                            <label>Category</label>
                            <select class="form-control" name="category">
                                <?php
                                foreach($categories as $category)
                                {
                                    echo "<option value='".$category['name']."' ".(($getsingle[0]['car_categories'] == $category['name'])?"selected":'').">".$category['name']."</option>";
                                }
                                if(isset($categories['status']) && $categories['status'] == 0)
                                {
                                    echo '<option value=""></option>';
                                }
                                ?>

                            </select>   
                        </div>
                        <div class="form-group mb-3">
                            <label>Car Name</label>
                            <input type="text" name="name" id="name" placeholder="Enter car name" value="<?php if(isset($getsingle[0]['name'])) { echo $getsingle[0]['name']; } ?>" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Model</label>
                            <input type="text" name="model" id="model" placeholder="Enter car model"value="<?php if(isset($getsingle[0]['model'])) { echo $getsingle[0]['model']; } ?>" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Color</label>
                            <input type="text" name="color" id="color" placeholder="Enter car color" value="<?php if(isset($getsingle[0]['color'])) { echo $getsingle[0]['color']; } ?>" class="form-control" required>
                        </div>
                        <div  class="form-group mb-3">
                            <button class="blue_btn" name="submit"><?php echo $title ?></button>
                        </div>
                        <!-- <hr> -->
                       
                </form>
            </div>
        </div>
    </div>
</section>





<?php
include 'include/footer.php'
?>