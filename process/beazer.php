<?php
	$file = '/var/www/inspirada.com/html/wp-content/plugins/property-finder/public/export/'.time().'.xml';
	$firstName = $argv[2];
	$lastName = $argv[3];
	$email = $argv[4];
	$phone = $argv[5];
	$comment = $argv[6];

    $xml = '<?xml version="1.0" encoding="UTF-8" ?>';
    $xml .= '<hsleads>'.PHP_EOL;
    $xml .= '<lead>'.PHP_EOL;
    $xml .= '<submit_date_time>'.str_replace('+00:00', '', date('c', strtotime('now'))).'</submit_date_time>'.PHP_EOL;
    $xml .= '<firstname>'.substr($firstName, 0, 15).'</firstname>'.PHP_EOL;
    $xml .= '<lastname>'.substr($lastName, 0, 40).'</lastname>'.PHP_EOL;
    $xml .= '<email>'.substr($email, 0, 40).'</email>'.PHP_EOL;
    $xml .= '<phone>'.substr(preg_replace("/[^0-9]/","",$phone), 0, 10).'</phone>'.PHP_EOL;
    $xml .= '<message>'.substr(strip_tags($comment), 0, 2048).'</message>'.PHP_EOL;
    $xml .= '<buildernumber>00850</buildernumber>'.PHP_EOL;
    $xml .= '<builderreportingname>Las Vegas</builderreportingname>'.PHP_EOL;
    $xml .= '<communitynumber></communitynumber>'.PHP_EOL;
    $xml .= '</lead>'.PHP_EOL;
    $xml .= '</hsleads>';
    $xmlobj = new SimpleXMLElement($xml);
    $xmlobj->asXML($file);

    // set up basic connection
    $conn_id = ftp_connect('64.94.4.105') or die('Could not connect');
    if (ftp_login($conn_id, 'ftp-inspirada', 'M@st3rp1@n')) {
        ftp_pasv($conn_id, false);
        if (ftp_put($conn_id, time().'.xml', $file, FTP_ASCII)) {
            $msg = 'true';
        } else {
            $msg = error_get_last();
        }
    } else {
        echo "Couldn't connect as $ftp_user\n";
    }
    
    // close the connection and the file handler
    ftp_close($conn_id);
    
    // Remove file
    unlink($file);
?>