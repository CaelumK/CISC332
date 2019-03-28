<!DOCTYPE html>
<html>
<head>
	<link href="styles.css" type="text/css" rel="stylesheet">
</head>
<body>

<h1> Job Postings </h1>

<a href="index.php" class="button">Home</a>

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
	echo "<h3>Jobs Specific to ".$_POST['company']."</h3>";
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
