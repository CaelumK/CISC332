<!DOCTYPE html>
<html>
<head>
	<link href="styles.css" type="text/css" rel="stylesheet">
</head>
<body>

<h1> Conference Schedule </h1>


<a href="schedule.php" class="button">Back to Schedule</a>

<p>Choose an Event to Edit:</p>

<?php

#connect to the database
$pdo = new PDO('mysql:host=localhost;dbname=conferencedb', "root", "");

#the query 
$sql = "SELECT session_ID, session_name, slot_date, start_time, end_time FROM time_slot";

#create the query
$opts = $pdo->prepare($sql);
$opts->execute();


?>


<form action="editSchedule.php" method='post'>
	<select name="session">
		<option>--select--</option>
			<?php
			while ($row = $opts->fetch()) {
				echo "<option value=".$row["session_ID"].">" . $row["session_name"] ."</option>";
			}
			?>
	</select>
	<input type="submit" />
</form>

<br>
<br>

<?php
	error_reporting(0);

	$pdo = new PDO('mysql:host=localhost;dbname=conferencedb', "root", "");

	$sql = "SELECT * from time_slot where session_ID = '".$_POST['session']."'";
	$stmt = $pdo->prepare($sql);   #create the query
	$stmt->execute();   #bind the parameters
    $stmt=$stmt->fetch();

    echo "Editing session: ".$stmt["session_name"];
    echo
    "<br>
    <form action='editSchedule.php' method='post'>
        Loction: <input type='text' name='location' value = '".$stmt['location']."'><br>
        Date: <input type='text' name='date' value = ".$stmt['slot_date']."><br>
        Start Time: <input type='text' name='startTime' value = ".$stmt['start_time']."><br>
        End Time: <input type='text' name='endTime' value = ".$stmt['end_time']."><br>
        Session_ID: <input type='text' name='session_ID' value = ".$stmt['session_ID'].">
        <input type='submit'>
    </form>";
 
    if (strlen($_POST['location'])>0){

        $sql = "UPDATE time_slot SET location='".$_POST['location']."',slot_date='".$_POST['date']."',start_time='".$_POST['startTime']."',end_time='".$_POST['endTime']."' WHERE session_ID = ".$_POST['session_ID']."";
        $stmt = $pdo->prepare($sql);   #create the query
        $stmt->execute();   #bind the parameters
        $stmt=$stmt->fetch();
        echo $sql;
    }


?>