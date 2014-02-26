<?php
                /*
                	Template Name: search-for-homes
                */ 
                
                $price_min = ($_GET['price_min']) ? $_GET['price_min'] : 0;
                $price_max = ($_GET['price_max']) ? $_GET['price_max'] : 999999999;
                $beds = ($_GET['beds']) ? $_GET['beds'] : 0;
                $builder = (!$_GET['builder']) ? false : $_GET['builder'];
                $stories = ($_GET['stories'] === 0) ? false : $_GET['stories'];
                $sq_ft = ($_GET['sq_ft']) ? $_GET['sq_ft'] : 0;
                $garage_bays = ($_GET['garage_bays'] === 0) ? false : $_GET['garage_bays'];
                
                $where_clause = 'WHERE ((price_min >= '.$price_min.' AND price_max <= '.$price_max.') OR price_min = 0) AND beds_max >= '.$beds.' AND sq_ft >= '.$sq_ft;    
                
                if ($builder) {
                    $where_clause .= " AND builder IN ('".implode("','",$builder).'\')';
                }
                
                if ($stories) {
                    $where_clause .= ' AND stories = '.$stories;
                }
                
                if ($garage_bays) {
                    $where_clause .= ' AND garage_bays_min = '.$garage_bays;
                }
                                
                $properties = $wpdb->get_results("SELECT * FROM ap_properties $where_clause ORDER BY price_min ASC" );
                
                
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
	<link href='//api.tiles.mapbox.com/mapbox.js/v1.6.0/mapbox.css' rel='stylesheet' />
	      <script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/modernizr.js"></script>
<style>
.list li {
list-style-type: disc;
}
.map-block IMG {
	width: auto !important; 
	}
.modal-dialog {
margin: 15%; }
.modal-body {
width: 160%; }
</style>
<?php wp_head() ?></head>
<body>
<div id="wrapper" style="background: white;">
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
				<?php the_field('headliner'); ?>
					</div>
	</section>
	<div class="search-section">
		<div class="holder" style="max-width: 1003px">
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
                                        <input class="steps" type="hidden" value="10000" />
										<input class="min" type="hidden" value="190000" /> 
                                        <input class="max" type="hidden" value="500000" />
										<input class="v1" type="hidden" name="price_min" value="<?php echo ($_GET['price_min']) ? $_GET['price_min'] : '190000'; ?>" /> 
                                        <input class="v2" type="hidden" name="price_max" value="<?php echo ($_GET['price_max']) ? $_GET['price_max'] : '500000'; ?>" />
                                    </div>
                                    <div class="range-values add">
                                        <strong>$<span class="disp-v1">195,000</span></strong>
                                        <strong class="max">$<span class="disp-v2">650,000</span></strong>
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
                                        <input class="v1" type="hidden" name="beds" value="<?php echo ($_GET['beds']) ? $_GET['beds'] : '2'; ?>" />
                                    </div>
                                    <div class="range-values">
                                        <strong><span class="disp-v1">2</span>+</strong>
                                    </div>
                                </div>
                            </div>

                            <strong class="title">Square Footage</strong>
                            <div class="slider-bar range-box">
                                <a class="btn btn-minus" href="#">–</a>
                                <a class="btn btn-plus" href="#">+</a>
                                <div class="range-holder">
                                    <div class="slider-range">
                                        <input class="range" type="hidden" value="max" />
                                        <input class="steps" type="hidden" value="100" />
                                        <input class="min" type="hidden" value="1500" />
                                        <input class="max" type="hidden" value="5000" />
                                        <input class="v1" name="sq_ft" type="hidden" value="<?php echo ($_GET['sq_ft']) ? $_GET['sq_ft'] : '1500'; ?>" />
                                    </div>
                                    <div class="range-values">
                                        <strong><span class="disp-v1">1500</span>+</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="select-row">
                                <select name="stories">
                                    <option <?php echo (!$_GET['stories']) ? 'selected="selected"' : ''; ?> value="0">Stories</option>
                                    <option value="1" <?php echo ($_GET['stories'] === '1') ? 'selected="selected"' : ''; ?>>1</option>
                                    <option value="2" <?php echo ($_GET['stories'] === '2') ? 'selected="selected"' : ''; ?>>2</option>
                                </select>
                                <select name="garage_bays">
                                    <option <?php echo (!$_GET['garage_bays']) ? 'selected="selected"' : ''; ?> value="0">Garage Bays</option>
                                    <option value="2" <?php echo ($_GET['garage_bays'] === '2') ? 'selected="selected"' : ''; ?>>2</option>
                                    <option value="3" <?php echo ($_GET['garage_bays'] === '3') ? 'selected="selected"' : ''; ?>>3</option>
                                </select>
                            </div>
                            
                            <div class="radio-area">
                                <strong class="title">Search By Builder</strong>
                                
                                <div class="rad-holder">
                                    <input id="radio-01" type="checkbox" name="builder[]" value="Beazer" />
                                    <label for="radio-01">Beazer—Spring 2015</label>
                                </div>
                                <div class="rad-holder">
                                    <input id="radio-02" type="checkbox" name="builder[]" value="KB Home" />
                                    <label for="radio-02">KB Home</label>
                                </div>
                                <div class="rad-holder">
                                    <input id="radio-03" type="checkbox" name="builder[]" value="Pardee" />
                                    <label for="radio-03">Pardee Homes—June 2014</label>
                                </div>
                                <div class="rad-holder">
                                    <input id="radio-04" type="checkbox" name="builder[]" value="Toll Brothers" />
                                    <label for="radio-04">Toll Brothers</label>
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
                    
                    <div id="searchMap" class="map-block"></div>
     
            </section>
            
            <div id="result_shell">
    		    <section class="info-section">
                    <div class="holder">
                        <div class="info-block">
                            <div class="scrollable-area">
                                <h1>Not Ready To Choose?</h1>
                                <p>No problem. Let us send you more information on your builder(s) of interest. </p>                                                                
<a class="button reqInfo" href="#" data-toggle="modal" data-target="#requestInfo">SEND ME INFORMATION</a>                            
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
                                                    <th><span>Floorplans</span>
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
                                                    <th class="hide-mobile"><span>Stories</span>
                                                        <ul class="sort-btns">
                                                                <li><a href="#">increase</a></li>
                                                                <li><a href="#">decrease</a></li>
                                                        </ul>
                                                    </th>
                                                    <th class="hide-mobile"><span>Garages</span>
                                                        <ul class="sort-btns">
                                                                <li><a href="#">increase</a></li>
                                                                <li><a href="#">decrease</a></li>
                                                        </ul>
                                                    </th>
                                                    <th><span>Images</span></th>
                                                    <th><span>Interested?</span></th>
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
                                                            <td class="hide-mobile"><?php echo $property->stories; ?></td>
                                                            <td class="hide-mobile"><?php echo $garage_bays; ?></td>
                                                            <td>
                                                                <?php switch($property->model) {
                                                                    case 'Monet 1576':
                                                                        echo '<a href="#" data-toggle="modal" data-target="#Monet1576">View</a>';
                                                                        break;
                                                                    case 'Monet 1736':
                                                                        echo '<a href="#" data-toggle="modal" data-target="#Monet1736">View</a>';
                                                                        break;
                                                                    case 'Monet 1843':
                                                                        echo '<a href="#" data-toggle="modal" data-target="#Monet1843">View</a>';
                                                                        break;
                                                                    case 'Cordoba':
                                                                        echo '<a href="#" data-toggle="modal" data-target="#Cordoba">View</a>';
                                                                        break;
                                                                    case 'Madeira':
                                                                        echo '<a href="#" data-toggle="modal" data-target="#Madeira">View</a>';
                                                                        break;
                                                                    case 'Santiago':
                                                                        echo '<a href="#" data-toggle="modal" data-target="#Santiago">View</a>';
                                                                        break;
                                                                    case 'Catania':
                                                                        echo '<a href="#" data-toggle="modal" data-target="#Catania">View</a>';
                                                                        break;
                                                                    case 'Messina':
                                                                        echo '<a href="#" data-toggle="modal" data-target="#Messina">View</a>';
                                                                        break;
                                                                    case 'Trapani':
                                                                        echo '<a href="#" data-toggle="modal" data-target="#Trapani">View</a>';
                                                                        break;
                                                                    default:
                                                                        echo '<a href="#" data-toggle="modal" data-target="#Andora">View</a>';
                                                                        break;
                                                                } ?>
                                                            </td>
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
                    <a class="button-request reqInfo" href="#" data-toggle="modal" data-target="#requestInfo" style="float:right; margin:-26px 200px 15px;">Request Information</a>
                    <ul class="companies-list">
                    	<li>
                            <div class="img-holder"><a href="/browse-the-builders/beazer-homes"><img alt="image description" src="/wp-content/uploads/2013/12/promo-logo-05.png" /></a></div>
                    
                            <dl>
                                <dt><strong>Coming Spring 2015</strong></dt>
                                    <dd></dd>
                                <dt><strong>Phone:</strong></dt>
                                    <dd>(702) 837-2100</dd>
                                <dt><strong>Email:</strong></dt>
                                    <dd><a href="mailto:info@beazer.com">info@beazer.com</a></dd>
                                </dl>
                        </li>
                    	<li>
                            <div class="img-holder"><a href="/browse-the-builders/kb-home"><img alt="image description" src="/wp-content/uploads/2013/12/promo-logo-06.png" /></a></div>
                    
                            <dl>
                                <dt><strong>Available Now</strong></dt>
                                    <dd></dd>
                                <dt><strong>Phone:</strong></dt>
                                    <dd>(702) 266-9900</dd>
                                <dt><strong>Email:</strong></dt>
                                    <dd><a href="mailto:info@kbhome.com">info@kbhome.com</a></dd>
                            </dl>
                        </li>
                    	<li>
                            <div class="img-holder"><a href="/browse-the-builders/pardee-homes"><img alt="image description" src="/wp-content/uploads/2013/12/promo-logo-07.png" /></a></div>
                    
                            <dl>
                                <dt><strong>Coming June 2014</strong></dt>
                                    <dd></dd>
                                <dt><strong>Phone:</strong></dt>
                                    <dd>(702) 604-3332</dd>
                                <dt><strong>Email:</strong></dt>
                                    <dd><a href="mailto:info@pardeehomes.com">info@pardeehomes.com</a></dd>
                            </dl>
                        </li>
                    	<li>
                            <div class="img-holder"><a href="/browse-the-builders/toll-brothers"><img alt="image description" src="/wp-content/uploads/2013/12/promo-logo-08.png" /></a></div>
                    
                            <dl>
                                <dt><strong>Available Now</strong></dt>
                                    <dd></dd>
                                <dt><strong>Phone:</strong></dt>
                                    <dd>(702) 243-9800</dd>
                                <dt><strong>Email:</strong></dt>
                                    <dd><a href="mailto:info@tollbrothers.com">info@tollbrothers.com</a></dd>
                            </dl>
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
 <h4 class="modal-title" id="myModalLabel"><div class="step1_head">Please send me information about my requested home selections from:</div><div class="step2_head" style="display:none;"><strong>THANK YOU!</strong><br />Links to your requested information are on their way!</div></h4>             </div>
            <div class="modal-body" style="width: 100%">
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
                                <input type="text" class="form-control" id="firstName" name="firstName" />
                            </div>
                            <div class="form-group">
                                <label for="lastName">Last Name</label>
                                <input type="text" class="form-control" id="lastName" name="lastName" />
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" />
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" />
                            </div>
                        </div>
                        <div class="floatRight">
                            <div class="form-group">
                                <label for="comment">Comment</label>
                                <textarea class="form-control" id="comment" name="comment"></textarea>
                            </div>
                        </div>
                    </form>
                    <div class="frmSub">
                        <p class="floatLeft threeHundred">Links to the requested information about these fine builders will be available immediately,and additional information will be sent to your email address.</p>
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
						<a href="http://www.kbhome.com/new-homes-las-vegas/inspirada" target="_blank" class="kb_home"></a>	 	
                       <a href="http://www.pardeehomes.com/" target="_blank" class="pardee_homes"></a>	 	
                        <a href="http://www.tollbrothers.com/NV/Toll_Brothers_at_Inspirada" target="_blank" class="toll_bros"></a>	
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--Slideshow modals -->
<div class="modal fade slideshow-modal" id="Monet1576" tabindex="-1" role="dialog" aria-labelledby="testModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close slideshow-close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <?php echo do_shortcode("[metaslider id=908]"); ?>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade slideshow-modal" id="Monet1736" tabindex="-1" role="dialog" aria-labelledby="testModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close slideshow-close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <?php echo do_shortcode("[metaslider id=906]"); ?>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade slideshow-modal" id="Monet1843" tabindex="-1" role="dialog" aria-labelledby="testModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close slideshow-close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <?php echo do_shortcode("[metaslider id=903]"); ?>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade slideshow-modal" id="Cordoba" tabindex="-1" role="dialog" aria-labelledby="testModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close slideshow-close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <?php echo do_shortcode("[metaslider id=912]"); ?>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade slideshow-modal" id="Madeira" tabindex="-1" role="dialog" aria-labelledby="testModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close slideshow-close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <?php echo do_shortcode("[metaslider id=914]"); ?>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade slideshow-modal" id="Santiago" tabindex="-1" role="dialog" aria-labelledby="testModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close slideshow-close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <?php echo do_shortcode("[metaslider id=918]"); ?>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade slideshow-modal" id="Catania" tabindex="-1" role="dialog" aria-labelledby="testModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close slideshow-close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <?php echo do_shortcode("[metaslider id=910]"); ?>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade slideshow-modal" id="Messina" tabindex="-1" role="dialog" aria-labelledby="testModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close slideshow-close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <?php echo do_shortcode("[metaslider id=916]"); ?>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade slideshow-modal" id="Trapani" tabindex="-1" role="dialog" aria-labelledby="testModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close slideshow-close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <?php echo do_shortcode("[metaslider id=920]"); ?>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade slideshow-modal" id="Andora" tabindex="-1" role="dialog" aria-labelledby="testModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close slideshow-close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <?php echo do_shortcode("[metaslider id=899]"); ?>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	<!-- Solista Park Modal -->
<div class="modal fade" id="solistamodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <div class="modal-content-parks">
      <div class="modal-body">
        <img src="<?php bloginfo('template_url') ?>/images/LightBox_SolistaPark.jpg">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	<!-- Capriola Park Modal -->
<div class="modal fade" id="capriolamodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content-parks">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <img src="<?php bloginfo('template_url') ?>/images/LightBox_CapriolaPark.jpg">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	<!-- Potenza Park Modal -->
<div class="modal fade" id="potenzamodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content-parks">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <img src="<?php bloginfo('template_url') ?>/images/LightBox_PotenzaPark.jpg">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	<!-- Potenza Park Modal -->
<div class="modal fade" id="aventuramodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content-parks">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <img src="<?php bloginfo('template_url') ?>/images/LightBox_AventuraPark.jpg">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

	<?php get_footer() ?>
<?php wp_footer() ?></body>
</html>