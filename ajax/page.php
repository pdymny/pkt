<?php

	include "../lib/html/simple_html_dom.php";
	require_once "../base.php";

	function categories($name, $db) {
		$query = $db->query("SELECT *, 	(SELECT COUNT(*) FROM bussines WHERE id_category = categories.id) AS lot, 
										(SELECT COUNT(*) FROM bussines WHERE id_category = categories.id AND phone > 0) AS phone,
										(SELECT COUNT(*) FROM bussines WHERE id_category = categories.id AND email != '') AS email
										FROM categories WHERE name = '".$name."'");
		$query = $query->fetch();

		return $query;
	}

	function page($name) {

		$file = "https://panoramafirm.pl/szukaj?k=".$name;


		//if(@file_exists($file)) {

			$html = file_get_html($file);

			print_r($html);


			$ret = $html->find('h1 b');
			$ret = $ret[0]->plaintext;

		//} else {
		//	$ret = 0;
		//}

		return $ret;
	}


	$name = $_POST['page'];

	$categories = categories($name, $db);
	$h1 = page($name);

?>

<h1><?php echo $name; ?></h1>
<div id='text'>
	<table style='width:400px;'>
		<tr>
			<th>W bazie:</th>
			<td><?php echo $categories['lot']; ?></td>
			<td><button class='button' onclick="display(<?php echo $categories['id']; ?>, '<?php echo $name; ?>');">Zobacz</button></td>
		</tr>
		<tr>
			<th>W bazie (numery):</th>
			<td><?php echo $categories['phone']; ?></td>
			<td></td>
		</tr>
		<tr>
			<th>W bazie (email):</th>
			<td><?php echo $categories['email']; ?></td>
			<td></td>
		</tr>
		<tr>
			<th>Na stronie:</th>
			<td><?php echo $h1; ?></td>
			<td>
			<?php //if(!empty($h1)) { ?>
				<button class='button' onclick="donwload(<?php echo $categories['id']; ?>, '<?php echo $name; ?>');">Pobierz nowe</button>
			<?php //} else { ?>
				<!--Brak połączenia.-->
			<?php //} ?>
			</td>
		</tr>
	</table>
</div>