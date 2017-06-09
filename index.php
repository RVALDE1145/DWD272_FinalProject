<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
</head>
<body>
    <form action="" method="POST">
		<fieldset>
				<legend>Become a Player!</legend>
					<br>
					<label>First Name:* </label>
							<input type="text" name="firstname" maxlength="25" value="<?php if (isset($_POST['firstname'])) echo $_POST['firstname']; ?>">
					<br>
					<label>Last Name:* </label>
							<input type="text" name="lastname" maxlength="25" value="<?php if (isset($_POST['lastname'])) echo $_POST['lastname']; ?>">
					<br>
					<label>Email:* </label>
							<input type="text" name="pemail" maxlength="30" value="<?php if (isset($_POST['pemail'])) echo $_POST['pemail']; ?>">
					<br>
					<label>Zip Code:* </label>
							<input type="text" name="pzipcode" maxlength="6" value="<?php if (isset($_POST['pzipcode'])) echo $_POST['pzipcode']; ?>">
					<br>
					<br>
					<label>PlayerID:* </label>
							<input type="text" name="playerid" maxlength="25" value="<?php if (isset($_POST['playerid'])) echo $_POST['playerid']; ?>">
					<br>							
					<br>
				<button name="submit" value="submit" type="submit">Done</button>
		</fieldset>		
	</form>
	
   <?php	

		echo "<p>in php</p>";
		// form submit
		if($_SERVER['REQUEST_METHOD'] == 'POST'){	
			
                        // connect to db
			require ('mysqli_connect.php');
                        
			echo "<p>verif start</p>";
			
			$errors = array();
			
			// fname
			if (empty($_POST['firstname'])){
				$errors[] = 'Enter First Name.';
			} else {
				$fName = mysqli_real_escape_string($dbc, $_POST['firstname']);
			}
			
			// lname
			if (empty($_POST['lastname'])){
				$errors[] = 'Enter Last Name.';
			} else {
				$lName = mysqli_real_escape_string($dbc, $_POST['lastname']);
			}
			
			// email
			if (empty($_POST['pemail'])) {
				$errors[] = 'Enter Email.';
			} else {
				$email = mysqli_real_escape_string($dbc, $_POST['pemail']);
			}
			
			// zipcode
			if (empty($_POST['pzipcode']) && is_numeric($dbc, $_POST['pzipcode'])){
				$errors[] = 'Enter Zip Code.';
			} else {
				$zip = trim($_POST['pzipcode']);
			}
			
			// playerid
			if (empty($_POST['playerid'])){
				$errors[] = 'Enter PlayerID.';
			} else {
				$pid = mysqli_real_escape_string($dbc, $_POST['playerid']);
			}
			
			// if form submission complete
			if (empty($errors)) {
				
				echo '<p>running queries</p>';
				
				// make query
				$q = "INSERT INTO person (email, fName, lName, zipCode) VALUES ('$fName', '$lName', '$email', '$zip')";
				$qq = "INSERT INTO player (playerID) VALUES ('$pid')";
				
				// run query
				$r = @mysqli_query ($dbc, $q, $qq);
				
				if ($r) // if ($r) if ran ok
				{
					echo 'Thank you, added new player!';
				} else {
					echo '<p>Add new player failed. :(</p>';
					echo mysqli_error($dbc);
				}
				
				// clear out
				mysqli_close($dbc);				
				exit();				
				
				} else {
				echo 'Error!';
				foreach ($errors as $msg){
					echo " - $msg<br />\n"; // print each error				
				}
				echo "Try Again.";
                                
			
			} // end if(empty($errors))
                
		} // end of post
 		
    ?> 
	
</body>
</html>