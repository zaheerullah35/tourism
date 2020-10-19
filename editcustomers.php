<?php
include_once("tourismdatabase.php");
session_start();
$userId=$_GET['userId'];
if (isset($_SESSION['UserId'])){
                    $stmt = $conn->prepare("SELECT userId,userType FROM user_profile WHERE userId=$userId");
                    $stmt->execute([$userId]); 
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
   <center><h3>Edit Customer</h3></center>

    <center>
               <center>
                <form method="Post" action="updatecustomers.php">
                   <div class="container">
                   
                   
                        <input name = "userId" type = "hidden" 
                            value="<?php echo $user['userId'];?>"><br>

                     User Type
                     <select name="userType">
                                <option value="Admin">Admin</option>
                                
                            </select> 
                            
                     
                        
                     
                        
                           <input name = "submit" type = "submit" 
                              id = "submit" value = "Update"> </br>
               
                              <a href="admindashboard.php">Back To Dashboard</a>

               </div>
               </form>
               </center>   
   </body>
</html>