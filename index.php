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

<h1> CEB Conference Details </h1>
<br>
<p> Choose any category for more information. </p>
<p>
<a href="committee.php" class="button">Organising Committee</a>
<a href="attendees.php" class="button">Attendees</a>
<a href="schedule.php" class="button">Schedule</a>
<a href="accommodation.php" class="button">Accomodation</a>
<a href="jobs.php" class="button">Jobs</a>
<a href="sponsors.php" class="button">Sponsors</a></p>
<br>
<?php

#connect to the database
$pdo = new PDO('mysql:host=localhost;dbname=conferencedb', "root", "");

$sql = "SELECT count(attendee_ID) as numStudents FROM attendees where attendees.type = 'student'";
$numStudent = $pdo->prepare($sql);   #create the query
$numStudent->execute();   #bind the parameters


$sql = "SELECT count(attendee_ID) as numProfessionals FROM attendees where attendees.type = 'professional'";
$numProfessional = $pdo->prepare($sql);   #create the query
$numProfessional->execute();   #bind the parameters

$sql = "SELECT count(attendee_ID) as numSponsors FROM attendees where attendees.type = 'sponsor'";
$numSponsor = $pdo->prepare($sql);   #create the query
$numSponsor->execute();   #bind the parameters


$sql = "SELECT count(company_ID) as numBronze FROM sponsorship_level where sponsorship_level.tier_ID = 1";
$numBronze = $pdo->prepare($sql);   #create the query
$numBronze->execute();   #bind the parameters

$sql = "SELECT count(company_ID) as numSilver FROM sponsorship_level where sponsorship_level.tier_ID = 2";
$numSilver = $pdo->prepare($sql);   #create the query
$numSilver->execute();   #bind the parameters

$sql = "SELECT count(company_ID) as numGold FROM sponsorship_level where sponsorship_level.tier_ID = 3";
$numGold = $pdo->prepare($sql);   #create the query
$numGold->execute();   #bind the parameters


$sql = "SELECT count(company_ID) as numPlatnium FROM sponsorship_level where sponsorship_level.tier_ID = 4";
$numPlatnium = $pdo->prepare($sql);   #create the query
$numPlatnium->execute();   #bind the parameters

$num1 = $numStudent->fetch();
$num2 = $numProfessional->fetch();
$num3 = $numSponsor->fetch();
$num4 = $numBronze->fetch();
$num5 = $numSilver->fetch();
$num6 = $numGold->fetch();
$num7 = $numPlatnium->fetch();
$attendeeprofit=(50*$num1['numStudents'])+(100*$num2['numProfessionals']);
$sponsorshipprofit=(10000*$num7['numPlatnium'])+(5000*$num6['numGold'])+(3000*$num5['numSilver'])+(1000*$num4['numBronze'])
?>


<h3>Conference attendance breakdown and profits:</h3>
<table cellspacing = 2 border = 1>
	<tr><th>Students</th><th>Sponsors</th><th>Professionals</th><th>Total Profits from Attendees ($)</th></tr>
    <?php
        echo "<tr><th>".$num1['numStudents']."</th><th>".$num2['numProfessionals']."</th><th>".$num3['numSponsors']."</th><th>".$attendeeprofit."</th></tr>";
    ?>
</table>

<br>

<h3>Conference sponsorship breakdown and profits:</h3>
<table cellspacing = 2 border = 1>
	<tr><th>Bronze</th><th>Silver</th><th>Gold</th><th>Platnium</th><th>Total Profits from Sponsorship ($)</th></tr>
    <?php
        echo "<tr><th>".$num4['numBronze']."</th><th>".$num5['numSilver']."</th><th>".$num6['numGold']."</th><th>".$num7['numPlatnium']."</th><th>".$sponsorshipprofit."</th></tr>";
    ?>
</table>


</body>
</html>