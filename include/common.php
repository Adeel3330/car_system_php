<?php
// session_start();
include_once 'db.php';
function password_generate($chars) 
{
  $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
  return substr(str_shuffle($data), 0, $chars);
}

function checktoken($token,$uid)
{
    global $db;
    $query = mysqli_query($db,"SELECT * from token where userid='".$uid."' AND token='".$token."'");
    if(mysqli_num_rows($query) == 1)
    {
        $row = mysqli_fetch_array($query);
        $previous = $row['generated_date'];
        $current = time();
        $totalSeconds = abs($current-$previous);
        if($totalSeconds > 86400)
        {
            return array('status'=>"0");
        }
        else
        {
            return true;
        }
        // return true;
    }
    else
    {
        // return "hello";
        return false;
    }
}

function getusername(){
    global $db;
    $query = mysqli_query($db,"SELECT * from users where id='".$_SESSION['id']."' and status !='delete'");
    if(mysqli_num_rows($query) > 0)
    {
        $row = mysqli_fetch_array($query);
       return $username = $row['firstname'].$row['lastname'];
    }
}
?>