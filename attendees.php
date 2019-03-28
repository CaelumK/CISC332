<!DOCTYPE html>
<html>
<head>
</head>
<style>
	h1,h3{
	  font-family: Verdana, Geneva, sans-serif;
	  color: black;
	  text-align: center;
	}

	p{
	  font-family: Verdana, Geneva, sans-serif;
	  color: black;
	  text-align: center;
	}
	.button {
	  border-radius: 25px;
	  background-color: white;
	  border: 1px solid black;
	  color: black;
	  padding: 5px 10px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 14px;
	  
	}
	form{
		text-align: center;
	}
	table{
		border: 1px solid black;
		border-collapse: collapse;
		width: 75%;
		text-align: center;
		font-size: 20px;
		margin: 1em auto;

	}
	th{
		border: 1px solid black;
		padding: 10px;
		text-align: center;
		vertical-align: center;
	}
	td{
		border: 1px solid black;
		padding: 5px;
		text-align: center;
		vertical-align: center;
	}
	.column {
	  float: left;
	  width: 33.33%;
	}
	.row:after {
	  content: "";
	  display: table;
	  clear: both;
	}
</style>
<body>

<h1> Conference Attendees </h1>

<p><a href="index.php" class="button">Home</a></p>

<h3>Add a new attendee:</h3>
<form action="add_drop_attendees.php" method="post">
	<p>Select attendee type to add:</p>
	<select type ="text", name="type">
		<option>--select--</option>
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
	$sql = "SELECT attendee_id
		FROM attendees
		WHERE attendee_id = ALL(SELECT max(attendee_id) AS max_id FROM attendees)";

	$stmt = $pdo->prepare($sql);   #create the query
	$stmt->execute();   #bind the parameters
	$row = $stmt->fetch();
	
	# Setting id to 1 greater than the biggest
	$attendee_id = $row['attendee_id']+1;

	# Determining amount needed to pay
	if (strlen($_POST['room_number']) > 0) {
		$fee = 50;
		$_POST['type'] = 'student';
		# Inserting new attendee into table
		$sql = "INSERT INTO attendees values
				(".$attendee_id.",'".$_POST['first_name']."','".$_POST['last_name']."','".$_POST['type']."',".$fee.",null);
				INSERT INTO accommodation values
				(".$attendee_id.",".$_POST['room_number'].",'".$_POST['first_name']."','".$_POST['last_name']."')";
				
	}	elseif (strlen($_POST['company_ID']) > 0) {
		$fee = 100;
		$_POST['type'] = 'sponsor';
		
		# insert into attendees and representing tables
		$sql = "INSERT INTO attendees values
				(".$attendee_id.",'".$_POST['first_name']."','".$_POST['last_name']."','".$_POST['type']."',".$fee.",".$_POST['company_ID'].");
				INSERT INTO representing values
				(".$attendee_id.",".$_POST['company_ID'].",'".$_POST['first_name']."','".$_POST['last_name']."',null)";
		
	}	else {
		$fee = 0;
		$_POST['type'] = 'professional';
		$sql = "INSERT INTO attendees values
				(".$attendee_id.",'".$_POST['first_name']."','".$_POST['last_name']."','".$_POST['type']."',".$fee.",null)";
	}
	
	
	# Need to make this dynamic
	$company_ID = null;
	
	
	
	$stmt = $pdo->prepare($sql);   #create the query
	$stmt->execute();   #bind the parameters
	echo "<p>".$_POST['first_name']." ".$_POST['last_name']." successfully added to attendees!</p>";
}


# Setting up text and table
echo "<p>Conference attendees broken down by category:</p>";
echo "<div class=row>";
echo "<div class=column>";
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
echo "</div>";

echo "<div class=column>";
echo "<h3>Professionals</h3>";
echo "<table cellspacing = 15><tr><th>First Name</th><th>Last Name</th></tr>";


$sql = "select * from attendees where attendees.type = 'professional'";
$stmt = $pdo->prepare($sql);   #create the query
$stmt->execute();   #bind the parameters

while ($row = $stmt->fetch()) {
	echo "<tr><td>".$row["first_name"]."</td><td>".$row["last_name"]."</td></tr>";
}

echo "</table>";
echo "</div>";

echo "<div class=column>";
echo "<h3>Sponsors</h3>";
echo "<table cellspacing = 15><tr><th>First Name</th><th>Last Name</th></tr>";


$sql = "select * from attendees where attendees.type = 'sponsor'";
$stmt = $pdo->prepare($sql);   #create the query
$stmt->execute();   #bind the parameters

while ($row = $stmt->fetch()) {
	echo "<tr><td>".$row["first_name"]."</td><td>".$row["last_name"]."</td></tr>";
}

echo "</table>";
echo "</div>";
echo "</div>";
?>

</body>
</html>
