<?php 
register_nav_menus( array('' => ''));
register_sidebar(array('name' => __( 'Footer Left' ),'id' => 'footer-left','description' => __( 'Footer Left' ),'before_title' => '<h2>','after_title' => '</h2>'));
register_sidebar(array('name' => __( 'Footer right' ),'id' => 'footer-right','description' => __( 'Footer Right' ),'before_title' => '<h2>','after_title' => '</h2>'));
register_sidebar(array('name' => __( 'Inspire Sidebar' ),'id' => 'inspire-sidebar','description' => __( 'Inspire Sidebar' ),'before_title' => '<h2>','after_title' => '</h2>'));
register_sidebar(array('name' => __( 'Right Sidebar' ),'id' => 'right-sidebar','description' => __( 'Right Sidebar' ),'before_title' => '<h2>','after_title' => '</h2>'));
register_sidebar(array('name' => __( 'Vicinity Sidebar' ),'id' => 'vicinity-sidebar','description' => __( 'Vicinity Sidebar' ),'before_title' => '<h2>','after_title' => '</h2>'));
register_sidebar(array('name' => __( 'Blog Sidebar' ),'id' => 'blog-sidebar','description' => __( 'Blog Sidebar' ),'before_title' => '<h2>','after_title' => '</h2>'));

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


?>