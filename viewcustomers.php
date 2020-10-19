<?php
include_once("tourismdatabase.php");
if(!isset($_SESSION)){
    session_start();
}
if (isset($_SESSION['UserId'])){
    $query ="SELECT * FROM user_profile WHERE userType='1' ";
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
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone</th>
                <th>Gender</th>
                <th>User Type</th>
                <th>createdOn</th>
                <th>updatedOn</th>
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
            <td><?php echo $result['firstName']?></td>
            <td><?php echo $result['lastName'];?></td>
            <td><?php echo $result['phone'];?></td>
            <td><?php echo $result['gender']?></td>
            <td><?php
             if($result['userType']==1)
             {
                 echo "Customer";
             }?></td>
            <td><?php echo $result['createdOn'];?></td>
            <td><?php echo $result['updatedOn'];?></td>
            <td><a href="editcustomers.php?userId=<?php echo $result['userId']; ?>">edit</a></td>
            </tr>
            <?php
           }
}
            ?>
        </table>
        <a href="admindashboard.php">Back To Dashboard</a>

        </center>
        </body>
        </html>
           

