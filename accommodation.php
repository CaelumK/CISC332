<!DOCTYPE html>
<html>
<head>
	<link href="styles.css" type="text/css" rel="stylesheet">
</head>
<body>

<h1> Hotel Rooms </h1>

<a href="index.html" class="button">Home</a>

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


echo "<h3>The Following Are all staying in room ".$_POST['roomNumber']." </h3>";
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
