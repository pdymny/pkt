<?php

	require_once "../base.php";

	$cat = $_POST['cat'];
	$date = $_POST['date'];

	$query = $db->query("SELECT * FROM bussines WHERE id_category = ".$cat." AND date = '".$date."'");
	while($tab = $query->fetch()) {
		$table[] = array('name' => $tab['business'], 'phone' => $tab['phone'], 'email' => $tab['email']);
	}

?>

<h1>Lista: <?php echo $date; ?></h1>

<div id='text'>
	<table>
		<tr>
			<th>Nazwa firmy</th>
			<th style="width:100px;">Telefon</th>
			<th>E-mail</th>
		</tr>
	<?php foreach($table as $tab) { ?>
		<tr>
			<td><?php echo $tab['name']; ?></td>
			<td><?php echo $tab['phone']; ?></td>
			<td><?php echo $tab['email']; ?></td>
		</tr>
	<?php } ?>
	</table>
</div>