<?php

include('config.php');

if(isset($_POST['save'])){
    $event_name = $_POST['event_name'];
    $desc = $_POST['event_desc'];
    $date = $_POST['event_date'];
    $loc = $_POST['event_loc'];
    $status ="published";

    $query = "insert into `upcoming_events`(`event_name`, `event_desc`, `event_date`, `location`) values ('$event_name','$desc', '$date','$loc')";

    mysqli_query($con, $query);

    echo"<script>alert('Data added successfully!')</script>";
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    $query = "delete from `upcoming_events` where `event_id` = $id ";

         $result = mysqli_query($con, $query);

         if($result){
             echo "<script>alert('Data has been deleted.')</script>";

             header('location: upcoming-events.php');
            }

}

$id = 0;
$update = false;
$name = '';
$desc = '';
$date = '';
$loc = '';

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $query = "select * from `upcoming_events` where `event_id` = $id ";

    $result = mysqli_query($con, $query);

    if(count(array($result))== 1){
        $row = $result->fetch_array();
        $id = $row['event_id'];
        $name = $row['event_name'];
        $desc = $row['event_desc'];
        $date = date("Y-m-d\TH:i:s", strtotime($row['event_date']));
        $loc = $row['location'];
    }
}

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['event_name'];
    $desc = $_POST['event_desc'];
    $date = $_POST['event_date'];
    $loc = $_POST['event_loc'];

    $query = "update `upcoming_events` set `event_name`='$name',`event_desc`='$desc',`event_date`='$date',`location`='$loc' WHERE event_id = $id";

    $result = mysqli_query($con, $query);
    if($result){
         echo "<script>alert('Data has been UPDATED.')</script>";

        header('location: upcoming-events.php');
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
        <h2>Upcoming Events</h2>

        <table class="table" >
            <thead>
                <th>Event Name</th>
                <th>Description</th>
                <th>Date</th>
                <th>Location</th>
                <th>Action</th>
            </thead>

            <?php
            include ('config.php');

            $query = "select * FROM `upcoming_events`";

             $result = mysqli_query($con, $query);

             while($row = $result->fetch_assoc()){?>
                <tbody>
                    <tr>
                        <td><?php echo $row['event_name'] ?></td>
                        <td><?php echo $row['event_desc'] ?></td>
                        <td><?php echo $row['event_date'] ?></td>
                        <td><?php echo $row['location'] ?></td>
                        <td>
                            <a href="events.php?edit=<?php echo $row['event_id'];?>" class="btns btn-orange" ><i class="fa fa-edit"></i></a>
                            <a href="events.php?delete=<?php echo $row['event_id'];?>" class="btns btn-red"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    
                </tbody>
             <?php } ?>
            
           
        </table>
      <!---  <div class="add-events">
           <div class="row">
           <form action="" method="post" class="inline-form">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <div class="form-group">
                <label>Event Name</label>
                <input type="text" value="<?php echo $name ; ?>" name="event_name" value=""required>
                </div>
                <div class="form-group">
                <label>Description</label>
                <textarea name="event_desc"  id="event_desc" cols="30" rows="3"><?php echo $desc ; ?></textarea>
                </div>
                <div class="form-group">
                <label>Date</label>
                <input type="datetime-local" value="<?php echo $date ?>" name="event_date" id="event_date">
                </div>
                <div class="form-group">
                <label>Location</label>
                <input type="text" value="<?php echo $loc ; ?>" name="event_loc">
                </div>
                <div class="form-group">
                    <?php
                        if($update == true):
                    ?>
                     <button type="submit" name="update">Update</button>
                     <?php else: ?>
                      <button type="submit" name="save">Save</button>
                    <?php endif; ?>
            </form>
           </div>
        </div>-->

        <div class="grid">
          <div class="painel">
              <div class="painel-header">
                  <h4 class="painel-title">Add Upcoming Events</h4>
              </div>
              <div class="painel-body">
                  
                <form action="#" class="inline-form" method="post">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                    <div class="group">
                        <label for="#">Event Name</label>
                        <input type="text" value="<?php echo $name ; ?>" name="event_name" value=""required>
                    </div>
                    <div class="group">
                        <label for="#">Description</label>
                        <textarea name="event_desc"  id="event_desc" cols="30" rows="1"><?php echo $desc ; ?></textarea>
                    </div>
                    <div class="group">
                        <label for="#">Date and Time</label>
                        <input type="datetime-local" value="<?php echo $date ?>" name="event_date" id="event_date">
                    </div>
                    <div class="group">
                        <label for="#">Location</label>
                        <input type="text" value="<?php echo $loc ; ?>" name="event_loc">
                    </div>
                    <div class="group">
                        <p>&nbsp;</p>
                        <?php
                        if($update == true):
                    ?>
                     <button type="submit" name="update" class="btns btn-green" style="width: 40%; height:60%;">Update</button>
                     <?php else: ?>
                      <button type="submit" name="save" class="btns btn-green" style="width: 40%;height:60%;">Save</button>
                    <?php endif; ?>
                    </div>
    
    </section>
</body>
</html>