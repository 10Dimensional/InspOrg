<script type="text/javascript">
<!--
if (screen.width <= 699) {
document.location = "/mobile/index.html";
}
//-->
</script>
<<<<<<< HEAD
<!-- Google Code for Remarketing Tag -->
<!--
Remarketing tags may not be associated with personally identifiable information or placed on pages related to sensitive categories. See more information and instructions on how to setup the tag on: http://google.com/ads/remarketingsetup
-->
<script type='text/javascript'>
/* <![CDATA[ */
var google_conversion_id = 974801844;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type='text/javascript' src='//www.googleadservices.com/pagead/conversion.js'>
</script>
<noscript>
<div style='display:inline;'>
<img height='1' width='1' style='border-style:none;' alt='' src='//googleads.g.doubleclick.net/pagead/viewthroughconversion/974801844/?value=0&amp;guid=ON&amp;script=0'/>
</div>
</noscript>

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
=======
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
>>>>>>> 088d4269edf3a53d6f5d6991504e4dfc8fad1fe8
<meta name="p:domain_verify" content="4da4f9ae5c143fe29aab861ee2cacadf"/>