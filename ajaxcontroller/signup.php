<?php
header("Access-Control-Allow-Origin: * ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include '../include/db.php';
include '../include/common.php';
include '../include/sendmail.php';
// var_dump($_POST);exit;
if(!isset($_POST['fname']))
{
     echo json_encode($error = array('status'=>'1','msg'=>'Please Enter first name'));
        exit;
}
else if(!isset($_POST['lname']))
{
     echo json_encode($error = array('status'=>'1','msg'=>'Please Enter last name'));
        exit;
}
else if(!isset($_POST['email']))
{
     echo json_encode($error = array('status'=>'1','msg'=>'Please Enter email'));
        exit;
}
else
{
$fname = mysqli_real_escape_string($db,htmlspecialchars($_POST['fname']));
$lname = mysqli_real_escape_string($db,htmlspecialchars($_POST['lname']));
$email = mysqli_real_escape_string($db,htmlspecialchars($_POST['email']));
$sel = mysqli_query($db,"SELECT * from users where email='".$email."' AND status != 'delete'");
if(mysqli_num_rows($sel) > 0)
{
    echo json_encode($error = array('status'=>'1','msg'=>'Email Already Exists'));
    exit;
}
else
{
    $insert = "INSERT INTO users(firstname,lastname,email,status) values('$fname','$lname','$email','verify')";
    $query = mysqli_query($db,$insert);
    if($query)
    {
        $pass = password_generate(7);
        $emailSend = SendMail($email,"For Signup Success","Your Password for Login is ".$pass);
        if($emailSend['code'] == 1)
        {
            $password = password_hash($pass,PASSWORD_DEFAULT);
            $query = mysqli_query($db,"UPDATE users set user_password='".$password."' WHERE email='".$email."'");
            if($query)
            {
                echo json_encode($error = array('status'=>'0','msg'=>'User Create Successfully'));
                exit;
            }
            else
            {
                echo json_encode($error = array('status'=>'1','msg'=>'Something went wrong'));
                exit;
            }
        }
        else
        {
            echo json_encode($error = array('status'=>'1','msg'=>$emailSend['message']));
            exit;
        }
        
    }
    else
    {
        echo json_encode($error = array('status'=>'1','msg'=>'Something went wrong'));
        exit;
    }
}
}
?>