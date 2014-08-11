<?php
    // Include Wordpress API
    include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
    // Include Campaign Monitor API
    include_once($_SERVER['DOCUMENT_ROOT'].'/wp-content/plugins/property-finder/lib/createsend-php/csrest_general.php');
    require_once $_SERVER['DOCUMENT_ROOT'].'/wp-content/plugins/property-finder/lib/createsend-php/csrest_subscribers.php';

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
        $subscribe = $_POST['subscribe'];
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
             //   generate_xml_email_kb($community_number);
            }

            if ($builder === 'beazer homes') {
                $title = 'Beazer Homes';
                $use_email = $beazer_email;
                $use_array = $beazer_array;

               // generate_xml_email_beazer($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['phone'], $_POST['comment'], $community_number);
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
            //generate_xml_email_kb();
        }

        //Add to campaign monitor
        if(isset($subscribe) && $subscribe == 'subscribe') {
            $auth = array('api_key' => 'b76726b5487a8012d8dadf7fbde197ec');
            $wrap = new CS_REST_Subscribers('af089ef176d2e472fae6c01c312eda7f', $auth);

            $result = $wrap->add(array(
                'EmailAddress' => trim($_POST['email']),
                'Name' => stripslashes($_POST['firstName']) . ' ' . stripslashes($_POST['lastName']),
                'Resubscribe' => true
            ));
        }

        print_r(json_encode(array('status' => $status, 'interested_models' => $requested_properties, 'builders' => $builders, 'firstName' => $_POST['firstName'], 'lastName' => $_POST['lastName'], 'email' => $_POST['email'], 'comment' => $_POST['comment'], 'phone' => $_POST['phone'])));


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
        //print_r(generate_xml_soap_toll());
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
        if ($_SERVER['HTTP_HOST'] !== 'www.inspirada.com') return true;
        global $wpdb;
        require_once "Mail.php";
        require_once "Mail/mime.php";

        $from = "Inspirada <info@inspirada.com>";
        $subject = "Inspirada - Henderson - Info Requested";

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