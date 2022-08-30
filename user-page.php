<?php
session_start();
include('config.php');
include('includes/function.php');

$user_data = check_login($con);

if(isset($_POST['submit'])){
    $event_id = $_POST['events_req'];
    $prefer_time = $_POST['pre-time'];
    $alter_time = $_POST['alt-time'];
    $status = "process";
    $id = $_POST['id'];
    $app_id = random_num(20);
    $query=mysqli_query($con,"insert into `user_request`( `user_id`, `event_id`, `pre_time`, `alt_time`, `stat`, `application_id`) values('$id','$event_id','$prefer_time','$alter_time','$status','$app_id')");
if($query)
{
 echo "<script>alert('Post successfully added')</script>";
 header("location: download.php");
}
else{
    echo "<script>alert('Something went wrong . Please try again.')</script>";   
} 
}

$id = 0;
$user= 0;
$update = false;
$name = '';
$desc = '';
$position = '';
$loc = '';
if(isset($_GET['user'])){
    $user = $_GET['user'];
    $query = "select event_request.avail_file FROM event_request, user_request,user_registration WHERE event_request.event_id = user_request.event_id AND user_registration.user_id = user_request.user_id and user_request.request_id = (SELECT MAX(request_id) FROM user_request WHERE user_request.user_id = $user)";
    $result = mysqli_query($con, $query);
    $file = mysqli_fetch_assoc($result);
    $filePath = 'admin/files/'.$file['avail_file'];

    if(file_exists($filePath)){
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename = '.basename($filePath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length:' .filesize('files/'.$file['avail_file']));
        readfile('files/'.$file['avail_file']);
        exit;
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>St. Josh Church</title>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<nav class="user-nav">
<label for=""><a href="#">St. Josh Church</a></label>
<ul>
    
    <li><a href="logout.php">Logout</a></li>
</ul>
<ul>
<li>Hello <?php echo $user_data['username']?> !</li>
</ul>



</nav>
  

    
    <section class="form-req">
        <div class="request">
            <div class="content-left">
            <h1>Event Application</h1>
            <form class="form" action="" method="post">
            <div class="user-details">
                <div class="input-box">
                   <label for="">Select Event</label>
                    <select name="events_req">
                        <?php
                           include('config.php');

                           $query = mysqli_query($con, "select event_id, event_name from event_request");

                           //$result = mysql_query($query);

                           while($row=mysqli_fetch_array($query))
                           { ?>
                        <option value="<?php echo htmlentities($row['event_id']);?>"><?php echo htmlentities($row['event_name']);?></option>
                         <?php  } ?>
                        </select>
                        <div class="input-box">
                            <label for="">Preferred Time & Date</label>
                            <input type="datetime-local" name="pre-time" id="pre-time">
                        </div>
                        <div class="input-box">
                            <label for="">Alternative Time & Date</label>
                            <input type="datetime-local" name="alt-time" id="alt-time">
                        </div>
                        
                    </select>
                    
                    <input name="id" type="hidden" value= "<?php echo $user_data['user_id']?>">
                    <button type="submit" name="submit" class="btns btn-blue">Submit</button>
                </div>
            </div>
        </form>
            </div>
            <div class="content-right">
                <img src="./images/time-management.svg" alt="">
            </div>
        </div>
        
    </section>

    <script>
        var content1 = document.getElementById("content1");
        var content2 = document.getElementById("content2");
        var content3 = document.getElementById("content3");

        var btn1 = document.getElementById("btn1");
        var btn2 = document.getElementById("btn2");
        var btn3 = document.getElementById("btn3");

        function openRequest(){
            content1.style.transform= "translateX(0)";
            content2.style.transform= "translateX(100%)";
            content3.style.transform= "translateX(100%)";
            btn1.style.color = "#677eff";
            btn2.style.color = "#000";
            btn3.style.color = "#000";
        }
        function openNotif(){
            content1.style.transform= "translateX(100%)";
            content2.style.transform= "translateX(0)";
            content3.style.transform= "translateX(100%)";
            btn1.style.color = "#000";
            btn2.style.color = "#677eff";
            btn3.style.color = "#000";
        }
        function opensettings(){
            content1.style.transform= "translateX(100%)";
            content2.style.transform= "translateX(100%)";
            content3.style.transform= "translateX(0)";
            btn1.style.color = "#000";
            btn2.style.color = "#000";
            btn3.style.color = "#677eff";
        }

    </script>
</body>
</html>