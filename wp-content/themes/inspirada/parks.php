<?php
                /*
                	Template Name: parks-template
                */ 
                
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
	<script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/jquery-1.8.3.min.js"></script>
	      <script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/modernizr.js"></script>
<style>
.modal-dialog {
margin: 15%; }
.modal-body {
width: 160%; }
</style>
	<!--[if IE]><script type="text/javascript" src="js/ie.js"></script><![endif]-->
	<!--[if lt IE 9]><link rel="stylesheet" href="css/ie.css" media="screen"/><![endif]-->
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
			<h1 class="page-title page-title-4">
				<span class="icon"><img src="<?php the_field('hexagon_icon'); ?>" alt=""></span>
				<span class="text"><?php the_field('headline'); ?></span>
                <iframe id="parks-video1" width="427" height="300" src="//www.youtube.com/embed/jajkv6yc33U" style="margin-left: 100px; vertical-align: top; margin-top: -5.4%;" frameborder="0" allowfullscreen></iframe>
                <!--<video width="320" height="240" controls="controls" style="margin-left: 100px; vertical-align: top; margin-top: -50px;">
                    <source src="https://www.dropbox.com/s/cp4bqphb66fnzk2/Sequence%201-HD%20Uncompressed%2010-bit%201080i60.mp4?n=300582233" type="video/mp4" />
                </video>-->
			</h1>
		</div>
		<div id="main">
			<div class="main-holder">
				<div id="content" class="main-col">
					<div class="section-box">
						<?php while ( have_posts() ) : the_post(); ?>

<?php the_content(); ?>
			<?php endwhile; // end of the loop. ?>						</div>
					</div>
			<aside id="sidebar" class="main-col">
						<?php if ( ! dynamic_sidebar('right-sidebar') ) : ?>
		<?php endif; ?>
			</aside>
			</div>
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
	</div>
	<?php get_footer() ?>
<?php wp_footer() ?></body>
</html>