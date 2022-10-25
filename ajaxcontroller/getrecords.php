<?php

// // var_dump($_SESSION);exit;
// $_SESSION['msg'] = "hello";
// $_SESSION['status'] = 1;
header("Access-Control-Allow-Origin: * ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include '../include/db.php';
include '../include/common.php';
include '../include/sendmail.php';
if(!isset($_POST['token']) || !isset($_POST['uid']) )
{
    echo $error = json_encode(array('status'=>'1','msg'=>'Token is not valid'));
    exit;
}
$token = checktoken($_GET['token'],$_GET['uid']);
if($token != true)
{
   
    echo $error = json_encode(array('status'=>'1','msg'=>'Token is not valid'));
    exit;
}
else
{
    if($_GET['purpose'] == "getcategories")
{
    $query = mysqli_query($db,"SELECT * from categories where status!='delete'");
    if(mysqli_num_rows($query) > 0)
    {
        while($row = mysqli_fetch_array($query))
        {
            $error[] = $row;
        }
    }
    else
    {
        $error = array('status'=>'0','msg'=>'No records found');
    }
}
else if($_GET['purpose'] == "deletecategories")
{
    if($_GET['id'] > 0)
    {
        $query = mysqli_query($db,"UPDATE categories SET status='delete'  where id ='".$_GET['id']."'");
        if($query)
        {
            $error = array('status'=>'3','msg'=>'Record Deleted');
        }
        else
        {
            $error = array('status'=>'2','msg'=>'Something Went Wrong');
        }
    }
    else{

    }
    
}
else if ($_GET['purpose'] == "get_single_category")
{
    $query = mysqli_query($db,"SELECT * from categories where status!='delete' and id='".$_GET['id']."'");
    if(mysqli_num_rows($query) > 0)
    {
        while($row = mysqli_fetch_array($query))
        {
            $error[] = $row;
        }
    }
    else
    {
        $error = array('status'=>'0','msg'=>'No records found');
    }
}
if($_GET['purpose'] == "getcars")
{
    $query = mysqli_query($db,"SELECT * from cars where status!='delete'");
    if(mysqli_num_rows($query) > 0)
    {
        while($row = mysqli_fetch_array($query))
        {
            $error[] = $row;
        }
    }
    else
    {
        $error = array('status'=>'0','msg'=>'No records found');
    }
}


if($_GET['purpose'] == "getusers")
{
    $query = mysqli_query($db,"SELECT * from users where status!='delete'");
    if(mysqli_num_rows($query) > 0)
    {
        while($row = mysqli_fetch_array($query))
        {
            $error[] = $row;
        }
    }
    else
    {
        $error = array('status'=>'0','msg'=>'No records found');
    }
}


else if ($_GET['purpose'] == "get_single_car")
{
    $query = mysqli_query($db,"SELECT * from cars where status!='delete' and id='".$_GET['id']."'");
    if(mysqli_num_rows($query) > 0)
    {
        while($row = mysqli_fetch_array($query))
        {
            $error[] = $row;
        }
    }
    else
    {
        $error = array('status'=>'0','msg'=>'No records found');
    }
}
else if($_GET['purpose'] == "deletecar")
{
    if($_GET['id'] > 0)
    {
        $query = mysqli_query($db,"UPDATE cars SET status='delete'  where id ='".$_GET['id']."'");
        if($query)
        {
            $error = array('status'=>'3','msg'=>'Record Deleted');
        }
        else
        {
            $error = array('status'=>'2','msg'=>'Something Went Wrong');
        }
    }
    else{
        $error = array('status'=>'2','msg'=>'Id not valid');
    }
    
}
else
{
    $error = array('status'=>'2','msg'=>'Purpose Not found');
}

echo json_encode($error);exit;
}


?>