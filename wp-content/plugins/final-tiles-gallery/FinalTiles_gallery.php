<?php
/**
 * @package FinalTiles_Gallery
 * @version 2.0.1
 */
/*
Plugin Name: Final Tiles Gallery
Plugin URI: http://codecanyon.net/item/final-tiles-gallery-for-wordpress/5189351?ref=GreenTreeLabs
Description: Wordpress Plugin for creating responsive image galleries. By: Green Tree Labs
Author: Green Tree Labs
Version: 2.0.1
Author URI: http://codecanyon.net/user/GreenTreeLabs
*/

function create_db_tables() {
	include_once (WP_PLUGIN_DIR . '/final-tiles-gallery/lib/install-db.php');			
	install_db();
}

if (!class_exists("FinalTiles_Gallery")) {
	class FinalTiles_Gallery {
		
		//Constructor
		public function __construct() 
		{
			$this->plugin_name = plugin_basename(__FILE__);		
			$this->define_constants();
			$this->define_db_tables();			
			$this->add_gallery_options();
			$this->FinalTilesdb = $this->create_db_conn();
						
			
			register_activation_hook( __FILE__, 'create_db_tables');					
			
			add_action('init', array($this, 'create_textdomain'));	

			add_action('wp_enqueue_scripts', array($this, 'add_gallery_scripts'));
			
			//add_action( 'admin_init', array($this,'gallery_admin_init') );
			add_action( 'admin_menu', array($this, 'add_gallery_admin_menu') );
			
			add_shortcode( 'FinalTilesGallery', array($this, 'gallery_shortcode_handler') );	

			add_action('wp_ajax_save_gallery', array($this,'save_gallery'));
			add_action('wp_ajax_save_image', array($this,'save_image'));
			add_action('wp_ajax_add_image', array($this,'add_image'));
			add_action('wp_ajax_list_images', array($this,'list_images'));
			add_action('wp_ajax_sort_images', array($this,'sort_images'));
			add_action('wp_ajax_delete_image', array($this,'delete_image'));
			add_action('wp_ajax_assign_filters', array($this,'assign_filters'));
		}
		
		//Define textdomain
		public function create_textdomain() 
		{
			$plugin_dir = basename(dirname(__FILE__));
			load_plugin_textdomain( 'FinalTiles-gallery', false, $plugin_dir.'/lib/languages' );
		}
		
		//Define constants
		public function define_constants() 
		{
			if ( ! defined( 'FINALTILESGALLERY_PLUGIN_BASENAME' ) )
				define( 'FINALTILESGALLERY_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
		
			if ( ! defined( 'FINALTILESGALLERY_PLUGIN_NAME' ) )
				define( 'FINALTILESGALLERY_PLUGIN_NAME', trim( dirname( FINALTILESGALLERY_PLUGIN_BASENAME ), '/' ) );
			
			if ( ! defined( 'FINALTILESGALLERY_PLUGIN_DIR' ) )
				define( 'FINALTILESGALLERY_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . FINALTILESGALLERY_PLUGIN_NAME );
		}
		
		//Define DB tables
		public function define_db_tables() 
		{
			global $wpdb;
			
			$wpdb->FinalTilesGalleries = $wpdb->prefix . 'FinalTiles_gallery';
			$wpdb->FinalTilesImages = $wpdb->prefix . 'FinalTiles_gallery_images';			
		}
				
		
		public function create_db_conn() 
		{
			require('lib/db-class.php');
			$FinalTilesdb = FinalTilesDB::getInstance();
			return $FinalTilesdb;
		}
		
		//Add gallery options
		public function add_gallery_options() 
		{
			$gallery_options = array(
				'margin'  => '10',
				'minTileWidth' => '100',
				'gridCellSize' => '25'
			);
			
			add_option('FinalTiles_gallery_options', array($this, $gallery_options));
		}
		
		//Add gallery scripts
		public function add_gallery_scripts() 
		{
			wp_enqueue_script('jquery');
			wp_register_script('jquery-easing', WP_PLUGIN_URL.'/final-tiles-gallery/scripts/jquery.easing.js', array('jquery'));
			wp_enqueue_script('jquery-easing');
			
			wp_register_script('finalTilesGallery', WP_PLUGIN_URL.'/final-tiles-gallery/scripts/jquery.finalTilesGallery.js', array('jquery'));
			wp_enqueue_script('finalTilesGallery');
			
			
			wp_register_style('finalTilesGallery_stylesheet', WP_PLUGIN_URL.'/final-tiles-gallery/scripts/ftg.css');			
			wp_enqueue_style('finalTilesGallery_stylesheet');

			wp_register_script('magnific_script', WP_PLUGIN_URL.'/final-tiles-gallery/lightbox/magnific/script.js', array('jquery'));
			wp_register_script('prettyphoto_script', WP_PLUGIN_URL.'/final-tiles-gallery/lightbox/prettyphoto/script.js', array('jquery'));
			wp_register_script('colorbox_script', WP_PLUGIN_URL.'/final-tiles-gallery/lightbox/colorbox/script.js', array('jquery'));
			wp_register_script('fancybox_script', WP_PLUGIN_URL.'/final-tiles-gallery/lightbox/fancybox/script.js', array('jquery'));
			wp_register_script('swipebox_script', WP_PLUGIN_URL.'/final-tiles-gallery/lightbox/swipebox/script.js', array('jquery'));
			wp_register_script('lightbox2_script', WP_PLUGIN_URL.'/final-tiles-gallery/lightbox/lightbox2/js/script.js', array('jquery'));

			wp_register_style('magnific_stylesheet', WP_PLUGIN_URL.'/final-tiles-gallery/lightbox/magnific/style.css');
			wp_register_style('prettyphoto_stylesheet', WP_PLUGIN_URL.'/final-tiles-gallery/lightbox/prettyphoto/style.css');
			wp_register_style('colorbox_stylesheet', WP_PLUGIN_URL.'/final-tiles-gallery/lightbox/colorbox/style.css');
			wp_register_style('fancybox_stylesheet', WP_PLUGIN_URL.'/final-tiles-gallery/lightbox/fancybox/style.css');
			wp_register_style('swipebox_stylesheet', WP_PLUGIN_URL.'/final-tiles-gallery/lightbox/swipebox/style.css');
			wp_register_style('lightbox2_stylesheet', WP_PLUGIN_URL.'/final-tiles-gallery/lightbox/lightbox2/css/style.css');
            
            wp_register_style('fontawesome_stylesheet', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css');
            wp_enqueue_style('fontawesome_stylesheet');
		}
				
		//Admin Section - register scripts and styles
		public function gallery_admin_init() 
		{
			if(function_exists( 'wp_enqueue_media' ))
			{
				wp_enqueue_media();
			}
			//wp_enqueue_script( 'custom-header' );

			wp_enqueue_script('jquery');
			wp_enqueue_script('jquery-ui-dialog');
			wp_enqueue_script('jquery-ui-sortable');
            
			wp_enqueue_script( 'wp-color-picker' );
			wp_enqueue_style( 'wp-color-picker' );

			wp_enqueue_script('media-upload');
			wp_enqueue_script('thickbox');

			wp_register_script('chosen', WP_PLUGIN_URL.'/final-tiles-gallery/admin/scripts/vendor/chosen.jquery.js');
			wp_enqueue_script('chosen');

			wp_register_script('futurico', WP_PLUGIN_URL.'/final-tiles-gallery/admin/scripts/SCF.ui.js', array('jquery', 'chosen'));
			wp_enqueue_script('futurico');

			wp_register_style('futurico', WP_PLUGIN_URL.'/final-tiles-gallery/admin/bundle.css', array('colors'));
			wp_enqueue_style('futurico');


			wp_register_script('final-tiles-gallery', WP_PLUGIN_URL.'/final-tiles-gallery/admin/scripts/final-tiles-gallery-admin.js', array('jquery','media-upload','thickbox'));
			wp_enqueue_script('final-tiles-gallery');
						
			wp_enqueue_style('thickbox');
			
			$ftg_db_version = '2.01';
			$installed_ver = get_option( "FinalTiles_gallery_db_version" );
			
			
			if( $installed_ver != $ftg_db_version )
			{
				create_db_tables();
				update_option( "FinalTiles_gallery_db_version", $ftg_db_version );
			}			
		}
				
		public function FinalTiles_gallery_admin_style_load() 
		{
			wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/ui-darkness/jquery-ui.min.css'); 
			//wp_enqueue_style('ftg-admin', WP_PLUGIN_URL.'/final-tiles-gallery/admin/style.css');
		}
		
		//Create Admin Menu
		public function add_gallery_admin_menu() 
		{
			$overview = add_menu_page('Final Tiles Gallery', 'Final Tiles Gallery', 1, 'FinalTiles-gallery-admin', array($this, 'add_overview'), WP_PLUGIN_URL.'/final-tiles-gallery/admin/icon.png');
			$tutorial = add_submenu_page('FinalTiles-gallery-admin', __('FinalTiles Gallery >> Tutorial','FinalTiles-gallery'), __('Tutorial','FinalTiles-gallery'), 1, 'tutorial', array($this, 'tutorial'));
			$add_gallery = add_submenu_page('FinalTiles-gallery-admin', __('FinalTiles Gallery >> Add Gallery','FinalTiles-gallery'), __('Add Gallery','FinalTiles-gallery'), 1, 'add-gallery', array($this, 'add_gallery'));
			$edit_gallery = add_submenu_page('FinalTiles-gallery-admin', __('FinalTiles Gallery >> Edit Gallery','FinalTiles-gallery'), __('Edit Gallery','FinalTiles-gallery'), 1, 'edit-gallery', array($this, 'edit_gallery'));
			
			add_action('admin_print_styles-'.$add_gallery, array($this, 'FinalTiles_gallery_admin_style_load'));
			add_action('admin_print_styles-'.$edit_gallery, array($this, 'FinalTiles_gallery_admin_style_load'));

			add_action('load-'.$tutorial, array($this, 'gallery_admin_init'));
			add_action('load-'.$overview, array($this, 'gallery_admin_init'));
			add_action('load-'.$add_gallery, array($this, 'gallery_admin_init'));
			add_action('load-'.$edit_gallery, array($this, 'gallery_admin_init'));
		}
		
		//Create Admin Pages
		public function add_overview() 
		{			
			include("admin/overview.php");
		}
		
		public function tutorial() 
		{			
			include("admin/tutorial.php");
		}
		
		public function add_gallery() 
		{
			include("admin/add-gallery.php");	
		}

		public function delete_image()
		{
			if(check_admin_referer('FinalTiles_gallery','FinalTiles_gallery')) 
			{
				foreach (explode(",", $_POST["id"]) as $id) {
			  		$this->FinalTilesdb->deleteImage(intval($id));
				}				
			}
			die();
		}

		public function assign_filters()
		{
			if(check_admin_referer('FinalTiles_gallery','FinalTiles_gallery')) 
			{
				foreach (explode(",", $_POST["id"]) as $id) 
				{
			  		$result = $this->FinalTilesdb->editImage($id, array("filters" => $_POST["filters"]));
				}				
			}
			die();
		}

		public function add_image()
		{
			if(check_admin_referer('FinalTiles_gallery','FinalTiles_gallery')) 
			{							  
				$gid = intval($_POST['galleryId']);
				$enc_images = stripslashes($_POST["enc_images"]);
				$images = json_decode($enc_images);

				$result = $this->FinalTilesdb->addImages($gid, $images);
				
				header("Content-type: application/json");
				if($result === false) 
				{					
					print "{\"success\":false}";
				}
				else
				{
					print "{\"success\":true}";
				}
			}	
			die();
		}

		public function sort_images()
		{
			if(check_admin_referer('FinalTiles_gallery','FinalTiles_gallery')) 
			{							  
				$result = $this->FinalTilesdb->sortImages(explode(',', $_POST['ids']));
				
				header("Content-type: application/json");
				if($result === false) 
				{					
					print "{\"success\":false}";
				}
				else
				{
					print "{\"success\":true}";
				}
			}	
			die();
		}

		public function save_image()
		{
			if(check_admin_referer('FinalTiles_gallery','FinalTiles_gallery')) 
			{	
				$result = false;
				$type = $_POST['type'];			
				$imageUrl = stripslashes($_POST['img_url']);
				$imageCaption = stripslashes($_POST['description']);
				$filters = stripslashes($_POST['filters']);
				$zoom = stripslashes($_POST['click_action']) == 'zoom' ? 'T' : 'F';
				$blank = stripslashes($_POST['blank']) == 'T' ? 'T' : 'F';
				$link = isset($_POST['url']) ? stripslashes($_POST['url']) : null;
				$imageId = intval($_POST['img_id']);
		        $sortOrder = intval($_POST['sortOrder']);
				
		        if($zoom == "T")
		        	$link = null;

				$data = array("imagePath" => $imageUrl,
							  "zoom" => $zoom,
							  "link" => $link,
							  "imageId" => $imageId,
							  "description" => $imageCaption,
							  "filters" => $filters,
							  "blank" => $blank,
							  "sortOrder" => $sortOrder);
				if(!empty($_POST["id"]))
				{
					$imageId = intval($_POST['id']);
					$result = $this->FinalTilesdb->editImage($imageId, $data);
				}
				else
				{
					$data["gid"] = intval($_POST['galleryId']);
					$result = $this->FinalTilesdb->addFullImage($data);
				}

				header("Content-type: application/json");

				if($result === false) 
				{					
					print "{\"success\":false}";
				}
				else
				{
					print "{\"success\":true}";
				}
			}
			die();
		}

		public function list_images()
		{
			if(check_admin_referer('FinalTiles_gallery','FinalTiles_gallery')) 
			{
				$gid = intval($_POST["gid"]);
				$imageResults = $this->FinalTilesdb->getImagesByGalleryId($gid);
				
				include('admin/include/image-list.php');
			}
			die();
		}

		public function save_gallery()
		{
			if(check_admin_referer('FinalTiles_gallery','FinalTiles_gallery')) 
			{
				$galleryName = stripslashes($_POST['galleryName']);
				$galleryDescription = stripslashes($_POST['galleryDescription']);	  
				$slug = strtolower(str_replace(" ", "", $galleryName));
				$margin = intval($_POST['margin']);
				$minTileWidth = intval($_POST['minTileWidth']);
			    $gridCellSize = intval($_POST['gridCellSize']);
			    $shuffle = $_POST['shuffle'];
			    $enableTwitter = $_POST['enableTwitter'];
			    $enableFacebook = $_POST['enableFacebook'];
			    $enableGplus = $_POST['enableGplus'];
			    $enablePinterest = $_POST['enablePinterest'];
			    $lightbox = $_POST['lightbox'];
			    $filters = $_POST['filters'];
			    $scrollEffect = $_POST['scrollEffect'];
			    $hoverEffect = $_POST['hoverEffect'];
			    $hoverColor = $_POST['hoverColor'];
			    $hoverEasing = $_POST['hoverEasing'];
			    $hoverOpacity = intval($_POST['hoverOpacity']);
			    $borderSize = intval($_POST['borderSize']);
			    $borderColor = $_POST['borderColor'];
			    $borderRadius = intval($_POST['borderRadius']);
			    $shadowColor = $_POST['shadowColor'];
			    $shadowSize = intval($_POST['shadowSize']);
			    $enlargeImages = $_POST['enlargeImages'];
			    $backgroundColor = $_POST['backgroundColor'];
			    $style = $_POST['style'];
			    $script = $_POST['script'];

			    $hoverEffectDuration = intval($_POST['hoverEffectDuration']);
				$id = isset($_POST['ftg_gallery_edit']) ? intval($_POST['ftg_gallery_edit']) : 0;

			    $data = array('name' => $galleryName, 'slug' => $slug, 'description' => $galleryDescription, 'lightbox' => $lightbox,
			                  'margin' => $margin, 'minTileWidth' => $minTileWidth, 'gridCellSize' => $gridCellSize, 'shuffle' => $shuffle, 
			                  'enableTwitter' => $enableTwitter, 'enableFacebook' => $enableFacebook, 'enableGplus' => $enableGplus, 'enablePinterest' => $enablePinterest,
			                  'hoverEffect' => $hoverEffect, 'hoverOpacity' => $hoverOpacity, 'hoverColor' => $hoverColor, 'hoverEffectDuration' => $hoverEffectDuration, 
			                  'hoverEasing' => $hoverEasing, 'filters' => $filters, 'borderSize' => $borderSize,
			                  'borderColor' => $borderColor, 'enlargeImages' => $enlargeImages, 
			                  'backgroundColor' => $backgroundColor, 'borderRadius' => $borderRadius,
			                   'shadowSize' => $shadowSize, 'shadowColor' => $shadowColor,
			                   'style' => $style, 'script' => $script, 'scrollEffect' => $scrollEffect );
			    
			    header("Content-type: application/json");
			    if($id > 0)
			    {
					$result = $this->FinalTilesdb->editGallery($id, $data);	
				}
				else
				{
					$result = $this->FinalTilesdb->addGallery($data);					
					$id = $this->FinalTilesdb->getNewGalleryId();
				}

				if($result) 
					print "{\"success\":true,\"id\":" . $id ."}";
				else
					print "{\"success\":false}";
			}
			die();
		}

		public function edit_gallery() {
			include("admin/edit-gallery.php");	
		}
		
		public function add_images() {
			include("admin/add-images.php");
		}	
		
		//Create gallery
		public function create_gallery($galleryId) {
			require_once('lib/gallery-class.php');			
			global $FinalTilesGallery;
			
			if (class_exists('FinalTilesGallery')) {
				$FinalTilesGallery = new FinalTilesGallery($galleryId, $this->FinalTilesdb);
				$settings = $FinalTilesGallery->getGallery();
				switch($settings->lightbox)
				{
					default:
					case "magnific":						
						wp_enqueue_style('magnific_stylesheet');
						wp_enqueue_script('magnific_script');
						break;
					case "prettyphoto":
						wp_enqueue_style('prettyphoto_stylesheet');
						wp_enqueue_script('prettyphoto_script');
						break;
					case "fancybox":
						wp_enqueue_style('fancybox_stylesheet');
						wp_enqueue_script('fancybox_script');
						break;
					case "colorbox":
						wp_enqueue_style('colorbox_stylesheet');
						wp_enqueue_script('colorbox_script');
						break;
					case "swipebox":
						wp_enqueue_style('swipebox_stylesheet');
						wp_enqueue_script('swipebox_script');
						break;
					case "lightbox2":
						wp_enqueue_style('lightbox2_stylesheet');
						wp_enqueue_script('lightbox2_script');
						break;
				}				
				return $FinalTilesGallery->render();
			}
			else {
				return "Gallery not found.";	
			}	
		}
		
		//Create Short Code
		public function gallery_shortcode_handler($atts) {
			return $this->create_gallery($atts['id']);
		}		
	}
}

if (class_exists("FinalTiles_Gallery")) {
    global $ob_FinalTiles_Gallery;
	$ob_FinalTiles_Gallery = new FinalTiles_Gallery();
}
?>