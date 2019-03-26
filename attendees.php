<!DOCTYPE html>
<html>
<head>
	<link href="styles.css" type="text/css" rel="stylesheet">
</head>
<body>

<h1> Conference Attendees </h1>

<a href="index.html" class="button">Home</a>

<h3>Add a new attendee:<h3>
<form action="attendees.php" method="post">
	<p>First name:</p>
	<input type="text" name="first_name">
	<br>
	<p>Last name:</p>
	<input type="text" name="last_name">
	<br>
	<p>Attendee Type:</p>
	<select type ="text", name="type">
		<option value = "student">Student</option>
		<option value = "professional">Professional</option>
		<option value = "sponsor">Sponsor</option>
	</select>
	<input value = "Add", type="submit">
</form>



<?php
error_reporting(0);
$pdo = new PDO('mysql:host=localhost;dbname=conferencedb', "root", "");

# Insert a new value into database
if (strlen($_POST['first_name']) > 0) {
	# Fetching the biggest attendee identifier
	$sql = "SELECT attendee_id, first_name, last_name
		FROM attendees
		WHERE attendee_id = ALL(SELECT max(attendee_id) AS max_id FROM attendees)";

	$stmt = $pdo->prepare($sql);   #create the query
	$stmt->execute();   #bind the parameters
	$row = $stmt->fetch();
	
	# Setting id to 1 greater than the biggest
	$attendee_id = $row['attendee_id']+1;

	# Determining amount needed to pay
	if ($_POST['type'] == 'student') {
		$fee = 50;
	}	elseif ($_POST['type'] == 'professional') {
		$fee = 100;
	}	else {
		$fee = 0;
	}
	
	# Need to make this dynamic
	$company_ID = null;
	
	# Inserting new attendee into table
	$sql = "INSERT INTO attendees values
		(".$attendee_id.",'".$_POST['first_name']."','".$_POST['last_name']."','".$_POST['type']."',".$fee.",null)";
	
	$stmt = $pdo->prepare($sql);   #create the query
	$stmt->execute();   #bind the parameters
	echo "<p>".$_POST['first_name']." ".$_POST['last_name']." successfully added to attendees!</p>";
}


# Setting up text and table
echo "<p>Conference attendees broken down by category:</p>";
echo "<h3>Students</h3>";
echo "<table cellspacing = 15><tr><th>First Name</th><th>Last Name</th></tr>";

# Connect to the database
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
