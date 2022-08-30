<?php

include('config.php');
$targetDir = "photos/";

if(isset($_POST['save'])){
    if(!empty($_FILES['photo']['name'])){
        $filename =basename($_FILES['photo']['name']);
        $targetFilePath = $targetDir . $filename;
        $fileType =pathinfo($targetFilePath, PATHINFO_EXTENSION);

        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
        if(in_array($fileType, $allowTypes)){
            if(move_uploaded_file($_FILES['photo']['tmp_name'], $targetFilePath)){
                $name = $_POST['name'];
                $desc = $_POST['desc'];
                $position = $_POST['position'];
            
                $query = "insert into `people`( `name`, `description`, `position`, `photo`) values ('$name','$desc', '$position','$filename')";
            
                mysqli_query($con, $query);

                if($query){
                    echo"<script>alert('Data added successfully!')</script>";
                }
            }
        }
    }
    
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    $query = "delete from `people` where `id` = $id ";

         $result = mysqli_query($con, $query);

         if($result){
             echo "<script>alert('Data has been deleted.')</script>";

             header('location: members.php');
            }

}

$id = 0;
$update = false;
$name = '';
$desc = '';
$position = '';
$loc = '';

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $query = "select * from `people` where `id` = $id ";

    $result = mysqli_query($con, $query);

    if(count(array($result))== 1){
        $row = $result->fetch_array();
        $id = $row['id'];
        $name = $row['name'];
        $desc = $row['description'];
        $position = $row['position'];
        $image = $row['photo'];
    }
}

if(isset($_POST['update'])){
    if(!empty($_FILES['photo']['name'])){
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
        <h2>Church Members</h2>

        <table class="table" >
            <thead>
                <th>Full Name</th>
                <th>Description</th>
                <th>Position</th>
                <th>Photo</th>
                <th>Action</th>
            </thead>

            <?php
            include ('config.php');

            $query = "select * FROM `people`";

             $result = mysqli_query($con, $query);

             while($row = $result->fetch_assoc()){
                $imageURL = 'photos/'.$row['photo'];
                 ?>
             
                <tbody>
                    <tr>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['description'] ?></td>
                        <td><?php echo $row['position'] ?></td>
                        <td><img src="<?php echo $imageURL ?>" alt="" height="30px" width="50px"></td>
                        <td>
                            <a href="members.php?edit=<?php echo $row['id'];?>" class="btns btn-orange" ><i class="fa fa-edit"></i></a>
                            <a href="members.php?delete=<?php echo $row['id'];?>" class="btns btn-red"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    
                </tbody>
             <?php } ?>
            
           
        </table>
     
        <div class="grid">
          <div class="painel">
              <div class="painel-header">
                  <h4 class="painel-title">Add New Member of Church</h4>
              </div>
              <div class="painel-body">
                <form action="#" class="inline-form" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                    <div class="group">
                        <label for="#">Full Name</label>
                        <input type="text" value="<?php echo $name ; ?>" name="name" value=""required>
                    </div>
                    <div class="group">
                        <label for="#">Description</label>
                        <textarea name="desc"  id="desc" cols="30" rows="1"><?php echo $desc ; ?></textarea>
                    </div>
                    <div class="group">
                        <label for="#">Position in Church</label>
                        <input type="text" value="<?php echo $position ; ?>" name="position" value=""required>
                    </div>
                    <div class="group">
                        <label for="#">Photo</label>
                        <input type="file" name="photo">
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