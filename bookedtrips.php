<?php
include_once("tourismdatabase.php");
if(!isset($_SESSION)){
    session_start();
}
if (isset($_SESSION['UserId'])){
    $session=$_SESSION['UserId'];

    $query ="SELECT userId FROM user_profile WHERE id=$session ";
    $statement=$conn->prepare($query);

	if(!$statement->execute()){

		echo "QUERY FAILED : Error -> " . json_encode($statement->errorMsg());
		return;
	}
	else{
     $result=$statement->fetch(PDO::FETCH_COLUMN);

    $query ="SELECT tourId FROM tour WHERE userId=$result ";
    $statement=$conn->prepare($query);
    if(!$statement->execute()){
        echo "QUERY FAILED : Error -> " . json_encode($statement->errorMsg());
        return;
    }
        $results=$statement->fetchAll(PDO::FETCH_COLUMN);
foreach($results as $result)
{
        $query1 ="SELECT bookId FROM booking WHERE tourId=$result ";
    $statement1=$conn->prepare($query1);
    if(!$statement1->execute()){
        echo "QUERY FAILED : Error -> " . json_encode($statement1->errorMsg());
        return;
    }
        $resultset=$statement1->fetchALL(PDO::FETCH_COLUMN);
        
foreach($resultset as $bookid)
{
        $query2 ="SELECT userId FROM booking WHERE bookId=$bookid ";
    $statement2=$conn->prepare($query2);
    if(!$statement2->execute()){
        echo "QUERY FAILED : Error -> " . json_encode($statement2->errorMsg());
        return;
    }
        $userid=$statement2->fetchAll(PDO::FETCH_COLUMN);
foreach($userid as $info)
{
        $query2 ="SELECT userId,firstName,lastName FROM user_profile WHERE userId=$info ";
    $statement2=$conn->prepare($query2);
    if(!$statement2->execute()){
        echo "QUERY FAILED : Error -> " . json_encode($statement2->errorMsg());
        return;
    }
        $userid=$statement2->fetchAll(PDO::FETCH_ASSOC);

        
        
            //getting tour id

            $query3 ="SELECT tourId FROM booking WHERE bookId=$bookid ";
    $statement3=$conn->prepare($query3);
    if(!$statement3->execute()){
        echo "QUERY FAILED : Error -> " . json_encode($statement3->errorMsg());
        return;
    }
        $tourid=$statement3->fetchAll(PDO::FETCH_COLUMN);



        


        
foreach($tourid as $tinfo)
{
        $query4 ="SELECT tourId,placeName FROM tour WHERE tourId=$tinfo ";
    $statement4=$conn->prepare($query4);
    if(!$statement4->execute()){
        echo "QUERY FAILED : Error -> " . json_encode($statement4->errorMsg());
        return;
    }
        $touridresult=$statement4->fetchAll(PDO::FETCH_ASSOC);

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
                <th>User Id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Seats</th>


            </tr>
        </thead>
        <tbody>
        <?php
        foreach($touridresult as $userinfo)
           {
               ?>
            <tr>
            <td><?php echo $userinfo['tourId']?></td>
            <td><?php echo $userinfo['placeName']?></td>



        <?php
        foreach($userid as $user)
           {
               ?>
            <td><?php echo $user['userId']?></td>
            <td><?php echo $user['firstName']?></td>
            <td><?php echo $user['lastName']?></td>

           
            <?php
           }?>
        <td><?php $query5 ="SELECT seats FROM booking WHERE bookId=$bookid ";
        $statement5=$conn->prepare($query5);
        if(!$statement5->execute()){
            echo "QUERY FAILED : Error -> " . json_encode($statement5->errorMsg());
            return;
        }
            $seats=$statement5->fetch(PDO::FETCH_COLUMN);
            echo $seats;?>
         </tr><?php
           }
                  ?>
        </table>

        </center>
        </body>
        </html>


<?php

        }
}
    }

    }
}
    
?>
<center>
    <a href="admindashboard.php">Back To Dashboard</a>
</center>
<?php
    }

?>
    




