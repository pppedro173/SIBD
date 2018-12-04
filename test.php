<html>
	<head>
		<title>ADD ANIMAL</title>
	</head>
	<body>
		<h1>Add Animal</h1>
		<form action="/ist181585/test.php">
			Animal Name:<br>
			<input type="text" name="Animalname">
			<br>Owner VAT:<br>
			<input type="text" name="OwnerVAT">
			<br>Species Name:<br>
			<input type="text" name="SpeciesName">
			<br>Colour:<br>
			<input type="text" name="NewColor">
			<br>Gender:<br>
			<input type="text" name="NewAnimalGender">
			<br>Birth Year:<br>
			<input type="text" name="NewAnimalBirthYear">
			<br>Age:<br>
			<input type="text" name="NewAnimalAge">
			<br><input type="submit" value="Submit">
		</form>
	</body>
	<?php
	        $host = "db.tecnico.ulisboa.pt";
	        $user = "ist181585";
			$pass = "cprq3592";
	        $dsn = "mysql:host=$host;dbname=$user";
	        try{
	            $connection = new PDO($dsn, $user, $pass);
	        }
	        catch(PDOException $exception){
	            echo("<p>Error: ");
	            echo($exception->getMessage());
	            echo("</p>");
	            exit();
	        }
			$Animalname = $_GET['Animalname'];
			$OwnerVAT=$_GET['OwnerVAT'];
			$SpeciesName=$_GET['SpeciesName'];
			$NewColor=$_GET['NewColor'];
			$NewAnimalGender=$_GET['NewAnimalGender'];
			$NewAnimalBirthYear=$_GET['NewAnimalBirthYear'];
			$NewAnimalAge=$_GET['NewAnimalAge'];
			
			
			$sql = " insert into animal values('$Animalname','$OwnerVAT','$SpeciesName','$NewColor','$NewAnimalGender','$NewAnimalBirthYear','$NewAnimalAge')";
			echo("<p>$sql</p>");
			$nrows = $connection->exec($sql);
			echo("<p>Rows inserted: $nrows</p>");
			if ($nrows==1){
				echo("<p>Rows inserted: $nrows</p>");
				echo("<tr><td>");
				echo("<a href='findUser.php?name={$row['Animalname']}&VAT={$row['OwnerVAT']}&ClientVAT={$OwnerVAT}'>Select Animal</a>");
				echo("<tr><td>");
				}

			

	    $connection = null;
	?>
</html>