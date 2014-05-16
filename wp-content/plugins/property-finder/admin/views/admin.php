<?php
/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package   Property_Finder
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2013 Your Name or Company Name
 */
error_reporting(E_ALL);
ini_set('display_errors', '1');
// Leads for builder
include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
global $wpdb;

$user_role = get_user_role(get_current_user_id());
$all_leads = array();
$builders_leads = array();
$offset = 0;
if ($user_role === 'kb_admin') {
    $lead_key = 'kb home';
} else if ($user_role === 'tollbrothersadmin') {
    $lead_key = 'toll brothers';
} else if ($user_role === 'beazer_admin') {
    $lead_key = 'beazer homes';
} else if ($user_role === 'pardee_admin') {
    $lead_key = 'pardee homes';
}

if (isset($lead_key)) {
    $pagenum = isset( $_GET['pagenum'] ) ? absint( $_GET['pagenum'] ) : 1;
    $limit = 25;
    $offset = ( $pagenum - 1 ) * $limit;
    $all_leads = $wpdb->get_results( "SELECT * FROM ap_leads ORDER BY timestamp DESC" );

    
}


if (!isset($_GET['single'])) { 
    foreach ($all_leads as $lead) {
        $builders = (is_array(json_decode($lead->builders))) ? json_decode($lead->builders) : array();
        if (in_array($lead_key, $builders)) {
            $builders_leads[] = $lead;
        }
    }
    
    $sliced_leads = array_slice($builders_leads, $offset);
    
?>
    <div class="lead_shell wrap">
    	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
    	<div class="export">
    	    <form method="POST" action="<?php echo admin_url( 'admin-post.php?action=export' ); ?>">
    	        <label>From: <input type="text" name="fromDate" /></label>
    	        <label>To: <input type="text" name="toDate" /></label>
    	        <input type="submit" value="Export" />
    	        <div><small>Please select a date range. If you do not select a date range, all entries will be exported.</small></div>
    	    </form>
    	</div>
    	<?php if (count($builders_leads)) { ?>
        <table id="tblBuilders" cellspacing="0" class="widefat fixed">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Firm</th>
                    <th>Comment</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody class="list:user user-list">
                <?php 
                $count = 1; 
                foreach ($sliced_leads as $builder_lead) { ?>
                    <tr name="<?php echo $builder_lead->id; ?>">
                        <td><?php echo ($builder_lead->first) ? $builder_lead->first : 'Not Provided'; ?></td>
                        <td><?php echo ($builder_lead->last) ? $builder_lead->last : 'Not Provided'; ?></td>
                        <td><?php echo ($builder_lead->email) ? $builder_lead->email : 'Not Provided'; ?></td>
                        <td><?php echo ($builder_lead->phone) ? $builder_lead->phone : 'Not Provided'; ?></td>
                        <td><?php echo ($builder_lead->firm) ? $builder_lead->firm : 'Not Provided'; ?></td>
                        <td><?php echo ($builder_lead->comment) ? $builder_lead->comment : 'Not Provided'; ?></td>
                        <td><?php echo ($builder_lead->timestamp) ? $builder_lead->timestamp : 'Not Provided'; ?></td>
                    </tr> 
                <?php 
                    if ($count >= $limit) break;
                $count++; } ?>
            </tbody>
        </table>
        <?php 
            $total = count($builders_leads);
            $num_of_pages = ceil( $total / $limit );
            $page_links = paginate_links( array(
                'base' => add_query_arg( 'pagenum', '%#%' ),
                'format' => '',
                'prev_text' => __( '&laquo;', 'aag' ),
                'next_text' => __( '&raquo;', 'aag' ),
                'total' => $num_of_pages,
                'current' => $pagenum
            ) );
             
            if ( $page_links ) {
                echo '<div class="tablenav"><div class="tablenav-pages" style="margin: 1em 0">' . $page_links . '</div></div>';
            }
        } else { ?>
            <p>Sorry, no leads for this user</p>
        <?php } ?>
    </div>
<?php } else { 
    foreach ($all_leads as $lead) {
        if ($lead->id !== $_GET['single']) continue;
        $builders = (is_array(json_decode($lead->builders))) ? json_decode($lead->builders) : array();
        if (in_array($lead_key, $builders)) {
            $builders_leads[] = $lead;
        }
    }
    
    $properties = ($builders_leads[0]->properties) ? $wpdb->get_results('SELECT * FROM ap_properties WHERE id IN( ' . implode( ',', json_decode($builders_leads[0]->properties)).')') : array();
    
?>
    <div class="lead_shell wrap">
        <a href="javascript:history.back();" class="back">&laquo; Back</a>
        <?php if (count($builders_leads[0])) { ?>
    	<h2><?php echo $builders_leads[0]->first.' '.$builders_leads[0]->last; ?></h2>
    	<p><strong>Email:</strong> <?php echo ($builders_leads[0]->email) ? $builders_leads[0]->email : 'Not Provided'; ?></p>
    	<p><strong>Phone:</strong> <?php echo ($builders_leads[0]->phone) ? $builders_leads[0]->phone : 'Not Provided'; ?></p>
    	<p><strong>Firm:</strong> <?php echo ($builders_leads[0]->firm) ? $builders_leads[0]->firm : 'Not Provided'; ?></p>
    	<p><strong>Address:</strong> <?php echo ($builders_leads[0]->address) ? $builders_leads[0]->address : 'Not Provided'; ?></p>
    	<p><strong>City:</strong> <?php echo ($builders_leads[0]->city) ? $builders_leads[0]->city : 'Not Provided'; ?></p>
    	<p><strong>State:</strong> <?php echo ($builders_leads[0]->state) ? $builders_leads[0]->state : 'Not Provided'; ?></p>
    	<p><strong>Zip:</strong> <?php echo ($builders_leads[0]->zip) ? $builders_leads[0]->zip : 'Not Provided'; ?></p>
    	
    	<p><strong>Desired Price Range:</strong> <?php echo ($builders_leads[0]->price_range) ? $builders_leads[0]->price_range : 'Not Provided'; ?></p>
    	<p><strong>Desired Square Footage:</strong> <?php echo ($builders_leads[0]->sqft) ? $builders_leads[0]->sqft : 'Not Provided'; ?></p>
    	
    	<p><strong>Comment:</strong> <?php echo ($builders_leads[0]->comment) ? $builders_leads[0]->comment : 'Not Provided'; ?></p>
    	<p><strong>Time:</strong> <?php echo ($builders_leads[0]->timestamp) ? $builders_leads[0]->timestamp : 'Not Provided'; ?></p>
        <?php if (!empty($properties)) { ?>
        <p><strong>Properties Interested In:</strong>
            <ul>
                <?php foreach ($properties as $property) { ?>
                    <li><a href="<?php echo $property->url; ?>"><?php echo $property->series.' '.$property->model; ?></a></li>
                <?php } ?>
            </ul>
        </p>
        <?php } ?>
        
        <?php } else { ?>
            <p>Sorry, this lead doesn't exist.</p>
        <?php } ?>
    </div>


<?php }
function get_user_role($uid) {
    global $wpdb;
    $role = $wpdb->get_var("SELECT meta_value FROM {$wpdb->usermeta} WHERE meta_key = 'wp_capabilities' AND user_id = {$uid}");
    if(!$role) return 'non-user';
    $rarr = unserialize($role);
    $roles = is_array($rarr) ? array_keys($rarr) : array('non-user');
    return $roles[0];
}
?>
