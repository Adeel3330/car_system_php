<?php
session_start();
header("Access-Control-Allow-Origin: * ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include '../include/db.php';
include '../include/common.php';
include '../include/sendmail.php';
if(!isset($_POST['password']))
{
     echo json_encode($error = array('status'=>'1','msg'=>'Please Enter Password'));
        exit;
}
else if(!isset($_POST['email']))
{
     echo json_encode($error = array('status'=>'1','msg'=>'Please Enter email'));
        exit;
}
else
{
$email = $_POST['email'];
$password = $_POST['password'];
$query = mysqli_query($db,"SELECT * from users where email='".$email."'");
if(mysqli_num_rows($query) == 1)
{
    $row = mysqli_fetch_array($query);
    if(password_verify($password,$row['user_password'])){
        $token = password_generate(30);
        $query = mysqli_query($db,"SELECT * from token where userid ='".$row['id']."'");
        if(mysqli_num_rows($query) == 0)
        {
            $ins = mysqli_query($db,"INSERT INTO token (userid,token,generated_date) values ('".$row['id']."','".$token."','".time()."')");
        }
        else{
            $ins = mysqli_query($db,"UPDATE token SET token = '".$token."',generated_date='".time()."' WHERE userid='".$row['id']."'");
           
        }
            if($ins)
            {
                $error = array('status'=>'0','msg'=>'Login Success','token'=>$token,'id'=>$row['id']);
            }
            else
            {
                $error = array('status'=>'1','msg'=>'Token not generated');
            }
        
        
    }
    else
    {
        $error = array('status'=>'1','msg'=>'Password not verified');
    }
}
else
{
    $error = array('status'=>'1','msg'=>'Email is invalid');
    
}
// var_dump($_SESSION);
echo json_encode($error);
}
?>