<?php
header("Access-Control-Allow-Origin: * ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include '../include/db.php';
include '../include/common.php';
if(!isset($_POST['token']) || !isset($_POST['uid']) ){
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
     echo json_encode($error = array('status'=>'1','msg'=>'Please Enter Car name'));
        exit;
}
else if(!isset($_POST['model']))
{
     echo json_encode($error = array('status'=>'1','msg'=>'Please Enter car Model'));
        exit;
}
else if(!isset($_POST['color']))
{
     echo json_encode($error = array('status'=>'1','msg'=>'Please Enter car color'));
        exit;
}
else if(!isset($_POST['category']))
{
     echo json_encode($error = array('status'=>'1','msg'=>'Please Enter car category'));
        exit;
}
else
{
    
    $name = mysqli_real_escape_string($db,htmlspecialchars($_POST['name']));
    $model = mysqli_real_escape_string($db,htmlspecialchars($_POST['model']));
    $color = mysqli_real_escape_string($db,htmlspecialchars($_POST['color']));
    $category = mysqli_real_escape_string($db,htmlspecialchars($_POST['category']));
    if($category == "")
    {
        echo json_encode($error = array('status'=>'2','msg'=>'Token is not valid'));
        exit;
    }
    // $name = mysqli_real_escape_string($db,htmlspecialchars($_POST['name']));
    if($_GET['purpose'] == "insert")
{
    
    // echo "SELECT * From categories WHERE name='".$_POST['name']."'";exit;
   $sel = mysqli_query($db,"SELECT * From cars WHERE name='".$name."' And status!='delete'");
   if(mysqli_num_rows($sel) > 0)
   {
       $error = array('status'=>'1','msg'=>'Car name already  exists');
   }
   else
   {
        $sel = mysqli_query($db,"SELECT * FROM cars where status !='delete' order by id desc");
        if(mysqli_num_rows($sel) > 0)
        {
            $row = mysqli_fetch_array($sel);
            $reg_no = "REG_000".($row['id']+1);
        }
        else
        {
            $reg_no = "REG_0001";
        }
        $query = mysqli_query($db,"INSERT into cars (name,car_categories,color,model,registration_no,status) values('".$name."','".$category."','".$color."','".$model."','".$reg_no."','active')");
        if($query)
        {
            $error = array('status'=>'3','msg'=>'Car Inserted');
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
        $query = mysqli_query($db,"UPDATE cars SET name='".$name."',car_categories='".$category."',model='".$model."',color='".$color."'  where id ='".$_GET['id']."'");
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