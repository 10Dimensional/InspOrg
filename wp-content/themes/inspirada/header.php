

	<!--<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/bootstrap.css">-->
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/bootstrap.css">
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/fancybox.css">
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/jcf.css">
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/all.css">
	<!--[if lt IE 9]><link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/ie.css" media="screen"/><![endif]-->
	 <!--Shrink header -->
	<script src="<?php bloginfo('template_url') ?>/js/classie.js"></script>
	<script src="<?php bloginfo('template_url') ?>/js/headerShrink.js"></script>
	<!-- end shrink header stuff -->

<script type="text/javascript">

jQuery(document).ready(function() {

	jQuery.fn.cleardefault = function() {
	return this.focus(function() {
		if( this.value == this.defaultValue ) {
			this.value = "";
		}
	}).blur(function() {
		if( !this.value.length ) {
			this.value = this.defaultValue;
		}
	});

	jQuery('#gform_11').submit(function (e) {
		e.preventDefault();
		if(jQuery('#input_11_1').val() === 'Full Name*') {
			e.preventDefault();
			jQuery('#input_11_1').css('border-color', 'red');
		}
	});
};
jQuery(".clearit input[type='text'], .clearit textarea").cleardefault();
$(function(){
    $('#header').data('size','big');
});

});
$(function(){
 var shrinkHeader = 300;
  $(window).scroll(function() {
    var scroll = getCurrentScroll();
      if ( scroll >= shrinkHeader ) {
           $('.header').addClass('shrink');
        }
        else {
            $('.header').removeClass('shrink');
        }
  });
function getCurrentScroll() {
    return window.pageYOffset;
    }
});

</script>

<style>
#gform_wrapper_11 {
	margin: 0;
	max-width: 95%;
	margin-left: 3%;
	margin-top: -15px;
}
#field_11_1 > label.gfield_label {
	width: 0px;
	display:none !important; 
	
}

#field_11_2 > label.gfield_label {
	width: 0px;
	display:none !important; 

}

#field_11_3 > label.gfield_label {
	width: 0px;
	display:none !important; 

}

#input_11_3 > li > label {
	width: 80%;
	color: black;
font-size: 11px;
margin-left: 8px;
}

#input_11_2 > li > label {
	width: 85%;
}

#field_11_2 > label > span.gfield_required {
	display: none;
}

#field_11_1 > label > span.gfield_required {
	display: none;
}

#input_11_1 > li > label {
	width: 85%;
}

input#input_11_2.medium {
	width: 69%;
	margin-left: 27px;
}

input#input_11_1.medium {
	width: 69%;
	margin-left: 27px;
}

input#gform_submit_button_11.button.gform_button {
	width: 69%;
	margin-right: 23% !important;
}

.header {
	height: 100px;
}

.header.shrink {
    height: 40px;
}

li.last-child.hover > a.last-child-a:after {display: none;}
@media only screen 
and (min-device-width : 768px) 
and (max-device-width : 1024px) 
and (orientation : landscape) {
#sign-up-form.modal-content {
	margin-left: 114% !important;
}
}
</style>
<header id="header" class="header-large">
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
<li class="mobile">
					<a data-toggle="modal" data-target="#emailsignup" data-backdrop="static" data-keyboard="false" href="#">
  						Sign up For Email!
					</a>
					</li>
				<li class="desktop" style="margin-top: -14%;
float: right;">
					<a data-toggle="modal" data-target="#emailsignup" data-backdrop="static" data-keyboard="false" href="#">
  						<img src="<?php bloginfo('template_url') ?>/images/signupbutton.png">
					</a>
				</li>	
					<li class="tablet" style="margin-top: -14%;">
					<a data-toggle="modal" data-target="#emailsignup" data-backdrop="static" data-keyboard="false" href="#">
  						<img src="<?php bloginfo('template_url') ?>/images/email-ipad.png">
					</a>
				</li>							
			</ul>
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="emailsignup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  	<div class="modal-dialog" style="padding-top: 0px; margin-top: 0px;">
    	<div class="modal-content" id="sign-up-form" style=" background: none; border-radius: 0px; box-shadow: none; border: none; width: 61%; margin-left: 85%;">
    		<div class="modal-header" style="background: none; padding: 0; height: 0; min-height: 0; border: none;">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="position: absolute; top: 5px; right: 66px; z-index: 9999;">&times;</button>
     		</div>
      		<div class="modal-body" style="background-color: #ffd61c; padding-top: 0px; padding-bottom: 10px; width: 85%;">
	          	<img src="<?php bloginfo('template_url') ?>/images/signupheader.png" style="width: 100%">
	     		<br><br>
	           	<?php gravity_form(11, false, false, false, '', false); ?> 
      		</div>
      	</div>
  	</div>
</div>

</nav>
	</div>
</header>
<meta name="p:domain_verify" content="4da4f9ae5c143fe29aab861ee2cacadf"/>