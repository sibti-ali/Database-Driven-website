<?php

/* This page displays the owners details
 */
include_once 'db_connect.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Owners</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400&display=swap" rel="stylesheet">
    <style type="text/css">
    
        body{background-image: url("../rsc/dog2.jpg");
            font-family: 'Montserrat', sans-serif;
        }
        h1{
            color: saddlebrown;
            font-weight: 200;
            font-size: 25px;
            
        }
        table{
            border-collapse: collapse;
            width: 100%;
            color: saddlebrown;
            
            font-size:15px;
            text-align: left;
        }
        th{
            background: bisque;
        }
        tr:nth-child(even) {background-color: #dddddd;}
        tr {
            border-bottom: 0.5px solid saddlebrown ;

        }
    </style>
</head>
<body>
<h1>The owner contact details are given below:</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Address</th>
        <th>Email</th>
        <th>Phone</th>
    </tr>
<?Php

if(isset($_GET['ID'])) {
    $connection;
//storing the url query string in a variable
    $ID = mysqli_real_escape_string($connection, $_GET['ID']);
//query for the selected owner details
    $Owner_query = "SELECT * FROM owners WHERE id = '$ID'; ";
    $Owner_result = mysqli_query($connection, $Owner_query) or die ("Bad query: $Owner_query");
    $Owner_row = mysqli_fetch_array($Owner_result);
    echo '<tr><td>' . $Owner_row['id'] . '</td><td>' . $Owner_row['name'] . '</td><td>' . $Owner_row['address'] . '</td><td>' . $Owner_row['email'] . '</td><td>' . $Owner_row['phone'] . '</td></tr>';
} else {
    //redirect to the home page
    header('Location: index.php');
}
?>

</table>
</body>
</html>
