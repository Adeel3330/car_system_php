<?php
header("Access-Control-Allow-Origin: * ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include '../include/db.php';
include '../include/common.php';
// var_dump($_POST);exit;
if(!isset($_POST['token']) || !isset($_POST['uid']) )
{
    echo $error = json_encode(array('status'=>'1','msg'=>'Token is not valid'));
    exit;
}
$token = checktoken($_POST['token'],$_POST['uid']);
if($token != true)
{
     echo $error = json_encode(array('status'=>'1','msg'=>'Token is not valid'));
    exit;
}
else
{
    if(!isset($_POST['name']))
{
     echo json_encode($error = array('status'=>'1','msg'=>'Please Enter Category name'));
        exit;
}
else
{
    $name = mysqli_real_escape_string($db,htmlspecialchars($_POST['name']));
    if($_GET['purpose'] == "insert")
{
    // echo "SELECT * From categories WHERE name='".$_POST['name']."'";exit;
   $sel = mysqli_query($db,"SELECT * From categories WHERE name='".$name."' And status!='delete'");
   if(mysqli_num_rows($sel) > 0)
   {
       $error = array('status'=>'1','msg'=>'Category name already  exists');
   }
   else
   {
        $query = mysqli_query($db,"INSERT into categories (name,status) values('".$name."','active')");
        if($query)
        {
            $error = array('status'=>'3','msg'=>'Category Inserted');
        }
        else
        {
            $error = array('status'=>'2','msg'=>'Something Went Wrong');
        }
    }
}
else if($_GET['purpose'] == "update")
{
    if($_GET['id'] > 0)
    {
        $query = mysqli_query($db,"UPDATE categories SET name='".$name."'  where id ='".$_GET['id']."'");
        if($query)
        {
            $error = array('status'=>'3','msg'=>'Category Updated');
        }
        else
        {
            $error = array('status'=>'2','msg'=>'Something Went Wrong');
        }
    }
    else{
            $error = array('status'=>'2','msg'=>'Id Not valid');
    }
    
}
else
{
    $error = array('status'=>'2','msg'=>'Purpose Not found');
}

echo json_encode($error);exit;

}
}


?>