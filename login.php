<?php
session_start();
error_reporting(0);
include('config.php');


//FOR USER REGISTRATION
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $mobile = $_POST['mobile-num'];
    $password = $_POST['password'];

    if(!empty($name) && !empty($email) && !empty($username) && !empty($mobile) && !empty($password))
    {
        $query = "insert into user_registration( name, email, phone_no, username, password) values ('$name', '$email', '$mobile', '$username', '$password')";

        mysqli_query($con, $query);
        
       header("location: login.php");
       die;
    }else{
        echo "<script>alert('Please enter info!')</script>";
    }
}
//FOR USER LOGIN
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    if( !empty($username) && !empty($password))
    {
        $query = "select * from user_registration where username = '$username' limit 1";

        $result = mysqli_query($con, $query);

        if($result){
            if($result && mysqli_num_rows($result) > 0)
            {
                $user_data = mysqli_fetch_assoc($result);
                if($user_data['password'] === $password)
                {
                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("location: user-page.php");
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
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <title>Login</title>
</head>
<body>
    <section class="login-sec">
    <div class="form-container">
        <div class="user signinBx">
            <div class="imgBx">
                <img src="./images/ch.jpg" alt="">
            </div>
            <div class="formBx">
                <form action="" method="POST">
                    <h2>sign in</h2>
                    <input type="text" name="username" placeholder="Username">
                    <input type="password" name="password" placeholder="Password">
                    <input type="submit" name="login" value="Login" id="login">
                    <p class="signup">Don't have an account? <a href="#" onclick="toggleForm()">Sign Up.</a></p>
                </form>
            </div>
        </div>
        <div class="user signupBx">
            <div class="formBx">
                <form action="" method="POST">
                    <h2>create an account</h2>
                    <input type="text" name="fullname" id="fullname" placeholder="Full Name" required>
                    <input type="text" name="username" id="username" placeholder="Username" required>
                    <input type="email" name="email"  id="email" placeholder="Email Address" required>
                    <input type="password" name="password" id="password"  placeholder="Password" required>
                    <input type="text" name="mobile-num" id="mobile-num" placeholder="Mobile Number" required>
                
                    <input type="submit" name="submit" id="submit" value="Register">
                    <p class="signup">already have an account? <a href="#" onclick="toggleForm()">Sign in.</a></p>
                </form>
            </div>
            <div class="imgBx">
                <img src="./images/mass.jpg" alt="">
            </div>
        </div>
    </div>
    </section>

    


    <script type="text/javascript">
        function toggleForm(){
            var container = document.querySelector('.form-container');
            container.classList.toggle('active');
        }
    </script>
</body>
</html>