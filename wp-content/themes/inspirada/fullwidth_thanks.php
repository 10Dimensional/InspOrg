<?php
                /*
                	Template Name: Full Width Thank You
                */ 
                
                
                print_r($_GET['price_range']);
                $price = explode('to', str_replace(',', '', str_replace('$', '', $_GET['price_range'])));
                $sqft = explode('to', str_replace(',', '', str_replace('sq ft', '', $_GET['sqft'])));
                $property_id = array();
                $price_min = ($_GET['price_range'] === 'below $200,000') ? 0 : $price[0];
                
                $price_max = ($_GET['price_range'] === 'over $500,000') ? 999999999 : (($_GET['price_range'] === 'below $200,000') ? 199999 : $price[1]);
    
                $builder = (!isset($_GET['builder'])) ? false : $_GET['builder'];
                $sq_ft_min = ($_GET['sqft'] === 'over 5,000 sq ft') ? 5000 : $sqft[0];
                $sq_ft_max = ($_GET['sqft'] === 'over 5,000 sq ft') ? 99999999999 : $sqft[1];
                

                $where_clause = 'WHERE ((price_min >= '.$price_min.' AND price_max <= '.$price_max.') OR price_min = 0) AND sq_ft >= '.$sq_ft_min.' AND sq_ft <= '.$sq_ft_max;    
                
                if ($builder) {
                    $where_clause .= " AND builder IN ('".implode("','",$builder).'\')';
                }
                
                                
                $properties = $wpdb->get_results("SELECT * FROM ap_properties $where_clause ORDER BY price_min ASC" );

                ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/fancybox.css">
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/bootstrap.css">
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/all.css">
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/jcf.css">
	<!--[if IE]><script type="text/javascript" src="js/ie.js"></script><![endif]-->
	   <!--[if lt IE 9]><link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/ie.css" media="screen"/><![endif]-->
	      <script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/modernizr.js"></script>
<?php wp_head() ?></head>
<body>
<!-- Facebook Conversion Code for Landing Page Lead -->
<script type="text/javascript">
var fb_param = {};
fb_param.pixel_id = '6013393403253';
fb_param.value = '0.00';
fb_param.currency = 'USD';
(function(){
  var fpw = document.createElement('script');
  fpw.async = true;
  fpw.src = '//connect.facebook.net/en_US/fp.js';
  var ref = document.getElementsByTagName('script')[0];
  ref.parentNode.insertBefore(fpw, ref);
})();
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/offsite_event.php?

id=6013393403253&amp;value=0&amp;currency=USD" /></noscript>

<!-- Google Code for Landing Page Lead Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 974801844;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "6pY1CMTs4QgQtJfp0AM";
var google_conversion_value = 1.000000;
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/974801844/?value=1.000000&amp;label=6pY1CMTs4QgQtJfp0AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

	<div id="wrapper">
		<?php get_header(); ?>
<style>
h1 {
	font: 24px/28px 'roboto_slabbold', 'Times New Roman', Times, serif;
}
#wrapper {
background: white;
}
</style>
		<div id="main" style="background: white">
			<div class="main-holder">
			    <h1>Thank You! Your Results are Below:</h1>
                <p>Below are the homes that match the search criteria you entered. Feel free to review them, and then we hope you'll come in to visit the community at Inspirada. The contact information for the model centers and maps are below.</p>

			    <?php if ($properties) { ?>
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
                        </tr>
                    </thead>
                    <tbody id="result_body">
                        <?php
                            foreach ($properties as $property) {
                                $property_id[] = $property->id;
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
                                </tr>
                            <?php } ?>                                 
                    </tbody>
                </table>
                
                <?php } else { ?>
                    <p>No results match your selection.</p>
                <?php } ?>
                
                <p>Didn't find the perfect match? Below are additional models that you might be interested in.</p>
                <?php $other_properties = $wpdb->get_results("SELECT * FROM ap_properties WHERE id NOT IN ('".implode("','",$property_id)."') ORDER BY price_min ASC"); ?>
                
                <?php if (isset($other_properties) && $other_properties) { ?>
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
                        </tr>
                    </thead>
                    <tbody id="result_body">
                        <?php
                            foreach ($other_properties as $property) { 
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
                                </tr>
                            <?php } ?>                                 
                    </tbody>
                </table>
			<?php } else { ?>
			    <p>No other properties available.</p>
			 <?php } ?>
			
			
			
			
			
			
			
<?php while ( have_posts() ) : the_post(); ?>

<?php the_content(); ?>

			<?php endwhile; // end of the loop. ?>
	</div>
	
	

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
  <div class="modal-dialog" style="margin: 15%;">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <div class="modal-content-parks">
      <div class="modal-body" style="width: 160%; ">
        <img src="<?php bloginfo('template_url') ?>/images/LightBox_SolistaPark.jpg">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	<!-- Capriola Park Modal -->
<div class="modal fade" id="capriolamodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="margin: 15%;">
    <div class="modal-content-parks">
      <div class="modal-body" style="width: 160%; ">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <img src="<?php bloginfo('template_url') ?>/images/LightBox_CapriolaPark.jpg">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	<!-- Potenza Park Modal -->
<div class="modal fade" id="potenzamodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="margin: 15%;">
    <div class="modal-content-parks">
      <div class="modal-body" style="width: 160%; ">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <img src="<?php bloginfo('template_url') ?>/images/LightBox_PotenzaPark.jpg">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	<!-- Potenza Park Modal -->
<div class="modal fade" id="aventuramodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="margin: 15%;">
    <div class="modal-content-parks">
      <div class="modal-body" style="width: 160%; ">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <img src="<?php bloginfo('template_url') ?>/images/LightBox_AventuraPark.jpg">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	
	
	
	<?php get_footer() ?>
<?php wp_footer() ?></body>
</html>