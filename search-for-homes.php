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
                
                $where_clause = 'WHERE price_min >= '.$price_min.' AND price_max <= '.$price_max.' AND beds_min >= '.$beds.' AND sq_ft >= '.$sq_ft;    
                
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
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/fancybox.css">
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/all.css">
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/jcf.css">
	<script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/jquery.main.js"></script>
	<!--[if IE]><script type="text/javascript" src="js/ie.js"></script><![endif]-->
	<!--[if lt IE 9]><link rel="stylesheet" href="css/ie.css" media="screen"/><![endif]-->
<?php wp_head() ?></head>
<body>
<div id="wrapper">
    <?php get_header() ?>
    <div class="w1">
		<div id="bg" class="bg-without-mask">
			<img src="<?php bloginfo('template_url') ?>/images/bg-wrapper-03.jpg" alt="">
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
                                        <input class="min" type="hidden" value="0" />
                                        <input class="max" type="hidden" value="1000000" />
                                        <input class="v1" type="hidden" value="180000" />
                                        <input class="v2" type="hidden" value="650000" />
                                    </div>
                                    <div class="range-values add">
                                        <strong>$<span class="disp-v1">180,000</span></strong>
                                        <strong class="max">$<span class="disp-v2">650,000</span></strong>
                                    </div>
                                </div>
                            </div>
                            
                            <strong class="title">Bedrooms</strong>
                                <input type="text" name="beds" />
                            <div class="slider-bar range-block">
                                <a class="btn btn-minus" href="#">–</a>
                                <a class="btn btn-plus" href="#">+</a>
                                <div class="range-holder">
                                    <div class="slider-range">
                                        <input class="range" type="hidden" value="max" />
                                        <input class="min" type="hidden" value="0" />
                                        <input class="max" type="hidden" value="8" />
                                        <input class="v1" type="hidden" value="2" />
                                    </div>
                                    <div class="range-values">
                                        <strong><span class="disp-v1">2</span>+</strong>
                                    </div>
                                </div>
                            </div>

                            <strong class="title">Square Footage</strong>
                                <input type="text" name="sq_ft" />
                            <div class="slider-bar range-block">
                                <a class="btn btn-minus" href="#">–</a>
                                <a class="btn btn-plus" href="#">+</a>
                                <div class="range-holder">
                                    <div class="slider-range">
                                        <input class="range" type="hidden" value="max" />
                                        <input class="min" type="hidden" value="0" />
                                        <input class="max" type="hidden" value="10000" />
                                        <input class="v1" type="hidden" value="1500" />
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
                                    <option value="3">3</option>
                                </select>
                                <select name="garage_bays">
                                    <option selected="selected" value="0">Garage Bays</option>
                                    <option value="1">1</option>
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
                                <p>At vero eos et accusamus et ius to ud odio as dignissimos du cimus qui et blanditiis prae et sentium voluptatum deleniti at que cor yiy rupti quos dio dolo res et quas molestias en exc en pturi sint occaecati cup iditate nonik provident, simi liq ue sunt in culpa qui offi cia deserunt mo llitia animi, id est laborum et id est laborum et id est laborum et</p>
                            
                               <a class="button" href="#">Request Information</a>
                            
                            </div>
                        </div>
                        <div class="table-block">
                            <div class="scrollable-area anyscrollable">
                                <div class="table-holder">
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
                                                <th><span>Garage Bays</span>
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
                                </div>
                            </div>
                        </div>
                    </div>
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
	<?php get_footer() ?>
<?php wp_footer() ?></body>
</html>