<?php 
register_nav_menus( array('' => ''));
register_sidebar(array('name' => __( 'Footer Left' ),'id' => 'footer-left','description' => __( 'Footer Left' ),'before_title' => '<h2>','after_title' => '</h2>'));
register_sidebar(array('name' => __( 'Footer right' ),'id' => 'footer-right','description' => __( 'Footer Right' ),'before_title' => '<h2>','after_title' => '</h2>'));
register_sidebar(array('name' => __( 'Inspire Sidebar' ),'id' => 'inspire-sidebar','description' => __( 'Inspire Sidebar' ),'before_title' => '<h2>','after_title' => '</h2>'));
register_sidebar(array('name' => __( 'Right Sidebar' ),'id' => 'right-sidebar','description' => __( 'Right Sidebar' ),'before_title' => '<h2>','after_title' => '</h2>'));
register_sidebar(array('name' => __( 'Blog Sidebar' ),'id' => 'blog-sidebar','description' => __( 'Blog Sidebar' ),'before_title' => '<h2>','after_title' => '</h2>'));



function the_breadcrumb() {
	if (!is_home()) {
		echo '<a href="';
		echo get_option('home');
		echo '">';
		bloginfo('name');
		echo "</a> » ";
		if (is_category() || is_single()) {
			the_category('title_li=');
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

if(function_exists('get_roster_slider')){
	function roster_add_pub_date($slider_excerpt,$post_id,$roster_slider_curr,$roster_slider_css){
		$the_post = get_post($post_id);
		$pub_date = mysql2date(get_option('date_format'), $the_post->post_date);
		$pub_date_html = '<div class="roster_pub_date">'.__('','roster-slider').$pub_date.'</div>';
		$slider_excerpt = $pub_date_html.$slider_title;
		return $slider_excerpt;
	}
	add_filter('roster_slide_excerpt_html','roster_add_pub_date',10,4);
}
?>