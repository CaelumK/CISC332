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

<h1> Conference Attendees </h1>

<p><a href="attendees.php" class="button">Attendees</a></p>

<form action='attendees.php' method='post'>
		<p>First name:</p>
		<input type='text' name='first_name'>
		<br>
		<p>Last name:</p>
		<input type='text' name='last_name'>
		<br>
<?php

	$pdo = new PDO('mysql:host=localhost;dbname=conferencedb', "root", "");

	
	if ($_POST['type'] == 'student') {
		#the query 
		$sql = "SELECT room_num
				FROM(
				    SELECT *
				    FROM hotel_room
				    JOIN(
				        SELECT room_number as room_num,COUNT(attendee_ID) as people
				        FROM accommodation
				        GROUP BY room_number
				    ) AS rooms
				    ON hotel_room.room_number = rooms.room_num
				) AS beds
				WHERE (beds.people) < (beds.number_of_beds)*2";

		#create the query
		$opts = $pdo->prepare($sql);
		$opts->execute();
		
		echo "<p>Select Room Number:</p>
			  <select name='room_number'>
			  <option>--select--</option>";
			
		while ($row = $opts->fetch()) {
				echo "<option value=".$row["room_num"].">" . $row["room_num"] ."</option>";	
		}
	} elseif ($_POST['type'] == 'sponsor'){
		echo "<p>Select Representing Company:</p>";
		#the query 
		$sql = "SELECT DISTINCT * FROM company";

		#create the query
		$opts = $pdo->prepare($sql);
		$opts->execute();
		echo 
		"<select name='company_ID'>
		<option>--select--</option>";
		while ($row = $opts->fetch()) {
			echo "<option value=".$row["company_ID"].">" . $row["name"] ."</option>";
		}
	}
	
	echo "<br><input value = 'Add', type='submit'>
		 </form>";

	?>

