<?php
include_once("tourismdatabase.php");
if(!isset($_SESSION)){
    session_start();
}
if (isset($_SESSION['UserId'])){
    date_default_timezone_set("Asia/Karachi");
    $date = date('Y-m-d H:i:s');
    $session=$_SESSION['UserId'];

    $query ="SELECT userId FROM user_profile WHERE id=$session ";
    $statement=$conn->prepare($query);

	if(!$statement->execute()){

		echo "QUERY FAILED : Error -> " . json_encode($statement->errorMsg());
		return;
	}
	else{
        $result=$statement->fetch(PDO::FETCH_COLUMN);

        $query1 ="SELECT tourId FROM booking WHERE userId=$result ";
        $statement1=$conn->prepare($query1);
    
        if(!$statement1->execute()){
    
            echo "QUERY FAILED : Error -> " . json_encode($statement1->errorMsg());
            return;
        }
        else{
            $resultset=$statement1->fetchALL(PDO::FETCH_COLUMN);
            ?>
            <center>
            <div id="container">  
        <table>
        <thead>
            <tr>
            <th>Tour Id</th>
        <th>Place Name</th>
        <th>Departure</th>
        <th>Arrival</th>
        <th>Seats</th>
        <th>Details</th>
        <th>Created On</th>
        <th>Updated On</th>            </tr>
        </thead>
        <tbody>
        </center>
<?php
            foreach($resultset as $info)
{
        $query2 ="SELECT tourId,placename,departure,arrival,seats,details,createdOn,updatedOn FROM tour WHERE tourId=$info AND arrival<'$date' ";
    $statement2=$conn->prepare($query2);
    if(!$statement2->execute()){
        echo "QUERY FAILED : Error -> " . json_encode($statement2->errorMsg());
        return;
    }
        $tourid=$statement2->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <center>
        
        <?php
        foreach($tourid as $user)
           {
               ?>
            <tr>
            <td><?php echo $user['tourId']?></td>
    <td><?php echo $user['placename']?></td>
    <td><?php echo $user['departure'];?></td>
    <td><?php echo $user['arrival'];?></td>
    <td><?php $query3 ="SELECT seats FROM booking WHERE tourId=$info";
        $statement3=$conn->prepare($query3);
        if(!$statement3->execute()){
            echo "QUERY FAILED : Error -> " . json_encode($statement3->errorMsg());
            return;
        }
            $seats=$statement3->fetch(PDO::FETCH_COLUMN);
            echo $seats;?></td>
    <td><?php echo $user['details'];?></td>
    <td><?php echo $user['createdOn'];?></td>
    <td><?php echo $user['updatedOn'];?></td>
            </tr>
            </body>
</html>
            <?php
           }





    }
    }
?>
<a href="customerdashboard.php">Back To Dashboard</a>
<?php
}
}?>




