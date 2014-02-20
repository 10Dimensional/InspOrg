<?php
if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); }

if(isset($_POST['galleryId'])) {
	if(check_admin_referer('FinalTiles_gallery','FinalTiles_gallery')) {
	  $this->FinalTilesdb->deleteGallery(intval($_POST['galleryId']));
		  
	  ?>  
	  <div class="updated"><p><strong><?php _e('Gallery has been deleted.', 'FinalTiles-gallery'); ?></strong></p></div>  
	  <?php	
	}
}

$galleryResults = $this->FinalTilesdb->getGalleries();

if (isset($_POST['defaultSettings'])) {
	if(check_admin_referer('FinalTiles_gallery','FinalTiles_gallery')) {
	  $temp_defaults = get_option('FinalTiles_gallery_options');
	  $temp_defaults[1]['margin'] = $_POST['margin'];
	  $temp_defaults[1]['minTileWidth'] = $_POST['minTileWidth'];
      $temp_defaults[1]['gridCellSize'] = $_POST['gridCellSize'];
	  
	  update_option('FinalTiles_gallery_options', $temp_defaults);
	  ?>  
	  <div class="updated"><p><strong><?php _e('Gallery options have been updated.', 'FinalTiles-gallery'); ?></strong></p></div>  
	  <?php
	}
}
$default_options = get_option('FinalTiles_gallery_options');
?>
<div class='wrap'>

<?php include("adv.php") ?>

<h2>Final Tiles Gallery</h2>
<p><?php _e('This is a listing of all galleries', 'FinalTiles-gallery'); ?></p>
    <table class="widefat post fixed" id="galleryResults" cellspacing="0">
    	<thead>
        <tr>
        	<th><?php _e('Gallery Name', 'FinalTiles-gallery'); ?></th>
            <th><?php _e('Gallery Short Code', 'FinalTiles-gallery'); ?></th>
            <th><?php _e('Description', 'FinalTiles-gallery'); ?></th>
            <th width="136"></th>
        </tr>
        </thead>
        <tfoot>
        <tr>
        	<th><?php _e('Gallery Name', 'FinalTiles-gallery'); ?></th>
            <th><?php _e('Gallery Short Code', 'FinalTiles-gallery'); ?></th>
            <th><?php _e('Description', 'FinalTiles-gallery'); ?></th>
            <th></th>
        </tr>
        </tfoot>
        <tbody>
        	<?php foreach($galleryResults as $gallery) { ?>				
            <tr>
            	<td><?php _e($gallery->name); ?></td>
                <td>
                    <div class="text dark">
                        <input type="text" size="40" value="[FinalTilesGallery id='<?php _e($gallery->Id); ?>']" />
                    </div>
                </td>
                <td><?php _e($gallery->description); ?></td>
                <td class="major-publishing-actions">
                <form name="delete_gallery_<?php _e($gallery->Id); ?>" method ="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
                	<?php wp_nonce_field('FinalTiles_gallery', 'FinalTiles_gallery'); ?>
                	<input type="hidden" name="galleryId" value="<?php _e($gallery->Id); ?>" />
                    <input type="submit" name="Submit" class="button alert" value="<?php _e('Delete Gallery', 'FinalTiles-gallery'); ?>" />
                </form>
                </td>
            </tr>
			<?php } ?>
        </tbody>
     </table>
     <br />
     <h3><?php _e('Default Options', 'FinalTiles-gallery'); ?></h3>
     <form name="save_default_settings" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
     <?php wp_nonce_field('FinalTiles_gallery', 'FinalTiles_gallery'); ?>
     <table class="widefat post fixed" cellspacing="0">
     	<thead>
        	<th><?php _e('Attribute', 'FinalTiles-gallery'); ?></th>
            <th><?php _e('Default Value', 'FinalTiles-gallery'); ?></th>
            <th><?php _e('Description', 'FinalTiles-gallery'); ?></th>
        </thead>
        <tfoot>
        	<th><?php _e('Attribute', 'FinalTiles-gallery'); ?></th>
            <th><?php _e('Default Value', 'FinalTiles-gallery'); ?></th>
            <th><?php _e('Description', 'FinalTiles-gallery'); ?></th>
        </tfoot>
        <tbody>
        	<tr class="alternate">
            	<td><?php _e('Default Margin', 'FinalTiles-gallery'); ?></td>
                <td>
                    <div class="text dark">
                        <input type="text" name="margin" id="margin" value="<?php _e($default_options[1]['margin']); ?>" /> px
                    </div>
                    </td>
                <td><?php _e('This is the default margin (in pixels) between tiles in galleries.<br />(This property can be overwritten when creating individual galleries.)', 'FinalTiles-gallery'); ?></td>
            </tr>
            <tr>
            	<td><?php _e('Default Minimum Tile Width', 'FinalTiles-gallery'); ?></td>
                <td>
                    <div class="text dark">
                        <input type="text" name="minTileWidth" id="minTileWidth" value="<?php _e($default_options[1]['minTileWidth']); ?>" /> px
                    </div>
                </td>
                <td><?php _e('This is the default minimum tile width (in pixels).<br />(This property can be overwritten when creating individual galleries.)', 'FinalTiles-gallery'); ?></td>
            </tr>
            <tr class="alternate">
                <td><?php _e('Grid Cell size', 'FinalTiles-gallery'); ?></td>
                <td>
                    <div class="text dark">
                        <input type="text" name="gridCellSize" id="gridCellSize" value="<?php _e($default_options[1]['gridCellSize']); ?>" /> px
                    </div>
                </td>
                <td><?php _e('Tiles are snapped to a virtual grid, good results are achieved with a value between 5 and 50', 'FinalTiles-gallery'); ?> <strong>Must be greater than 0.</strong></td>
            </tr>
            <tr>
            	<td>                
                	<input type="hidden" name="defaultSettings" value="true" />
                    <input type="submit" name="Submit" class="button button-primary" value="<?php _e('Save', 'FinalTiles-gallery'); ?>" />                
                </td>
                <td></td>
                <td>
            </tr>
        </tbody>
     </table>
     </form>
     
</div>