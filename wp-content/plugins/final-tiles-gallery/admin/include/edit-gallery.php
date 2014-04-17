<?php
    function ftg_p($gallery, $field, $default = NULL)
    {    
        if($gallery == NULL || $gallery->$field === NULL) 
        {
            if($default === NULL)
            {
                print "";
            }
            else
            {
                print $default;
            }
        } 
        else 
        {
            print $gallery->$field;
        }
    }
    function ftg_sel($gallery, $field, $value)
    {
        if($gallery == NULL)
            print "";
        else
            if($gallery->$field == $value)
                print "selected";
    }

    
?>
            <tr class="alternate">
            	<td><strong><?php _e('Gallery Name', 'FinalTiles-gallery'); ?>:</strong></td>
                <td>
                    <div class="text dark">
                        <input type="text" size="30" name="galleryName" value="<?php ftg_p($gallery, "name")  ?>" />
                    </div>
                </td>
                <td><?php _e('This name is the internal name for the gallery.<br />Please avoid non-letter characters such as', 'FinalTiles-gallery'); ?> ', ", *, etc.</td>
            </tr>
            <tr>
            	<td><strong><?php _e('Gallery Description', 'FinalTiles-gallery'); ?>:</strong></td>
                <td>
                    <div class="text dark">
                        <input type="text" size="50" name="galleryDescription" value="<?php ftg_p($gallery, "description")  ?>" />
                    </div>
                </td>
                <td><?php _e('This description is for internal use.', 'FinalTiles-gallery'); ?></td>
            </tr> 
            <tr class="alternate">
                <td><strong><?php _e('Gallery width', 'FinalTiles-gallery'); ?>:</strong></td>
                <td>
                    <div class="text dark">
                        <input type="text" size="10" name="width" value="<?php ftg_p($gallery, "width", "100%")  ?>" />
                    </div>
                </td>
                <td><?php _e('Width of the gallery in pixels or percentage.', 'FinalTiles-gallery'); ?></td>
            </tr>            
            <tr>
            	<td><strong><?php _e('Margin', 'FinalTiles-gallery'); ?>:</strong></td>
                <td>
                    <div class="text dark">
                        <input type="text" size="10" name="margin" value="<?php ftg_p($gallery, "margin", $margin)  ?>" />px
                    </div>
                </td>
                <td></td>
            </tr>
            <tr class="alternate">
            	<td><strong><?php _e('Tile minimum width', 'FinalTiles-gallery'); ?>:</strong></td>
                <td>
                    <div class="text dark">
                        <input type="text" size="10" name="minTileWidth" value="<?php ftg_p($gallery, "minTileWidth", $minTileWidth)  ?>" />px
                    </div>
                </td>
                <td></td>
            </tr>
            <tr>
                <td><strong><?php _e('Size of the grid', 'FinalTiles-gallery'); ?>:</strong></td>
                <td>
                    <div class="scrollbox js-scrollbox disk" data-step="1" data-max="100" data-min="5">
                        <div class="hitbox"></div>
                        <div class="scale" style="width: 50%"></div>
                    </div> 
                    <span><?php ftg_p($gallery, "gridCellSize", 25) ?></span> px
                    <input type="hidden" value="<?php ftg_p($gallery, "gridCellSize", $gridCellSize) ?>" name="gridCellSize" />
                </td>
                <td><?php _e('Tiles are snapped to a virtual grid, the higher this value the higher the chance to get aligned tiles.', 'FinalTiles-gallery'); ?></td>
            </tr>
            <tr class="alternate">
                <td><strong><?php _e('Filters', 'FinalTiles-gallery'); ?>:</strong></td>
                <td class="filters">
                    <div class="text dark">
                        
                    </div>
                    <a href="#" class="add button firm">+ Add filter</a>
                    <input type="hidden" name="filters" value="<?php ftg_p($gallery, "filters")  ?>" />
                </td>
                <td></td>
            </tr>
            <tr>
                <td><strong><?php _e('Select the lightbox manager', 'FinalTiles-gallery'); ?>:</strong></td>
                <td>
                    <select class="select js-select" name="lightbox">
                        <option value="">None</option>
                        <option <?php ftg_sel($gallery, "lightbox", "magnific")  ?> value="magnific">Magnific popup</option>
                        <option <?php ftg_sel($gallery, "lightbox", "colorbox")  ?> value="colorbox">ColorBox</option>
                        <option <?php ftg_sel($gallery, "lightbox", "prettyphoto")  ?> value="prettyphoto">Pretty Photo</option>
                        <option <?php ftg_sel($gallery, "lightbox", "fancybox")  ?> value="fancybox">FancyBox</option>
                        <option <?php ftg_sel($gallery, "lightbox", "swipebox")  ?> value="swipebox">SwipeBox</option>
						<option <?php ftg_sel($gallery, "lightbox", "lightbox2")  ?> value="lightbox2">LightBox</option>
                    </select></td>
                <td></td>
            </tr>
            <tr class="alternate">
                <td><strong><?php _e('Hover effect', 'FinalTiles-gallery'); ?>:</strong></td>
                <td>
                    <select class="select js-select" name="hoverEffect">
                        <option <?php ftg_sel($gallery, "hoverEffect", "fade")  ?> value="fade">Fade</option>
                        <option <?php ftg_sel($gallery, "hoverEffect", "slide-top")  ?> value="slide-top">Slide from top</option>
                        <option <?php ftg_sel($gallery, "hoverEffect", "slide-bottom")  ?> value="slide-bottom">Slide from bottom</option>
                        <option <?php ftg_sel($gallery, "hoverEffect", "slide-left")  ?> value="slide-left">Slide from left</option>
                        <option <?php ftg_sel($gallery, "hoverEffect", "slide-right")  ?> value="slide-right">Slide from right</option>
                    </select>
                </td>
                <td></td>
            </tr>
            <tr>
                <td><strong><?php _e('Hover effect easing', 'FinalTiles-gallery'); ?>:</strong></td>
                <td>
                    <select class="select js-select" name="hoverEasing">
                    <?php foreach(array('swing', 'easeInQuad', 'easeOutQuad', 'easeInOutQuad', 'easeInCubic', 'easeOutCubic', 'easeInOutCubic', 'easeInQuart', 'easeOutQuart', 'easeInOutQuart', 'easeInQuint', 'easeOutQuint', 'easeInOutQuint', 'easeInSine', 'easeOutSine', 'easeInOutSine', 'easeInExpo', 'easeOutExpo', 'easeInOutExpo', 'easeInCirc', 'easeOutCirc', 'easeInOutCirc', 'easeInElastic', 'easeOutElastic', 'easeInOutElastic', 'easeInBack', 'easeOutBack', 'easeInOutBack', 'easeInBounce', 'easeOutBounce', 'easeInOutBounce') as $easing) : ?>
                        <option <?php ftg_sel($gallery, "hoverEasing", $easing)  ?> value="<?php print $easing ?>"><?php print $easing ?></option>
                    <?php endforeach ?>
                    </select>
                </td>
                <td></td>
            </tr>
            <tr class="alternate">
                <!-- http://make.wordpress.org/core/2012/11/30/new-color-picker-in-wp-3-5/ -->
            	<td><strong><?php _e('Hover color', 'FinalTiles-gallery'); ?>:</strong></td>
                <td><input type="text" size="6" data-default-color="#000000" name="hoverColor" value="<?php ftg_p($gallery, "hoverColor", "#000000")  ?>" class='pickColor' /></td>
                <td></td>
            </tr>
            <tr>
                <td><strong><?php _e('Hover effect duration', 'FinalTiles-gallery'); ?>:</strong></td>
                <td>
                    <div class="scrollbox js-scrollbox disk" data-step="50" data-max="1000" data-min="50">
                        <div class="hitbox"></div>
                        <div class="scale" style="width: 50%"></div>
                    </div> 
                    <span><?php ftg_p($gallery, "hoverEffectDuration", 250) ?></span> ms
                    <input type="hidden" value="<?php ftg_p($gallery, "hoverEffectDuration", 250) ?>" name="hoverEffectDuration" />
                </td>
                <td></td>
            </tr>
            <tr class="alternate">
                <td><strong><?php _e('Hover opacity', 'FinalTiles-gallery'); ?>:</strong></td>
                <td>
                    <div class="scrollbox js-scrollbox disk" data-step="1" data-max="100" data-min="10">
                        <div class="hitbox"></div>
                        <div class="scale" style="width: 50%"></div>
                    </div> 
                    <span><?php ftg_p($gallery, "hoverOpacity", 80) ?></span>%
                    <input type="hidden" value="<?php ftg_p($gallery, "hoverOpacity", 80) ?>" name="hoverOpacity" />
                </td>
                <td></td>
            </tr>
            <tr>
                <td><strong><?php _e('Effect on page scroll', 'FinalTiles-gallery'); ?>:</strong></td>
                <td>
                    <select class="select js-select" name="scrollEffect">
                        <option <?php ftg_sel($gallery, "scrollEffect", "slide")  ?> value="slide">Slide</option>
                        <option <?php ftg_sel($gallery, "scrollEffect", "zoom")  ?> value="zoom">Zoom</option>
                    </select>
                </td>
                <td></td>
            </tr>
            <tr class="alternate">
                <td><strong><?php _e('Shuffle images', 'FinalTiles-gallery'); ?>:</strong></td>
                <td>
                    <div class="commutator off">
                      <div class="is on">On<div class="is off">Off</div></div>
                    </div>
                    <input type="hidden" name="shuffle" value="<?php ftg_p($gallery, "shuffle", 'F') ?>" />
                </td>
                <td><?php _e('Choose "Yes" if you want to shuffle the gallery at each page reload', 'FinalTiles-gallery'); ?></td>
            </tr>
            <tr>
                <td><strong><?php _e('Add Twitter icon', 'FinalTiles-gallery'); ?>:</strong></td>
                <td>
                    <div class="commutator off">
                      <div class="is on">On<div class="is off">Off</div></div>
                    </div>
                    <input type="hidden" name="enableTwitter" value="<?php ftg_p($gallery, "enableTwitter", 'F') ?>" />
                </td>
                <td></td>
            </tr>
            <tr class="alternate">
                <td><strong><?php _e('Add Facebook icon', 'FinalTiles-gallery'); ?>:</strong></td>
                <td>
                    <div class="commutator off">
                      <div class="is on">On<div class="is off">Off</div></div>
                    </div>
                    <input type="hidden" name="enableFacebook" value="<?php ftg_p($gallery, "enableFacebook", 'F') ?>" />
                </td>
                <td></td>
            </tr>
            <tr>
                <td><strong><?php _e('Add Google Plus icon', 'FinalTiles-gallery'); ?>:</strong></td>
                <td>
                    <div class="commutator off">
                      <div class="is on">On<div class="is off">Off</div></div>
                    </div>
                    <input type="hidden" name="enableGplus" value="<?php ftg_p($gallery, "enableGplus", 'F') ?>" />
                </td>
                <td></td>
            </tr>
            <tr class="alternate">
                <td><strong><?php _e('Add Pinterest icon', 'FinalTiles-gallery'); ?>:</strong></td>
                <td>
                    <div class="commutator off">
                      <div class="is on">On<div class="is off">Off</div></div>
                    </div>
                    <input type="hidden" name="enablePinterest" value="<?php ftg_p($gallery, "enablePinterest", 'F') ?>" />
                </td>
                <td></td>
            </tr>            
            <tr>
                <td><strong><?php _e('Border size', 'FinalTiles-gallery'); ?>:</strong></td>
                <td>
                    <div class="scrollbox js-scrollbox disk" data-step="1" data-max="10" data-min="0">
                        <div class="hitbox"></div>
                        <div class="scale" style="width: 50%"></div>
                    </div> 
                    <span><?php ftg_p($gallery, "borderSize", 0) ?></span> px
                    <input type="hidden" value="<?php ftg_p($gallery, "borderSize", 0) ?>" name="borderSize" />
                </td>
                <td></td>
            </tr>
            <tr class="alternate">
                <td><strong><?php _e('Border radius', 'FinalTiles-gallery'); ?>:</strong></td>
                <td>
                    <div class="scrollbox js-scrollbox disk" data-step="1" data-max="100" data-min="0">
                        <div class="hitbox"></div>
                        <div class="scale" style="width: 50%"></div>
                    </div> 
                    <span><?php ftg_p($gallery, "borderRadius", 0) ?></span> px
                    <input type="hidden" value="<?php ftg_p($gallery, "borderRadius", 0) ?>" name="borderRadius" />
                </td>
                <td></td>
            </tr>
            <tr>
                <!-- http://make.wordpress.org/core/2012/11/30/new-color-picker-in-wp-3-5/ -->
                <td><strong><?php _e('Border color', 'FinalTiles-gallery'); ?>:</strong></td>
                <td><input type="text" size="6" data-default-color="#fff" name="borderColor" value="<?php ftg_p($gallery, "borderColor", "#cccccc")  ?>" class='pickColor' /></td>
                <td></td>
            </tr>
            <tr class="alternate">
                <!-- http://make.wordpress.org/core/2012/11/30/new-color-picker-in-wp-3-5/ -->
                <td><strong><?php _e('Background color', 'FinalTiles-gallery'); ?>:</strong></td>
                <td><input type="text" size="6" data-default-color="#fff" name="backgroundColor" value="<?php ftg_p($gallery, "backgroundColor", "#ffffff")  ?>" class='pickColor' /></td>
                <td>The background color is visible only when a tile is bigger than the image. It may happens under some circumstances when the parameter "Allow image enlargement is set to <em>Off</em></td>
            </tr>
            <tr>
                <td><strong><?php _e('Shadow size', 'FinalTiles-gallery'); ?>:</strong></td>
                <td>
                    <div class="scrollbox js-scrollbox disk" data-step="1" data-max="20" data-min="0">
                        <div class="hitbox"></div>
                        <div class="scale" style="width: 50%"></div>
                    </div> 
                    <span><?php ftg_p($gallery, "shadowSize", 0) ?></span> px
                    <input type="hidden" value="<?php ftg_p($gallery, "shadowSize", 0) ?>" name="shadowSize" />
                </td>
                <td></td>
            </tr>
            <tr class="alternate">
                <!-- http://make.wordpress.org/core/2012/11/30/new-color-picker-in-wp-3-5/ -->
                <td><strong><?php _e('Shadow color', 'FinalTiles-gallery'); ?>:</strong></td>
                <td><input type="text" size="6" data-default-color="#000" name="shadowColor" value="<?php ftg_p($gallery, "shadowColor", "#000000")  ?>" class='pickColor' /></td>
                <td></td>
            </tr>
            <tr>
                <td><strong><?php _e('Allow image enlargement', 'FinalTiles-gallery'); ?>:</strong></td>
                <td>
                    <div class="commutator off">
                      <div class="is on">On<div class="is off">Off</div></div>
                    </div>
                    <input type="hidden" name="enlargeImages" value="<?php ftg_p($gallery, "enlargeImages", 'T') ?>" />
                </td>
                <td></td>
            </tr>
            <tr class="alternate">
                <td><strong><?php _e('Custom CSS', 'FinalTiles-gallery'); ?>:</strong></td>
                <td>
                    <div class="text dark">
                        <textarea name="style"><?php print stripslashes($gallery->style) ?></textarea>
                    </div>
                </td>
                <td class="instructions">
                    <strong>Write just the code without using the &lt;style&gt; tag.</strong>
                    <br />

                    Add here your custom CSS rules. Useful selectors:
                    <ul>
                        <li>
                            <em>.final-tiles-gallery</em> : gallery container;
                        </li>
                        <li>
                            <em>.final-tiles-gallery .tile-inner</em> : tile content;
                        </li>
                        <li>
                            <em>.final-tiles-gallery .tile-inner .item</em> : image of the tile;
                        </li>
                        <li>
                            <em>.final-tiles-gallery .tile-inner .caption</em> : caption of the tile;
                        </li>
                        <li>
                            <em>.final-tiles-gallery .ftg-filters</em> : filters container
                        </li>
                        <li>
                            <em>.final-tiles-gallery .ftg-filters a</em> : filter
                        </li>
                        <li>
                            <em>.final-tiles-gallery .ftg-filters a.selected</em> : selected filter
                        </li>
                    </li>
                </td>
            </tr>
            <tr>
                <td><strong><?php _e('Custom Javascript', 'FinalTiles-gallery'); ?>:</strong></td>
                <td>
                    <div class="text dark">
                        <textarea name="script"><?php print stripslashes($gallery->script) ?></textarea>
                    </div>
                </td>
                <td class="instructions">
                    This script will be called after the gallery initialization. Useful for custom lightboxes.
                    <br />
                    <br />
                    <strong>Write just the code without using the &lt;script&gt;&lt;/script&gt; tags</strong>
                </td>
            </tr>