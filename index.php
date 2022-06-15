<?php

	require_once "base.php";

	function categories($db, $table=null) {
		$query = $db->query("SELECT * FROM categories WHERE id > 0");
		while($tab = $query->fetch()) {
			$table[] = $tab['name'];
		}
		return $table;
	}


	if(!empty($_POST['cat'])) {

		$cat = $_POST['cat'];

		$db->exec("INSERT INTO categories (name) VALUE ('".$cat."')");
	}

	$categories = categories($db);

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Baza firm.</title>
	<script src="jquery-1.8.0.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="ajax.js"></script> 
	<link rel="stylesheet" href="style.css">
	</head>
	<body>

		<div class='container'>
			<div class='left'>
				<div id='menu'>
					<h1>Kategorie</h1>

					<div id='text'>
					<?php foreach($categories as $tab) { ?>
						<button class='button' onclick="linker('<?php echo $tab; ?>');"><?php echo $tab; ?></button>

					<?php } ?>

					</div>

				</div>

				<div id='menu'>
					<h1>Nowa kategoria</h1>

					<div id='text'>
						<form action="" method="post">
							<input type='text' name='cat' id='cat' />
							<input class='button' type="submit" value="Zapisz" style="float:right;" />
						</form>
					</div>
				</div>

			</div>

			<div class='right'>
				<div id='main' class='one'></div>
				<div id='main' class='two'></div>
				<div id='main' class='three'></div>
			</div>
		</div>


	</body>
</html>

