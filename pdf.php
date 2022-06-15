<?php

	include("lib/mpdf/mpdf.php");
	require_once "base.php";

	$cat = $_GET['cat'];
	$date = $_GET['date'];

	$category = $db->query("SELECT *, (SELECT COUNT(*) FROM bussines WHERE id_category = ".$cat.") AS lot FROM categories WHERE id = ".$cat."");
	$category = $category->fetch();

	$x = 0;
	$i = 1;

	while($x <= $category['lot']){
		$table = "";

		$query = $db->query("SELECT * FROM bussines WHERE id_category = ".$cat." AND date = '".$date."' AND phone > 0 LIMIT ".$x.", 30");
		while($tab = $query->fetch()) {
			if(!empty($tab['phone'])) {
				$table[] = array('lp' => $i++, 'name' => $tab['business'], 'phone' => $tab['phone'], 'email' => $tab['email']);
			}
		}

		$data[] = $table;

		$x = $x+31;
	}

	//echo "<pre>";
	//print_r($data);


	$mpdf = new mPDF('UTF-8','A4'); 
	$mpdf->SetTitle('Kategoria: '.$category['name'].'. Pobrane: '.$date.'.');
	$mpdf->SetAuthor('DymCode');
	$mpdf->SetCreator('DymCode Generator PDF 1.0');
	$mpdf->SetFooter('Strona {PAGENO} | Kategoria: '.$category['name'].'. | Pobrane: '.$date.'.');


	foreach($data as $dat) {
		if(!empty($dat)) {
			$content = "
				<link type='text/css' href='style_pdf.css' rel='stylesheet'>

				<page>
					<table border='1'>
						<tr>
							<th style='width:30px;'>Lp.</th>
							<th>Nazwa firmy</th>
							<th style='width:100px;'>Telefon</th>
							<th>E-mail</th>
							<th>Notatka</th>
						</tr>
				";
				foreach($dat as $tab) {
					$content.= "
						<tr>
							<td>".$tab['lp']."</td>
							<td>".$tab['name']."</td>
							<td>".$tab['phone']."</td>
							<td>".$tab['email']."</td>
							<td></td>
						</tr>
					";
				}
			$content.="</table>";


			$mpdf->AddPage('P','','','','',10,10,10,10,18,12);
			$mpdf->WriteHTML($content);

		}
	}

	$mpdf->Output();

?>