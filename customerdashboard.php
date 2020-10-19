
<html>
<head>
    </head>
    <body>
    <title>Tourism Website</title>
   <center><h3>Welcome To Customer Dashboard</h3></center>

    <center>

    <a href="logout.php">logout</a>

    
    
    
    <a href="scheduletrips.php">Schedule Trips</a>
    <a href="pasttrips.php">Past Trips</a>

    <a href="customerprofile.php">View Profile</a>

    
 </center>
</body>
</html>

<?php
include_once("tourismdatabase.php");
if(!isset($_SESSION)){
    session_start();
}
if (isset($_SESSION['UserId'])){
    $date = date('Y-m-d H:i:s');
    $session=$_SESSION['UserId'];

    $session=$_SESSION['UserId'];

    $query ="SELECT userId FROM user_profile WHERE id=$session ";
    $statement=$conn->prepare($query);

	if(!$statement->execute()){

		echo "QUERY FAILED : Error -> " . json_encode($statement->errorMsg());
		return;
	}
	else{
        $result=$statement->fetch(PDO::FETCH_COLUMN);
        }
    }

    $query ="SELECT tourId,placename,departure,arrival,seats,availableseats,details,createdOn,updatedOn FROM tour WHERE departure>'$date' ";
    $statement=$conn->prepare($query);
    if(!$statement->execute()){
        echo "QUERY FAILED : Error -> " . json_encode($statement->errorMsg());
        return;
    }
        $results=$statement->fetchAll(PDO::FETCH_ASSOC);

?>
</tr>
</tbody>
<center>
<div id="container">  
<table>
<thead>
    <tr>
        <th>Tour Id</th>
        <th>Place Name</th>
        <th>Departure</th>
        <th>Arrival</th>
        <th>Total Seats</th>
        <th>Available Seats</th>
        <th>Details</th>
        <th>Created On</th>
        <th>Updated On</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
<?php
foreach($results as $result)
   {
       ?>
    <tr>
    <td><?php echo $result['tourId']?></td>
    <td><?php echo $result['placename']?></td>
    <td><?php echo $result['departure'];?></td>
    <td><?php echo $result['arrival'];?></td>
    <td><?php echo $result['seats']?></td>
    <td><?php echo $result['availableseats']?></td>
    <td><?php echo $result['details'];?></td>
    <td><?php echo $result['createdOn'];?></td>
    <td><?php echo $result['updatedOn'];?></td>
    <td><a href="booktour.php?tourId=<?php echo $result['tourId']; ?>">book</a></td>
    </tr>
    <?php
   }

    ?>
</table>
</center>
</body>
</html>











