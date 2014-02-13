<?php
if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); }

	$temp_defaults = get_option('FinalTiles_gallery_options');	

	$margin = $temp_defaults[1]['margin'];
	$minTileWidth = $temp_defaults[1]['minTileWidth'];
    $gridCellSize = $temp_defaults[1]['gridCellSize'];
	
?>
<div class='wrap'>
    <?php include("adv.php") ?>
<h2>Final Tiles Gallery - <?php _e('Add Gallery', 'FinalTiles-gallery'); ?></h2>

	
    <p><?php _e('This is where you can create new galleries. Once the new gallery has been added, a short code will be provided for use in posts.', 'FinalTiles-gallery'); ?></p>
    
    <form name="gallery_form" id="gallery_form" action="?" method="post">
    <?php wp_nonce_field('FinalTiles_gallery', 'FinalTiles_gallery'); ?>
    <input type="hidden" name="add_gallery" value="true" />
    <table class="widefat post fixed" cellspacing="0" id="settings">
    	<thead>
        <tr>
        	<th width="250"><?php _e('Attribute', 'FinalTiles-gallery'); ?></th>
            <th><?php _e('Value', 'FinalTiles-gallery'); ?></th>
            <th><?php _e('Description', 'FinalTiles-gallery'); ?></th>
        </tr>
        </thead>
        <tfoot>
        <tr>
        	<th><?php _e('Attribute', 'FinalTiles-gallery'); ?></th>
            <th><?php _e('Value', 'FinalTiles-gallery'); ?></th>
            <th><?php _e('Description', 'FinalTiles-gallery'); ?></th>
        </tr>
        </tfoot>
        <tbody>
        	<?php include("include/edit-gallery.php") ?>
            <tr>
            	<td class="major-publishing-actions">
                    <input id="add-gallery" type="submit" name="Submit" class="button-huge positive" value="<?php _e('Add Gallery', 'FinalTiles-gallery'); ?>" />
                </td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
	</table>
    </form>
</div>
