<?php
session_start();
include('config.php');
include('includes/function.php');


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="application-form">
        <div class="app-title">
            <h1>Application Form</h1>
            <h3>St. Josh Church</h3>
            <div class="app-form">
            <table class="application_tbl">
            <?php
        include ('config.php');

        $query = "select user_registration.name, event_request.event_name, user_request.pre_time,user_request.alt_time,user_request.application_date, user_request.application_id  FROM user_request,user_registration, event_request WHERE user_request.user_id =user_registration.user_id AND user_request.event_id = event_request.event_id AND user_request.request_id = (SELECT MAX(user_request.request_id) FROM `user_request`)";

         $result = mysqli_query($con, $query);

         while($row = $result->fetch_assoc()){
             ?>
                <tr>
                    <td style="text-align:right">Application No:</td>
                    <td style="text-align:center"><?php echo $row['application_id'] ?></td>
                </tr>
                <tr>
                     <td style="text-align:right">Name:</td>
                    <td style="text-align:center"><?php echo $row['name'] ?></td>
                </tr>
                <tr>
                    <td  style="text-align:right">Requested Event:</td>
                    <td style="text-align:center"><?php echo $row['event_name'] ?></td>
                </tr>
                <tr>
                    <td style="text-align:right">Prefered Time and Date:</td>
                    <td style="text-align:center"><?php echo $row['pre_time'] ?></td>
                </tr>
                <tr>
                     <td style="text-align:right">alternative Time and Date:</td>
                    <td style="text-align:center"><?php echo $row['alt_time'] ?></td>
                </tr>
                <tr>
                    <td style="text-align:right">Application Date:</td>
                    <td style="text-align:center"><?php echo $row['application_date'] ?></td>
                </tr>
            </table>
            <?php } ?>
            <div class="reminder">
                <small>This is use for application purposes only. <br> Please present it upon submitting your form to the Church.</small>
            </div>
            </div>
            
        </div>
    </div>
   <script>
       <?php
        if(isset($_GET['print'])){ ?>
            window.print();
      <?php  }
       ?>
   </script>
</body>
</html>