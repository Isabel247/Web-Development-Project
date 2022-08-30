<?php
session_start();
include('config.php');
include('includes/function.php');

$user_data = check_login($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>St. Josh Church</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="user-nav">
        <label for=""><a href="user-page.php">St. Josh Church</a></label>
        <ul>
            <li><a href="logout.php">Logout</a></li>
        </ul>
        <ul>
        <li>Hello <?php echo $user_data['username']?> !</li>
        </ul>
       
        
        
        </nav>
    <div id="downloads" class="request">
        <div class="content-left">
            <h1>Download Forms</h1>
            <p>You're application has been sent! <br>
            Please download the form that must be filled up and the application slip that will serve as proof of application. <br>
            </p>
            <?php
        include ('config.php');

        $query = "select MAX(user_id)as 'user' FROM `user_request`
        ";

         $result = mysqli_query($con, $query);

         while($row = $result->fetch_assoc()){
             ?>
            <a class="btns" href="user-page.php?user=<?php echo $row['user']?>" style="margin-bottom: 20px"><i class="fa fa-download"></i>Form</a>
            <a href="print.php?print=1" target="_blank" style="margin-bottom: 10px">Application Slip</a>
            <?php }?>
        </div>
        <div class="content-right">
            <img src="./images/sent.svg" alt="">
        </div>
    </div>
    
</body>
</html>