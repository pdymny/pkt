<?php

	set_time_limit(0);

	include "../lib/html/simple_html_dom.php";
	require_once "../base.php";

	$name = $_POST['page'];
	$cat = $_POST['cat'];
	
	$page = 1;
	$lot = 0;

	for($i=0; !empty($page); $i++) {

		if($lot >= 1000) {
			exit;
		} else {
	 	
		 	$file = "https://pkt.pl/szukaj/".$name."/".$page;
			$html = file_get_html($file);

			$ret = $html->find('h1 b');
			$ret = $ret[0]->plaintext;

			if(!empty($ret)) {
				$page = $page + 1;
			}

			foreach($html->find('div.box-content') as $element) {
				$bussines = $element->find('h2.company-name');
				$bussines = $bussines[0]->plaintext;

				if(!empty($bussines)) {

					$phone = $element->find('div.call--phone a');
					if(!empty($phone)) {
						$phone = $phone[0]->getAttribute('data-phone');
					} else {
						$phone = "";
					}
					
					$email = $element->find('a.popup span');
					if(!empty($email)) {
						$email = $email[0]->getAttribute('title');
					} else {
						$email = "";
					}

					$query = $db->prepare("SELECT * FROM bussines WHERE business = :bussines");
					$query->bindValue(":bussines", $bussines);
					$query->execute();
					$query = $query->fetch();

					if(empty($query)) {

						$insert = $db->prepare("INSERT INTO bussines (id_category, business, phone, email, date) 
												VALUE (:cat, :bussines, :phone, :email, now())");
						$insert->bindValue(":cat", $cat);
						$insert->bindValue(":bussines", $bussines);
						$insert->bindValue(":phone", $phone);
						$insert->bindValue(":email", $email);
						$insert->execute();

						$lot = $lot + 1;
					}

				}

			}
		}
	} 

	echo "Dodano do bazy: ".$lot." firm. Zakończono prace.<br/>";

?>