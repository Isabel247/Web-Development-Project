<?php

include('config.php');

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
        <h2>Customers</h2>

    <table class="table" >
            <thead>
                <th>Full Name</th>
                <th>Email</th>
                <th>Contact Number</th>
                <th>Username</th>
            </thead>

            <?php
            include ('config.php');

            $query = "select * FROM `user_registration`";

             $result = mysqli_query($con, $query);

             while($row = $result->fetch_assoc()){?>
                <tbody>
                    <tr>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><?php echo $row['phone_no'] ?></td>
                        <td><?php echo $row['username'] ?></td>
                    <!--    <td>
                            <a href="upcoming-events.php?edit=<?php echo $row['event_id'];?>"
                            class="ev-btn" >Edit</a>
                            <a href="upcoming-events.php?delete=<?php echo $row['event_id'];?>"
                            class="ev-btn" >Delete</a>
                        </td>-->
                    </tr>
                    
                </tbody>
             <?php } ?>
            
           
        </table>
    </section>
</body>
</html>