<?php

	set_time_limit(0);

	require_once "../base.php";

	require_once '../lib/phpmailer/class.phpmailer.php';    //dodanie klasy phpmailer
	require_once '../lib/phpmailer/class.smtp.php';    //dodanie klasy smtp

	$mail = new PHPMailer();    //utworzenie nowej klasy phpmailer
	$mail->From = "support@polisonline.pl";    //adres e-mail użyty do wysyłania wiadomości
	$mail->FromName = "Support Polis Online";    //imię i nazwisko lub nazwa użyta do wysyłania wiadomości
	$mail->AddReplyTo('support@polisonline.pl', 'Support Polis Online'); //adres e-mail nadawcy oraz jego nazwa
	$mail->SMTPSecure = "plain";
	$mail->SMTPAutoTLS = false;                                             //w polu "Odpowiedz do"  
	$mail->Host = "mail.polisonline.pl";    //adres serwera SMTP wysyłającego e-mail
	$mail->Mailer = "smtp";    //do wysłania zostanie użyty serwer SMTP
	$mail->SMTPAuth = true;    //włączenie autoryzacji do serwera SMTP
	$mail->Username = "support@polisonline.pl";    //nazwa użytkownika do skrzynki e-mail
	$mail->Password = "b8jd63kmdys7as";    //hasło użytkownika do skrzynki e-mail
	$mail->Port = 25; //port serwera SMTP zależny od konfiguracji dostawcy usługi poczty
	$mail->CharSet = "UTF-8";


	$cat = $_POST['cat'];
	$date = $_POST['date'];
	$title = $_POST['title'];
	$text = $_POST['text'];

	$error = 0;
	$succes = 0;


	$query = $db->query("SELECT * FROM bussines WHERE id_category = ".$cat." AND date = '".$date."' AND email != '' ");
	while($tab = $query->fetch()) {	

		$mail->Subject = $title;    //Temat wiadomości, można stosować zmienne i znaczniki HTML
	    $mail->Body = $text;  

	    $mail->AddAddress ($tab['email'],$tab['email']);    //adres skrzynki e-mail oraz nazwa
	                                                    //adresata, do którego trafi wiadomość
	    
	    if(!$mail->Send()) {
  			$error = $error + 1;
		} else {
			$succes = $succes + 1;
		}

	    $mail->ClearAddresses();
  		$mail->ClearAttachments();

  		sleep(5);
	}

	echo "Wysłanych popranie: ".$succes." | Niewysłanych: ".$error." | Razem: ".$error+$succes;


?>