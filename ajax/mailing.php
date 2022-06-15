<?php

	require_once "../base.php";

	$cat = $_POST['cat'];
	$date = $_POST['date'];

	$query = $db->query("SELECT COUNT(*) AS lot FROM bussines WHERE id_category = ".$cat." AND date = '".$date."' AND email != '' ");
	$query = $query->fetch();

?>

<h1>Mailing: <?php echo $date; ?> | <?php echo $query['lot']; ?> firm.</h1>

<div id='text'>

	<input type="text" name="title" id="title" style="width:85%;"/>
	<button class='button' onclick="mailing_send(<?php echo $cat; ?>, '<?php echo $date; ?>');">Wyślij</button>
	<br/>
	<textarea name="text" id="texter" style="width:95%;height:200px;"></textarea>
	
</div>