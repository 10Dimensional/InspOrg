	<footer id="footer">
		<div class="footer-holder">
			<section class="column">
	<?php if ( ! dynamic_sidebar('footer-left') ) : ?>
				<?php endif; ?>
		<div id="footermenu">
 <?php wp_nav_menu( array('menu' => 'Footer Menu', 'items_wrap' => 'INSPIRADA 2014. All Rights Reserved.  %3$s', )); ?>
	</div>
										</section>
			<section class="contacts-column">
			<?php if ( ! dynamic_sidebar('footer-right') ) : ?>
		<?php endif; ?></div>
				</section>
	</widget>
	
