<?php 
register_nav_menus( array('' => ''));
register_sidebar(array('name' => __( 'Footer Left' ),'id' => 'footer-left','description' => __( 'Footer Left' ),'before_title' => '<h2>','after_title' => '</h2>'));
register_sidebar(array('name' => __( 'Footer right' ),'id' => 'footer-right','description' => __( 'Footer Right' ),'before_title' => '<h2>','after_title' => '</h2>'));
register_sidebar(array('name' => __( 'Inspire Sidebar' ),'id' => 'inspire-sidebar','description' => __( 'Inspire Sidebar' ),'before_title' => '<h2>','after_title' => '</h2>'));
register_sidebar(array('name' => __( 'Right Sidebar' ),'id' => 'right-sidebar','description' => __( 'Right Sidebar' ),'before_title' => '<h2>','after_title' => '</h2>'));
register_sidebar(array('name' => __( 'Vicinity Sidebar' ),'id' => 'vicinity-sidebar','description' => __( 'Vicinity Sidebar' ),'before_title' => '<h2>','after_title' => '</h2>'));
register_sidebar(array('name' => __( 'Blog Sidebar' ),'id' => 'blog-sidebar','description' => __( 'Blog Sidebar' ),'before_title' => '<h2>','after_title' => '</h2>'));
register_sidebar(array('name' => __( 'Landing Sidebar' ),'id' => 'Landing-sidebar','description' => __( 'Landing Sidebar' ),'before_title' => '<h2>','after_title' => '</h2>'));

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
		if ($form_items['label'] === 'First Name') {
			$first_id = $form_items['id'];
		} else if ($form_items['label'] === 'Last Name') {
			$last_id = $form_items['id'];
		} else if ($form_items['label'] === 'Email') {
    		$email_id = $form_items['id'];
		} else if ($form_items['label'] === 'Phone') {
    		$phone_id = $form_items['id'];
		} else if ($form_items['label'] === 'Comment') {
    		$comment_id = $form_items['id'];
		} else if ($form_items['label'] === 'Brokerage Firm') {
		    $firm_id = $form_items['id'];
		} else if ($form_items['label'] === 'Address') {
		    foreach ($form_items['inputs'] as $form_item) {
    		    if ($form_item['label'] === 'Street Address') {
        		    $address_id = $form_item['id'];
    		    } else if ($form_item['label'] === 'State / Province') {
        		    $state_id = $form_item['id'];
    		    } else if ($form_item['label'] === 'City') {
        		    $city_id = $form_item['id'];
    		    } else if ($form_item['label'] === 'ZIP / Postal Code') {
        		    $zip_id = $form_item['id'];
    		    }
		    }
		} else if (is_array($form_items['inputs'])) {
		    foreach ($form_items['inputs'] as $form_item) {
    		    $builders_id[] = $form_item['id'];
		    }
		} else if ($form_items['label'] === 'Builder') {
            $builders_id = $form_items['id'];	
		} else if ($form_items['label'] === 'Desired Price Range') {
            $price_range_id = $form_items['id'];	
		} else if ($form_items['label'] === 'Desired Square Footage') {
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
    $to = 'liz@lucidagency.com';


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
    
    header ("Content-Type: application/octet-stream");
    header ("Content-disposition: attachment; filename=info.xml");

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


?>