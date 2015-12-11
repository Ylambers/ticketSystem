<?php 
	require_once ("db-connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Employee</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="container">
		<div class="grid">
			<div class="grid-item one-whole">
				<h3>De medewerkers</h3>
			</div>	
			<?php 
				$query = "SELECT * FROM employee";
				$res = mysqli_query($conn, $query);
				while ($row = mysqli_fetch_array($res)) {
					echo '<div class="grid-item one-quarter">';
					echo '<div class="employee-block">';
					echo "<span> Naam: </span>";
					echo $row['name'];
					echo "<br />";
					echo "<span> Telefoon-nummer: </span>";
					echo $row['phone'];
					echo "<br />";
					echo "<span> E-mail: </span>";
					echo $row['email'];
					echo "<br />";
					echo "<span> Rechten: </span>";
					echo $row['role'];
					echo "<br/>";
					echo "<span> Foto van de medewerker:</span>";
					echo "<br/>";
					echo "<img src=" . $row['image'] . " width='100px' height='150px'>";
					echo "</div>";
					echo "</div>";
				}
			?>
		</div>
		<div class="grid">
			<div class="grid-item one-whole">
				<h3>Medewerker toevoegen</h3>
			</div>
			<div class="grid-item one-whole">					
				<form enctype="multipart/form-data" name="form" action="send-employee.php" method="post">
					<h5>Naam van de Medewerker:</h5>
				    <input type="text" name="post_medewerker" required>
				    <h5>Foto van medewerker:</h5>
				    <input type="file" name="post_image">
				    <h5>E-mail:</h5>
				    <input type="text" name="post_email" required>
				    <h5>Telefoon-nummer:</h5>
				    <input type="text" name="post_phone" required>
				    <h5>Rechten van de medewerker:</h5>
				    <input type="text" name="post_role" required>
				    <br /> <br>
				    <input type="submit" value="Medewerker toevoegen">
				</form>
			</div>
		</div>
</body>
</html>