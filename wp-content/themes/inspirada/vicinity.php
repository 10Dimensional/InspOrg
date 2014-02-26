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
    <link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/bootstrap.css">
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/fancybox.css">
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/all.css">
	<link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/jcf.css">
    <script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/jquery.main.js"></script>
    		      <script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/modernizr.js"></script>
    <!--[if lte IE 8]>
    <link href='//api.tiles.mapbox.com/mapbox.js/v1.4.0/mapbox.ie.css' rel='stylesheet' />
  <![endif]-->
	<!--[if IE]><script type="text/javascript" src="js/ie.js"></script><![endif]-->
	<!--[if lt IE 9]><link rel="stylesheet" href="css/ie.css" media="screen"/><![endif]-->
<body>
<div id="wrapper">
		<?php wp_head() ?><?php get_header() ?>
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
			<section class="vicinity-section" style="min-height:1060px;">
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
                                <a href="#" class="opener" id="Pools">Resident Pools</a>
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
  <link href='//api.tiles.mapbox.com/mapbox.js/v1.6.0/mapbox.css' rel='stylesheet' />
  
  <style>
    body { margin:0; padding:0; }
    #map { position: absolute; z-index: 1; margin-top: 342px; top:0; bottom:0; width: 760px; height: 1060px; }
    @media only screen 
and (min-device-width : 768px) 
and (max-device-width : 1024px) 
and (orientation : portrait) {
    #map { position: absolute; z-index: 1; margin-top: 342px; top:0; bottom:0; width: 515px; height: 1060px; }
}
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
img[src="http://a.tiles.mapbox.com/v3/marker/pin-m+1087bf.png"]{opacity:0 !important;}

.list li {
list-style-type: disc;
}
</style>
<div id='map'></div>
<script>
var map = L.map('map', {
	minZoom: 2,
	maxZoom: 6
	});
var ui = document.getElementById('map-ui');
var baselayer = L.tileLayer('http://166.78.0.133:8888/v2/base/{z}/{x}/{y}.png').addTo(map);
map.setView([-77, 22.763671875], 4);
map.touchZoom.disable();
map.doubleClickZoom.disable();
map.scrollWheelZoom.disable();
// disable tap handler, if present.
if (map.tap) map.tap.disable();
addLayer(L.tileLayer('http://166.78.0.133:8888/v2/beazer/{z}/{x}/{y}.png'), 'Beazer', 1);
addLayer(L.tileLayer('http://166.78.0.133:8888/v2/kb/{z}/{x}/{y}.png'), 'KB Home', 2);
addLayer(L.tileLayer('http://166.78.0.133:8888/v2/pardee/{z}/{x}/{y}.png'), 'Pardee Homes', 3);
addLayer(L.tileLayer('http://166.78.0.133:8888/v2/toll/{z}/{x}/{y}.png'), 'Toll Brothers', 4);
addLayer(L.tileLayer('http://166.78.0.133:8888/v2/parks/{z}/{x}/{y}.png'), 'Parks', 5);
addLayer(L.tileLayer('http://166.78.0.133:8888/v2/trails/{z}/{x}/{y}.png'), 'Trails', 6);
addLayer(L.tileLayer('http://166.78.0.133:8888/v2/pools/{z}/{x}/{y}.png'), 'Pools', 7);
addLayer(L.tileLayer('http://166.78.0.133:8888/v2/neccessities/{z}/{x}/{y}.png'), 'Nearby Necessities', 8);
var steetlayer = L.tileLayer('http://166.78.0.133:8888/v2/streets/{z}/{x}/{y}.png',10).addTo(map);
 var markerLayer = L.mapbox.markerLayer().loadURL('/wp-content/themes/inspirada/markers.geojson');
            markerLayer.options.sanitizer = function(x) { return x; };

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

    /*
    var trailMarkers = new Array(Trails, Open Space);
    var parkMarkers = new Array(Aventura Park, Future Park, Capriola Park (Under construction), Potenza Park (Under construction), Solista Park (Completed));*/

    //link.href = '#';
    //link.className = 'active';
    //link.innerHTML = name;

    link.onclick = function(e) {
        event.preventDefault ? e.preventDefault() : event.returnValue = false;
        if (event.preventDefault) e.stopPropagation();

        if (map.hasLayer(layer)) {
            map.removeLayer(layer);
            this.className = 'opener';

            if(name === "Parks") {
                document.getElementById('parks_holder').style.display="none";

                var allElements = document.getElementsByClassName('leaflet-marker-icon');
                for (var i = 0; i < allElements.length; i++)
                {
                    if (allElements[i].getAttribute('src') == 'http://a.tiles.mapbox.com/v3/marker/pin-l+1087bf.png')
                    {
                        allElements[i].setAttribute('class', 'hide-marker');
                    }
                }
            }
        } else {
            map.addLayer(layer);
            this.className = 'active opener';

            switch(name) {
            	case('KB Home'):
    			 var markerLayer = L.mapbox.markerLayer().loadURL('/wp-content/themes/inspirada/markers.geojson');
          		  markerLayer.options.sanitizer = function(x) { return x; };
            	 markerLayer.setFilter(function(f) {
                            return f.properties['title'] === 'KB Future Development' || f.properties['title'] === 'KB Currently Selling' || f.properties['title'] === 'KB Available Summer 2014' || f.properties['title'] === 'KB Available Summer 2014' || f.properties['title'] === 'KB Available Fall 2014' || f.properties['title'] === 'KB Home Model Center'; 
                        })
                    .addTo(map);
                    markerLayer.on('mouseover', function(e) {
                        e.layer.openPopup();
                    });
                    markerLayer.on('mouseout', function(e) {
                        e.layer.closePopup();
                    });
            		break;
            	case('Beazer'):
                var markerLayer = L.mapbox.markerLayer().loadURL('/wp-content/themes/inspirada/markers.geojson');
            markerLayer.options.sanitizer = function(x) { return x; };
             markerLayer.setFilter(function(f) {
                            return f.properties['title'] === 'Beazer Available 2015'; 
                        })
                    .addTo(map);
                    markerLayer.on('mouseover', function(e) {
                        e.layer.openPopup();
                    });
                    markerLayer.on('mouseout', function(e) {
                        e.layer.closePopup();
                    });
            		break;
                case('Pardee Homes'):
                        var markerLayer = L.mapbox.markerLayer().loadURL('/wp-content/themes/inspirada/markers.geojson');
            markerLayer.options.sanitizer = function(x) { return x; };
             markerLayer.setFilter(function(f) {
                            return f.properties['title'] === 'Pardee Future Development' || f.properties['title'] === 'Pardee Available June 2014' || f.properties['title'] === 'Pardee Available June 2014'; 
                        })
                    .addTo(map);
                    markerLayer.on('mouseover', function(e) {
                        e.layer.openPopup();
                    })
                    markerLayer.on('mouseout', function(e) {
                        e.layer.closePopup();
                    })
                    break;
                case('Toll Brothers'):
                       var markerLayer = L.mapbox.markerLayer().loadURL('/wp-content/themes/inspirada/markers.geojson');
            markerLayer.options.sanitizer = function(x) { return x; };
             markerLayer.setFilter(function(f) {
                            return f.properties['title'] === 'Toll Brothers Future Development' || f.properties['title'] === 'Toll Brothers Available 2015' || f.properties['title'] === 'Toll Brothers Available Fall 2014' || f.properties['title'] === 'Toll Brothers Model Center' || f.properties['title'] === 'Toll Brothers Available Summer 2014' || f.properties['title'] === 'Toll Brothers Currently Selling'; 
                        })
                    .addTo(map);
                    markerLayer.on('mouseover', function(e) {
                        e.layer.openPopup();
                    });
                    markerLayer.on('mouseout', function(e) {
                        e.layer.closePopup();
                    });
                    break;
                case('Nearby Necessities'):
                      var markerLayer = L.mapbox.markerLayer().loadURL('/wp-content/themes/inspirada/markers.geojson');
             markerLayer.setFilter(function(f) {
                            return f.properties['title'] === 'Necessities'; 
                        })
                    .addTo(map);
                    markerLayer.on('mouseover', function(e) {
                        e.layer.openPopup();
                    });
                    markerLayer.on('mouseout', function(e) {
                        e.layer.closePopup();
                    });
                    break;
                case('Trails'):
                        var markerLayer = L.mapbox.markerLayer().loadURL('/wp-content/themes/inspirada/markers.geojson');
             markerLayer.setFilter(function(f) {
                            return f.properties['title'] === 'Trails' || f.properties['title'] === 'Open Space'; 
                        })
                    .addTo(map);
                    markerLayer.options.sanitizer = function(x) { return x; };
                    markerLayer.on('mouseover', function(e) {
                        e.layer.openPopup();
                    });
                    markerLayer.on('mouseout', function(e) {
                        e.layer.closePopup();
                    });
                    break;
            	case('Parks'):
            		     var markerLayer = L.mapbox.markerLayer().loadURL('/wp-content/themes/inspirada/markers.geojson');
            markerLayer.options.sanitizer = function(x) { return x; };
             markerLayer.setFilter(function(f) {
				   		   return f.properties['title'] === 'Aventura Park' || f.properties['title'] === 'Future Park' || f.properties['title'] === 'Capriola Park (Under construction)' || f.properties['title'] === 'Potenza Park (Under construction)'|| f.properties['title'] === 'Solista Park (Completed)'; 
				        })
			            .addTo(map);
                        /*markerLayer.on('mouseover', function(e) {
                            e.layer.openPopup();
                        })
                        markerLayer.on('mouseout', function(e) {
                            e.layer.closePopup();
                        })*/
            		break;
            }

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

</aside>

			</section>
	</blogcontent>
	<!-- Solista Park Modal -->
<div class="modal fade" id="solistamodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <div class="modal-content-parks">
      <div class="modal-body">
        <img src="<?php bloginfo('template_url') ?>/images/LightBox_SolistaPark.jpg">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	<!-- Capriola Park Modal -->
<div class="modal fade" id="capriolamodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <div class="modal-content-parks">
      <div class="modal-body">
        <img src="<?php bloginfo('template_url') ?>/images/LightBox_CapriolaPark.jpg">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	<!-- Potenza Park Modal -->
<div class="modal fade" id="potenzamodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <div class="modal-content-parks">
      <div class="modal-body">
        <img src="<?php bloginfo('template_url') ?>/images/LightBox_PotenzaPark.jpg">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	<!-- Potenza Park Modal -->
<div class="modal fade" id="aventuramodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <div class="modal-content-parks">
      <div class="modal-body">
        <img src="<?php bloginfo('template_url') ?>/images/LightBox_AventuraPark.jpg">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	</div>
</div>
	<?php get_footer() ?>
<?php wp_footer() ?></body>
</html>