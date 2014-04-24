<?php 
register_nav_menus( array('' => ''));
register_sidebar(array('name' => __( 'Footer Left' ),'id' => 'footer-left','description' => __( 'Footer Left' ),'before_title' => '<h2>','after_title' => '</h2>'));
register_sidebar(array('name' => __( 'Footer right' ),'id' => 'footer-right','description' => __( 'Footer Right' ),'before_title' => '<h2>','after_title' => '</h2>'));
register_sidebar(array('name' => __( 'Inspire Sidebar' ),'id' => 'inspire-sidebar','description' => __( 'Inspire Sidebar' ),'before_title' => '<h2>','after_title' => '</h2>'));
register_sidebar(array('name' => __( 'Right Sidebar' ),'id' => 'right-sidebar','description' => __( 'Right Sidebar' ),'before_title' => '<h2>','after_title' => '</h2>'));
register_sidebar(array('name' => __( 'Vicinity Sidebar' ),'id' => 'vicinity-sidebar','description' => __( 'Vicinity Sidebar' ),'before_title' => '<h2>','after_title' => '</h2>'));
register_sidebar(array('name' => __( 'Blog Sidebar' ),'id' => 'blog-sidebar','description' => __( 'Blog Sidebar' ),'before_title' => '<h2>','after_title' => '</h2>'));
register_sidebar(array('name' => __( 'Landing Sidebar' ),'id' => 'Landing-sidebar','description' => __( 'Landing Sidebar' ),'before_title' => '<h2>','after_title' => '</h2>'));
register_sidebar(array('name' => __( 'Landing Alt Sidebar' ),'id' => 'Landing-alt-sidebar','description' => __( 'Landing Alt Sidebar' ),'before_title' => '<h2>','after_title' => '</h2>'));

function the_breadcrumb() {
	if (!is_home()) {
		echo '<a href="';
		echo get_option('home');
		echo '">';
		bloginfo('name');
		echo "</a> » ";
		if (is_category() || is_single()) {
			the_category(' » ');
			if (is_single()) {
				echo " » ";
				the_title();
			}
		} elseif (is_page()) {
			echo the_title();
		}
	}
}


// register wp_nav_menu
add_action( 'init', 'register_my_menus' );
function register_my_menus() {
	register_nav_menus( array(
	'primary-menu' => __( 'Primary Menu', 'inspirada' ),
	'footer-menu' => __( 'Footer Menu', 'inspirada' )
	
	)
	);
}

// remove ul wp_nav_menu
function remove_ul ( $menu ){
    return preg_replace( array( '#^<ul[^>]*>#', '#</ul>$#' ), '', $menu );
}
add_filter( 'wp_nav_menu', 'remove_ul' );

add_theme_support( 'post-thumbnails' ); 

function custom_excerpt_length( $length ) {
	return 15;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/**
 * Proper way to enqueue scripts and styles
 */
function theme_name_scripts() {
	wp_enqueue_script( 'jquery-ui', get_template_directory_uri() . '/js/jquery-ui.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'bootstrap', '//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js', array(), '1.0.0', true );
	wp_enqueue_script( 'jquery-main', get_template_directory_uri() . '/js/jquery.main.js', array('jquery', 'jquery-ui'), '1.0.0', true );
	wp_enqueue_script( 'mapbox', '//api.tiles.mapbox.com/mapbox.js/v1.6.0/mapbox.js', '', '', true );


	//wp_dequeue_script('jquery.cycle1');
}

add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );


// Replaces the excerpt "more" text by a link
function new_excerpt_more($more) {
       global $post;
	return '<a style=" text-decoration: none; " class="moretag" href="'. get_permalink($post->ID) . '"> MORE</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');
add_filter('widget_text', 'do_shortcode');



/* Gravity Forms Save to DB */

add_action('gform_after_submission', 'post_to_third_party', 10, 2);
function post_to_third_party($entry, $form)
{
    $first_id = null;
    $last_id = null;
    $email_id = null;
    $phone_id = null;
    $comment_id = null;
    $firm_id = null;
    $address_id = null;
    $city_id = null;
    $state_id = null;
    $zip_id = null;
    $builders_id = array();
    $price_range_id = null;
    $sqft_id = null;
    
	// Get Field IDs
	foreach ($form['fields'] as $form_items) {
		if (($form_items['label'] === 'First Name') || (strpos($form_items['defaultValue'], 'First Name') !== FALSE)) {
			$first_id = $form_items['id'];
		} else if (($form_items['label'] === 'Last Name') || (strpos($form_items['defaultValue'], 'Last Name') !== FALSE)) {
			$last_id = $form_items['id'];
		} else if (($form_items['label'] === 'Email') || (strpos($form_items['defaultValue'], 'Email') !== FALSE)) {
    		$email_id = $form_items['id'];
		} else if (($form_items['label'] === 'Phone') || (strpos($form_items['defaultValue'], 'Phone') !== FALSE)) {
    		$phone_id = $form_items['id'];
		} else if (($form_items['label'] === 'Comment') || (strpos($form_items['defaultValue'], 'Comment') !== FALSE)) {
    		$comment_id = $form_items['id'];
		} else if (($form_items['label'] === 'Brokerage Firm') || (strpos($form_items['defaultValue'], 'Brokerage Firm') !== FALSE)) {
		    $firm_id = $form_items['id'];
		} else if (($form_items['label'] === 'Address') || (strpos($form_items['defaultValue'], 'Address') !== FALSE)) {
		    foreach ($form_items['inputs'] as $form_item) {
    		    if (($form_item['label'] === 'Street Address') || (strpos($form_items['defaultValue'], 'Street Address') !== FALSE)) {
        		    $address_id = $form_item['id'];
    		    } else if (($form_item['label'] === 'State / Province') || (strpos($form_items['defaultValue'], 'State / Province') !== FALSE)) {
        		    $state_id = $form_item['id'];
    		    } else if (($form_item['label'] === 'City') || (strpos($form_items['defaultValue'], 'City') !== FALSE)) {
        		    $city_id = $form_item['id'];
    		    } else if (($form_item['label'] === 'ZIP / Postal Code') || (strpos($form_items['defaultValue'], 'ZIP / Postal Code') !== FALSE)) {
        		    $zip_id = $form_item['id'];
    		    }
		    }
		} else if (is_array($form_items['inputs'])) {
		    foreach ($form_items['inputs'] as $form_item) {
    		    $builders_id[] = $form_item['id'];
		    }
		} else if (($form_items['label'] === 'Builder') || (strpos($form_items['defaultValue'], 'Builder') !== FALSE)) {
            $builders_id = $form_items['id'];	
		} else if (($form_items['label'] === 'Desired Price Range') || (strpos($form_items['defaultValue'], 'Desired Price Range') !== FALSE)) {
            $price_range_id = $form_items['id'];	
		} else if (($form_items['label'] === 'Desired Square Footage') || (strpos($form_items['defaultValue'], 'Desired Square Footage') !== FALSE)) {
            $sqft_id = $form_items['id'];	
		}
	}
	
	$first = ($first_id) ? $entry[$first_id] : null;
	$last = ($last_id) ? $entry[$last_id] : null;
	$email = ($email_id) ? $entry[$email_id] : null;
	$phone = ($phone_id) ? $entry[$phone_id] : null;
	$comment = ($comment_id) ? $entry[$comment_id] : null;
	$firm = ($firm_id) ? $entry[$firm_id] : null;
	$address = (isset($entry[strval($address_id)])) ? $entry[strval($address_id)] : null;
	$city = (isset($entry[strval($city_id)])) ? $entry[strval($city_id)] : null;
	$state = (isset($entry[strval($state_id)])) ? $entry[strval($state_id)] : null;
	$zip = (isset($entry[strval($zip_id)])) ? $entry[strval($zip_id)] : null;
	$builder = (isset($entry[strval($builders_id)])) ? $entry[strval($builders_id)] : null;
	$price_range = (isset($entry[strval($price_range_id)])) ? $entry[strval($price_range_id)] : null;
	$sqft = (isset($entry[strval($sqft_id)])) ? $entry[strval($sqft_id)] : null;
	
	if ($builder === 'all') {
    	$builders = array(
    	    'beazer homes',
            'kb home',
            'pardee homes',
            'toll brothers'
        );
	} else {
	    $builders = array();
    	foreach ($builders_id as $builder) {
    	    $curBuilder = str_replace('  ', ' ', strtolower($entry[$builder]));
    	    if ($curBuilder !== '') {
        	    $builders[] = $curBuilder;
    	    }
    	}
	}
	
	if (in_array('kb home', $builders)) {
    	generate_xml_email_kb_main($first, $last, $email, $phone, $comment);
	}
	
	if (in_array('beazer homes', $builders)) {
    	generate_xml_email_beazer_main($first, $last, $email, $phone, $comment);
	}
	
	if (in_array('toll brothers', $builders)) {
    	generate_xml_soap_toll_main($email, $comment, $first, $phone, $last);
	}
	
	save_to_admin($first, $last, $email, $phone, $comment, $firm, $address, $city, $state, $zip, json_encode($builders), $price_range, $sqft);

	return;
}

function save_to_admin($first=null, $last=null, $email=null, $phone=null, $comment=null, $firm=null, $address=null, $city=null, $state=null, $zip=null, $builders=null, $price_range=null, $sqft=null)
{		
	$mysqli = new mysqli("localhost", "inspirada", "Ge50Ku7HQlIF", "inspirada");

	if ($mysqli->connect_errno) {
	    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	
	$query = "INSERT INTO ap_leads (first, last, email, phone, comment, firm, address, city, state, zip, builders, sqft, price_range) VALUES ('$first', '$last', '$email', '$phone', '$comment', '$firm', '$address', '$city', '$state', '$zip', '$builders', '$sqft', '$price_range')";

	if ($mysqli->query($query)) {
		//echo 'success';
	} else {
        // FAIL
	}
}




function generate_xml_email_kb_main($firstName, $lastName, $email, $phone, $comment, $community_number)
{
    require_once "Mail.php";
    require_once "Mail/mime.php";
    $to = 'inspirada@kbhome.com';


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
    $subject = "Info Requested";
     
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

function generate_xml_email_beazer_main($firstName, $lastName, $email, $phone, $comment, $community_number)
{
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
    $file = 'wp-content/plugins/property-finder/public/export/'.time().'.xml';
    
    
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


function generate_xml_soap_toll_main($email, $comment, $firstName, $phone, $lastName)
{
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
        return $response;
    } catch (SoapFault $e) {
        return 'Caught SOAP exception: '.$e->getMessage();
    } catch(Exception $e) {
        return 'Caught exception: '. $e->getMessage();
    }
}



function myawesometheme_validate_gravity_default_values( $validation_result ) {
	
	// Get the form object from the validation result
	$form = $validation_result["form"];
	
	// Get the current page being validated
	$current_page = rgpost( 'gform_source_page_number_' . $form['id'] ) ? rgpost( 'gform_source_page_number_' . $form['id'] ) : 1;
	
	// Loop through the form fields
	foreach( $form['fields'] as &$field ){
 
		$value_number = rgpost( "input_{$field['id']}" );
 
		// If there's a default value for the field, make sure the submitted value isn't the default value
		if ( !empty( $field['defaultValue'] ) && $field['defaultValue'] === $value_number ) {
		  $is_valid = false;
		}
		else {
		  $is_valid = true;
		}
		
		// If the field is valid we don't need to do anything, skip it
		if( !$is_valid ) {
			// The field failed validation, so first we'll need to fail the validation for the entire form
			$validation_result['is_valid'] = false;
			
			// Next we'll mark the specific field that failed and add a custom validation message
			$field['failed_validation'] = true;
			$field['validation_message'] = "You can't submit the default value.";
		}
	}
 
	// Assign our modified $form object back to the validation result
	$validation_result['form'] = $form;
	
	// Return the validation result
	return $validation_result;
}
add_filter( 'gform_validation_7', 'myawesometheme_validate_gravity_default_values' ); 


add_action('wp_head','google_analytics',1000,1);
function google_analytics() {
	echo "
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-45598753-1', 'inspirada.com');
  ga('send', 'pageview');

</script>";
}
