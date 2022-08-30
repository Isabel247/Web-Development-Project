<?php

include('config.php');

$id = 0;
$status = '';

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $query = "update `user_request` SET `stat`= 'Approved' WHERE `request_id`= $id ";

    $result = mysqli_query($con, $query);

    if($result){
        echo "<script>alert('Data has been UPDATED.')</script>";

        header('location: request.php');
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
    <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!---<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">-->
</head>
<body>
    <input type="checkbox" id="menu">
    <?php include('includes/header.php') ?>
    <?php include('includes/sidebar.php') ?>

    
    <section class="data">
        <h2>Request</h2>

        
    <form action="" method="POST">
    <input type="hidden" name="id" value="<?php echo $id ?>">
    <table class="table" >
            <thead>
                 <th>Application ID</th>
                <th>Customer Name</th>
                <th>Event Request</th>
                <th>Prefered Date</th>
                <th>Aternative Date</th>
                <th>Status</th>
            </thead>

            <?php
            include ('config.php');

            $query = "select user_request.request_id,user_registration.name, event_request.event_name , user_request.pre_time, user_request.alt_time, user_request.stat,user_request.application_id  FROM user_request,user_registration,event_request where user_request.user_id = user_registration.user_id and event_request.event_id = user_request.event_id";

             $result = mysqli_query($con, $query);

             while($row = $result->fetch_assoc()){?>
                <tbody>
                    <tr>
                        <td><?php echo $row['application_id'] ?></td>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['event_name'] ?></td>
                        <td><?php echo $row['pre_time'] ?></td>
                        <td><?php echo $row['alt_time'] ?></td>
                        <?php 
                                if($row['stat'] == 'process'){
                                   $status = "Process";
                                }else{
                                    $status = "Approved";
                                }
                            ?> 
                        <td>
                            <a href="request.php?edit=<?php echo $row['request_id'];?>"
                            class="ev-btn" ><?php echo $status ?></a>
                        </td>
                    </tr>
                    
                </tbody>
    </form>
             <?php } ?>
            
           
        </table>
    </section>
</body>
</html>