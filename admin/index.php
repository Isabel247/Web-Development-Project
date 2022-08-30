<?php
session_start();
error_reporting(0);
include('config.php');

//FOR LOGIN
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    if( !empty($username) && !empty($password))
    {
        $query = "select * from admin where username = '$username' limit 1";

        $result = mysqli_query($con, $query);

        if($result){
            if($result && mysqli_num_rows($result) > 0)
            {
                $user_data = mysqli_fetch_assoc($result);
                if($user_data['password'] === $password)
                {
                    $_SESSION['admin_id'] = $user_data['admin_id'];
                    header("location: request.php");
                    die;
                }
            }
        }

        echo "<script>alert('Invalid informations!')</script>";
    }else{
        echo "<script>alert('Please enter info!')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body class="login-body">
    <div class="login-box">
        <div class="inner-box">
            <div class="text-box">
                <div class="imgBx">
                    <img src="images/launch.svg" alt="">
                    <span>Login here</span>
                </div>
            </div>
            <form action="" class="login-form" method="POST">
            <div class="img-box">
                    <img src="images/bighead.svg" alt="">
                </div>
                <div class="input-box">
                    <input type="text" name="username" id="" placeholder="Username">
                </div>
                <div class="input-box">
                    <input type="password" name="password" id="" placeholder="Password">
                </div>
                <div class="button-box">
                    <button name="login">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>