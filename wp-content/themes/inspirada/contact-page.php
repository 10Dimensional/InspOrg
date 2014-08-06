<?php
                /*
                	Template Name: contact-page
                */ 
                
                ?>
<!DOCTYPE html>
<html>
<head>
   <link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/bootstrap.css">
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/fancybox.css">
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/all.css">
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/jcf.css">

    <script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/modernizr.js"></script>
       <script type="text/javascript" src="//api.tiles.mapbox.com/mapbox.js/v1.6.0/mapbox.js"></script> 
<!--       	<script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/jquery-1.8.3.min.js"></script>

	[if IE]><script type="text/javascript" src="js/ie.js"></script><![endif]-->
	   <!--[if lt IE 9]><link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/ie.css" media="screen"/><![endif]-->
	</head>
<body>
	<div id="wrapper" style="background: white;">
		      <?php wp_head() ?>
<?php get_header() ?>
		    <script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/modernizr.js"></script>
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
			</h1>
		</div>
		<section class="contacts-section">
			<div class="holder" style="padding-top: 30px;">
			<div class="contact-block">
<?php while ( have_posts() ) : the_post(); ?>

<?php the_content(); ?>

			<?php endwhile; // end of the loop. ?>
<div class="companies-info-block">
<div class="holder" style="margin-bottom: 50px;">
	<?php the_field('contactright'); ?>
	</div>
	</section>
<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
<link href='//api.tiles.mapbox.com/mapbox.js/v1.6.0/mapbox.css' rel='stylesheet' />
  <style>
    body { margin:0; padding:0; }
    #map { position:relative; top:0; bottom:0; background: none; border: none;}
    img[src="http://a.tiles.mapbox.com/v3/marker/pin-m+f86767.png"]{opacity:1 !important;}
    img[src="http://a.tiles.mapbox.com/v3/marker/pin-m+f1f075.png"]{opacity:1 !important;}
    img[src="http://a.tiles.mapbox.com/v3/marker/pin-m+f86767@2x.png"]{opacity:1 !important;}
    img[src="http://a.tiles.mapbox.com/v3/marker/pin-m+f1f075@2x.png"]{opacity:1 !important;}
  </style>
<div id='map' style="height: 1060px; width: 1003px; margin: 0 auto;"></div>
<script>
var map = L.map('map', {
	minZoom: 2,
	maxZoom: 4
	});
var baselayer = L.tileLayer('http://23.253.101.150:8888/v2/newcontact/{z}/{x}/{y}.png').addTo(map);
map.setView([-76, 22.763671875], 4);
map.touchZoom.disable();
map.doubleClickZoom.disable();
map.scrollWheelZoom.disable();
// disable tap handler, if present.
if (map.tap) map.tap.disable();
addLayer(L.tileLayer('http://23.253.101.150:8888/v2/newcontact/{z}/{x}/{y}.png'), 'Models', 1);


function addLayer(layer, name, zIndex) {
    layer
        .setZIndex(zIndex)
        .addTo(map);
    // Create a simple layer switcher that toggles layers on
    // and off.
    var item = document.createElement('li');
    var link = document.createElement('a');

    var markerLayer = L.mapbox.markerLayer().loadURL('http://166.78.0.133/wp-content/themes/inspirada/contact.geojson').addTo(map);
    markerLayer.options.sanitizer = function(x) { return x; };

/*    markerLayer.on('mouseover', function(e) {
        e.layer.openPopup();
    })
    markerLayer.on('mouseout', function(e) {
        e.layer.closePopup();
    }) */

    link.href = '#';
    link.className = 'active';
    link.innerHTML = name;

    link.onclick = function(e) {
        e.preventDefault();
        e.stopPropagation();

        if (map.hasLayer(layer)) {
            map.removeLayer(layer);
            this.className = '';
        } else {
            map.addLayer(layer);
            this.className = 'active';
        }
    };

    //item.appendChild(link);
    //ui.appendChild(item);
}
/*map.markerLayer.on('click', function(e) {
        map.panTo(e.layer.getLatLng());
    });*/
</script>	
		</blogcontent>
		</section>
<!-- Modal -->
<div class="modal fade" id="kbModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top:109px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">To KB Home Model Center</h4>
      </div>
      <div class="modal-body" style="padding: 25px;">
      <p><strong>From Bicentennial</strong><br>Turn Left on Via Firenze,<br>Left on Paladi,<br>Right on Borgaro to KB Home sales office.
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal -->
<div class="modal fade" id="TollModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">To Toll Brothers Model Center</h4>
      </div>
      <div class="modal-body" style="padding: 25px;">
            <p><strong>From Bicentennial</strong><br>Turn North on Via Firenze,<br>Turn Left (West) on Via Festiva,<br>Continue as Via Festiva becomes Mantua Village Ave.<br>Follow Mantua Village,<br>Turn Left (South) on Via Delle Arti Street,<br>Sales Center is on your left.
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal -->
<div class="modal fade" id="PardeeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">To Pardee Model Center</h4>
      </div>
      <div class="modal-body" style="padding: 25px;">
            <p><strong>From St Rose Parkway</strong><br>
Head south on Executive Airport Drive</br>
Continue onto Via Inspirada</br>
Continue onto Bicentennial Pkwy</br>
Right onto Via Inspirada</br>
Left onto Pavilio Drive and follow the signs to Alterra & Solano</br></br>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="BeazerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top:109px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">To Beazer Model Center</h4>
      </div>
      <div class="modal-body" style="padding: 25px;">
      <p><strong>From 1-15 South</strong>
Take I-15 South to the St. Rose Parkway Exit and turn Left going East.<br>
Go 2.5 miles to Executive Airport Drive and turn right going South.<br>
Go 2 miles on Executive Airport Drive and it will transition into Bicentennial Parkway.<br>
Proceed on Bicentennial Parkway for .25 miles and turn right into The Overlook (Visitor Center).<br>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div style="height: 30px; width: 100%; background: white;"></div>
	<?php get_footer() ?>
<?php wp_footer() ?></body>
</html>