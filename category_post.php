<?php
session_start();

include_once 'include/curl.php';
if(isset($_POST['submit']))
{
    if(isset($_GET['id']) && $_GET['id'] > 0)
{
    $url = "ajaxcontroller/category_post.php?purpose=update&id=".$_GET['id'];
}
else
{
$url = "ajaxcontroller/category_post.php?purpose=insert";
}
// session_start();
$categories = CurlApi($url,$_POST);
// var_dump($categories);exit;
if($categories['status'] != 1)
{
    $_SESSION['msg'] = $categories['msg'];
    $_SESSION['status'] = $categories['status'];
    header("location:categories.php");
}

// var_dump($_SESSION);exit;
}
if(isset($_GET['id']) && $_GET['id'] > 0)
{
$url2 = "ajaxcontroller/getrecords.php?purpose=get_single_category&id=".$_GET['id'];
$getsingle = CurlApiget($url2);
// var_dump($getsingle[0]['name']);exit;
$title = "Update Category";
if(isset($getsingle['msg']))
{
    $_SESSION['msg'] = $getsingle['msg'];
    $_SESSION['status'] = $getsingle['status'];
    header("location:categories.php");
}
}
else
{
    $title = "Create Category";
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
                            <label>Category Name</label>
                            <input type="text" name="name" id="name" placeholder="Enter first name for signup" value="<?php if(isset($getsingle[0]['name'])) { echo $getsingle[0]['name']; } ?>" class="form-control" required>
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