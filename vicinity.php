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
    <script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/jquery.main.js"></script>
	<!--[if IE]><script type="text/javascript" src="js/ie.js"></script><![endif]-->
	<!--[if lt IE 9]><link rel="stylesheet" href="css/ie.css" media="screen"/><![endif]-->
<body>
<div id="wrapper">
		<?php get_header() ?>
		<div class="w1">
			<div id="bg-vicinity">
				<img src="<?php bloginfo('template_url') ?>/images/bg-wrapper-02.jpg" alt="">
			</div>
			<nav>
				<ul class="breadcrumbs">
<?php the_breadcrumb(); ?>
				</ul>
			</nav>
			<h1 class="page-title">
				<span class="icon"><img src="<?php the_field('hexagon_icon'); ?>" alt=""></span>
				<span class="text"><?php the_field('headline'); ?></span><br>
				<span class="text" style="font:20px 'arimoregular', Helvetica, sans-serif; padding-top: 56px;"><?php the_field('paragraph'); ?></span>
			</h1>
			<section class="vicinity-section" style="min-height:760px;">
                <div class="panel" style="position: absolute; z-index: 1000; margin-top: 10px; margin-left: 10px;">
                    <section>
                        <h1>Builders</h1>
                        <ul class="accordion builders-list">
                            <li class="style-1">
                                <a href="#" class="opener" id="Beazer">Beazer</a>
                                <p>Coming Spring 2015</p>
                            </li>
                            <li class="style-2">
                                <a href="#" class="opener" id="KB Home">KB Home</a>
                                </li>
                            <li class="style-3">
                                <a href="#" class="opener" id="Pardee Homes">Pardee Homes</a>
                                <p>Coming this June</p>

                            </li>
                            <li class="style-4">
                                <a href="#" class="opener" id="Toll Brothers">Toll Brothers</a>
                            </li>
                        </ul>
                    </section>
                    <section>
                        <h1 class="title-1">Community</h1>
                        <ul class="accordion community-list">
                            <!--<li class="style-3">
                                <a href="#" class="opener" id="Schools">Schools</a>
                            </li>-->
                            <li class="style-1">
                                <a href="#" class="opener" id="Parks">Parks</a>
                                  <div class="slide" id="parks_holder" style="width: 202px; display: none;">
                                    <ul class="vicinity">
                                    <li>Aventura Park (Fall 2014)</li>
                                    <li>Capriola Park (Under Construction)</li>
                                    <li>Potenza Park (Under construction)</li>
                                    <li>Solista Park (Completed)</li>
                                    </ul>
                                    </div>
                            </li>
                            <li class="style-2">
                                <a href="#" class="opener" id="Pools">Pools</a>
                            </li>
                            <li class="style-3">
                                <a href="#" class="opener" id="Trails">Trails</a>
                            </li>
                            <li class="style-4">
                                <a href="#" class="opener" id="Nearby Necessities">Nearby Necessities</a>
                            </li>
                        </ul>
                        
                    </section>
                    <ul id='map-ui'></ul>
                </div>
  <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
  <script src='//api.tiles.mapbox.com/mapbox.js/v1.6.0/mapbox.js'></script>
  <link href='//api.tiles.mapbox.com/mapbox.js/v1.6.0/mapbox.css' rel='stylesheet' />
  
  <style>
    body { margin:0; padding:0; }
    #map { position: absolute; z-index: 1; margin-top: 342px; top:0; bottom:0; width:100%; }
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
addLayer(L.mapbox.tileLayer('lucidagency.5tn019k9'), 'KB Home', 2);
addLayer(L.mapbox.tileLayer('lucidagency.8yr5dn29'), 'Pardee Homes', 3);
addLayer(L.mapbox.tileLayer('lucidagency.luxwp14i'), 'Toll Brothers', 4);
addLayer(L.mapbox.tileLayer('lucidagency.n0e2vs4i'), 'Parks', 5);
addLayer(L.mapbox.tileLayer('lucidagency.6jchm2t9'), 'Trails', 6);
addLayer(L.mapbox.tileLayer('lucidagency.x65n4s4i'), 'Pools', 7);
addLayer(L.mapbox.tileLayer('lucidagency.e3mu0udi'), 'Nearby Necessities', 8);

//var markerLayer = L.mapbox.markerLayer()
//    .loadURL('<?php bloginfo('template_url') ?>/markers.geojson')
//    .addTo(map);

function addLayer(layer, name, zIndex) {
    layer
        .setZIndex(zIndex)
        //.addTo(map);

    // Create a simple layer switcher that toggles layers on
    // and off.
    //var item = document.createElement('li');
    var link = document.getElementById(name);

    var markerLayer = L.mapbox.markerLayer().loadURL('<?php bloginfo('template_url') ?>/markers.geojson');

    /*
    var trailMarkers = new Array(Trails, Open Space);
    var parkMarkers = new Array(Aventura Park, Future Park, Capriola Park (Under construction), Potenza Park (Under construction), Solista Park (Completed));*/

    //link.href = '#';
    //link.className = 'active';
    //link.innerHTML = name;

    link.onclick = function(e) {
        e.preventDefault();
        e.stopPropagation();

        if (map.hasLayer(layer)) {
            map.removeLayer(layer);
            this.className = 'opener';

            markerLayer.setFilter(function(f) { 
               return false; 
            })
            .removeLayer(map);

            if(name === "Parks") {
                document.getElementById('parks_holder').style.display="none";
            }
        } else {
            map.addLayer(layer);
            this.className = 'active opener';

            markerLayer.setFilter(function(f) { 
               return f.properties['category'] === name; 
            })
            .addTo(map);

            markerLayer.on('mouseover', function(e) {
                e.layer.openPopup();
            })
            markerLayer.on('mouseout', function(e) {
                e.layer.closePopup();
            })

            if(name === "Parks") {
                document.getElementById('parks_holder').style.display="block";
            }
        }
    };

    //item.appendChild(link);
    //ui.appendChild(item);
}
</script>
<aside id="sidebar-vicinity" class="main-col"><div class="vicinity-box">
<h2>Nearby</h2>
						<?php if ( ! dynamic_sidebar('vicinity-sidebar') ) : ?>
		<?php endif; ?></div>
			</div>				</div>



			</section>
	</blogcontent>
	</div>
	<?php get_footer() ?>
<?php wp_footer() ?></body>
</html>