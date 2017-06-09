<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
</head>
<body>

<form action = "" method="POST">
<button name="submit" value="submit" type="submit">Run</button>
</form>

<?php require ('mysqli_connect.php'); ?>

<?php 

// queries to return a screen with data from db
$q = "USE GameCo;

SELECT player.playerID, game.gameID, game.gmID 
FROM player
INNER JOIN game ON player.gameID=game.gameID
ORDER BY gameID;

SELECT person.email, player.playerID
FROM person
INNER JOIN player ON player.email = person.email
ORDER BY person.email;

SELECT companyID, gameID, gmID
FROM game
ORDER BY companyID;";

$r = @mysqli_query ($dbc, $q); 

	// run queries
	if ($r) { // if it ran OK.

		echo '<h1>Success!</h1>';
		echo ($r);	

	} else { // if it did not run OK.

		// error message
		echo '<h1>System Error</h1>';		 
			
	} // end of if ($r)
	
	// close database connection
	mysqli_close($dbc); 
	
	include ('includes/footer.html'); 
	exit();

?>


