<?php
                /*
                	Template Name: vicinity
                */ 
                
                ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/fancybox.css">
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/all.css">
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/jcf.css">
	<!--[if IE]><script type="text/javascript" src="js/ie.js"></script><![endif]-->
	<!--[if lt IE 9]><link rel="stylesheet" href="css/ie.css" media="screen"/><![endif]-->
<body>
<div id="wrapper">
		<?php get_header() ?>
		<div class="w1">
			<div id="bg">
				<img src="<?php bloginfo('template_url') ?>/images/bg-wrapper-02.jpg" alt="">
			</div>
			<nav>
				<ul class="breadcrumbs">
<?php the_breadcrumb(); ?>
				</ul>
			</nav>
			<h1 class="page-title">
				<span class="icon"><img src="<?php the_field('hexagon_icon'); ?>" alt=""></span>
				<span class="text"><?php the_field('headline'); ?></span>
			</h1>
			<section class="vicinity-section">
				<div class="panel">
					<section>
					<ul id='map-ui'></ul>
					</section>
				</div>
  <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
  <script src='//api.tiles.mapbox.com/mapbox.js/v1.6.0/mapbox.js'></script>
  <link href='//api.tiles.mapbox.com/mapbox.js/v1.6.0/mapbox.css' rel='stylesheet' />
  
  <style>
    body { margin:0; padding:0; }
    #map { position:relative; top:0; bottom:0; width:100%; }
  </style>
</head>
<body>
<style>
#map-ui {
    top: 75px;
    left: 10px;
    list-style: none;
    margin: 0;
    padding: 0;
    z-index: 100;
}

#map-ui a {
    font: normal 13px/18px 'Helvetica Neue', Helvetica, sans-serif;
    background: #FFF;
    color: #3C4E5A;
    display: block;
    margin: 0;
    padding: 0;
    border: 1px solid #BBB;
    border-bottom-width: 0;
    min-width: 138px;
    padding: 10px;
    text-decoration: none;
}

#map-ui a:hover {
    background: #ECF5FA;
}

#map-ui li:last-child a {
    border-bottom-width: 1px;
    -webkit-border-radius: 0 0 3px 3px;
    border-radius: 0 0 3px 3px;
}

#map-ui li:first-child a {
    -webkit-border-radius: 3px 3px 0 0;
    border-radius: 3px 3px 0 0;
}

#map-ui a.active {
    background: #3887BE;
    border-color: #3887BE;
    border-top-color: #FFF;
    color: #FFF;
}
</style>
<div id='map' style="width: 760px; height: 758px;"></div>
<script>
var map = L.mapbox.map('map', 'lucidagency.srbjra4i');
var ui = document.getElementById('map-ui');

addLayer(L.mapbox.tileLayer('lucidagency.f4h4obt9'), 'Beazer', 1);
addLayer(L.mapbox.tileLayer('lucidagency.5tn019k9'), 'KB', 2);
addLayer(L.mapbox.tileLayer('lucidagency.e3mu0udi'), 'Necessities', 3);
addLayer(L.mapbox.tileLayer('lucidagency.8yr5dn29'), 'Pardee', 4);
addLayer(L.mapbox.tileLayer('lucidagency.n0e2vs4i'), 'Parks', 5);
addLayer(L.mapbox.tileLayer('lucidagency.x65n4s4i'), 'Pools', 6);
addLayer(L.mapbox.tileLayer('lucidagency.88lzyqfr'), 'Schools', 7);
addLayer(L.mapbox.tileLayer('lucidagency.luxwp14i'), 'Toll', 8);
addLayer(L.mapbox.tileLayer('lucidagency.6jchm2t9'), 'Trails', 9);

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

    item.appendChild(link);
    ui.appendChild(item);
}
</script>				</div>
			</section>
	</blogcontent>
	</div>
	<?php get_footer() ?>
<?php wp_footer() ?></body>
</html>