<?php
add_action( 'widgets_init', 'Property_Finder_Widget' );


function property_finder_widget() {
	register_widget( 'Property_Finder_Widget' );
}

class Property_Finder_Widget extends WP_Widget {

	function Property_Finder_Widget() {
		$widget_ops = array( 'classname' => 'example', 'description' => __('A widget that displays the Property Finder Search ', 'example') );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'example-widget' );
		
		$this->WP_Widget( 'example-widget', __('Property Finder', 'example'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
	    global $wpdb;
		extract($args);
		
		// Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$theme = $instance['theme'];

		echo $before_widget;

		// Display the widget title 
		if ($title) echo $before_title . $title . $after_title;

		$properties = $wpdb->get_results("SELECT * FROM ap_properties" );
			
        // Display Widget
        switch ($theme) {
            case 'theme1': ?>
                <div class="filter-box">
    				<form type="post" action="/search-for-homes/" class="filter-form">
    					<fieldset>
    						<h2 style="display:none;">Builders</h2>
    						<div class="radio-area" style="display:none;">
    							<div class="rad-holder">
    								<input id="radio-01" name="builder" value="Beazer" type="checkbox" checked>
    								<label for="radio-01">Beazer - Coming Spring 2015</label>
    							</div>
    							<div class="rad-holder">
    								<input id="radio-02" name="builder" value="KB Home" type="checkbox" checked>
    								<label for="radio-02">KB Home</label>
    							</div>
    							<div class="rad-holder">
    								<input id="radio-03" name="builder" value="Pardee" type="checkbox" checked>
    								<label for="radio-03">Pardee - Coming Soon</label>
    							</div>
    							<div class="rad-holder">
    								<input id="radio-04" name="builder" value="Toll Brothers" type="checkbox" checked>
    								<label for="radio-04">Toll Brothers</label>
    							</div>
                                <div class="rad-holder"></div>
    						</div>
    						<div class="sliders-holder">
    							<h2>Find Your Home</h2>
    							<strong class="title">Price Range</strong>
    							<div class="slider-bar range-box">
    								<a href="#" class="btn btn-minus">–</a>
    								<a href="#" class="btn btn-plus">+</a>
    								<div class="range-holder">
    									<div class="slider-range">
    										<input type="hidden" class="range" value="true" />
    										<input type="hidden" class="steps" value="10000" />
    										<input type="hidden" class="min" value="190000" />
    										<input type="hidden" class="max" value="500000" />
    										<input type="hidden" class="v1" name="price_min" value="190000" />
    										<input type="hidden" class="v2" name="price_max"value="500000" />
    									</div>
    									<div class="range-values add">
    										<strong>$<span class="disp-v1">190,000</span></strong>
    										<strong class="max">$<span class="disp-v2">500,000</span></strong>
    									</div>
    								</div>
    							</div>
    							<strong class="title">Bedrooms</strong>
                                <div class="slider-bar range-box">
                                    <a class="btn btn-minus" href="#">–</a>
                                    <a class="btn btn-plus" href="#">+</a>
                                    <div class="range-holder">
                                        <div class="slider-range">
                                            <input class="range" type="hidden" value="max" />
                                            <input class="steps" type="hidden" value="1" />
                                            <input class="min" type="hidden" value="2" />
                                            <input class="max" type="hidden" value="6" />
                                            <input class="v1" type="hidden" name="beds" value="2" />
                                        </div>
                                        <div class="range-values">
                                            <strong><span class="disp-v1">2</span>+</strong>
                                        </div>
                                    </div>
                                </div>
    						</div>
    						<input type="submit" value="FILTER" />
    					</fieldset>
    				</form>
    			</div>
                <?php break;
            case 'theme2': ?>
                <section class="filter-section personality-section">
                    <aside class="filter-col">
                        <h1>First home? Bigger home? Dream Home? You’re Home.</h1>
                        <section class="panel">
                            <h1>Search by Preferences</h1>
                            <form type="post" action="/search-for-homes/" class="filter-form">
                                <fieldset>
                                    <strong class="title">Price Range</strong>
                                    <div class="slider-bar range-box">
                                        <a href="#" class="btn btn-minus">–</a>
                                        <a href="#" class="btn btn-plus">+</a>
                                        <div class="range-holder">
                                            <div class="slider-range ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" aria-disabled="false">
                                                <input type="hidden" class="range" value="true">
                                                <input type="hidden" class="steps" value="10000">
                                                <input type="hidden" class="min" value="190000">
                                                <input type="hidden" class="max" value="500000">
                                                <input type="hidden" class="v1" value="190000">
                                                <input type="hidden" class="v2" value="500000">
                                                <div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 18%; width: 47%;"></div>
                                                <a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 18%;"></a>
                                                <a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 65%;"></a>
                                            </div>
                                            <div class="range-values add">
                                                <strong>$<span class="disp-v1">190,000</span></strong>
                                                <strong class="max">$<span class="disp-v2">500,000</span></strong>
                                            </div>
                                        </div>
                                    </div>
                                    <strong class="title">Bedrooms</strong>
                                    <div class="slider-bar range-box">
                                        <a href="#" class="btn btn-minus">–</a>
                                        <a href="#" class="btn btn-plus">+</a>
                                        <div class="range-holder">
                                            <div class="slider-range">
                                                <input class="range" type="hidden" value="max" />
                                                <input class="steps" type="hidden" value="1" />
                                                <input class="min" type="hidden" value="2" />
                                                <input class="max" type="hidden" value="6" />
                                                <input class="v1" type="hidden" name="beds" value="2" />
                                            </div>
                                            <div class="range-values">
                                                <strong><span class="disp-v1">2</span>+</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <strong class="title">Square Footage</strong>
                                    <div class="slider-bar range-box">
                                        <a href="#" class="btn btn-minus">–</a>
                                        <a href="#" class="btn btn-plus">+</a>
                                        <div class="range-holder">
                                            <div class="slider-range ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" aria-disabled="false">
                                                <input type="hidden" class="range" value="max">
                                                <input class="steps" type="hidden" value="100" />
                                                <input type="hidden" class="min" value="0">
                                                <input type="hidden" class="max" value="5000">
                                                <input type="hidden" class="v1" value="1500">
                                                <a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 15%;"><strong style="position: absolute; left: -30px; top: 20px; min-width: 70px; text-align: center; font-weight: normal;"><span class="disp-v1">1,500</span>+</strong></a>
                                            </div>
                                            
                                            <div class="range-values"></div>
                                        </div>
                                    </div>
                                    <div class="select-row">
                                        <select class="jcf-hidden" name="stories">
                                            <option selected="selected" value="0">Stories</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                        <select class="jcf-hidden" name="garage_bays">
                                            <option selected="selected" value="0">Garage Bays</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                    <div class="radio-area">
                                        <strong class="title">Search By Builder</strong>
                                        <div class="rad-holder">
                                            <input id="radio-01" name="builder" value="Beazer" type="radio">
                                            <label for="radio-01">Beazer</label>
                                        </div>
                                        <div class="rad-holder">
                                            <input id="radio-02" name="builder" value="KB Home" type="radio">
                                            <label for="radio-02">KB Home</label>
                                        </div>
                                        <div class="rad-holder">
                                            <input id="radio-03" name="builder" value="Pardee" type="radio">
                                            <label for="radio-03">Pardee</label>
                                        </div>
                                        <div class="rad-holder">
                                            <input id="radio-04" name="builder" value="Toll Brothers" type="radio">
                                            <label for="radio-04">Toll Brothers</label>
                                        </div>
                                        <div class="rad-holder">
                                            <input id="radio-05" name="builder" value="All" type="radio">
                                            <label for="radio-05">All</label>
                                        </div>
                                    </div>
                                <input type="submit" value="FILTER">
                            </fieldset>
                        </form>
                    </aside>
                </section>

                <?php break;
            default:
                echo 'Please Select a Theme!';
        }
		
		echo $after_widget;
	}

	// Update the widget 
	function update($new_instance, $old_instance) {
		$instance = $old_instance;

		// Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['theme'] = strip_tags($new_instance['theme']);

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => __('Title', 'example'), 'theme' => 'default' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

		<p>
		    <label for="<?php echo $this->get_field_id( 'theme' ); ?>"><?php _e('Theme:', 'example'); ?></label>
		    <select id="<?php echo $this->get_field_id( 'theme' ); ?>" name="<?php echo $this->get_field_name( 'theme' ); ?>" style="width:100%;">
		        <option value="default">Select Theme</option>
		        <option value="theme1" <?php echo ($instance['theme'] === 'theme1') ? 'selected' : ''; ?>>Theme 1</option>
		        <option value="theme2" <?php echo ($instance['theme'] === 'theme2') ? 'selected' : ''; ?>>Theme 2</option>
		    </select>
			
		</p>

	<?php
	}
}

?>