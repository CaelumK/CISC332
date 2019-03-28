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


<h1> Company Sponsorship Levels </h1>

<p><a href="index.php" class="button">Home</a></p>
<p>Levels: 1 - Platinum, 2 - Gold, 3 - Silver, 4 - Bronze</p>

<h3>Edit sponsors:</h3>
<p>If removing sponsors, only need to provide the company ID.</p>
<p>This will remove all representative attendees for that sponsor</p>

<form action="sponsors.php" method="post">
	<p>Action:</p>
	<select type="type", name="action">
		<option value = 0>--select--</option>
		<option value = 1>Add Sponsor</option>
		<option value = 2>Remove Sponsor</option>
	</select>
	<input value = "Submit", type="submit">
</form>

<?php
error_reporting(0);
if ($_POST['action'] == 1){
	echo "<form action='sponsors.php' method='post'>
			<p>Company Name:</p>
			<input type='text' name='name'>
			<br>
			<p>Sponsorship Level:</p>
			<select type ='text', name='level'>
				<option value = 1>Platinum</option>
				<option value = 2>Gold</option>
				<option value = 3>Silver</option>
				<option value = 4>Bronze</option>
			</select>
			<input value = 'Add', type='submit'>
		</form>";
} elseif ($_POST['action'] == 2) {
	echo "<form action='sponsors.php' method='post'>
			<p>Provide company ID of sponsor to remove:</p>
			<input type='text' name='ID'>
			<input value = 'Remove', type='submit'>
		</form>";	
}
?>




<?php
error_reporting(0);
$pdo = new PDO('mysql:host=localhost;dbname=conferencedb', "root", "");

# Insert a new value into database
if (strlen($_POST['name']) > 0) {
	# Fetching the biggest company identifier
	$sql = "SELECT company_ID, name
		   FROM company
		   WHERE company_ID = ALL(SELECT max(company_ID) AS max_id FROM company)";
	
	$stmt = $pdo->prepare($sql);   #create the query
	$stmt->execute();   #bind the parameters
	$row = $stmt->fetch();
	
	# Setting id to 1 greater than the biggest
	$company_id = $row['company_ID']+1;
	
	# Initializing to 0 emails sent
	$emails_sent = 0;
	
	# Inserting new company into company table and company into sponsorship level table
	$sql = "INSERT INTO company values
			(".$company_id.",'".$_POST['name']."',".$emails_sent.");
			INSERT INTO sponsorship_level values (".$company_id.",".$_POST['level'].")";

	# Executing statement	
	$stmt = $pdo->prepare($sql);   #create the query
	$stmt->execute();   #bind the parameters
	echo "<p>".$_POST['name']." successfully added to sponsors!</p>";
} elseif ($_POST['ID'] > 0) {
	$sql = "DELETE FROM company WHERE company_ID =".$_POST['ID'].";
		DELETE FROM sponsorship_level WHERE company_ID =".$_POST['ID'].";
		";
	$stmt = $pdo->prepare($sql);   #create the query
	$stmt->execute();   #bind the parameters
	
}

echo "<p>The following are all of the conference sponsors</p>";
echo "<table cellspacing = 15><tr><th>Company ID</th><th>Company Name</th><th>Sponsorship Level</th><th>Emails Sent</th></tr>";

# Connect to the database
$pdo = new PDO('mysql:host=localhost;dbname=conferencedb', "root", "");

$sql = "select * from company, sponsorship_level 
		where company.company_ID = sponsorship_level.company_id";
$stmt = $pdo->prepare($sql);   #create the query
$stmt->execute();   #bind the parameters

while ($row = $stmt->fetch()) {
	echo "<tr><td>".$row["company_ID"]."</td><td>".$row["name"]."</td><td>".$row["tier_ID"]."</td><td>".$row["emails_sent"]."</td></tr>";
} 
?>

</table>
</body>
</html>
