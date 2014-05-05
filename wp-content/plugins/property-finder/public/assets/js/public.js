var map = '',
    builder_layers = {
        'Beazer': 'http://23.253.101.150:8888/v2/beazer/{z}/{x}/{y}.png',
        'KB Home': 'http://23.253.101.150:8888/v2/kb/{z}/{x}/{y}.png',
        'KB2014': 'http://166.78.0.133:8888/v2/kb2014/{z}/{x}/{y}.png',
        'Necessities': 'http://23.253.101.150:8888/v2/neccessities/{z}/{x}/{y}.png',
        'Pardee': 'http://23.253.101.150:8888/v2/pardee/{z}/{x}/{y}.png',
        'Pardee2014': 'http://166.78.0.133:8888/v2/pardee2014/{z}/{x}/{y}.png',
        'Parks': 'http://23.253.101.150:8888/v2/parks/{z}/{x}/{y}.png',
        'Pools': 'http://23.253.101.150:8888/v2/pools/{z}/{x}/{y}.png',
        'schools': 'http://23.253.101.150:8888/v2/schools/{z}/{x}/{y}.png',
        'Toll Brothers': 'http://23.253.101.150:8888/v2/toll/{z}/{x}/{y}.png',
        'Toll2014': 'http://166.78.0.133:8888/v2/toll2014/{z}/{x}/{y}.png',
        'Trails': 'http://23.253.101.150:8888/v2/trails/{z}/{x}/{y}.png'
    };
    
(function ( $ ) {
    "use strict";

    $(function () {
        if ($('#searchMap').length) {
            var map = L.map('searchMap', {
                minZoom: 2,
                maxZoom: 6
            });
            var baselayer = L.tileLayer('http://23.253.101.150:8888/v2/base/{z}/{x}/{y}.png').addTo(map);
            map.setView([-77, 22.763671875], 4);
            
            var markerLayer = L.mapbox.markerLayer().loadURL('/wp-content/themes/inspirada/markers.geojson');
            markerLayer.options.sanitizer = function(x) { return x; };
            

            map.touchZoom.disable();
            map.doubleClickZoom.disable();
            map.scrollWheelZoom.disable();
            if (map.tap) map.tap.disable();

            var mapgroup = L.layerGroup().addTo(map);    
            mapgroup.addLayer(L.tileLayer(builder_layers.Parks), 'Parks', 1);
            mapgroup.addLayer(L.tileLayer(builder_layers.Necessities), 'Necessities', 1);
            markerLayer.setFilter(function(f) {
                return f.properties.category === 'Parks';
            }).addTo(map);
            
            var markerLayer = L.mapbox.markerLayer().loadURL('/wp-content/themes/inspirada/markers.geojson');
            markerLayer.options.sanitizer = function(x) { return x; };
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
            

                var markerLayer = L.mapbox.markerLayer().loadURL('/wp-content/themes/inspirada/markers.geojson');
            markerLayer.options.sanitizer = function(x) { return x; };                       
               markerLayer.setFilter(function (f) { 
		   		   return f.properties['title'] === 'Aventura Park' || f.properties['title'] === 'Future Park' || f.properties['title'] === 'Capriola Park (Under construction)' || f.properties['title'] === 'Potenza Park (Under construction)'|| f.properties['title'] === 'Solista Park (Completed)'; 
		        })
	            .addTo(map);
                markerLayer.options.sanitizer = function(x) { return x; };
            
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
                    mapgroup.addLayer(L.tileLayer(builder_layers.Parks), 'Parks', 1);
                    mapgroup.addLayer(L.tileLayer(builder_layers.Necessities), 'Necessities', 1);
                    var markerLayer = L.mapbox.markerLayer().loadURL('/wp-content/themes/inspirada/markers.geojson');
                    markerLayer.options.sanitizer = function(x) { return x; };
                    markerLayer.setFilter(function(f) {
                        return f.properties.category === 'Parks';
                    }).addTo(map);

                    for (var b in response.builders) {
                        
                        if (builder_layers[response.builders[b]]) {
                            mapgroup.addLayer(L.tileLayer(builder_layers[response.builders[b]]), b, 1);
                        }
                        
                        if (response.builders[b] === 'Beazer') {
                            markerLayer.setFilter(function(f) {
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
                        }
                        
 
                        if (response.builders[b] === 'KB Home') {
                            var markerLayer = L.mapbox.markerLayer().loadURL('/wp-content/themes/inspirada/markers.geojson');
                            markerLayer.options.sanitizer = function(x) { return x; };
                                markerLayer.setFilter(function(f) {
                                    return f.properties['title'] === 'KB Future Development' || f.properties['title'] === 'KB Currently Selling' || f.properties['title'] === 'KB Available Summer 2014' || f.properties['title'] === 'KB Available Summer 2014' || f.properties['title'] === 'KB Available Fall 2014' || f.properties['title'] === 'KB Home Model Center'; 
                                }).addTo(map);
                            markerLayer.on('mouseover', function(e) {
                                e.layer.openPopup();
                            });
                            markerLayer.on('mouseout', function(e) {
                                e.layer.closePopup();
                            });
                        }
                        
                        if (response.builders[b] === 'Pardee') {
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
                            });
                        }
                        
                        if (response.builders[b] === 'Toll Brothers') {
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
                        }
                        
                        if (response.builders[b] === 'Necessities') {
                            var markerLayer = L.mapbox.markerLayer().loadURL('/wp-content/themes/inspirada/markers.geojson');
                            markerLayer.options.sanitizer = function(x) { return x; };
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
                        }
                        
                        if (response.builders[b] === 'Trails') {
                            var markerLayer = L.mapbox.markerLayer().loadURL('/wp-content/themes/inspirada/markers.geojson');
            markerLayer.options.sanitizer = function(x) { return x; };
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
                        }
                        
                        if (response.builders[b] === 'Parks') {
                            var markerLayer = L.mapbox.markerLayer().loadURL('/wp-content/themes/inspirada/markers.geojson');
            markerLayer.options.sanitizer = function(x) { return x; };
                           markerLayer.setFilter(function (f) { 
    				   		   return f.properties['title'] === 'Aventura Park' || f.properties['title'] === 'Future Park' || f.properties['title'] === 'Capriola Park (Under construction)' || f.properties['title'] === 'Potenza Park (Under construction)'|| f.properties['title'] === 'Solista Park (Completed)'; 
    				        })
    			            .addTo(map);
                            markerLayer.options.sanitizer = function(x) { return x; };
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
                    async: true,
                    type: 'POST',
                    url: property_finder.plugin_url+'/public/ajax.php',
                    data: str+'&type=info',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            window.location = '/thank-you-homes?interested_models='+response.interested_models+'&firstName='+response.firstName+'&lastName='+response.lastName+'&email='+response.email+'&phone='+response.phone+'&comment='+response.comment;
                            /*
if (response.has_toll) {
                                
                                $.ajax({
                                    async: true,
                                    type: 'POST',
                                    url: property_finder.plugin_url+'/public/ajax.php',
                                    data: str+'&type=toll',
                                    dataType: '',
                                    success: function(response) {
                                    }
                                });
                            }
                        
                            $('#requestInfo .step1').hide();
                            var model_list = '';
                            for (var x = 0; x <= response.interested_models.length - 1; x++) {
                                model_list += '<li><a href="'+response.interested_models[x].url+'" target="_blank">'+response.interested_models[x].builder+': '+response.interested_models[x].model+'</a></li>';
                            }

                            $('#modelList').html(model_list);
                            $('#requestInfo .modal-title .step1_head').hide();
                            $('#requestInfo .modal-title .step2_head').show();

                            $('#requestInfo .step2').show();
*/
                        }
                    }
                });
            }
        });
        
        if ($('#homes_thanks').length) {
            var query = getUrlVars(),
                data = {},
                builders = query['builders'],
                builders = builders.replace(/%20/g, ''),
                builders = builders.replace(/\+/g, ' '),
                builders = builders.split(',');

            if (!builders || $.inArray('Toll Brothers', builders)) {
                data.firstName = query['firstName'];
                data.lastName = query['lastName'];
                data.email = query['email'];
                data.phone = query['phone'];
                data.comment = query['comment'];
                
                data.type = 'toll';
                
                 $.ajax({
                    async: true,
                    type: 'POST',
                    url: property_finder.plugin_url+'/public/ajax.php',
                    data: data,
                    dataType: '',
                    success: function(response) {}
                });
            }
        }

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

function getUrlVars()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}