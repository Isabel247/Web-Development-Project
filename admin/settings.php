<?php

include('config.php');
$targetDir = "photos/";

if(isset($_POST['save'])){
    if(!empty($_FILES['file']['name'])){
        $pname = rand(1000, 10000)."-".$_FILES['file']['name'];
        $tname = $_FILES['file']['tmp_name'];
        $upload_dir = "files/";
        $name = $_POST['name'];
            if(move_uploaded_file($tname, $upload_dir.$pname)){
                
                $query = "insert into `event_request`( `event_name`, `avail_file`)  values ('$name','$pname')";
            
                mysqli_query($con, $query);

                if($query){
                    echo"<script>alert('Data added successfully!')</script>";
                }
            }
        }
    }
    


if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    $query = "delete from `event_request` where `event_id` = $id ";

         $result = mysqli_query($con, $query);

         if($result){
             echo "<script>alert('Data has been deleted.')</script>";

             header('location: settings.php');
            }

}

$id = 0;
$update = false;
$name = '';
$desc = '';
$position = '';
$loc = '';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "select * from `event_request` where `event_id` = $id ";
    $result = mysqli_query($con, $query);
    $file = mysqli_fetch_assoc($result);
    $filePath = 'files/'.$file['avail_file'];

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
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $query = "select * from `event_request` where `event_id` = $id ";

    $result = mysqli_query($con, $query);

    if(count(array($result))== 1){
        $row = $result->fetch_array();
        $id = $row['event_id'];
        $name = $row['event_name'];
        $file = $row['avail_file'];
    }
}

if(isset($_POST['update'])){
    if(!empty($_FILES['file']['name'])){
        $filename =basename($_FILES['photo']['name']);
        $targetFilePath = $targetDir . $filename;
        $fileType =pathinfo($targetFilePath, PATHINFO_EXTENSION);

        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
        if(in_array($fileType, $allowTypes)){
            if(move_uploaded_file($_FILES['photo']['tmp_name'], $targetFilePath)){
                $id = $_POST['id'];
                $name = $_POST['name'];
                $desc = $_POST['desc'];
                $position = $_POST['position'];
            
                $query = "update `people` set `name`='$name',`description`='$desc',`position`='$position',`photo`='$filename' WHERE id = $id";
            
                $result = mysqli_query($con, $query);
                if($result){
                    echo "<script>alert('Data has been UPDATED.')</script>";

                    header('location: members.php');
                }
            }
        }
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
        <h2>Event Request</h2>

        <table class="table" >
            <thead>
                <th>Event Name</th>
                <th>Available File/Form</th>
                <th>Action</th>
            </thead>

            <?php
            include ('config.php');

            $query = "select * FROM `event_request`";

             $result = mysqli_query($con, $query);

             while($row = $result->fetch_assoc()){
                $file = $row['avail_file'];
                 ?>
             
                <tbody>
                    <tr>
                        <td><?php echo $row['event_name'] ?></td>
                        <td><?php echo $file ?></td>
                        <td>
                            <a href="settings.php?id=<?php echo $row['event_id'];?>" class="btns btn-blue" ><i class="fa fa-download"></i></a>
                            <a href="settings.php?edit=<?php echo $row['event_id'];?>" class="btns btn-orange" ><i class="fa fa-edit"></i></a>
                            <a href="settings.php?delete=<?php echo $row['event_id'];?>" class="btns btn-red"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    
                </tbody>
             <?php } ?>
            
           
        </table>
     
        <div class="grid">
          <div class="painel">
              <div class="painel-header">
                  <h4 class="painel-title">Add Schedule Events</h4>
              </div>
              <div class="painel-body">
                <form action="#" class="inline-form" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                    <div class="group">
                        <label for="#">Event Name</label>
                        <input type="text" value="<?php echo $name ; ?>" name="name" value=""required>
                    </div>
                    
                    <div class="group">
                        <label for="#">Downloadable File or Form</label>
                        <input type="file" name="file">
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