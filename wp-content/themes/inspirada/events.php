<?php
            /*
                	Template Name: events
                	                */ 
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
	<!--[if IE]><script type="text/javascript" src="js/ie.js"></script><![endif]-->
	   <!--[if lt IE 9]><link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/ie.css" media="screen"/><![endif]-->
<?php wp_head() ?></head>
<body>
	      <script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/modernizr.js"></script>
<style>
.events-section .box {
	width: 33.3%;
	height: 260px;
	margin-bottom: 70px;	
}
.posts{ float:left; overflow:hidden; }
	#recent-posts-3 ul li { margin-bottom: 7px; }
	#categories-3 ul li { margin-bottom: 7px; }
</style>
<?php wp_head() ?></head>
<body>
	<div id="wrapper">
		<?php get_header() ?>
		<div class="w1">
			<div id="bg" class="bg-without-mask">
				<img src="<?php bloginfo('template_url') ?>/images/bg-wrapper-07.jpg" alt="">
			</div>
			<nav>
				<ul class="breadcrumbs">
<?php the_breadcrumb(); ?>
				</ul>
			</nav>
			<h1 class="page-title page-title-4">
				<span class="icon"><img src="<?php the_field('hexagon_icon'); ?>" alt=""></span>
				<span class="text"><?php single_cat_title( $prefix = '', $display = true ); ?></span>
			</h1>
		</div>
			<section class="text-section style-red">
			<div class="holder">
				<?php echo category_description(); ?>
			</div>
			</section>
	<div class="events-section">
			<div class="holder">
				<div class="frame">
				<div class="posts" style="width: 75%">
				<?php
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;



    $args=array(
      'post_type' => 'post',
      'post_status' => 'publish',
      'caller_get_posts'=> 1,
      "paged" => $paged
      );

    
    $my_query = new WP_Query($args);
        
    
    
    if( $my_query->have_posts() ) {
      while ($my_query->have_posts()) : $my_query->the_post(); ?>      
					<section class="box">
						<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a>
						<div class="description">
							<div class="text-wrap">
							<em class="date" style="color: #ff6c36;"><?php the_time('F jS, Y') ?></em>
								<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
								<p> <?php the_excerpt(); ?></p>
							</div>
						</div>
					</section>
			<?php
      endwhile;
    }
wp_reset_query(); ?>
				</div>
            			<aside id="sidebar" class="main-col" style="width: 224px;">
						<?php if ( ! dynamic_sidebar('blog-sidebar') ) : ?>
		<?php endif; ?>
			</aside>

            <div class="pagination" style="display:block; clear:both; padding:25px 0 0 50px;; width:100%; box-sizing:border-box;">
    			<div class="right" style="float:left;"><?php previous_posts_link('&laquo; Previous Page' ); ?></div>
                <div class="left" style="float:right;"><?php next_posts_link ('Next Page &raquo;' ); ?></div>
            </div>
            
				</div>
			</div>
				<?php get_footer() ?>
<?php wp_footer() ?></body>
</html>