<!DOCTYPE html>
<html>
<head>
	<link href="styles.css" type="text/css" rel="stylesheet">
</head>
<body>

<h1> CEB Conference Details </h1>
<p> Choose any category for more information. </p>

<a href="committee.php" class="button">Organising Committee</a>
<a href="attendees.php" class="button">Attendees</a>
<a href="schedule.php" class="button">Schedule</a>
<a href="accommodation.php" class="button">Accomodation</a>
<a href="jobs.php" class="button">Jobs</a>
<a href="sponsors.php" class="button">Sponsors</a>

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


<h2>Conference attendance breakdown and profits:</h2>
<table cellspacing = 2 border = 1>
	<tr><th>Students</th><th>Sponsors</th><th>Professionals</th><th>Total Profits from Attendees ($)</th></tr>
    <?php
        echo "<tr><th>".$num1['numStudents']."</th><th>".$num2['numProfessionals']."</th><th>".$num3['numSponsors']."</th><th>".$attendeeprofit."</th></tr>";
    ?>
</table>

<br>

<h2>Conference sponsorship breakdown and profits:</h2>
<table cellspacing = 2 border = 1>
	<tr><th>Bronze</th><th>Silver</th><th>Gold</th><th>Platnium</th><th>Total Profits from Sponsorship ($)</th></tr>
    <?php
        echo "<tr><th>".$num4['numBronze']."</th><th>".$num5['numSilver']."</th><th>".$num6['numGold']."</th><th>".$num7['numPlatnium']."</th><th>".$sponsorshipprofit."</th></tr>";
    ?>
</table>


</body>
</html>