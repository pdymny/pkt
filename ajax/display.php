<?php

	require_once "../base.php";


	$name = $_POST['page'];
	$cat = $_POST['cat'];

	$query = $db->query("SELECT *, 	COUNT(*) AS lot, date AS c,
									(SELECT COUNT(*) FROM bussines WHERE id_category = ".$cat." AND phone > 0 AND date = c) AS xphone,
									(SELECT COUNT(*) FROM bussines WHERE id_category = ".$cat." AND email != '' AND date = c) AS xemail
								 FROM bussines WHERE id_category = ".$cat." GROUP BY c");
	while($tab = $query->fetch()) {
		$table[] = array('date' => $tab['date'], 'lot' => $tab['lot'], 'phone' => $tab['xphone'], 'email' => $tab['xemail']);
	}

?>

<h1>Lista ściągnięć</h1>

<div id="text">
	<table>
		<tr>
			<th>Data utworzenia</th>
			<th>Ilość</th>
			<th>Numery</th>
			<th>E-mail</th>
			<th></th>
			<th></th>
			<tH></tH>
		</tr>
	<?php foreach($table as $tab) { ?>
		<tr>
			<td><?php echo $tab['date']; ?></td>
			<td><?php echo $tab['lot']; ?></td>
			<td><?php echo $tab['phone']; ?></td>
			<td><?php echo $tab['email']; ?></td>
			<td><button class='button' onclick="lista(<?php echo $cat; ?>, '<?php echo $tab['date']; ?>');">Pokaż</button></td>
			<td><a class='button' href='pdf.php?cat=<?php echo $cat; ?>&date=<?php echo $tab['date']; ?>' target="_blank">PDF</a></td>
			<td><button class='button' onclick="mailing(<?php echo $cat; ?>, '<?php echo $tab['date']; ?>');">Mailing</button></td>
		</tr>
	<?php } ?>
	</table>
</div>
