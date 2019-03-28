<!DOCTYPE html>
<html>
<head>
	<link href="styles.css" type="text/css" rel="stylesheet">
</head>
<body>

<h1> Conference Schedule </h1>

<a href="index.php" class="button">Home</a>
<a href="editSchedule.php" class="button">Edit Schedule</a>

<p>Choose a Date to view the schedule:</p>


<?php

#connect to the database
$pdo = new PDO('mysql:host=localhost;dbname=conferencedb', "root", "");

#the query 
$sql = "SELECT DISTINCT slot_date FROM time_slot";

#create the query
$opts = $pdo->prepare($sql);
$opts->execute();
?>


<form action="schedule.php" method='post'>
	<select name="day">
	<option>--select--</option>
			<?php
			while ($row = $opts->fetch()) {
				echo "<option value=".$row["slot_date"].">" . $row["slot_date"] ."</option>";
			}
			?>
	</select>
	<input type="submit" />
</form>

<br>
<br>

<?php
	error_reporting(0);
	echo "<h3>The planned schedule for ".$_POST['day']."</h3>";
	echo "<table cellspacing = 15><tr><th>Session Name</th><th>Start Time</th><th>End Time</th><th>Location</th></tr>";

	$pdo = new PDO('mysql:host=localhost;dbname=conferencedb', "root", "");

	$sql = "select * from time_slot where slot_date = '".$_POST['day']."'";
	$stmt = $pdo->prepare($sql);   #create the query
	$stmt->execute();   #bind the parameters

	while ($row = $stmt->fetch()) {
		echo "<tr><td>".$row["session_name"]."</td><td>".$row["start_time"]."</td><td>".$row["end_time"]."</td><td>".$row["location"]."</td></tr>";
	}

?>

</body>
</html>
