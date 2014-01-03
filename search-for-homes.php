<?php
                /*
                	Template Name: search-for-homes
                */ 
                
                $price_min = ($_GET['price_min']) ? $_GET['price_min'] : 0;
                $price_max = ($_GET['price_max']) ? $_GET['price_max'] : 999999999;
                $beds = ($_GET['beds']) ? $_GET['beds'] : 0;
                $builder = (!$_GET['builder'] || $_GET['builder'] === 'all') ? false : $_GET['builder'];
                $stories = ($_GET['stories'] === 0) ? false : $_GET['stories'];
                $sq_ft = ($_GET['sq_ft']) ? $_GET['sq_ft'] : 0;
                $garage_bays = ($_GET['garage_bays'] === 0) ? false : $_GET['garage_bays'];
                
                $where_clause = 'WHERE price_min >= '.$price_min.' AND price_max <= '.$price_max.' AND beds_max >= '.$beds.' AND sq_ft >= '.$sq_ft;    
                
                if ($builder) {
                    $where_clause .= ' AND builder = "'.$builder.'"';
                }
                
                if ($stories) {
                    $where_clause .= ' AND stories = '.$stories;
                }
                
                if ($garage_bays) {
                    $where_clause .= ' AND garage_bays_min = '.$garage_bays;
                }
                                
                $properties = $wpdb->get_results("SELECT * FROM ap_properties $where_clause" );
                
                
                ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/bootstrap.css">
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/fancybox.css">
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/all.css">
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/jcf.css">
<?php wp_head() ?></head>
<body>
<div id="wrapper">
    <?php get_header() ?>
    <div class="w1">
		<div id="bg" class="bg-without-mask">
				<img src="<?php the_field('hero_image'); ?>" alt="">
						</div>
		<nav>
			<ul class="breadcrumbs">
                <?php the_breadcrumb(); ?>
			</ul>
		</nav>
		<h1 class="page-title page-title-1">
			<span class="icon"><img src="<?php the_field('hexagon_icon'); ?>" alt=""></span>
			<span class="text"><?php the_field('headline'); ?></span>
		</h1>
	</div>
	<section class="text-section">
		<div class="holder">
				<?php the_field('searchheadliner'); ?>
					</div>
	</section>
	<div class="search-section">
		<div class="holder">
            <?php while ( have_posts() ) : the_post(); ?>

                <?php the_content(); ?>

            <?php endwhile; // end of the loop. ?>
            
            
            <section class="filter-section">
                <div class="panel">
                    <h1>Search by Preferences</h1>
                    <form id="frmPropertySearch" class="filter-form" action="#">
                        <fieldset>
                            <strong class="title">Price Range</strong>
                            <div class="slider-bar range-box">
                                <a class="btn btn-minus" href="#">–</a>
                                <a class="btn btn-plus" href="#">+</a>
                                <div class="range-holder">
                                    <div class="slider-range">
                                        <input class="range" type="hidden" value="true" />
                                        <input class="steps" type="hidden" value="1000" />
										<input class="min" type="hidden" value="190000" /> 
                                        <input class="max" type="hidden" value="500000" />
										<input class="v1" type="hidden" name="price_min" value="195000" /> 
                                        <input class="v2" type="hidden" name="price_max" value="350000" />
                                    </div>
                                    <div class="range-values add">
                                        <strong>$<span class="disp-v1">195,000</span></strong>
                                        <strong class="max">$<span class="disp-v2">650,000</span></strong>
                                    </div>
                                </div>
                            </div>
                            
                            <strong class="title">Bedrooms</strong>
                            <div class="slider-bar range-block">
                                <a class="btn btn-minus" href="#">–</a>
                                <a class="btn btn-plus" href="#">+</a>
                                <div class="range-holder">
                                    <div class="slider-range">
                                        <input class="range" type="hidden" value="max" />
                                        <input class="min" type="hidden" value="0" />
                                        <input class="max" type="hidden" value="6" />
                                        <input class="v1" type="hidden" name="beds" value="2" />
                                    </div>
                                    <div class="range-values">
                                        <strong><span class="disp-v1">2</span>+</strong>
                                    </div>
                                </div>
                            </div>

                            <strong class="title">Square Footage</strong>
                            <div class="slider-bar range-block">
                                <a class="btn btn-minus" href="#">–</a>
                                <a class="btn btn-plus" href="#">+</a>
                                <div class="range-holder">
                                    <div class="slider-range">
                                        <input class="range" type="hidden" value="max" />
                                        <input class="min" type="hidden" value="1500" />
                                        <input class="max" type="hidden" value="5000" />
                                        <input class="v1" name="sq_ft" type="hidden" value="1500" />
                                    </div>
                                    <div class="range-values">
                                        <strong><span class="disp-v1">1500</span>+</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="select-row">
                                <select name="stories">
                                    <option selected="selected" value="0">Stories</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                                <select name="garage_bays">
                                    <option selected="selected" value="0">Garage Bays</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                            
                            <div class="radio-area">
                                <strong class="title">Search By Builder</strong>
                                
                                <div class="rad-holder">
                                    <input id="radio-01" type="radio" name="builder" value="Beazer" />
                                    <label for="radio-01">Beazer</label>
                                </div>
                                <div class="rad-holder">
                                    <input id="radio-02" type="radio" name="builder" value="KB Home" />
                                    <label for="radio-02">KB Home</label>
                                </div>
                                <div class="rad-holder">
                                    <input id="radio-03" type="radio" name="builder" value="Pardee" />
                                    <label for="radio-03">Pardee</label>
                                </div>
                                <div class="rad-holder">
                                    <input id="radio-04" type="radio" name="builder" value="Toll Brothers" />
                                    <label for="radio-04">Toll Brothers</label>
                                </div>
                                <div class="rad-holder">
                                    <input id="radio-00" type="radio" name="builder" value="all" />
                                    <label for="radio-00">All</label>
                                </div>
                                <div class="rad-holder">
                                    
                                </div>
                            </div>

                            <input type="submit" value="FILTER" />
                            <div class="matches-counter">
                                <strong class="number"><?php echo count($properties); ?></strong>matches
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="map-block"><img class="placeholder" alt="image description" src="/wp-content/uploads/2013/12/map-placeholder.png" /></div>
            </section>
            
            <div id="result_shell">
    		    <section class="info-section">
                    <div class="holder">
                        <div class="info-block">
                            <div class="scrollable-area">
                                <h1>Request Information</h1>
                                <p>Not Ready To Choose? No problem. Let us send you more information on your builder(s) of interest. </p>								
<a class="button reqInfo" href="#" data-toggle="modal" data-target="#requestInfo">Click Here</a>                            
                            </div>
                        </div>
                        <div class="table-block">
                            <div class="scrollable-area anyscrollable">
                                <div class="table-holder">
                                    <form id="frmPropertyList">
                                        <table class="info-table">
                                            <thead>
                                                <tr>
                                                    <th><span>Builder</span>
                                                        <ul class="sort-btns">
                                                        	<li><a href="#">increase</a></li>
                                                        	<li><a href="#">decrease</a></li>
                                                        </ul>
                                                    </th>
                                                    <th><span>Series</span>
                                                        <ul class="sort-btns">
                                                        	<li><a href="#">increase</a></li>
                                                        	<li><a href="#">decrease</a></li>
                                                        </ul>
                                                    </th>
                                                    <th><span>Model</span>
                                                        <ul class="sort-btns">
                                                        	<li><a href="#">increase</a></li>
                                                        	<li><a href="#">decrease</a></li>
                                                        </ul>
                                                    </th>
                                                    <th><span>Sq Ft</span>
                                                        <ul class="sort-btns">
                                                        	<li><a href="#">increase</a></li>
                                                        	<li><a href="#">decrease</a></li>
                                                        </ul>
                                                    </th>
                                                    <th><span>Bdrms</span>
                                                        <ul class="sort-btns">
                                                        	<li><a href="#">increase</a></li>
                                                        	<li><a href="#">decrease</a></li>
                                                        </ul>
                                                    </th>
                                                    <th><span>Baths</span>
                                                        <ul class="sort-btns">
                                                        	<li><a href="#">increase</a></li>
                                                        	<li><a href="#">decrease</a></li>
                                                        </ul>
                                                    </th>
                                                    <th><span>Stories</span>
                                                        <ul class="sort-btns">
                                                        	<li><a href="#">increase</a></li>
                                                        	<li><a href="#">decrease</a></li>
                                                        </ul>
                                                    </th>
                                                    <th><span>Garages</span>
                                                        <ul class="sort-btns">
                                                        	<li><a href="#">increase</a></li>
                                                        	<li><a href="#">decrease</a></li>
                                                        </ul>
                                                    </th>
                                                    <th><span>Renderings</span></th>
                                                    <th><span>Info Pack</span></th>
                                                </tr>
                                            </thead>
                                            <tbody id="result_body">
                                                <?php
                                                    foreach ($properties as $property) { 
                                                        $beds = ($property->beds_min === $property->beds_max) ? $property->beds_min : $property->beds_min.' - '.$property->beds_max;
                                                        $baths = ($property->baths_min === $property->baths_max) ? $property->baths_min : $property->baths_min.' - '.$property->baths_max;
                                                        $garage_bays = ($property->garage_bays_min === $property->garage_bays_max) ? $property->garage_bays_min : $property->garage_bays_min.' - '.$property->garage_bays_max;
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $property->builder; ?></td>
                                                            <td><?php echo $property->series; ?></td>
                                                            <td><?php echo $property->model; ?></td>
                                                            <td><?php echo number_format($property->sq_ft); ?></td>
                                                            <td><?php echo $beds; ?></td>
                                                            <td><?php echo $baths; ?></td>
                                                            <td><?php echo $property->stories; ?></td>
                                                            <td><?php echo $garage_bays; ?></td>
                                                            <td><a href="#">Slideshow</a></td>
                                                            <td><input type="checkbox" name="request_info[]" value="<?php echo $property->id; ?>" /></td>
                                                        </tr>
                                                    <?php } ?>                                 
                                                
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="button reqInfo" href="#" data-toggle="modal" data-target="#requestInfo" style="float:right; margin:15px 200px 15px;">Request Information</a>
                    <ul class="companies-list">
                    	<li>
                            <div class="img-holder"><a href="#"><img alt="image description" src="/wp-content/uploads/2013/12/promo-logo-05.png" /></a></div>
                            <strong class="title">Beazer Homes</strong>
                    
                            <dl><dt><strong>Coming Spring 2015</strong></dt><dd></dd><dt><strong>Phone:</strong></dt><dd>(702) 987-0055</dd><dt><strong>Email:</strong></dt><dd><a href="mailto:info@beazer.com">info@beazer.com</a></dd></dl>
                        </li>
                    	<li>
                            <div class="img-holder"><a href="3"><img alt="image description" src="/wp-content/uploads/2013/12/promo-logo-06.png" /></a></div>
                            <strong class="title">KB Home</strong>
                    
                            <dl><dt><strong>Phone:</strong></dt><dd>(702) 266-9900</dd><dt><strong>Email:</strong></dt><dd><a href="mailto:info@kbhome.com">info@kbhome.com</a></dd></dl>
                        </li>
                    	<li>
                            <div class="img-holder"><a href="#"><img alt="image description" src="/wp-content/uploads/2013/12/promo-logo-07.png" /></a></div>
                            <strong class="title">Pardee Homes</strong>
                    
                            <dl><dt><strong>Phone:</strong></dt><dd>(702) 614-1400</dd><dt><strong>Email:</strong></dt><dd><a href="mailto:info@pardeehomes.com">info@pardeehomes.com</a></dd></dl>
                        </li>
                    	<li>
                            <div class="img-holder"><a href="#"><img alt="image description" src="/wp-content/uploads/2013/12/promo-logo-08.png" /></a></div>
                            <strong class="title">Toll Brothers</strong>
                    
                            <dl><dt><strong>Phone:</strong></dt><dd>(702) 243-9800</dd><dt><strong>Email:</strong></dt><dd><a href="mailto:info@tollbrothers.com">info@tollbrothers.com</a></dd></dl>
                        </li>
                    </ul>
                </section>
    		</div>                
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="requestInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
 <h4 class="modal-title" id="myModalLabel"><div class="step1_head">Please send me information about my requested home selections from:</div><div class="step2_head" style="display:none;"><strong>THANK YOU!</strong><br />Links to your requested information<br />are on their way!</div></h4>             </div>
            <div class="modal-body">
                <div class="step1">
                    <form id="frmRequestInfo" role="form">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="builders[]" value="beazer homes"> Beazer Homes
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="builders[]" value="kb home"> KB Home
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="builders[]" value="pardee homes"> Pardee Homes
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="builders[]" value="toll brothers"> Toll Brothers
                            </label>
                        </div>
                        <div class="floatLeft">
                            <div class="form-group">
                                <label for="firstName">First Name</label>
                                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" />
                            </div>
                            <div class="form-group">
                                <label for="lastName">Last Name</label>
                                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name" />
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" />
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" />
                            </div>
                        </div>
                        <div class="floatRight">
                            <div class="form-group">
                                <label for="comment">Comment</label>
                                <textarea class="form-control" id="comment" name="comment" placeholder="Comment"></textarea>
                            </div>
                        </div>
                    </form>
                    <div class="frmSub">
                        <p class="floatLeft threeHundred">Links to the requested information about these fine builders will be sent to your email address.</p>
                        <button id="submitRequestInfo" type="button" class="btn btn-primary">Continue</button>
                    </div>
                </div>
                <div class="step2" style="display:none;">
                    <ul id="modelList"></ul>
                    <div class="frmSub">
                        <p class="floatLeft threeHundred">We appreciate your interest!</p>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Continue</button>
                          </div>	 	
	                    <div class="builder_logos">	 	
                        <a href="http://www.beazer.com" target="_blank" class="beazer_homes"></a>	 	
						<a href="#" target="_blank" class="kb_home"></a>	 	
                       <a href="http://www.pardeehomes.com/" target="_blank" class="pardee_homes"></a>	 	
                        <a href="http://www.tollbrothers.com/NV/Toll_Brothers_at_Inspirada" target="_blank" class="toll_bros"></a>	
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

	<?php get_footer() ?>
<?php wp_footer() ?></body>
</html>