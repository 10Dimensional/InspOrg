<?php
/**
 * Plugin Name.
 *
 * @package   Property_finder_Admin
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2013 Your Name or Company Name
 */

/**
 * Plugin class. This class should ideally be used to work with the
 * administrative side of the WordPress site.
 *
 * If you're interested in introducing public-facing
 * functionality, then refer to `class-property-finder.php`
 *
 * @TODO: Rename this class to a proper name for your plugin.
 *
 * @package Property_Finder_Admin
 * @author  Your Name <email@example.com>
 */
 error_reporting(E_ALL);
 ini_set('display_errors', '1');
class Property_Finder_Admin {

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Slug of the plugin screen.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_screen_hook_suffix = null;

	/**
	 * Initialize the plugin by loading admin scripts & styles and adding a
	 * settings page and menu.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		/*
		 * @TODO :
		 *
		 * - Uncomment following lines if the admin class should only be available for super admins
		 */
		/* if( ! is_super_admin() ) {
			return;
		} */

		/*
		 * Call $plugin_slug from public plugin class.
		 *
		 * @TODO:
		 *
		 * - Rename "Property_Finder" to the name of your initial plugin class
		 *
		 */
		$plugin = Property_Finder::get_instance();
		$this->plugin_slug = $plugin->get_plugin_slug();

		// Load admin style sheet and JavaScript.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
        
        // Export
        add_action( 'admin_post_export', array( $this, 'export_csv' ));
        
		// Add the options page and menu item.
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );

		// Add an action link pointing to the options page.
		$plugin_basename = plugin_basename( plugin_dir_path( __DIR__ ) . $this->plugin_slug . '.php' );
		add_filter( 'plugin_action_links_' . $plugin_basename, array( $this, 'add_action_links' ) );

		/*
		 * Define custom functionality.
		 *
		 * Read more about actions and filters:
		 * http://codex.wordpress.org/Plugin_API#Hooks.2C_Actions_and_Filters
		 */
		add_action( '@TODO', array( $this, 'action_method_name' ) );
		add_filter( '@TODO', array( $this, 'filter_method_name' ) );

	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		/*
		 * @TODO :
		 *
		 * - Uncomment following lines if the admin class should only be available for super admins
		 */
		/* if( ! is_super_admin() ) {
			return;
		} */

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Register and enqueue admin-specific style sheet.
	 *
	 * @TODO:
	 *
	 * - Rename "Property_Finder" to the name your plugin
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_styles() {

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( $this->plugin_screen_hook_suffix == $screen->id ) {
			wp_enqueue_style( $this->plugin_slug .'-admin-styles', plugins_url( 'assets/css/admin.css', __FILE__ ), array(), Property_Finder::VERSION );
			wp_enqueue_style( $this->plugin_slug .'-jquery-ui-styles', plugins_url( 'assets/css/jquery-ui-1.10.4.custom.min.css', __FILE__ ), array(), Property_Finder::VERSION );
		}

	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @TODO:
	 *
	 * - Rename "Property_Finder" to the name your plugin
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_scripts() {

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( $this->plugin_screen_hook_suffix == $screen->id ) {
			wp_enqueue_script( $this->plugin_slug . '-admin-script', plugins_url( 'assets/js/admin.js', __FILE__ ), array( 'jquery' ), Property_Finder::VERSION );
			
			wp_enqueue_script( 'jquery-ui-core', '/wp-includes/js/jquery/ui/jquery.ui.core.min.js');
			wp_enqueue_script( 'jquery-ui-datepicker', '/wp-includes/js/jquery/ui/jquery.ui.datepicker.min.js');
			
			
			
		}

	}
	
	/**
	 * Export CSV
	 *
	 * @since    1.0.0
	 */
	public function export_csv()
	{
	    error_reporting(E_ALL);
	    ini_set('display_errors', '1');
	    global $wpdb;
	    
        $from = ($_POST['fromDate']) ? date('Y-m-d 00:00:00', strtotime($_POST['fromDate'])) : false;
        $to = ($_POST['toDate']) ? date('Y-m-d 99:99:99', strtotime($_POST['toDate'])) : false;
        print_r($from);
        $user = wp_get_current_user();
        $user_role = $user->roles[0];
        
        if ($user_role === 'kb_admin') {
            $lead_key = 'kb home';
        } else if ($user_role === 'tollbrothersadmin') {
            $lead_key = 'toll brothers';
        } else if ($user_role === 'beazer_admin') {
            $lead_key = 'beazer homes';
        } else if ($user_role === 'pardee_admin') {
            $lead_key = 'pardee homes';
        }
        
        
        $filename = ABSPATH . 'wp-content/plugins/property-finder/public/export/export.csv';
        $all_leads = ($from && $to) ? $wpdb->get_results('SELECT * FROM ap_leads WHERE timestamp >= "'.$from.'" AND timestamp <= "'.$to.'" ORDER BY timestamp DESC') : $wpdb->get_results('SELECT * FROM ap_leads ORDER BY timestamp DESC');
        $fp = fopen($filename, 'w');
        $builders_leads = array();
        
        foreach ($all_leads as $lead) {
            $builders = (is_array(json_decode($lead->builders))) ? json_decode($lead->builders) : array();
            if (in_array($lead_key, $builders)) {
                $builders_leads[] = $lead;
            }
        }
        
        $headers = array(
            'id',
            'first',
            'last',
            'email',
            'phone',
            'comment',
            'firm',
            'address',
            'city',
            'state',
            'zip',
            'properties',
            'time'
        );
        
        
        fputcsv($fp, $headers);
        
        $leads_array = array();
        foreach ($builders_leads as $lead) {
            $properties = ($lead->properties) ? $wpdb->get_results('SELECT * FROM ap_properties WHERE id IN( ' . implode( ',', json_decode($lead->properties)).') AND LOWER(builder) = LOWER("'.$lead_key.'")') : array();
            $property_val = '';
            
            $prop_count = 0;
            foreach ($properties as $property) {
                if ($prop_count === 0) {
                    $property_val .= $property->series.' '.$property->model;
                } else {
                    $property_val .= ', '.$property->series.' '.$property->model;
                }
                $prop_count++;
            }
        
        
            $leads_array = array(
                $lead->id,
                $lead->first,
                $lead->last,
                $lead->email,
                $lead->phone,
                $lead->comment,
                $lead->firm,
                $lead->address,
                $lead->city,
                $lead->state,
                $lead->zip,
                $property_val,
                $lead->timestamp
            );
            
            fputcsv($fp, $leads_array);
        }
        
        fclose($fp);        
        
        	    
	    // Set headers
		header('Content-Description: File Transfer');
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename=export.csv');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filename));
        
        // Clean / flush output buffer 
        ob_clean();
        flush();
        
        // Download
        readfile($filename);
	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */
	public function add_plugin_admin_menu() {

		/*
		 * Add a settings page for this plugin to the Settings menu.
		 *
		 * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
		 *
		 *        Administration Menus: http://codex.wordpress.org/Administration_Menus
		 *
		 * @TODO:
		 *
		 * - Change 'Page Title' to the title of your plugin admin page
		 * - Change 'Menu Text' to the text for menu item for the plugin settings page
		 * - Change 'manage_options' to the capability you see fit
		 *   For reference: http://codex.wordpress.org/Roles_and_Capabilities
		 */
		 
		$this->plugin_screen_hook_suffix = add_menu_page(
			__( 'Leads', $this->plugin_slug ),
			__( 'Leads', $this->plugin_slug ),
			'read',
			$this->plugin_slug,
			array( $this, 'display_plugin_admin_page'),
			'',
			7
		);
	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_admin_page() {
		include_once( 'views/admin.php' );
	}

	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */
	public function add_action_links( $links ) {

		return array_merge(
			array(
				'settings' => '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_slug ) . '">' . __( 'Settings', $this->plugin_slug ) . '</a>'
			),
			$links
		);

	}

	/**
	 * NOTE:     Actions are points in the execution of a page or process
	 *           lifecycle that WordPress fires.
	 *
	 *           Actions:    http://codex.wordpress.org/Plugin_API#Actions
	 *           Reference:  http://codex.wordpress.org/Plugin_API/Action_Reference
	 *
	 * @since    1.0.0
	 */
	public function action_method_name() {
		// @TODO: Define your action hook callback here
	}

	/**
	 * NOTE:     Filters are points of execution in which WordPress modifies data
	 *           before saving it or sending it to the browser.
	 *
	 *           Filters: http://codex.wordpress.org/Plugin_API#Filters
	 *           Reference:  http://codex.wordpress.org/Plugin_API/Filter_Reference
	 *
	 * @since    1.0.0
	 */
	public function filter_method_name() {
		// @TODO: Define your filter hook callback here
	}

}
