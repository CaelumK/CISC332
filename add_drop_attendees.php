</head>
<body>

<h1> Conference Attendees </h1>

<a href="attendees.php" class="button">Attendees</a>

<form action='attendees.php' method='post'>
		<p>First name:</p>
		<input type='text' name='first_name'>
		<br>
		<p>Last name:</p>
		<input type='text' name='last_name'>
		<br>
<?php

	$pdo = new PDO('mysql:host=localhost;dbname=conferencedb', "root", "");

	
	if ($_POST['type'] == 'student') {
		#the query 
		$sql = "SELECT DISTINCT room_number FROM accommodation";

		#create the query
		$opts = $pdo->prepare($sql);
		$opts->execute();
		
		echo "<p>Select Room Number:</p>
			  <select name='room_number'>";
			
		while ($row = $opts->fetch()) {
			echo "<option value=".$row["room_number"].">" . $row["room_number"] ."</option>";
		}
	} elseif ($_POST['type'] == 'sponsor'){
		echo "<p>Select Representing Company:</p>";
		#the query 
		$sql = "SELECT DISTINCT * FROM company";

		#create the query
		$opts = $pdo->prepare($sql);
		$opts->execute();
		echo 
		"<select name='company_ID'>";
		while ($row = $opts->fetch()) {
			echo "<option value=".$row["company_ID"].">" . $row["name"] ."</option>";
		}
	}
	
	echo "<input value = 'Add', type='submit'>
		 </form>";

	?>

