
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
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/bootstrap.css">
<style>
#field_9_1 > label.gfield_label {
	width: 0px;
	
}

#field_9_2 > label.gfield_label {
	width: 0px;
}

#field_9_3 > label.gfield_label {
	width: 0px;
}

#input_9_1 > li > label {
	width: 85%;
	color: black;
font-size: 12px;
margin-left: 8px;
}

#input_9_2 > li > label {
	width: 85%;
}

#field_9_2 > label > span.gfield_required {
	display: none;
}

#field_9_3 > label > span.gfield_required {
	display: none;
}

#input_9_3 > li > label {
	width: 85%;
}

input#input_9_2.medium {
	width: 100%;
}

input#input_9_3.medium {
	width: 100%;
}

input#gform_submit_button_9.button.gform_button {
	width: 100%;
	margin-right: 0 !important;
}

li.last-child.hover > a.last-child-a:after {display: none;}
</style>
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
				<li style="margin-top: -7%;"><a data-toggle="modal" data-target="#emailsignup" href="#">
  <img src="<?php bloginfo('template_url') ?>/images/signupbutton.png"
</a></li>				
			</ul>
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="emailsignup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="padding-top: 0px;
margin-top: 0px;">
    <div class="modal-content" style=" background: none; border-radius: 0px; box-shadow: none; border: none; width: 66%; margin-left: 85%;">
      <div class="modal-body" style="background-color: #ffd61c; padding-top: 0px;">
          <img src="<?php bloginfo('template_url') ?>/images/signupheader.png" style="width: 100%">
      <br><br>
               <?php gravity_form(9, false, false, false, '', false); ?>
          </div>
      </div>
  </div>
</div>

</nav>
	</div>
</header>
<meta name="p:domain_verify" content="4da4f9ae5c143fe29aab861ee2cacadf"/>