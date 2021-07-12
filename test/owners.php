<?php
include_once 'db_connect.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Owners</title>
    <style type="text/css">
        body{{background-image:url("rsc/dog.jpg");}}
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
</head>
<body>
<h1>The owner contact details are given below</h1>
<table>
    <tr>
        <th>ID </th>
        <th>Name</th>
        <th>Address</th>
        <th>Email</th>
        <th>Phone</th>
    </tr>
<?Php
$connection;
$ID = mysqli_real_escape_string($connection, $_GET['ID']);
$Owner_query = "SELECT * FROM owners WHERE id = '$ID'; ";
$Owner_result = mysqli_query($connection, $Owner_query) or die ("Bad query: $Owner_query");
$Owner_row = mysqli_fetch_array ($Owner_result);
echo  '<tr><td>' . $Owner_row['id'] . '</td><td>' .$Owner_row['name'] . '</td><td>' .$Owner_row['address'] . '</td><td>' .$Owner_row['email'] . '</td><td>' .$Owner_row['phone'] . '</td></tr>'
?>
</table>

</body>
</html>
