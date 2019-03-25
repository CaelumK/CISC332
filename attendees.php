<!DOCTYPE html>
<html>
<head>
	<link href="styles.css" type="text/css" rel="stylesheet">
</head>
<body>

<h1> Conference Attendees </h1>

<a href="index.html" class="button">Home</a>
<?php
echo "<p>Conference attendees broken down by category</p>";
echo "<h3>Students</h3>";
echo "<table cellspacing = 15><tr><th>First Name</th><th>Last Name</th></tr>";

# Connect to the database
$pdo = new PDO('mysql:host=localhost;dbname=conferencedb', "root", "");

$sql = "select * from attendees where attendees.type = 'student'";
$stmt = $pdo->prepare($sql);   #create the query
$stmt->execute();   #bind the parameters

while ($row = $stmt->fetch()) {
	echo "<tr><td>".$row["first_name"]."</td><td>".$row["last_name"]."</td></tr>";
}
echo "</table>";
echo "<h3>Professionals</h3>";
echo "<table cellspacing = 15><tr><th>First Name</th><th>Last Name</th></tr>";


$sql = "select * from attendees where attendees.type = 'professional'";
$stmt = $pdo->prepare($sql);   #create the query
$stmt->execute();   #bind the parameters

while ($row = $stmt->fetch()) {
	echo "<tr><td>".$row["first_name"]."</td><td>".$row["last_name"]."</td></tr>";
}

echo "</table>";
echo "<h3>Sponsors</h3>";
echo "<table cellspacing = 15><tr><th>First Name</th><th>Last Name</th></tr>";


$sql = "select * from attendees where attendees.type = 'sponsor'";
$stmt = $pdo->prepare($sql);   #create the query
$stmt->execute();   #bind the parameters

while ($row = $stmt->fetch()) {
	echo "<tr><td>".$row["first_name"]."</td><td>".$row["last_name"]."</td></tr>";
}
?>

</table>
</body>
</html>
