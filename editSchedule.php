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


<p><a href="schedule.php" class="button">Back to Schedule</a></p>

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

    echo "<p>Editing session: ".$stmt["session_name"]."</p>";
    echo
    "<br>
    <form action='editSchedule.php' method='post'>
        <p>Location:</p> <input type='text' name='location' value = '".$stmt['location']."'><br>
        <p>Date:</p> <input type='text' name='date' value = ".$stmt['slot_date']."><br>
        <p>Start Time:</p> <input type='text' name='startTime' value = ".$stmt['start_time']."><br>
        <p>End Time:</p> <input type='text' name='endTime' value = ".$stmt['end_time']."><br>
        <p>Session_ID (do not edit):</p> <input type='text' name='session_ID' value = ".$stmt['session_ID']."><br><br>
        <input type='submit'>
    </form>";
 
    if (strlen($_POST['location'])>0){

        $sql = "UPDATE time_slot SET location='".$_POST['location']."',slot_date='".$_POST['date']."',start_time='".$_POST['startTime']."',end_time='".$_POST['endTime']."' WHERE session_ID = ".$_POST['session_ID']."";
        $stmt = $pdo->prepare($sql);   #create the query
        $stmt->execute();   #bind the parameters
        $stmt=$stmt->fetch();
    }


?>