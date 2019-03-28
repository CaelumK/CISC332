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
		width: 50%;
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
	td,tr{
		border: 1px solid black;
		padding: 5px;
		text-align: center;
		vertical-align: center;
	}
</style>
<body>

<h1> Conference Schedule </h1>

<p><a href="index.php" class="button">Home</a>
<a href="editSchedule.php" class="button">Edit Schedule</a></p>

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
