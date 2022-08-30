<?php
session_start();
include('config.php');
include('function.php');

$user_data = check_login($con);

?>

<div class="side-menu">
    <center>
        <div class="avatar"><img src="./images/bighead.svg" alt=""></div>
        <br><br>
        <h2><?php echo $user_data['name']?></h2>
    </center>
    <br>
    <a href="request.php" ><i class="fa fa-envelope"></i><span>Request</span></a>
    <a href="customers.php" ><i class="fa fa-user"></i><span>Customers</span></a>
    <a href="upcoming-events.php" ><i class="fa fa-calendar"></i><span>Upcoming Events</span></a>
    <a href="members.php" ><i class="fa fa-users"></i><span>Members</span></a>
    <a href="settings.php" ><i class="fa fa-cogs"></i><span>Website Settings</span></a>

    <a href="logout.php" class="logout"><span>Logout</span></a>
</div>