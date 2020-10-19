<?php
include_once("tourismdatabase.php");
session_start();
$session=$_SESSION['UserId'];
$userId=$_GET['userId'];
if (isset($_SESSION['UserId'])){
                    $stmt = $conn->prepare("SELECT userId,firstName,lastName,phone,gender,createdOn,updatedOn FROM user_profile WHERE userId=$userId");
                    $stmt->execute([$userId]); 
                    $user = $stmt->fetch();
                    if(!$stmt->execute()){
                        echo "QUERY FAILED : Error -> " . json_encode($stmt->errorMsg());
                        return;
                    } 
                    
                    $stmt1 = $conn->prepare("SELECT id,email,password FROM user WHERE id=$session");
                    $stmt1->execute(); 
                    $user1 = $stmt1->fetch();
                    if(!$stmt1->execute()){
                        echo "QUERY FAILED : Error -> " . json_encode($stmt ->errorMsg());
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
                <form method="Post" action="updateprofile.php">
                   <div class="container">
                   
                   
                        <input name = "userId" type = "hidden" 
                            value="<?php echo $user['userId'];?>"><br>
                            
                     Email
                        <input name = "email" type = "text" 
                            value="<?php echo $user1['email'];?>"><br>
                     
                     Password    
                        <input name = "password" type = "text" 
                           value="<?php echo $user1['password'];?>"><br>


                     First Name
                        <input name = "firstName" type = "text" 
                            value="<?php echo $user['firstName'];?>"><br>
                     
                        Last Name
                        <input name = "lastName" type = "text" 
                            value="<?php echo $user['lastName'];?>"><br>
                     Phone
                        <input name = "phone" type = "text" 
                            value="<?php echo $user['phone'];?>"><br>
                     
                           Gender
                        <input name = "gender" type = "text" 
                           value="<?php echo $user['gender'];?>"><br>
                     
                     
                        
                           <input name = "submit" type = "submit" 
                              id = "submit" value = "Update"> </br>
               
                              <a href="admindashboard.php">Back To Dashboard</a>

               </div>
               </form>
               </center>   
   </body>
</html>