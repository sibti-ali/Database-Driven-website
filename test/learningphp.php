<?php
 include_once 'db_connect.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Poppleton Dog show</title>
</head>
<style type="text/css">
    h1{
        color: saddlebrown;
        font-size: 30px;
        font-family: monospace;
        
    }
    table{
        border-collapse: collapse;
        width: 90%;
        color: saddlebrown;
        font-family: monospace;
        font-size:15px;
        text-align: left;
    }
    th{
        background: bisque;

    }
    tr:nth-child(even) {background-color: #dddddd;}
     tbody tr {
         border-bottom: 2px solid saddlebrown ;

     }


</style>
<body>

<?php
$connection;
$header_query = "SELECT COUNT(DISTINCT(competitions.event_id)) AS Events,  COUNT(DISTINCT(dogs.owner_id)) AS Owners, COUNT(DISTINCT(entries.dog_id)) AS Dogs
FROM competitions
JOIN entries, dogs
WHERE competitions.id = entries.competition_id
AND  entries.dog_id = dogs.id;
";
$header_result = mysqli_query($connection, $header_query);
$header_array = mysqli_fetch_assoc($header_result);


?>
<h1>Welcome to Poppleton dog Show! This year <?php echo $header_array['Owners']?> owners entered <?php echo $header_array['Dogs'] ?> dogs in <?php echo $header_array['Events'] ?> events </h1>




<table>
    <tr>
        <th>Name</th>
        <th>Breed</th>
        <th>Avg_Score</th>
        <th>Owner</th>
        <th>Email</th>
    </tr>
    <?php
    //the leaderboard query
    $leaderboard_query = "WITH records
AS
(
    SELECT  a.id, a.name, cast((AVG(c.score)) as decimal (10,2)) Avg_score, b.name Breed, o.name Owner, o.email Email, o.id OwnersId,
            DENSE_RANK() OVER (ORDER BY AVG(c.score) DESC) 
    FROM    dogs a
    		INNER JOIN breeds b
    				ON a.breed_id = b.id
            INNER JOIN entries c
                ON a.id = c.dog_id
    		INNER JOIN owners o
    			ON a.owner_id = o.id
    		
    
    GROUP   BY a.id, a.name
    HAVING	COUNT(c.dog_id) > 1
)
SELECT  Name, Avg_Score, Breed , Owner , Email, OwnersId
FROM    records
ORDER   BY Avg_score DESC, Name
LIMIT	10;";

    $leaderboard_result = mysqli_query($connection, $leaderboard_query);
    //printing out data in the table
    if($leaderboard_result -> num_rows > 0) {
        while ($dog = $leaderboard_result->fetch_assoc()) {

            echo "<tr><td>" .  $dog ['Name'] . "</td><td>" . $dog ['Breed'] . "</td><td>" . $dog['Avg_Score']."</td><td>" ."<a href='owners.php?ID={$dog['OwnersId']}'>{$dog['Owner']} </a>"."</td><td>" .
                "<a href='mailto: {$dog['Email']}'> {$dog['Email'] } </a>". "</td></tr>" ;

        }
        echo "</table>";
    }
    else{
        echo "0 results";
    }

    ?>
</table>

<?php
//Terminate the database connection.
$connection = null;


?>

</body>
</html>