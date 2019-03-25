<!DOCTYPE html>
<html>
<head>
	<link href="styles.css" type="text/css" rel="stylesheet">
</head>
<body>

<h1> Company Sponsorship Levels </h1>

<a href="index.html" class="button">Home</a>
<?php
echo "<p>The following are all of the conference sponsors</p>";
echo "<table cellspacing = 15><tr><th>Company Name</th><th>Sponsorship Level</th></tr>";

# Connect to the database
$pdo = new PDO('mysql:host=localhost;dbname=conferencedb', "root", "");

$sql = "select company.name, sponsorship_level.tier_ID from company, sponsorship_level 
		where company.company_ID = sponsorship_level.company_id";
$stmt = $pdo->prepare($sql);   #create the query
$stmt->execute();   #bind the parameters

while ($row = $stmt->fetch()) {
	echo "<tr><td>".$row["name"]."</td><td>".$row["tier_ID"]."</td></tr>";
}
?>

</table>
</body>
</html>
