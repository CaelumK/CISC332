<!DOCTYPE html>
<html>
<head>
	<link href="styles.css" type="text/css" rel="stylesheet">
</head>
<body>

<h1> Organising Committee </h1>

<a href="index.php" class="button">Home</a>

<p>Choose a Sub-Committee to view its members:</p>


<?php

#connect to the database
$pdo = new PDO('mysql:host=localhost;dbname=conferencedb', "root", "");

#the query 
$sql = "SELECT sub_committee_name FROM sub_committee";

#create the query
$opts = $pdo->prepare($sql);
$opts->execute();
?>


<form action="committee.php" method='post'>
	<select name="committee">
			<option>--select--</option>
			<?php
			while ($row = $opts->fetch()) {
				echo "<option value=".$row["sub_committee_name"].">" . $row["sub_committee_name"] ."</option>";
			}
			?>
	</select>
	<input type="submit" />
</form>

<br>
<br>

<?php
	error_reporting(0);
	echo "<h3>The following are all memebers on the ".$_POST['committee']." sub committee</h3>";
	echo "<table cellspacing = 15><tr><th>First Name</th><th>Last Name</th></tr>";

	$pdo = new PDO('mysql:host=localhost;dbname=conferencedb', "root", "");

	$sql = "select * from participation where sub_committee_name = '".$_POST['committee']."'";
	$stmt = $pdo->prepare($sql);   #create the query
	$stmt->execute();   #bind the parameters

	while ($row = $stmt->fetch()) {
		echo "<tr><td>".$row["first_name"]."</td><td>".$row["last_name"]."</td></tr>";
	}

?>

</body>
</html>
