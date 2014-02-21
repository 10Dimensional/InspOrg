<?php   
    // Include Wordpress API
    include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
    
    if ($_POST['type'] === 'info') {
        // Request Info
        $requested_properties = $_POST['request_info'];
        $properties = $wpdb->get_results('SELECT * FROM ap_properties WHERE id IN ('.implode(',', array_map('intval', $requested_properties)).')');
        $beazer_array = array();
        $kb_array = array();
        $pardee_array = array();
        $toll_array = array();
        $beazer_email = 'liz@lucidagency.com';
        $kb_email = 'liz@lucidagency.com';
        $pardee_email = 'liz@lucidagency.com';
        $toll_email = 'liz@lucidagency.com';
        $builders = $_POST['builders'];
        $status = 'success';
        $property_ids = array();
        
        foreach ($properties as $property) {
            if ($property->builder === 'Beazer Homes') {
                $beazer_array[] = $property;
            } else if ($property->builder === 'KB HOME') {
                $kb_array[] = $property;
            } else if ($property->builder === 'Pardee Homes') {
                $pardee_array[] = $property;
            } else if ($property->builder === 'Toll Brothers') {
                $toll_array[] = $property;
            }
            
            $property_ids[] = $property->id;
        }
        
        foreach ($builders as $builder) {
            $use_email = '';
            $use_array = array();
            $title = '';
            
            if ($builder === 'kb home') {
                $title = 'KB Home';
                $use_email = $kb_email;
                $use_array = $kb_array;   
            }
            
            if ($builder === 'beazer homes') {
                $title = 'Beazer Homes';
                $use_email = $beazer_email;
                $use_array = $beazer_array;   
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
            }
            
            if (!requestInfo($title, $use_email, $use_array)) {
                $status = 'fail';
            }
        }
        
        // Store in DB
        $wpdb->insert( 
        	'ap_leads', 
        	array( 
        		'first' => stripslashes($_POST['firstName']), 
        		'last' => stripslashes($_POST['lastName']),
        		'email' => trim($_POST['email']),
        		'phone' => trim($_POST['phone']),
        		'comment' => trim($_POST['comment']),
        		'builders' => json_encode($_POST['builders']),
        		'properties' => json_encode($property_ids)
        	)
        );

        print_r(json_encode(array('status' => $status, 'interested_models' => $properties)));
    } else {
        // Filter Results
        $price_min = ($_POST['price_min']) ? $_POST['price_min'] : 0;
        $price_max = ($_POST['price_max']) ? $_POST['price_max'] : 999999999;
        $beds = ($_POST['beds']) ? $_POST['beds'] : 0;
        $builder = (!$_POST['builder']) ? false : $_POST['builder'];
        $stories = ($_POST['stories'] === 0) ? false : $_POST['stories'];
        $sq_ft = ($_POST['sq_ft']) ? $_POST['sq_ft'] : 0;
        $garage_bays = ($_POST['garage_bays'] === 0) ? false : $_POST['garage_bays'];
                
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
        
        $properties = $wpdb->get_results("SELECT * FROM ap_properties $where_clause ORDER BY price_min ASC");
        
        
        $result_data = '';
        $result_count = 0;
        $arrBuilder = array();
        foreach ($properties as $property) {
            $beds = ($property->beds_min === $property->beds_max) ? $property->beds_min : $property->beds_min.' - '.$property->beds_max;
            $baths = ($property->baths_min === $property->baths_max) ? $property->baths_min : $property->baths_min.' - '.$property->baths_max;
            $garage_bays = ($property->garage_bays_min === $property->garage_bays_max) ? $property->garage_bays_min : $property->garage_bays_min.' - '.$property->garage_bays_max;
            
            if (!in_array($property->builder, $arrBuilder)) {
                $arrBuilder[] = $property->builder;
            }
           
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
                <td style="text-align:center;"><input type="checkbox" name="request_info[]" value="'.$property->id.'" /></td>
            </tr>';
            $result_count++;
        }
        
        print_r(json_encode(array('count' => $result_count, 'builders' => $arrBuilder, 'results' => $result_data)));   
    }
    
    
    
    function requestInfo($title, $to, $properties) {
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
?>