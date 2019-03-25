<!DOCTYPE html>
<html>
<head>
	<link href="styles.css" type="text/css" rel="stylesheet">
</head>
<body>

<h1> Organising Committee </h1>

<a href="index.html" class="button">Home</a>

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

<select id='subcom'>
	<?php
		while ($row = $opts->fetch()) {
			echo "<option>" . $row["sub_committee_name"] ."</option>";
		}
	?>
</select>

<button onclick="viewCommitteeButton()">View</button>

<br>
<br>

<table id="committeeTable" hidden>
	<tr><th>First Name</th><th>Last Name</th></tr>
</table>

<script>
function viewCommitteeButton() {
  

  var comm = document.getElementById("subcom");
  var subCommittee = comm.options[comm.selectedIndex].value;
  document.cookie = "subCommittee";
  

  <?php
  	$sub = "hello";
  	echo $sub;
  	$sql = "SELECT "
  ?>
var comTable = document.getElementById("committeeTable");
  comTable.style.display = "table";

  
} 
</script>
