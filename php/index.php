<?php

/* To-do: A simple database driven website displaying database details.
          

 * Author: Sibtain Ali
 * Version: 1.0
 *
 */




    include_once 'db_connect.php';
    include 'queries.php';
?>
<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <title>PoppletonDogShow</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href = "../css/styles.css">
    
</head>
    <style>
       
    </style>
   
<body>
    <div class="container">
        <nav class="navbar">
            <div class="leftside">
                <a>Poppleton Dog Show</a>
            </div>
            <div class="rightside">
                <a href="http://">our dogs</a>  
                <a href="http://">about</a>
        </div>
         
        </nav>


<?php
$connection;
$header_result = mysqli_query($connection, $header_query);
$header_array = mysqli_fetch_assoc($header_result);
$leaderboard_result = mysqli_query($connection, $leaderboard_query);
?>
<h1> <?php echo 'This year '. $header_array['Owners']?> owners entered <?php echo $header_array['Dogs'] ?> dogs in <?php echo $header_array['Events'] ?> events   </h1>
<h2> The top 10 dogs for this season are:</h2>



        <div id="tabCon">    
            <table>
                <tr class="rows">
                    <th>Name</th>
                    <th>Breed</th>
                    <th>Avg Score</th>
                    <th>Owner</th>
                    <th>Email</th> 
                </tr>
        </div>        
        <?php
    /*
     * Printing out data in the table
     * Clicking on the owner's ID would redirect to a page showing owner's details
     */
    if($leaderboard_result -> num_rows > 0) {
        while ($dog = $leaderboard_result->fetch_assoc()) {
            
            echo '<tr><td>' .  $dog ['Name'] . "</td><td>" . $dog ['Breed'] . "</td><td>" . $dog['Avg_Score']."</td><td>" ."<a class='owners' href='owners.php?ID={$dog['OwnersId']}'>{$dog['Owner']} </a>"."</td><td>" .
                "<a class = 'emails' href='mailto: {$dog['Email']}'> {$dog['Email'] } </a>". "</td></tr>";

        }
            echo "</table>";
    }
    else{
        echo "0 results";
    }
    ?>

       

    </div>
<?php
//Terminate the database connection.
$connection = null;
?>
<script src="../js/index.js"> </script>
</body>
</html>