<?php
include_once("tourismdatabase.php");
if(!isset($_SESSION)){
    session_start();
}
if (isset($_SESSION['UserId'])){
    $session=$_SESSION['UserId'];

    $query1 ="SELECT email,password FROM user WHERE id=$session ";
    $statement1=$conn->prepare($query1);

	if(!$statement1->execute()){

		echo "QUERY FAILED : Error -> " . json_encode($statement1->errorMsg());
		return;
	}
	else{
        $resultset=$statement1->fetchAll(PDO::FETCH_ASSOC);
        }





    $query ="SELECT userId FROM user_profile WHERE id=$session ";
    $statement=$conn->prepare($query);

	if(!$statement->execute()){

		echo "QUERY FAILED : Error -> " . json_encode($statement->errorMsg());
		return;
	}
	else{
        $result=$statement->fetch(PDO::FETCH_COLUMN);
        }
    

    $query ="SELECT userId,firstName,lastName,phone,gender,createdOn,updatedOn FROM user_profile WHERE userId=$result ";
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
        <th>User Id</th>
        <th>Email</th>
        <th>Password</th> 
        <th>First Name</th>
        <th>Last Name</th>
        <th>Phone</th>
        <th>Gender</th>
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
    <td><?php echo $result['userId']?></td>
    <?php
    foreach($resultset as $val)
    {?>
    <td><?php echo $val['email']?></td>
    <td><?php echo $val['password']?></td>
    <?php
    }
    ?>
    <td><?php echo $result['firstName']?></td>
    <td><?php echo $result['lastName'];?></td>
    <td><?php echo $result['phone'];?></td>
    <td><?php echo $result['gender']?></td>
    <td><?php echo $result['createdOn'];?></td>
    <td><?php echo $result['updatedOn'];?></td>
    <td><a href="editprofile.php?userId=<?php echo $result['userId']; ?>">edit</a></td>
    </tr>
    <?php
   }

    ?>
</table>
<a href="admindashboard.php">Back To Dashboard</a>

</center>
</body>
</html>
<?php
}
?>