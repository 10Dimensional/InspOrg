<?php
/*
	Template Name: Search Homes Thank You
*/ 

    $requested_properties = (isset($_GET['interested_models'])) ? $_GET['interested_models'] : array();
    $properties = $wpdb->get_results('SELECT * FROM ap_properties WHERE id IN ('.$requested_properties.')');
    
    $first = $_GET['firstName'];
    $last = $_GET['lastName'];
    $email = $_GET['email'];
    $community = $_GET['community'];
    $phone = $_GET['phone'];
    $comment = $_GET['comment'];
    $builders = ($_GET['builders'] !== 'false') ? explode(',', $_GET['builders']) : false;

    if (in_array('kb home', $builders) || !$builders) {
        generate_xml_email_kb_main($first, $last, $email, $phone, $comment, $community);
    }

    if (in_array('beazer homes', $builders) || !$builders) {
        generate_xml_email_beazer_main($first, $last, $email, $phone, $community);
    } 

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/fancybox.css">
		   <link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/bootstrap.css">
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/all.css">

	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/jcf.css">
	<!--[if IE]><script type="text/javascript" src="js/ie.js"></script><![endif]-->
	   <!--[if lt IE 9]><link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/ie.css" media="screen"/><![endif]-->
	      <script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/modernizr.js"></script>

<!-- Google Code for Search for Homes (Website) Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 974801844;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "ivwtCOTo4QgQtJfp0AM";
var google_conversion_value = 1.000000;
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/974801844/?value=1.000000&amp;label=ivwtCOTo4QgQtJfp0AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript><!-- Facebook Conversion Code for Website Lead -->
<script type="text/javascript">
var fb_param = {};
fb_param.pixel_id = '6013393414653';
fb_param.value = '0.00';
fb_param.currency = 'USD';
(function(){
  var fpw = document.createElement('script');
  fpw.async = true;
  fpw.src = '//connect.facebook.net/en_US/fp.js';
  var ref = document.getElementsByTagName('script')[0];
  ref.parentNode.insertBefore(fpw, ref);
})();
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/offsite_event.php?id=6013393414653&amp;value=0&amp;currency=USD" /></noscript>
	<div id="wrapper">
		<?php wp_head() ?></head>
<body id="homes_thanks"><?php get_header(); ?>
<style>
h1 {
	font: 24px/28px 'roboto_slabbold', 'Times New Roman', Times, serif;
}

p.thank-you {display: block;
margin-left: 35%;
font: 16px 'arimobold', Helvetica, sans-serif;
margin-top: 10px;
clear: both;
float: left;
text-align: center;
width: auto;
color: #ff6c36;
margin-bottom: 30px;} 

.button {
	float: inherit;
	margin-left: 20px;
}

#wrapper {
background: white;
}

</style>
		<div id="main" style="background: white">
			<div class="main-holder">
			   <h1 style="text-align: center; padding-bottom: 30px; padding-top: 30px;">Thank You! Links to your requested information are on their way!</h1>
			   <ul id="modelList">
			        <?php
                        foreach ($properties as $property) {
                            echo '<li><a href="'.$property->url.'" target="_blank">'.$property->builder.': '.$property->model.'</a></li>';
                        }			        
			        ?>
			   </ul>
			   
               <p class="thank-you">We appreciate your interest!</p><a class="button reqInfo" href="/search-for-homes" >CONTINUE</a>
			</div>
<div style="margin: 0 auto; max-width: 1003px; padding-top: 30px; max-height: 200px;"><?php while ( have_posts() ) : the_post(); ?>

<?php the_content(); ?>

			<?php endwhile; // end of the loop. ?>
</div></div>
	
	
    <script type="text/javascript">
    	console.log('start');
    	var data = {};
    	data.first = '<?php echo $first; ?>';
    	data.last = '<?php echo $last; ?>';
    	data.email = '<?php echo $email; ?>';
    	data.comment = '<?php echo $comment; ?>';
    	data.phone = '<?php echo $phone; ?>';
    	data.community = '<?php echo $community; ?>';
    	
    	
    	<?php if (in_array('toll brothers', $builders) || !$builders) { ?>
	    	jQuery.ajax({
	    		type: 'POST',
	    		url: '/process/toll.php',
	    		data: data,
	    		success: function(response) {
	    			console.log(response);
	    		},
	    		error: function(response) {
		    		console.log('fail');
	    		}
	    	});
		<?php } ?>
    </script>
    
    
    <?php 
	
	    	//var_dump(generate_xml_soap_toll_main($email, $comment, $first, $phone, $last, $community));

        
?>
	
	
	
	
	<?php get_footer() ?>
<?php wp_footer() ?></body>
</html>