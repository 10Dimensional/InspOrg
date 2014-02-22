var map = '',
    ui = '',
    builder_layers = {
        'Beazer': 'http://166.78.0.133:8888/v2/beazer/{z}/{x}/{y}.png',
        'KB HOME': 'http://166.78.0.133:8888/v2/kb/{z}/{x}/{y}.png',
        'Mecessities': 'http://166.78.0.133:8888/v2/neccessities/{z}/{x}/{y}.png',
        'Pardee': 'http://166.78.0.133:8888/v2/pardee/{z}/{x}/{y}.png',
        'Parks': 'http://166.78.0.133:8888/v2/parks/{z}/{x}/{y}.png',
        'Pools': 'http://166.78.0.133:8888/v2/pools/{z}/{x}/{y}.png',
        'schools': 'http://166.78.0.133:8888/v2/schools/{z}/{x}/{y}.png',
        'Toll Brothers': 'http://166.78.0.133:8888/v2/toll/{z}/{x}/{y}.png',
        'Trails': 'http://166.78.0.133:8888/v2/trails/{z}/{x}/{y}.png'
    };
var ui = '';

 (function ( $ ) {
	"use strict";
   
	$(function () {
	    if ($('#searchMap').length) {
    	    map = L.mapbox.map('searchMap');
    	    ui = document.getElementById('map-ui');
    	    var baselayer = L.tileLayer('http://166.78.0.133:8888/v2/base/{z}/{x}/{y}.png').addTo(map);
    	    
    	    map.setView([-77, 22.763671875], 4);
    	    map.dragging.disable();
            map.touchZoom.disable();
            map.doubleClickZoom.disable();
            map.scrollWheelZoom.disable();
            // disable tap handler, if present.
            if (map.tap) map.tap.disable();
    	    
            ui = document.getElementById('map-ui');
/*             map.setZoomRange(2, 4); */
            var mapgroup = L.layerGroup().addTo(map);
            
            console.log(builder_layers);
            for (var b in builder_layers) {
                console.log(b);
                if (builder_layers[b]) {
                    //addLayer(L.tileLayer(builder_layers[b]), b, 1);
                    mapgroup.addLayer(L.tileLayer(builder_layers[b]), b, 1);
                }
   
        	    
    	    }
	    }
	     
	    $('#requestInfo').on('hidden.bs.modal', function (e) {
	        $('#requestInfo .step1').show();
            $('#requestInfo .step2').hide();
            $('#requestInfo .modal-title .step1_head').show();
            $('#requestInfo .modal-title .step2_head').hide();
            $('#frmRequestInfo input[type="checkbox"]').removeAttr('checked');
            $('#submitRequestInfo').removeAttr('disabled').text('Continue');
            $('#frmRequestInfo')[0].reset();
        });
	
	
        $('#frmPropertySearch').submit(function(e) {
            e.preventDefault();

            var str = $(this).serialize();
            $.ajax({
            	type: 'POST',
            	url: property_finder.plugin_url+'/public/ajax.php',
            	data: str,
            	dataType: 'json',
            	success: function(response) {
            	    mapgroup.clearLayers();
            	    for (var b in builder_layers) {
                        
                        if (builder_layers[response.builders[b]]) {
                            console.log('t');
                            addLayer(L.tileLayer(builder_layers[b]), b, 1);
                            //mapgroup.addLayer(L.tileLayer(builder_layers[response.builders[b]]), b, 1);
                        }
                	    
            	    }
            	    
            	    
            	    $('.matches-counter .number').text(response.count);
            	    $('#result_body').html(response.results);
            	    $('.info-table').trigger("update");
            	}
            });
        });
        
        $('#submitRequestInfo').click(function(e) {
            e.preventDefault();
            $('#frmRequestInfo').submit();
        });
        
        $('#frmRequestInfo').submit(function(e) {
            e.preventDefault();           
            var error = false;
            $('#frmRequestInfo input').css('border', '');
            
            $('#frmRequestInfo input').each(function() {
                if ($(this).attr('name') === 'firstName' && !$(this).val()) {
                    $(this).css('border', '#ff0000 solid 1px');
                    error = true;
                }
                
                if ($(this).attr('name') === 'lastName' && !$(this).val()) {
                    $(this).css('border', '#ff0000 solid 1px');
                    error = true;
                }
    
                if (!validateEmail($('#frmRequestInfo input[name="email"]').val()) || !$('#frmRequestInfo input[name="email"]').val()) {
                    $('#frmRequestInfo input[name="email"]').css('border', '#ff0000 solid 1px');
                    error = true;
                }
            });
            
            if (!error) {
                var str = $(this).serialize()+'&'+$('#frmPropertyList').serialize();
                $('#submitRequestInfo').attr('disabled', 'disabled').text('Loading...');
                $.ajax({
                	type: 'POST',
                	url: property_finder.plugin_url+'/public/ajax.php',
                	data: str+'&type=info',
                	dataType: 'json',
                	success: function(response) {
                	    if (response.status === 'success') {
                    	    $('#requestInfo .step1').hide();
                    	    var model_list = '';
                    	    for (var x = 0; x <= response.interested_models.length - 1; x++) {
                    	        console.log(response.interested_models[x]);
                        	    model_list += '<li><a href="'+response.interested_models[x].url+'" target="_blank">'+response.interested_models[x].builder+': '+response.interested_models[x].model+'</a></li>';
                    	    }
                    	    
                    	    $('#modelList').html(model_list);                    	    
                    	    $('#requestInfo .modal-title .step1_head').hide();
                    	    $('#requestInfo .modal-title .step2_head').show();
                    	    
                    	    $('#requestInfo .step2').show();
                	    }
                	}
                });
            }
        });
        
        $('.reqInfo').click(function(e) {
            $('#frmRequestInfo input[type="checkbox"]').removeAttr('checked');
            $('input[name="request_info[]"]:checked').each(function() {
                var builder = $(this).parent().parent().find('td').first().text().toLowerCase();
                $('#frmRequestInfo input[value="'+builder+'"]').filter(function () { 
                    return this.value.toLowerCase();
                }).attr('checked', 'checked');
            });
        });

	});

}(jQuery));

function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function addLayer(layer, name, zIndex) {
    layer
        .setZIndex(zIndex)
 
    // Create a simple layer switcher that toggles layers on
    // and off.
    //var item = document.createElement('li');
    var link = document.getElementById(name);
    console.log(link);
//Prevents the layers from loading until they're clicked on the selector
 
    link.onclick = function(e) {
        event.preventDefault ? e.preventDefault() : event.returnValue = false;
        if (event.preventDefault) e.stopPropagation();
 
//Turn the layers on and off
 
        if (map.hasLayer(layer)) {
            map.removeLayer(layer);
            this.className = 'opener';
 
            if(name === "Parks") {
                document.getElementById('parks_holder').style.display="none";
            }
        } else {
            mapgroup.addLayer(layer);
            this.className = 'active opener';
 
//Load the layers, and the markers based on title attribute (set in geoJSON)
            switch(name) {
            	case('KB Home'):
                    var markerLayer = L.mapbox.markerLayer()
                        .loadURL('/wp-content/themes/inspirada/markers.geojson')
                        .setFilter(function(f) {
                            return f.properties['title'] === 'KB Future Development' || f.properties['title'] === 'KB Currently Selling' || f.properties['title'] === 'KB Available Summer 2014' || f.properties['title'] === 'KB Available Summer 2014' || f.properties['title'] === 'KB Available Fall 2014' || f.properties['title'] === 'KB Home Model Center'; 
                        })
                    .addTo(map);
                    //This is the code to make leaflet popups happen on hover 
                    markerLayer.options.sanitizer = function(x) { return x; };
                    markerLayer.on('mouseover', function(e) {
                        e.layer.openPopup();
                    });
                    markerLayer.on('mouseout', function(e) {
                        e.layer.closePopup();
                    });
            		break;
            	case('Beazer'):
                    var markerLayer = L.mapbox.markerLayer()
                        .loadURL('/wp-content/themes/inspirada//markers.geojson')
                        .setFilter(function(f) {
                            return f.properties['title'] === 'Beazer Available 2015'; 
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
                case('Pardee Homes'):
                    var markerLayer = L.mapbox.markerLayer()
                        .loadURL('/wp-content/themes/inspirada//markers.geojson')
                        .setFilter(function(f) {
                            return f.properties['title'] === 'Pardee Future Development' || f.properties['title'] === 'Pardee Available June 2014' || f.properties['title'] === 'Pardee Available June 2014'; 
                        })
                    .addTo(map);
                    markerLayer.options.sanitizer = function(x) { return x; };
                    markerLayer.on('mouseover', function(e) {
                        e.layer.openPopup();
                    })
                    markerLayer.on('mouseout', function(e) {
                        e.layer.closePopup();
                    })
                    break;
                case('Toll Brothers'):
                    var markerLayer = L.mapbox.markerLayer()
                        .loadURL('/wp-content/themes/inspirada//markers.geojson')
                        .setFilter(function(f) {
                            return f.properties['title'] === 'Toll Brothers Future Development' || f.properties['title'] === 'Toll Brothers Available 2015' || f.properties['title'] === 'Toll Brothers Available Fall 2014' || f.properties['title'] === 'Toll Brothers Model Center' || f.properties['title'] === 'Toll Brothers Available Summer 2014' || f.properties['title'] === 'Toll Brothers Currently Selling'; 
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
                case('Nearby Necessities'):
                    var markerLayer = L.mapbox.markerLayer()
                        .loadURL('/wp-content/themes/inspirada//markers.geojson')
                        .setFilter(function(f) {
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
                    var markerLayer = L.mapbox.markerLayer()
                        .loadURL('/wp-content/themes/inspirada//markers.geojson')
                        .setFilter(function(f) {
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
            		var markerLayer = L.mapbox.markerLayer()
				        .loadURL('/wp-content/themes/inspirada//markers.geojson')
				        .setFilter(function (f) { 
				   		   return f.properties['title'] === 'Aventura Park' || f.properties['title'] === 'Future Park' || f.properties['title'] === 'Capriola Park (Under construction)' || f.properties['title'] === 'Potenza Park (Under construction)'|| f.properties['title'] === 'Solista Park (Completed)'; 
				        })
			            .addTo(map);
			            //This allows modal pop ups in the leaflet API
                        markerLayer.options.sanitizer = function(x) { return x; };
                        /*markerLayer.on('mouseover', function(e) {
                     //This makes sure that you can click on the map layer instead of hover over it
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