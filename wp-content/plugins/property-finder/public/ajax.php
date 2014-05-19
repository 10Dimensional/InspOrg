<?php
    // Include Wordpress API
    include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
    
    if ($_POST['type'] === 'info') {
        // Request Info
        $requested_properties = (isset($_POST['request_info'])) ? $_POST['request_info'] : false;
        $properties = ($requested_properties) ? $wpdb->get_results('SELECT * FROM ap_properties WHERE id IN ('.implode(',', array_map('intval', $requested_properties)).')') : array();
        $beazer_array = array();
        $kb_array = array();
        $pardee_array = array();
        $toll_array = array();
        $beazer_email = 'lasvegashomes@beazer.com';
        $kb_email = 'inspirada@kbhome.com';
        $pardee_email = 'leadsource@ljgnetwork.com';
        $toll_email = 'inspirada@tollbrothers.com';
        $builders = $_POST['builders'];
        $status = 'success';
        $property_ids = array();
        $community_number = 0;

        foreach ($properties as $property) {
            if ($property->builder === 'Beazer Homes') {
                $beazer_array[] = $property;
            } else if ($property->builder === 'KB HOME') {
                $kb_array[] = $property;
                
                if ($property->series === 'Monet') {
                    $community_number = '00851018';
                } else if ($property->series === 'Matisse') {
                    $community_number = '00851203';
                } else if ($property->series === 'Michelangelo') {
                    $community_number = '00851100';
                } else if ($property->series === 'Renoir') {
                    $community_number = '00851017';
                } else if ($property->series === 'Van Gogh') {
                    $community_number = '00851215';
                }
                
                
            } else if ($property->builder === 'Pardee Homes') {
                $pardee_array[] = $property;
            } else if ($property->builder === 'Toll Brothers') {
                $toll_array[] = $property;
            }
            
            $property_ids[] = $property->id;
        }
        
        $send_kb_xml = false;
        $has_toll = 0;
        foreach ($builders as $builder) {
            $use_email = '';
            $use_array = array();
            $title = '';
            $mail_now = 1;
            
            if ($builder === 'kb home') {
                $mail_now = 0;
                generate_xml_email_kb($community_number);
            }
            
            if ($builder === 'beazer homes') {
                $title = 'Beazer Homes';
                $use_email = $beazer_email;
                $use_array = $beazer_array;
                
                generate_xml_email_beazer($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['phone'], $_POST['comment'], $community_number);
            }
            
            if ($builder === 'pardee homes') {
                $title = 'Pardee Homes';
                $use_email = $pardee_email;
                $use_array = $pardee_array;   
            }
            
            if ($builder === 'toll brothers') {
                $title = 'Toll Brothers';
                $use_email = $toll_email;
                $use_array = $toll_array;
                $has_toll = 1;
            }
            
            if ($mail_now !== 0) {
                if (!requestInfo($title, $use_email, $use_array)) {
                    $status = 'fail';
                }
            }
        }
        
        if (!$builders) {
            $has_toll = 1;
            generate_xml_email_kb();
        }
        
        print_r(json_encode(array('status' => $status, 'interested_models' => $requested_properties, 'firstName' => $_POST['firstName'], 'lastName' => $_POST['lastName'], 'email' => $_POST['email'], 'comment' => $_POST['comment'], 'phone' => $_POST['phone'])));
        
        
        // Store in DB
        $wpdb->insert( 
            'ap_leads', 
            array( 
                'first' => stripslashes($_POST['firstName']), 
                'last' => stripslashes($_POST['lastName']),
                'email' => trim($_POST['email']),
                'phone' => trim($_POST['phone']),
                'comment' => trim($_POST['comment']),
                'builders' => (isset($_POST['builders'])) ? json_encode($_POST['builders']) : '',
                'properties' => json_encode($property_ids)
            )
        );
    } else if ($_POST['type'] === 'toll') {
        print_r(generate_xml_soap_toll());
    } else {
        // Filter Results
        $price_min = ($_POST['price_min']) ? $_POST['price_min'] : 0;
        $price_max = ($_POST['price_max']) ? $_POST['price_max'] : 999999999;
        $beds = ($_POST['beds']) ? $_POST['beds'] : 0;
        $builder = (!$_POST['builder']) ? false : $_POST['builder'];
        $stories = ($_POST['stories'] === 0) ? false : $_POST['stories'];
        $sq_ft = ($_POST['sq_ft']) ? $_POST['sq_ft'] : 0;
        $garage_bays = ($_POST['garage_bays'] === 0) ? false : $_POST['garage_bays'];
        $builder_results = array();
        
        
        $where_clause = 'WHERE ((price_min >= '.$price_min.' AND price_max <= '.$price_max.') OR price_min = 0) AND beds_max >= '.$beds.' AND sq_ft >= '.$sq_ft;    
        
        if ($builder) {
            $where_clause .= " AND builder IN ('".implode("','",$builder).'\')';
        }
                        
        if ($stories) {
            $where_clause .= ' AND stories = '.$stories;
        }
        
        if ($garage_bays) {
            $where_clause .= ' AND garage_bays_max >= '.$garage_bays;
        }
        
        $properties = $wpdb->get_results("SELECT * FROM ap_properties $where_clause ORDER BY sq_ft ASC");
        
        
        $result_data = '';
        $result_count = 0;
        $arrBuilder = array();
        foreach ($properties as $property) {
            $beds = ($property->beds_min === $property->beds_max) ? $property->beds_min : $property->beds_min.' - '.$property->beds_max;
            $baths = ($property->baths_min === $property->baths_max) ? $property->baths_min : $property->baths_min.' - '.$property->baths_max;
            $garage_bays = ($property->garage_bays_min === $property->garage_bays_max) ? $property->garage_bays_min : $property->garage_bays_min.' - '.$property->garage_bays_max;
            
            /* if (!in_array($property->builder, $arrBuilder)) { */
                $arrBuilder[] = $property->builder;
/*             } */
           
            $result_data .= '
            <tr>
                <td>'.$property->builder.'</td>
                <td>'.$property->series.'</td>
                <td>'.$property->model.'</td>
                <td>'.number_format($property->sq_ft).'</td>
                <td>'.$beds.'</td>
                <td>'.$baths.'</td>
                <td>'.$property->stories.'</td>
                <td>'.$garage_bays.'</td>
                <td><a href="#" data-toggle="modal" data-target="#'.str_replace(' ', '', $property->model).'">View</a></td>
                <td style="text-align:center;"><input type="checkbox" name="request_info[]" value="'.$property->id.'" /> Add to download cart</td>
            </tr>';
            
            if (!in_array($property->builder, $builder_results)) {
                $builder_results[] = $property->builder;
            }
            
            $result_count++;
        }
        
        print_r(json_encode(array('count' => $result_count, 'builders' => $builder, 'builder_results' => $builder_results, 'results' => $result_data)));   
    }
    
    
    
    function requestInfo($title, $to, $properties) {
        if ($_SERVER['HTTP_HOST'] !== 'www.inspirada.com') return;
        global $wpdb;
        require_once "Mail.php";
        require_once "Mail/mime.php";
    
        $from = "Inspirada <info@inspirada.com>";
        $subject = "Info Requested";
         
        $host = "smtp.gmail.com";
        $port = '465';
        $username = "InspiradaHenderson@gmail.com";
        $password = "0bbLsE9fRXGU";
         
        $headers = array ('From' => $from, 'To' => $to, 'Subject' => $subject);
    
        // Get form fields
        $name = stripslashes($_POST['firstName']) . ' ' . stripslashes($_POST['lastName']);
        $phone = trim($_POST['phone']);
        $email = trim($_POST['email']);
        $comment = trim($_POST['comment']);
    
        // Format Message
        $body = '<h1>'.$title.'</h1><br /><br />
<strong>Name:</strong><br />'.$name.'<br /><br />
<strong>Phone Number:</strong><br />'.$phone.'<br /><br />
<strong>Email:</strong><br />'.$email.'<br /><br />
<strong>Comment:</strong><br />'.$comment;

        $count = 0;
        foreach ($properties as $property) {
            if ($count === 0) {
                $body .= '<br /><br /><strong>Properties</strong></br >';
            }
            $body .= $property->series.' '.$property->model.'<br />';
            
            $count++;
        }
        
        $mime = new Mail_mime();
        $mime->setHTMLBody($body);
 
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
    
    function generate_xml_email_beazer($firstName, $lastName, $email, $phone, $comment, $community_number)
    {
        if ($_SERVER['HTTP_HOST'] !== 'www.inspirada.com') return;
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
    
        $xmlobj = new SimpleXMLElement($xml);
        $xmlobj->asXML(ABSPATH . 'wp-content/plugins/property-finder/public/export/'.time().'.xml');
            
        // open some file for reading
        $file = $_SERVER['DOCUMENT_ROOT'].'/wp-content/plugins/property-finder/public/export/'.time().'.xml';
      
        
        // set up basic connection
        $conn_id = ftp_connect('64.94.4.105');
        if (@ftp_login($conn_id, 'ftp-inspirada', 'M@st3rp1@n')) {
            if (ftp_put($conn_id, time().'.xml', $file, FTP_ASCII)) {
                $msg = true;
            } else {
                $msg = error_get_last();
            }
        } else {
            echo "Couldn't connect as $ftp_user\n";
       } 
        // close the connection and the file handler
        ftp_close($conn_id);
    
        return $msg;
    }
    
    function generate_xml_email_kb($community_number='')
    {
        if ($_SERVER['HTTP_HOST'] !== 'www.inspirada.com') return;
        require_once "Mail.php";
        require_once "Mail/mime.php";
        $to = 'inspirada@kbhome.com';


        $xml = '<?xml version="1.0" encoding="UTF-8" ?>';
        $xml .= '<hsleads>'.PHP_EOL;
        $xml .= '<lead>'.PHP_EOL;
        $xml .= '<submit_date_time>'.str_replace('+00:00', '', date('c', strtotime('now'))).'</submit_date_time>'.PHP_EOL;
        $xml .= '<firstname>'.substr($_POST['firstName'], 0, 15).'</firstname>'.PHP_EOL;
        $xml .= '<lastname>'.substr($_POST['lastName'], 0, 40).'</lastname>'.PHP_EOL;
        $xml .= '<email>'.substr($_POST['email'], 0, 40).'</email>'.PHP_EOL;
        $xml .= '<phone>'.substr(preg_replace("/[^0-9]/","",$_POST['phone']), 0, 10).'</phone>'.PHP_EOL;
        $xml .= '<message>'.substr($_POST['comment'], 0, 2048).'</message>'.PHP_EOL;
        $xml .= '<buildernumber>00850</buildernumber>'.PHP_EOL;
        $xml .= '<builderreportingname>Las Vegas</builderreportingname>'.PHP_EOL;
        $xml .= '<communitynumber>'.$community_number.'</communitynumber>'.PHP_EOL;
        $xml .= '</lead>'.PHP_EOL;
        $xml .= '</hsleads>';        
        
        header ("Content-Type: application/octet-stream");
        header ("Content-disposition: attachment; filename=".time().".xml");
    
        $from = "Inspirada <info@inspirada.com>";
        $subject = "Info Requested";
         
        $host = "smtp.gmail.com";
        $port = '465';
        $username = "InspiradaHenderson@gmail.com";
        $password = "0bbLsE9fRXGU";
         
        $headers = array ('From' => $from, 'To' => $to, 'Subject' => $subject);
    
        // Get form fields

    
        // Format Message
        $body = '';

        
        $mime = new Mail_mime();
        $mime->setHTMLBody($body);
        
        $xmlobj = new SimpleXMLElement($xml);
        $xmlobj->asXML(ABSPATH . 'wp-content/plugins/property-finder/public/export/text.xml');
        
        $mime->addAttachment(ABSPATH . 'wp-content/plugins/property-finder/public/export/text.xml', 'text/xml'); 
 
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
    
    
    function generate_xml_soap_toll()
    {
        if ($_SERVER['HTTP_HOST'] !== 'www.inspirada.com') return;
        ini_set("soap.wsdl_cache_enabled", "0");
        
        try {
            $client = new SoapClient(
                "https://ftp2.tollbrothers.com/Services/LeadService?wsdl", array(
                "encoding" => "ISO-8859-1",
                "trace" => 1,
                "exceptions" => 1,
                "connection_timeout" => 1000)
            );

            $auth = array('username' => "lucid_t", 'password' => "U0hVZLAup2sXVjP");
            $lead = array(
                'email' => $_POST['email'],
                'comments' => $_POST['comment'],
                'community_id' => "8566",
                'first_name' => $_POST['firstName'],
                'homephone' => $_POST['phone'],
                'last_name' => $_POST['lastName'],
                'mobilephone' => $_POST['phone'],
                'requestdate' => date('Y/m/d', strtotime('now'))
            );
        
            $response = $client->SubmitLeads(array('Auth' => $auth, 'Lead' => array($lead)));
            return $response;
        } catch (SoapFault $e) {
            return 'Caught SOAP exception: '.$e->getMessage();
        } catch(Exception $e) {
            return 'Caught exception: '. $e->getMessage();
        }
    }
?>