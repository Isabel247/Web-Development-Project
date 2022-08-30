<?php
    include('config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>St.Josh</title>

    <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php require "includes/header.php";  ?>

    <main>
        <section class="banner">
            <div class="event-box">
                <h2 class="event-h2">upcoming events</h2>
                <?php
                    include ('config.php');

                    $query = "select * FROM upcoming_events WHERE upcoming_events.event_date > CURRENT_DATE()";

                    $result = mysqli_query($con, $query);

                    while($row = $result->fetch_assoc()){
                        $date = date_create($row['event_date']);

                ?>
                <div class="event-content">
                    <p>What: <?php echo $row['event_name'] ?> <br>Description: <?php echo $row['event_desc'] ?> <br>When: <?php echo date_format($date, 'F j, Y g:i: a'); ?> <br>Where: <?php echo $row['location'] ?></p>
                </div>
                <?php }?>
            </div>
        </section>
        <section class="about">
            <?php require "about.php";  ?>
                <div class="people" id="people">
                    <div class="p-container">
                        <h1 class="title">Our Priest</h1>
                        <div class="p-card">
                            <?php include ('config.php');
                                $query = "select * FROM people"; 
                                $result = mysqli_query($con, $query);
                                while($row = $result->fetch_assoc()){
                                $imageURL = 'admin/photos/'.$row['photo'];
                            ?>

                        <div class="p-img-box"><img src="<?php echo $imageURL?>" alt=""> </div>
                            <div class="p-content">
                                <div>
                                    <h2 class="p-title"><?php echo $row['name']?></h2>
                                    <h3 class="role"><?php echo $row['position']?></h3>
                                    <p><?php echo $row['description']?></p>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    
                </div>
                <div class="location"></div>
                
                <div class="menu" id="menu" >
                    <article class="menu-pic">
                        <img src="./admin/images/press.svg" alt="">
                    </article>
                    <article class="menu-text">
                        <div class="menu-text-center">
                            <h1>Schedule Event</h1>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rerum repudiandae consequatur quasi suscipit, aliquid repellendus tenetur ex delectus in culpa doloremque totam dolorum magni earum corrupti vero cupiditate ea deleniti reiciendis. Consequatur incidunt repudiandae, ex est sunt itaque culpa alias, odio mollitia illo, quam dignissimos cum. Fugit recusandae voluptas aliquam?</p>
                            <a target="_blank" href="login.php">Schedule Event</a>
                        </div>
                    </article>	
                </div>
            </div>
        </section>
    </main>

    
    <?php require "includes/footer.php";  ?>
</body>
</html>