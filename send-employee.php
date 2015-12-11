<?php
require_once "db-connection.php";

$cleanData = array();
foreach ($_POST as $key => $item){
	$cleanData[$key] = mysqli_real_escape_string($conn, $item);
}

// Hier pusht hij alle info uit de $_POST in de array cleanData hier is $key dus$_POST[post_naam]
// Hier is $item de value die in de velden is ingevuld.
// En daarna escaped hij alle special characters eruit, mysqli_real_escape_string zet eigenlijk voor elk speciaal teken een / dus bijvoorbeeld "'s hertogenbosch" word "/'s hertogen bosch"
// hierdoor kan het op een goeie manier in de db gezet worden

//Sending form data to sql db.

$uploadedImage = $_FILES['post_image']['tmp_name'];
$newImage = 'content/' . $_FILES['post_image']['name'];
move_uploaded_file($uploadedImage, $newImage);

$query = "INSERT INTO employee (name, image, email, phone, role, role_role_id)
VALUES ('$cleanData[post_medewerker]', '$newImage', '$cleanData[post_email]', '$cleanData[post_phone]', '$cleanData[post_role]', 1)";

mysqli_query($conn, $query);


?>