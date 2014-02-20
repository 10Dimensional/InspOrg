<?php
if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); }

$galleryResults = $this->FinalTilesdb->getGalleries();
$gallery = null;
//Select gallery
if(isset($_POST['select_gallery']) || isset($_POST['galleryId'])) {
	if(check_admin_referer('FinalTiles_gallery','FinalTiles_gallery')) {
	  $gid = (isset($_POST['select_gallery'])) ? intval(stripslashes($_POST['select_gallery'])) : intval(stripslashes($_POST['galleryId']));	
	  
	  $imageResults = $this->FinalTilesdb->getImagesByGalleryId($gid);
	  $gallery = $this->FinalTilesdb->getGalleryById($gid);      
	}
}

?>
<div class='wrap'>
    <?php include("adv.php") ?>

<h2>FinalTiles Gallery - <?php _e('Edit Galleries', 'FinalTiles-gallery'); ?></h2>
<?php if(!isset($_POST['select_gallery']) && !isset($_POST['galleryId'])) { ?>
    <p><?php _e('Select a gallery to edit its properties', 'FinalTiles-gallery'); ?></p>		
    <table class="widefat post fixed" id="galleryResults" cellspacing="0">
	<thead>
    	<tr>
          <th><?php _e('Gallery Name', 'FinalTiles-gallery'); ?></th>
          <th><?php _e('Description', 'FinalTiles-gallery'); ?></th>
          <th></th>
          <th></th>
        </tr>
    </thead>
    <tfoot>
    	<tr>
          <th><?php _e('Gallery Name', 'FinalTiles-gallery'); ?></th>
          <th><?php _e('Description', 'FinalTiles-gallery'); ?></th>
          <th></th>
          <th></th>
        </tr>
    </tfoot>
    <tbody>
    	<?php
			foreach($galleryResults as $gallery) {
				?>
                <tr>
                	<td><?php _e($gallery->name); ?></td>
                    <td><?php _e($gallery->description); ?></td>
                    <td></td>
                    <td>
                    	<form name="select_gallery_form" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>" method="post">
                    	<?php wp_nonce_field('FinalTiles_gallery', 'FinalTiles_gallery'); ?>
                        <input type="hidden" name="galleryId" value="<?php _e($gallery->Id); ?>" />
                        <input type="hidden" name="galleryName" value="<?php _e($gallery->name); ?>" />
                        <input type="submit" name="Submit" class="button firm button-primary" value="<?php _e('Select Gallery', 'FinalTiles-gallery'); ?>" />
                		</form>
                    </td>
                </tr>
		<?php } ?>
        <tr>
        </tr>
    </tbody>
</table>
    
    <?php } else if(isset($_POST['select_gallery']) || isset($_POST['galleryId'])) { ?>  

        <h3>Gallery: <?php _e($gallery->name); ?></h3>        
        
        <div class="mbl">
            <div class="header">
                <div class="wrapper">
                    <ul class="header-navigation" id="gallery-edit-nav">
                        <li class="current">
                            <a href="#settings">Settings</a>
                        </li>
                        <li>
                            <a href="#images">Images</a>                            
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="settings">
            <form name="gallery_form" id="gallery_form" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>" method="post">
            <?php wp_nonce_field('FinalTiles_gallery', 'FinalTiles_gallery'); ?>
            <input type="hidden" name="ftg_gallery_edit" id="gallery-id" value="<?php _e($gid); ?>" />
            <table class="widefat post fixed" cellspacing="0">
            	<thead>
                <tr>
                	<th width="250"><?php _e('Attribute Name', 'FinalTiles-gallery'); ?></th>
                    <th><?php _e('Value', 'FinalTiles-gallery'); ?></th>
                    <th><?php _e('Description', 'FinalTiles-gallery'); ?></th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                	<th><?php _e('Attribute Name', 'FinalTiles-gallery'); ?></th>
                    <th><?php _e('Value', 'FinalTiles-gallery'); ?></th>
                    <th><?php _e('Description', 'FinalTiles-gallery'); ?></th>
                </tr>
                </tfoot>
                <tbody>
                	<?php include("include/edit-gallery.php") ?>
                    <tr>
                    	<td class="major-publishing-actions"><input id="edit-gallery" type="submit" name="Submit" class="button-huge positive" value="<?php _e('Update Gallery', 'FinalTiles-gallery'); ?>" /></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
        	</table>
            </form>
        </div>

        <!-- images section -->
        <div id="images">
            
            <div class="actions">
                <a href="#" class="open-media-panel button firm mlm">Add images</a>
                <span class="tip">For multiple selections: Click+CTRL.</span>
                <span class="tip">Drag images to change order.</span>
            </div>
            <div class="tips">
                <strong>About choosing a proper image size:</strong> Final Tiles Gallery doesn't scale down the images
                when there's enough space, it gives you the freedom to choose your favourite size for each image.
                So you should use images that are smaller than the container, choose the <strong>thumbnail</strong> or 
                <strong>medium</strong> size, for example.
            </div>
            <div class="bulk">
                <h4>Bulk Actions</h4>
                <div class="options">
                    <a href="#" data-action="select">Select all</a>
                    <a href="#" data-action="deselect">Deselect all</a>
                    <a href="#" data-action="toggle">Toggle selection</a>
                    <a href="#" data-action="remove">Remove</a>
                    <a href="#" data-action="filter">Assign filters</a>
                </div>
                <div class="panel">
                    <strong></strong>
                    <p class="text"></p>
                    <p class="buttons">
                        <a class="button mrm cancel" href="#">Cancel</a>
                        <a class="button mrm proceed firm" href="#">Proceed</a>
                    </p>
                </div>
            </div>
            <div id="image-list"></div>

            <!-- image panel -->
            <div id="image-panel-model" style="display:none">
                <a href="#" class="close" title="Close">X</a>
                <div class="clearfix">
                    <div class="left">
                        <div class="figure"></div>
                        <div class="field sizes"></div>
                    </div>
                    <div class="right">
                        <div class="field">
                            <label>Caption</label>
                            <div class="text dark">
                                <textarea name="description"></textarea>
                            </div>
                        </div>
                        <div class="field">
                            <label>Action on click</label>
                            <ul class="actions">
                                <li><input type="radio" name="click_action" value="" /> None</li>
                                <li><input type="radio" name="click_action" value="zoom" /> Zoom</li>
                                <li>
                                    <div class="text dark">
                                        <input type="radio" name="click_action" value="url" /> Go to URL:                                     
                                        <input type="text" size="20" value="" name="url" disabled />
                                        <input type="checkbox" name="blank" value="T" /> Blank
                                    </div>
                                </li>
                            </ul>                        
                        </div>                    
                    </div>
                </div>
                <div class="field filters clearfix"></div>
                <div class="field buttons">
                    <a href="#" data-action="cancel" class="button neutral">Cancel</a>
                    <a href="#" data-action="save" class="button positive">Save</a>
                </div>
            </div>
        </div>
        <script>
            jQuery(function () {
                var $ = jQuery;
                $("#gallery-edit-nav a").click(function (e) {
                    e.preventDefault();
                    var target = $(this).attr("href");
                    $("#images, #settings").hide();
                    $(target).show();

                    $("#gallery-edit-nav li").removeClass("current");
                    $(this).parent().addClass("current");
                });
                FTG.load_images();
                FTG.init_gallery();
            });
        </script>
    <?php } ?>  
</div>