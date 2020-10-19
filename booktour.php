<!DOCTYPE HTML>
<head>
    </head>
<body>
    <title>Tourism Website</title>
   <center><h5>Book Tour</h5></center>
<body>
<center>
<div class="floating-box">
<form name="form1" method="post">
   
   <label for="seats">Enter Total Seats</label>
   <input type="text"  name="seats" required><br><br>

   <input name="submit" type="submit" id="submit" value="save"><br>
   <br><div class=head1><p><a href=customerdashboard.php>Back to Dashboard</a></p></div>
   </center>


<?php
extract($_POST);
include_once("tourismdatabase.php");
session_start();

if (isset($_SESSION['UserId'])){
$session=$_SESSION['UserId'];
$tourId=$_GET['tourId'];
if(isset($submit))

{
    $query ="SELECT userId FROM user_profile WHERE id=$session ";
                    $statement=$conn->prepare($query);

	if(!$statement->execute()){

		echo "QUERY FAILED : Error -> " . json_encode($statement->errorMsg());
		return;
	}
	else{
        $results=$statement->fetch(PDO::FETCH_COLUMN);

        $query1 ="SELECT availableseats FROM tour WHERE tourId=$tourId ";
                    $statement1=$conn->prepare($query1);

	if(!$statement1->execute()){

		echo "QUERY FAILED : Error -> " . json_encode($statement1->errorMsg());
		return;
	}
	else{
        $resultset=$statement1->fetch(PDO::FETCH_COLUMN);

        
}
    
}
        ?>
    </center>
<?php
    if($seats>$resultset)
    {
        ?><center><?php echo "Not Enough Seats";?></center><?php
    }
    else{
            $available=$resultset-$seats;
        $sql1 = "UPDATE tour SET availableseats='$available' WHERE tourId='$tourId'";
        $conn->prepare($sql1)->execute();
      


	$sql="INSERT INTO booking(userId,tourId,seats) VALUES($results,$tourId,?)";
    $statement =$conn->prepare($sql);
    $statement->execute([$seats]);
    }
}
}
?>

</body>
</html>