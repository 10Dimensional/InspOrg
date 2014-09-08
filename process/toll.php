<?php
if ($_SERVER['HTTP_HOST'] !== 'www.inspirada.com') {
	echo 'invalid';
	return;
}
ini_set("soap.wsdl_cache_enabled", "0");
try {

	$first = $_POST['first'];
    $last = $_POST['last'];
    $email = $_POST['email'];
    $community = $_POST['community'];
    $phone = $_POST['phone'];
    $comment = $_POST['comment'];


    $client = new SoapClient(
        "https://ftp2.tollbrothers.com/Services/LeadService?wsdl", array(
        "encoding" => "ISO-8859-1",
        "trace" => 1,
        "exceptions" => 1,
        "connection_timeout" => 1000)
    );

    $auth = array('username' => "lucid_t", 'password' => "U0hVZLAup2sXVjP");
    $lead = array(
        'email' => $email,
        'comments' => $comment,
        'community_id' => "8566",
        'first_name' => $firstName,
        'homephone' => $phone,
        'last_name' => $lastName,
        'mobilephone' => $phone,
        'requestdate' => date('Y/m/d', strtotime('now'))
    );

    $response = $client->SubmitLeads(array('Auth' => $auth, 'Lead' => array($lead)));
    echo $response;
} catch (SoapFault $e) {
    echo 'Caught SOAP exception: '.$e->getMessage();
} catch(Exception $e) {
    echo 'Caught exception: '. $e->getMessage();
}

?>