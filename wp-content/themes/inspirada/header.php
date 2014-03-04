<script type="text/javascript">
<!--
if (screen.width <= 699) {
document.location = "/mobile/index.html";
}
//-->
</script>
		<header id="header">
			<div class="header-holder">
				<strong class="logo"><a href="/">Inspirada - Live inspired</a></strong>
				<nav class="open-close hide-mobile">
					<a href="#" class="nav-opener opener"></a>
					<ul id="nav" class="slide hide-mobile">
						<?php if ( has_nav_menu( 'primary-menu', 'inspirada' ) ) { ?>
							<?php wp_nav_menu( array( 'container' => false, 'theme_location' => 'primary-menu', 'link_before' => '<span>', 'link_after' => '</span>', 'fallback_cb' => 'display_home' ) ); ?>
						<?php } else { ?>
					 		<li><span><a href="<?php echo get_option('home'); ?>">Home</a><span></li>
							<?php wp_list_pages('title_li=&depth=4&sort_column=menu_order'); ?>
						<?php	} ?>					
					</ul>
				</nav>
			</div>
			</header>
<meta name="p:domain_verify" content="4da4f9ae5c143fe29aab861ee2cacadf"/>