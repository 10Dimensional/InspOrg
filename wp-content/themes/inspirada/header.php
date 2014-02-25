		<header id="header">
			<div class="header-holder">
				<strong class="logo"><a href="/">Inspirada - Live inspired</a></strong>
				<nav class="open-close hide-mobile">
					<a href="#" class="nav-opener opener">Open nav</a>
					<ul id="nav" class="slide">
						<?php if ( has_nav_menu( 'primary-menu', 'inspirada' ) ) { ?>
							<?php wp_nav_menu( array( 'container' => false, 'theme_location' => 'primary-menu', 'link_before' => '<span>', 'link_after' => '</span>', 'fallback_cb' => 'display_home' ) ); ?>
						<?php } else { ?>
					 		<li><span><a href="<?php echo get_option('home'); ?>">Home</a><span></li>
							<?php wp_list_pages('title_li=&depth=4&sort_column=menu_order'); ?>
						<?php	} ?>					
					</ul>
				</nav>
			</div>
			<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
			</header>
		