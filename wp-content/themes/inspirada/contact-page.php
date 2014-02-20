<?php
                /*
                	Template Name: contact-page
                */ 
                
                ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/bootstrap.css">
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/fancybox.css">
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/all.css">
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/jcf.css">
	<!--[if IE]><script type="text/javascript" src="js/ie.js"></script><![endif]-->
	<!--[if lt IE 9]><link rel="stylesheet" href="css/ie.css" media="screen"/><![endif]-->
<?php wp_head() ?></head>
<body>
	<div id="wrapper" style="background: white;">
		<?php get_header() ?>
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
  </style>
<div id='map' style="height: 614px; width: 1003px; margin: 0 auto;"></div>
<script>
var map = L.mapbox.map('map', 'lucidagency.h1f1j2an');
var markerLayer = L.mapbox.markerLayer()
    .loadURL('http://166.78.0.133/wp-content/themes/inspirada/models.geojson')
    .addTo(map);
markerLayer.options.sanitizer = function(x) { return x; };

map.markerLayer.on('ready', function (e) {
    map.markerLayer.eachLayer(function (marker) {
        marker.openPopup();
    });
});

/*map.markerLayer.on('mouseover', function(e) {
    e.layer.openPopup();
})
map.markerLayer.on('mouseout', function(e) {
    e.layer.closePopup();
})*/

function addLayer(layer, name, zIndex) {
    layer
        .setZIndex(zIndex)
        .addTo(map);

    // Create a simple layer switcher that toggles layers on
    // and off.
    var item = document.createElement('li');
    var link = document.createElement('a');

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

function triggerPopUp() {
  map.markerLayer.eachLayer(function (marker) {
      marker.openPopup();
  });
}
map.markerLayer.on('click', function(e) {
        map.panTo(e.layer.getLatLng());
    });
</script>			
		</blogcontent>
		</section>
<!-- Modal -->
<div class="modal fade" id="kbModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">To KB Home Model Center</h4>
      </div>
      <div class="modal-body">
<p>Follow Via Firenze from Volunteer Boulevard to Via Festiva<br>

Turn Left onto Via Festiva<br>

KB Home Model Center is on the Right</p>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal -->
<div class="modal fade" id="tollModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">To Toll Brothers Model Center</h4>
      </div>
      <div class="modal-body">
        <p>Follow Via Firenze from Volunteer Boulevard to Via Festiva<br>

Turn Right onto Via Festiva to Via Delle Arti<br>

Turn Left onto Via Delle Arti<br>

Toll Brothers Model Center is on the Left</p>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>
</div>

<div style="height: 30px; width: 100%; background: white;"></div>
	<?php get_footer() ?>
<?php wp_footer() ?></body>
</html>