<?php


/*
|--------------------------------------------------------------------------
| CONTROL, REGISTER & ENQUEUE FRONT END SCRIPTS / STYLES
|--------------------------------------------------------------------------
*/
function easymedia_frontend_stylesheet() {
	        wp_enqueue_style( 'easymedia_styles', EMGDEF_PLUGIN_URL .'css/frontend.css' );
			wp_enqueue_style( 'easymedia_paganimate', EMGDEF_PLUGIN_URL .'includes/css/animate.css' );		
}
add_action( 'wp_print_styles', 'easymedia_frontend_stylesheet' );


function easymedia_frontend_script() {

	wp_enqueue_script( 'fittext' );	
	if ( easy_get_option( 'easymedia_plugin_core' ) != 'none' ) {wp_enqueue_script( 'mootools-core' ); }
	wp_enqueue_script( 'easymedia-core' );	
	wp_enqueue_script( 'easymedia-isotope' );
	wp_enqueue_script( 'easymedia-frontend' );
	wp_enqueue_script( 'easymedia-jpages' );
	wp_enqueue_script( 'easymedia-lazyload' );
		
	if ( EMG_IS_AJAX == '1' ) { wp_enqueue_script( 'easymedia-ajaxfrontend' ); }
		
	( easy_get_option( 'easymedia_disen_autopl' ) == '1' ) ? $audautoplay = 'true' : $audautoplay = 'false';
	( easy_get_option( 'easymedia_disen_audio_loop' ) == '1' ) ? $audioloop = 'true' : $audioloop = 'false';
	( easy_get_option( 'easymedia_disen_autoplv' ) == '1' ) ? $autoplaya = '&autoplay=1' : $autoplaya = '';
	( easy_get_option( 'easymedia_disen_autoplv' ) == '1' ) ? $autoplayb = '?autoplay=1' : $autoplayb = '';
	( easy_get_option( 'easymedia_disen_autoplv' ) == '1' ) ? $autoplayc = '1' : $autoplayc = '0';
	( easy_get_option( 'easymedia_disen_rclick' ) == '1' ) ? $disenrclck = 'true' : $disenrclck = 'false';
	( easy_get_option( 'easymedia_cls_pos' ) == 'Bottom' ) ? $cbpos = '0' : $cbpos = '1';
	( easy_get_option( 'easymedia_sos_pos' ) == 'Bottom' ) ? $sspos = '0' : $sspos = '1';	
	( easy_get_option( 'easymedia_disen_autoplv' ) == '1' ) ? $autoplayd = 'true' : $autoplayd = 'false';	
	( easy_get_option( 'easymedia_disen_showcntr' ) == '1' ) ? $disencntr = 'true' : $disencntr = 'false';	
	
	$eparams = array(
		'nblaswf' => plugins_url( '/swf/NonverBlaster.swf' , __FILE__ ),
  		'audiovol' => easy_get_option( 'easymedia_audio_vol' ),
  		'audioautoplay' => $audautoplay,
  		'audioloop' => $audioloop,
  		'vidautopa' => $autoplaya,
  		'vidautopb' => $autoplayb,  
  		'vidautopc' => $autoplayc, 
  		'vidautopd' => $autoplayd,	
		'drclick' => $disenrclck,	
		'swcntr' => $disencntr,
		'pageffect' => easy_get_option( 'easymedia_pag_effect' ),	
		'ajaxconid' => easy_get_option( 'easymedia_ajax_con_id' ),
		'defstyle' => easy_get_option( 'easymedia_box_style' ),							
  		'mediaswf' => plugins_url( '/addons/mediaelement/flashmediaelement.swf' , __FILE__ ), 
  		'ajaxpth' => plugins_url( 'easyloader.php' , __FILE__ ),  
  		'ovrlayop' => easy_get_option( 'easymedia_overlay_opcty' ) / 100,   
		'closepos' => $cbpos,	
		'sospos' => $sspos,	
		);

	wp_localize_script( 'easymedia-core', 'EasyM', $eparams );		
		
}
add_action( 'wp_enqueue_scripts', 'easymedia_frontend_script' );

function easymedia_frontend_prop()
{   
		$boxstyle = EMGDEF_PLUGIN_URL . 'css/styles/mediabox';
		echo "<link rel=\"alternate stylesheet\" title=\"Dark\" type=\"text/css\" media=\"screen,projection\" href=\"$boxstyle/Dark.css\" />\n";
		echo "<link rel=\"alternate stylesheet\" title=\"Light\" type=\"text/css\" media=\"screen,projection\" href=\"$boxstyle/Light.css\" />\n";
		echo "<link rel=\"alternate stylesheet\" title=\"Transparent\" type=\"text/css\" media=\"screen,projection\" href=\"$boxstyle/Transparent.css\" />\n";
		
ob_start(); ?>

<script src="<?php echo plugins_url('addons/mediaelement/mediaelement-and-player.min.js' , __FILE__) ?>"></script>
<link href="<?php echo plugins_url('addons/mediaelement/mediaelementplayer-skin-yellow.css' , __FILE__) ?>" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo plugins_url('dynamic-style.php' , __FILE__) ?>" type="text/css" media="screen" />   

<!-- Easy Media Gallery PRO START (version <?php echo EASYMEDIA_VERSION; ?>)-->       

 <!--[if lt IE 9]>
<script src="<?php echo plugins_url( 'js/func/html5.js' , __FILE__ );  ?>" type="text/javascript"></script>
<![endif]-->   

 <!--[if lt IE 9]>
<script src="<?php echo plugins_url( 'js/func/html5shiv.js' , __FILE__ );  ?>" type="text/javascript"></script>
<![endif]-->  

<!-- Easy Media Gallery PRO END  -->  
    
	<?php echo ob_get_clean();		
}
add_action( 'wp_head', 'easymedia_frontend_prop' );

?>