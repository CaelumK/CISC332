<!DOCTYPE html>
<html>
<head>
<link href="firstPage.css" type="text/css" rel="stylesheet" >
</head>
<body>
<h2>Employee Information</h2>


<?php
$givenName = $_POST["firstname"];                      
$surname = $_POST["lastname"];
$dept = $_POST["deptname"];
echo "<h3>Hello $givenName $surname</h3>";
echo "<p>I see you are in the $dept department.</p>";

echo "<p>Here is a list of all the professors at the university and their salaries!</p>";

echo "<table><tr><th>Name</th><th>Room Number</th></tr>";

#connect to the database
$pdo = new PDO('mysql:host=localhost;dbname=conferencedb', "root", "");

$sql = "select first_name, room_number from accomodation";
$stmt = $pdo->prepare($sql);   #create the query
$stmt->execute();   #bind the parameters

#stmt contains the result of the program execution
#use fetch to get results row by row.
while ($row = $stmt->fetch()) {
	echo "<tr><td>".$row["first_name"]."</td><td>".$row["room_number"]."</td></tr>";
}


?>
</table>
</body>
</html> 
