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

<h1> Job Postings </h1>

<p><a href="index.php" class="button">Home</a></p>

<?php

#connect to the database
$pdo = new PDO('mysql:host=localhost;dbname=conferencedb', "root", "");

#the query 
$sql = "SELECT name FROM company";

#create the query
$opts = $pdo->prepare($sql);
$opts->execute();
?>


<form action="jobs.php" method='post'>
	<select name="company">
		<option>--select--</option>
			<?php
			while ($row = $opts->fetch()) {
				echo "<option value=".$row["name"].">" . $row["name"] ."</option>";
			}
			?>
	</select>
	<input type="submit" />
</form>

<br>
<br>

<?php
	error_reporting(0);
	echo "<h3>Jobs specific to ".$_POST['company']."</h3>";
	echo "<table cellspacing = 15><tr><th>Company</th><th>Position</th><th>Pay Rate</th><th>City</th><th>Province</th></tr>";

	$pdo = new PDO('mysql:host=localhost;dbname=conferencedb', "root", "");

	$sql = "select * from company, job_ads 
			where company.company_ID = job_ads.company_ID AND company.name = '".$_POST['company']."'";
	$stmt = $pdo->prepare($sql);   #create the query
	$stmt->execute();   #bind the parameters

	while ($row = $stmt->fetch()) {
		echo "<tr><td>".$row["name"]."</td><td>".$row["position"]."</td><td>".$row["pay_rate"]."</td><td>".$row["city"]."</td><td>".$row["province"]."</td></tr>";
	}

?>

</table>

<br>
<br>

<?php
echo "<h3>The following are all posted job advertisements</h3>";
echo "<table cellspacing = 15><tr><th>Company Position</th><th>Company ID</th><th>Pay Rate</th><th>City</th><th>Province</th></tr>";

# Connect to the database
$pdo = new PDO('mysql:host=localhost;dbname=conferencedb', "root", "");

$sql = "select * from job_ads";
$stmt = $pdo->prepare($sql);   #create the query
$stmt->execute();   #bind the parameters

while ($row = $stmt->fetch()) {
	echo "<tr><td>".$row["position"]."</td><td>".$row["company_ID"]."</td><td>".$row["pay_rate"]."</td><td>".$row["city"]."</td><td>".$row["province"]."</td></tr>";
}
?>

</table>
</body>
</html>
