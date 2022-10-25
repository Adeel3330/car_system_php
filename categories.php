<?php
session_start();
include_once 'include/curl.php';
if(isset($_GET['delete']) && $_GET['id'] > 0)
{
    $url = "ajaxcontroller/getrecords.php?purpose=deletecategories&id=".$_GET['id'];
}
else
{
$url = "ajaxcontroller/getrecords.php?purpose=getcategories";
}
$categories = CurlApiget($url,false);

$title = "Categories";
include 'include/include.php';
include 'include/header.php';
$data = checktoken($_SESSION['token'],$_SESSION['id']);
if(isset($_GET['delete']) && $categories['status'])
{
        $_SESSION['status'] = $categories['status'];
        $_SESSION['msg'] = $categories['msg'];
        header("location:categories.php");
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
                    <a href="category_post.php" class="btn btn-primary ms-auto" >Create Category</a href="category_post.php">
                </div>
                    <!-- <div class="table-responsive"> -->
                        <table class="table table-hovered" id="datatable">
                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Categories Name</td>
                                    <td>status</td>
                                    <td>Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if(isset($categories['status']) && $categories['status'] == 0)
                                {
                                    echo '<tr><td colspan="4">No Records found</td></tr>';
                                }
                                else if(isset($categories['status']) && $categories['status'] == 1)
                                {
                                    echo '<tr><td colspan="4">'.$categories['msg'].'</td></tr>';
                                }
                                else
                                {
                                    foreach($categories as $category)
                                    {
                                        // var_dump($category['status']);exit;
                                ?>
                                <tr>
                                    <td><?php echo $category['id'] ?></td>
                                    <td><?php echo $category['name'] ?></td>
                                    <td><span class="badge bg-primary"><?php echo $category['status'] ?></span></td>
                                    <td><a href="category_post.php?id=<?php echo $category['id'] ?>" class="btn btn-small rounded-circle btn-primary"><i class="fa fa-edit"></i></a>  <a href="categories.php?delete=true&id=<?php echo $category['id'] ?>" class="btn btn-small rounded-circle btn-danger"><i class="fa fa-trash"></i></a></td>
                                    <!-- <td></td> -->
                                </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    <!-- </div> -->
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