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

/**
 * Proper way to enqueue scripts and styles
 */
function theme_name_scripts() {
	wp_enqueue_script( 'jquery-ui', get_template_directory_uri() . '/js/jquery-ui.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'bootstrap', '//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js', array(), '1.0.0', true );
	wp_enqueue_script( 'jquery-main', get_template_directory_uri() . '/js/jquery.main.js', array('jquery', 'jquery-ui'), '1.0.0', true );
}

add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );

?>