<?php
                /*
                	Template Name: Full Width Thank You
                */ 
                
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
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/all.css">
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/jcf.css">
	<!--[if IE]><script type="text/javascript" src="js/ie.js"></script><![endif]-->
	   <!--[if lt IE 9]><link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/ie.css" media="screen"/><![endif]-->
	      <script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/modernizr.js"></script>

<?php wp_head() ?></head>
<body>
	<div id="wrapper">
		<?php get_header(); ?>
		<div class="w1">
			<div id="bg" class="bg-with-mask">
				<img src="<?php the_field('hero_image'); ?>" alt="">
			</div>
			<nav>
				<ul class="breadcrumbs">
<?php the_breadcrumb(); ?>
				</ul>
			</nav>
			<h1 class="page-title page-title-4">
				<span class="icon"><img src="<?php the_field('hexagon_icon'); ?>" alt=""></span>
				<span class="text"><?php the_field('headline'); ?></span>
			</h1>
		</div>
		<section class="text-section">
			<div class="holder">
									<?php the_field('headliner'); ?>
			</div>
		</section>
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
	
	
	
	
	
	
	<?php get_footer() ?>
<?php wp_footer() ?></body>
</html>