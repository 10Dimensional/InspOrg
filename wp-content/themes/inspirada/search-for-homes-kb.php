<?php
                /*
                	Template Name: KB Homes
                */ 
                
                $price_min = ($_GET['price_min']) ? $_GET['price_min'] : 0;
                $price_max = ($_GET['price_max']) ? $_GET['price_max'] : 999999999;
                $beds = ($_GET['beds']) ? $_GET['beds'] : 0;
                $builder = (!$_GET['builder'] || $_GET['builder'] === 'all') ? false : $_GET['builder'];
                $stories = ($_GET['stories'] === 0) ? false : $_GET['stories'];
                $sq_ft = ($_GET['sq_ft']) ? $_GET['sq_ft'] : 0;
                $garage_bays = ($_GET['garage_bays'] === 0) ? false : $_GET['garage_bays'];
                
                $where_clause = 'WHERE builder = "KB HOME" AND price_min >= '.$price_min.' AND price_max <= '.$price_max.' AND beds_max >= '.$beds.' AND sq_ft >= '.$sq_ft;    
                
                if ($builder) {
                    $where_clause .= ' AND builder = "'.$builder.'"';
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
	<style>
	    div.scrollable-area-wrapper.noscroll-horizontal.noscroll-vertical, div.scrollable-area.anyscrollable {height:auto !important;}
	</style>
	      <script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/modernizr.js"></script>

<?php wp_head() ?></head>
<body>
<div id="wrapper" style="background: white">

    <?php get_header() ?>
    <div class="w1">
		<div id="bg" class="bg-without-mask">
<?php 
    echo do_shortcode("[metaslider id=836]"); 
?>						</div>
		<nav>
			<ul class="breadcrumbs">
                <?php the_breadcrumb(); ?>
			</ul>
		</nav>
		<h1 class="page-title page-title-1" style="padding:0;">
			<a href="http://www.kbhome.com/new-homes-las-vegas/inspirada" target="_blank"><img src="<?php bloginfo('template_url') ?>/images/kb-for-builders-page.png" class="kb" style=" margin-left: -76px; "></a>
		</h1>
	</div>
	<div class="search-section" style="background:white;">
		<div class="holder">
        
            <?php while ( have_posts() ) : the_post(); ?>

                <?php the_content(); ?>

            <?php endwhile; // end of the loop. ?>

      
		</div>
	<aside id="sidebar-builders" class="main-col">
						<?php if ( ! dynamic_sidebar('right-sidebar') ) : ?>
		<?php endif; ?>
	</aside>
	</div>
	
  <?php if ($properties) { ?>
            <div id="result_shell" style="width: 1003px; margin: 0 auto; margin-top: -100px;">
    		    <section class="info-section">
                    <div class="holder" style="margin-top: 40px;">
                        <div class="table-block">
                            <div class="scrollable-area anyscrollable">
                                <div class="table-holder">
                                    <form id="frmPropertyList">
                                        <table class="info-table info-table-interior">
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
                                                                } ?>
                                                            </td>
                                                            <td><input type="checkbox" name="request_info[]" value="<?php echo $property->id; ?>" /></td>
                                                        </tr>
                                                    <?php } ?>                                 
                                                
                                            </tbody>
                                        </table>
                                    </form>
                    </div>
                    <a class="button-request reqInfo" href="#" data-toggle="modal" data-target="#requestInfo" style="float:right; margin-top: 20px">Request Information</a>
                                </section>
    		</div>
    
    		<?php } ?>    
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