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

<h1> Organising Committee </h1>

<p><a href="index.php" class="button">Home</a></p>

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
	echo "<h3>The following are all members on the ".$_POST['committee']." sub-committee</h3>";
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
