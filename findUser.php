<html>
    <head>
		<title>Animals vet Database</title>
	</head>
    <body>
        <h1>Animals list</h1>
        <form action="/ist181585/findUser.php">
            Animal Name:<br>
            <input type="text" name="Animalname">
            <br>Owner Name:<br>
            <input type="text" name="Ownername">
            <br>Client VAT:<br>
            <input type="text" name="ClientVAT">
            <br><input type="submit" value="Search">
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
		$Ownername=$_GET['Ownername'];
		$ClientVAT=$_GET['ClientVAT'];
		echo("<h3>Results found with: $Animalname</h3>");
		
		$stmt = $connection->prepare("
		select a.name,a.species_name,a.colour,a.gender, a.birth_year, a.VAT,person.name as person 
		from animal as a,person 
		where a.`name`=? and a.VAT=person.VAT
		and person.name like ?;");		
		
		if ($stmt == FALSE){
			echo("<p>Error in connection");
			exit();
		}
		$stmt->execute(array("$Animalname","%$Ownername%"));
		$result = $stmt->fetchALL();

		$count = 0;
		foreach($result as $row){
			$count = $count + 1;
		}
		if($count !=0){
			echo("<table border=\"1\">");
			echo("<tr><td>name</td><td>species</td><td>colour</td><td>gender</td><td>birth year</td><td>VAT</td><td>person</td></tr>");
			foreach($result as $row){
				echo("<tr><td>");
				echo("<a href='consults.php?name={$row['name']}&VAT={$row['VAT']}&ClientVAT={$ClientVAT}'>{$row['name']}</a>");
				echo("</td><td>");
				echo($row['species_name']);
				echo("</td><td>");
				echo($row['colour']);
				echo("</td><td>");
				echo($row['gender']);
				echo("</td><td>");
				echo($row['birth_year']);
				echo("</td><td>");
				echo($row['VAT']);
				echo("</td><td>");
				echo($row['person']);	
				echo("</td></tr>");	
			}
			echo("</table>");
		}else{
			echo("<h4>No Match Found</h4>");
			echo("<a href='test.php?'>Add Animal</a>");
		}
	$connection = null;		
    ?>
    
    

</html>
