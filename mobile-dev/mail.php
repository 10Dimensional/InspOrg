<?php
	//****************************************
	//edit here
	$senderName = 'Inspirada Mobile Site';
	$senderEmail = 'dev+inspirada@lucidagency.co';
	$targetEmail = 'liz@lucidagency.com';
	$messageSubject = 'Message from Inspirada Mobile site';
	$redirectToReferer = false;
	$redirectURL = 'thank-you.html';
	//****************************************

	// mail content
	$ufname = $_POST['ufname'];
	$ulname = $_POST['ulname'];
	$umail = $_POST['umail'];
	$uphone = $_POST['uphone'];
	$uaddress = $_POST['uaddress'];
	$ucity = $_POST['ucity'];
	$ustate = $_POST['ustate'];
	$uzip = $_POST['uzip'];
	$urealtor = $_POST['urealtor'];
	 
	// prepare message text
	$messageText =	'first name: '.$ufname."\n".
					'last name: '.$ulname."\n".
					'Email address: '.$umail."\n".
					'phone: '.$uphone."\n".
					'address: '.$uaddress."\n".
					'city: '.$ucity."\n".
					'state: '.$ustate."\n".
					'zip: '.$uzip."\n".
					'Are You a Realtor?: '.$urealtor."\n";

	// send email
	$senderName = "=?UTF-8?B?" . base64_encode($senderName) . "?=";
	$messageSubject = "=?UTF-8?B?" . base64_encode($messageSubject) . "?=";
	$messageHeaders = "From: " . $senderName . " <" . $senderEmail . ">\r\n"
				. "MIME-Version: 1.0" . "\r\n"
				. "Content-type: text/plain; charset=UTF-8" . "\r\n";

	if (preg_match('/^[_.0-9a-z-]+@([0-9a-z][0-9a-z-]+.)+[a-z]{2,4}$/',$targetEmail,$matches))
	mail($targetEmail, $messageSubject, $messageText, $messageHeaders);

	// redirect
	if($redirectToReferer) {
		header("Location: ".@$_SERVER['HTTP_REFERER'].'#sent');
	} else {
		header("Location: ".$redirectURL);
	}
?>