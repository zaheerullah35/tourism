<!DOCTYPE HTML>
<head>
    </head>
<body>
    <title>Tourism Website</title>
   <center><h5>Create New Tour</h5></center>
<body>
<center>
<div class="floating-box">
<form name="form1" method="post">
   <label for="placename">Enter Place Name </label>
   <input type="text" name="placename" required><br><br>

   <label for="departure">Enter Departure</label>
   <input type="datetime-local"  name="departure" required><br><br>

   <label for="arrival">Enter Arrival</label>
   <input type="datetime-local"  name="arrival" required><br><br>

   <label for="seats">Enter Total Seats</label>
   <input type="text"  name="seats" required><br><br>


   <label for="details">Enter Details</label>
   <input type="text"  name="details" required><br><br>


<?php
extract($_POST);
include_once("tourismdatabase.php");
session_start();
if (isset($_SESSION['UserId'])){
$session=$_SESSION['UserId'];
$date = date('Y-m-d H:i:s');
$session=$_SESSION['UserId'];

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
        }
    $query = "SELECT tourId FROM tour WHERE `placename` = ? AND `departure` = ? AND `arrival` = ? AND `seats` = ? AND `details` = ?";
	$statement = $conn->prepare($query);
	$statement->bindValue(1, $placename);
	$statement->bindValue(2, $departure);
    $statement->bindValue(3, $arrival);
	$statement->bindValue(4, $seats);
    $statement->bindValue(5, $details);

    $result = $statement->fetch(PDO::FETCH_ASSOC);
	if(!$statement->execute()){
		echo "QUERY FAILED : Error -> " . json_encode($statement->errorMsg());
		return;
	}
	else{
       
        ?><center><div class="container">
    <p>Data submitted</p>
    <div>
    </center>
<?php
    }
    
	$sql="INSERT INTO tour(userId,placename,departure,arrival,seats,availableseats,details) VALUES($results,?,?,?,?,$seats,?)";
    $statement =$conn->prepare($sql);
    $statement->execute([$placename,$departure,$arrival,$seats,$details]);


}
}
?>

<input name="submit" type="submit" id="submit" value="save"><br>
   <br><div class=head1><p><a href=admindashboard.php>Back to Dashboard</a></p></div>
   </center>
</body>
</html>