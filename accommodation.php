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

<h1> Hotel Rooms </h1>

<p><a href="index.php" class="button">Home</a></p>

<p>Choose a hotel room to see its residents:</p>


<?php

error_reporting(0);
#connect to the database
$pdo = new PDO('mysql:host=localhost;dbname=conferencedb', "root", "");

#the query 
$sql = "SELECT DISTINCT room_number FROM accommodation";

#create the query
$opts = $pdo->prepare($sql);
$opts->execute();
?>


<form action="accommodation.php" method='post'>
	<select name="roomNumber">
		<option>--select--</option>
			<?php
			while ($row = $opts->fetch()) {
				echo "<option value=".$row["room_number"].">" . $row["room_number"] ."</option>";
			}
			?>
	</select>
	<input type="submit" />
</form>

<br>
<br>

<?php
error_reporting(0);


echo "<h3>The following are all staying in room ".$_POST['roomNumber']." </h3>";
echo "<table cellspacing = 15><tr><th>First Name</th><th>Last Name</th></tr>";

$pdo = new PDO('mysql:host=localhost;dbname=conferencedb', "root", "");

$sql = "select * from accommodation where room_number = '".$_POST['roomNumber']."'";
$stmt = $pdo->prepare($sql);   #create the query
$stmt->execute();   #bind the parameters

while ($row = $stmt->fetch()) {
	echo "<tr><td>".$row["first_name"]."</td><td>".$row["last_name"]."</td></tr>";
}


//Initializing variable
$roomNumber = 0; //Initialization value; Examples
             //"" When you want to append stuff later
             //0  When you want to add numbers later
//isset()
$value = isset($_POST['roomNumber']) ? $_POST['roomNumber'] : '';
//empty()
$value = !empty($_POST['roomNumber']) ? $_POST['roomNumber'] : '';

error_reporting(E_ERROR | E_PARSE);


?>

</body>
</html>
