<?php
                /*
                	Template Name: DEBUG
                */

                error_reporting(E_ALL);
                ini_set('display_errors', '1');


                generate_xml_email_kb_main_debug('mike','aguiar','mike@lucidagency.com','444-333-2222','comment goes here');

                function generate_xml_email_kb_main_debug($firstName, $lastName, $email, $phone, $comment)
                {
                        error_reporting(E_ALL);
                        ini_set('display_errors', '1');
                //    if ($_SERVER['HTTP_HOST'] !== 'www.inspirada.com') return;
                    require_once "Mail.php";
                    require_once "Mail/mime.php";
                    $to = 'mike@aliasproject.com';

                    $xml = '<?xml version="1.0" encoding="UTF-8" ?>';
                    $xml .= '<hsleads>'.PHP_EOL;
                    $xml .= '<lead>'.PHP_EOL;
                    $xml .= '<submit_date_time>'.str_replace('+00:00', '', date('c', strtotime('now'))).'</submit_date_time>'.PHP_EOL;
                    $xml .= '<firstname>'.substr($firstName, 0, 15).'</firstname>'.PHP_EOL;
                    $xml .= '<lastname>'.substr($lastName, 0, 40).'</lastname>'.PHP_EOL;
                    $xml .= '<email>'.substr($email, 0, 40).'</email>'.PHP_EOL;
                    $xml .= '<phone>'.substr(preg_replace("/[^0-9]/","",$phone), 0, 10).'</phone>'.PHP_EOL;
                    $xml .= '<message>'.substr($comment, 0, 2048).'</message>'.PHP_EOL;
                    $xml .= '<buildernumber>00850</buildernumber>'.PHP_EOL;
                    $xml .= '<builderreportingname>Las Vegas</builderreportingname>'.PHP_EOL;
                    $xml .= '<communitynumber></communitynumber>'.PHP_EOL;
                    $xml .= '</lead>'.PHP_EOL;
                    $xml .= '</hsleads>';

                    $from = "Inspirada <info@inspirada.com>";
                    $subject = "Inspirada - Henderson - Info Requested";

                    $host = "smtp.gmail.com";
                    $port = '465';
                    $username = "InspiradaHenderson@gmail.com";
                    $password = "0bbLsE9fRXGU";

                    $headers = array ('From' => $from, 'To' => $to, 'Subject' => $subject);

                    // Format Message
                    $body = '';

                    $mime = new Mail_mime();
                    $mime->setHTMLBody($body);

                    $xmlobj = new SimpleXMLElement($xml);
                    $xmlobj->asXML(ABSPATH . 'wp-content/plugins/property-finder/public/export/'.time().'.xml');

                    $mime->addAttachment(ABSPATH . 'wp-content/plugins/property-finder/public/export/'.time().'.xml', 'text/xml');

                    $body = $mime->get();
                    $headers = $mime->headers($headers);

                    $smtp = Mail::factory('smtp',
                        array (
                            'host' => $host,
                            //'port' => $port,
                            'auth' => true,
                            'username' => $username,
                            'password' => $password
                        )
                    );

                    $mail = $smtp->send($to, $headers, $body);
                    return (PEAR::isError($mail)) ? false : true;
                }

                ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/bootstrap.css">
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/fancybox.css">
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/all.css">
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/jcf.css">
	<link href='//api.tiles.mapbox.com/mapbox.js/v1.6.0/mapbox.css' rel='stylesheet' />
	      <script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/modernizr.js"></script>
	   <!--[if lt IE 9]><link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/ie.css" media="screen"/>
	   <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
	   <![endif]-->
<style>
.list li {
list-style-type: disc;
}
.map-block IMG {
	width: auto !important;
	}
.info-table {
	background: #295585;
}
.filter-form .title {
	color: white;
}
img[src="http://a.tiles.mapbox.com/v3/marker/pin-m+1087bf@2x.png"]{opacity:0 !important;}
</style>
<?php wp_head() ?></head>
<body>
<div id="wrapper" style="background: white;">
    <?php get_header() ?>

    tester

	<?php get_footer() ?>
<?php wp_footer() ?></body>
</html>
