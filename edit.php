<?php
include_once("tourismdatabase.php");
session_start();
$tourId=$_GET['tourId'];
if (isset($_SESSION['UserId'])){
                    $stmt = $conn->prepare("SELECT tourId,placename,departure,arrival,seats,details FROM tour WHERE tourId=$tourId");
                    $stmt->execute([$tourId]); 
                    $user = $stmt->fetch();
                    if(!$stmt->execute()){
                        echo "QUERY FAILED : Error -> " . json_encode($stmt->errorMsg());
                        return;
                    } 
                  }
                ?>
                <!DOCTYPE HTML>
<head>
    </head>
<body>
<title>Tourism Website</title>
   <center><h3>Edit</h3></center>

    <center>
               <center>
                <form method="Post" action="update.php">
                   <div class="container">
                   
                   
                        <input name = "tourId" type = "hidden" 
                            value="<?php echo $user['tourId'];?>"><br>

                     Place Name
                        <input name = "placename" type = "text" 
                            value="<?php echo $user['placename'];?>"><br>
                     
                        Departure
                        <input name = "departure" type = "text" 
                            value="<?php echo $user['departure'];?>"><br>
                     Arrival
                        <input name = "arrival" type = "text" 
                            value="<?php echo $user['arrival'];?>"><br>
                     
                           Seats
                        <input name = "seats" type = "text" 
                           value="<?php echo $user['seats'];?>"><br>
                     
                       Details
                        <input name = "details" type = "text" 
                            value="<?php echo $user['details'];?>"><br>


                     
                        
                           <input name = "submit" type = "submit" 
                              id = "submit" value = "Update"> </br>
               
                              <a href="admindashboard.php">Back To Dashboard</a>

               </div>
               </form>
               </center>   
   </body>
</html>