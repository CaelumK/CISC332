<!DOCTYPE html>
<html>
<head>
	<link href="styles.css" type="text/css" rel="stylesheet">
</head>
<body>

<h1> Job Postings </h1>

<a href="index.html" class="button">Home</a>
<?php
echo "<p>The following are all posted job advertisements</p>";
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
