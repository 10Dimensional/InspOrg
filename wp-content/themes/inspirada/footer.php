	<footer id="footer">
		<div class="footer-holder">
			<section class="column">
				<h1>LIVE INSPIRED—THE INSPIRADA BLOG</h1>
				<div class="carousel">
					<div class="carousel-holder">
						<div class="mask" style="height: 220px;">
							<div class="slideset">
								<?php 
									$args = array(
										'post_type' 	=> 'post',
										'post_status' 	=> 'publish',
										'category'		=> 1
									);
									$feautured_posts = get_posts($args);
									$count = 0;
									foreach ($feautured_posts as $f_post) { ?>
										<?php setup_postdata($f_post); ?>
										<?php $slideCount = $count % 4; ?>
										<?php $slideClass = $slideCount == 0 ? '' : 'style-'.$slideCount; ?>
										<section class="slide <?php echo $slideClass; ?>">
											<div class="slide-frame">
												<a href="<?php echo get_permalink($f_post->ID); ?>">
													<?php if (has_post_thumbnail( $f_post->ID ) ): ?>
													<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $f_post->ID ), 'single-post-thumbnail' ); ?>
												<?php endif; ?>
													<img class="image" src="<?php echo $image[0]; ?>" alt="" />
												</a>
												<div class="text-holder">
													<em class="date"><?php echo date('m.d.y', strtotime($f_post->post_date)); ?></em>
													<?php $ending = strlen($f_post->post_title) > 40 ? '...' : ''; ?>
													<h1><a href="<?php echo get_permalink($f_post->ID); ?>" style="text-decoration: none;"><?php echo substr($f_post->post_title,0, 40).$ending; ?></a></h1>
													<p><?php echo get_the_excerpt(); ?></p>
													<a href="<?php echo get_permalink($f_post->ID); ?>" style="color: black; text-decoration: none;">MORE >></a>
												</div>
											</div>
										</section>
										<?php $count++; ?>
									<?php } ?>
							</div>
						</div>
						<a class="btn-prev" id="btn-prev" href="#">Previous</a>
						<a class="btn-next" id="btn-next" href="#">Next</a>
					</div>
					<div class="slider-bar">
						<div class="slider">
							<a href="#" class="arrow-left">left</a>
							<a href="#" class="arrow-right">right</a>
						</div>
					</div>
				</div>
	<?php if ( ! dynamic_sidebar('footer-left') ) : ?>
				<?php endif; ?>
		<div id="footermenu">
 <?php wp_nav_menu( array('menu' => 'Footer Menu', 'items_wrap' => '&copy; INSPIRADA 2014. All Rights Reserved.  %3$s', )); ?>
	</div>
										</section>
			<section class="contacts-column">
			<?php if ( ! dynamic_sidebar('footer-right') ) : ?>
		<?php endif; ?></div>
				</section>
	</widget>
	
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->