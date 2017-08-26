<?php
	$mysqli = new mysqli('localhost', 'root', '', 'designercontacts');
	$result = $mysqli->query('select * from users');
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<title>Presto Interiors</title>
</head>
<body>
	<header>
		<div class = "headerWrapper">
			
		</div>
	</header>
	<h1></h1>
	<ul>Companies: 
		<?php foreach($result as $row): ?>
			<li><?= $row['company_title'] ?></li>
		<?php endforeach; ?>
		<form meathod = "post" >

		</form>
		<?php
			$testarray = [1, 2, 3, 4];
			echo (count($testarray));

		  ?>
	</ul>
</body>
</html>