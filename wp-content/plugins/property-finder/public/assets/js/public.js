//Test ;)//

var builder_layers = {
        'Beazer': 'http://23.253.101.150:8888/v2/beazer/{z}/{x}/{y}.png',
        'KB HOME': 'http://23.253.101.150:8888/v2/kb/{z}/{x}/{y}.png',
        'Necessities': 'http://23.253.101.150:8888/v2/neccessities/{z}/{x}/{y}.png',
        'Pardee': 'http://23.253.101.150:8888/v2/pardee/{z}/{x}/{y}.png',
        'Parks': 'http://23.253.101.150:8888/v2/parks/{z}/{x}/{y}.png',
        'Pools': 'http://23.253.101.150:8888/v2/pools/{z}/{x}/{y}.png',
        'schools': 'http://23.253.101.150:8888/v2/schools/{z}/{x}/{y}.png',
        'Toll Brothers': 'http://23.253.101.150:8888/v2/toll/{z}/{x}/{y}.png',
        'Trails': 'http://23.253.101.150:8888/v2/trails/{z}/{x}/{y}.png'
    },
    builder_active_layers = {
        'Beazer': 'http://23.253.101.150:8888/v2/beazer/{z}/{x}/{y}.png',
        'KB HOME': 'http://23.253.101.150:8888/v2/kb_current/{z}/{x}/{y}.png',
        'Necessities': 'http://23.253.101.150:8888/v2/neccessities/{z}/{x}/{y}.png',
        'Pardee': 'http://23.253.101.150:8888/v2/pardee_current/{z}/{x}/{y}.png',
        'Parks': 'http://23.253.101.150:8888/v2/parks/{z}/{x}/{y}.png',
        'Pools': 'http://23.253.101.150:8888/v2/pools/{z}/{x}/{y}.png',
        'schools': 'http://23.253.101.150:8888/v2/schools/{z}/{x}/{y}.png',
        'Toll Brothers': 'http://23.253.101.150:8888/v2/toll_current/{z}/{x}/{y}.png',
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

            L.tileLayer('http://23.253.101.150:8888/v2/newstreets/{z}/{x}/{y}.png').addTo(map);
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
                return f.properties.title === 'Aventura Park' || f.properties.title === 'Future Park' || f.properties.title === 'Capriola Park (Under construction)' || f.properties.title === 'Potenza Park (Under construction)'|| f.properties.title === 'Solista Park (Completed)' || f.properties.title === 'Necessities' || f.properties.category === 'Parks';
            }).addTo(map);
            
            markerLayer.options.sanitizer = function(x) { return x; };
        }

        $('.radio-area input[type="checkbox"]').click(function() {
            if ($('.radio-area input[type="checkbox"]:checked').length) {
                $('#future_shell').html('<input id="future" type="checkbox" name="show_future" value="true" /> <label for="future">Show Future Properties</label>');
            } else {
                $('#future_shell').html('');
            }
        });

        $('#requestInfo').on('hidden.bs.modal', function () {
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

                    var loop_key = response.builder_results,
                        markerJson = '/wp-content/themes/inspirada/active-markers-2014.geojson';

                    if ($('#future').is(':checked')) {
                        markerJson = '/wp-content/themes/inspirada/markers.geojson';
                        if ($('#radio-01').is(':checked') || !response.builders) {
                            loop_key.push('Beazer');
                        }

                        if ($('#radio-03').is(':checked') || !response.builders) {
                            loop_key.push('Pardee');
                        }
                    }
                    
                    var array_title = [],
                        markerLayer = L.mapbox.markerLayer().loadURL(markerJson);

                    markerLayer.options.sanitizer = function(x) { return x; };
                    
                    for (var b = 0; b < loop_key.length; b++) {
                        if ($('#future').is(':checked')) {
                            if (builder_layers[loop_key[b]]) {
                                mapgroup.addLayer(L.tileLayer(builder_layers[loop_key[b]]), b, 1);
                            }
                        } else {
                            if (builder_active_layers[loop_key[b]]) {
                                mapgroup.addLayer(L.tileLayer(builder_active_layers[loop_key[b]]), b, 1);
                            }
                        }

                        switch (loop_key[b]) {
                            case 'KB HOME':
                                array_title.push('KB Future Development', 'KB Currently Selling', 'KB Available Summer 2014', 'KB Available Summer 2014', 'KB Available Fall 2014', 'KB Home Model Center');
                                break;
                            case 'Pardee':
                                array_title.push('Pardee Future Development', 'Pardee Available August 2014', 'Pardee Available January 2015');
                                break;
                            case 'Toll Brothers':
                                array_title.push('Toll Brothers Future Development', 'Toll Brothers Available 2015', 'Toll Brothers Available Fall 2014', 'Toll Brothers Model Center', 'Toll Brothers Available Summer 2014', 'Toll Brothers Currently Selling');
                                break;
                            case 'Beazer':
                                array_title.push('Beazer Available 2015');
                                break;
                            case 'Necessities':
                                array_title.push('Necessities');
                                break;
                            case 'Trails':
                                array_title.push('Trails', 'Open Space');
                                break;
                            case 'Parks':
                                array_title.push('Aventura Park', 'Future Park', 'Capriola Park (Under construction)', 'Potenza Park (Under construction)', 'Solista Park (Completed)');
                                break;
                        }
                    }

                    markerLayer.setFilter(function (f) {
                        return ($.inArray(f.properties.title, array_title) > -1) ? true : false;
                    });

                    mapgroup.addLayer(markerLayer);

                    markerLayer.on('mouseover', function(e) {
                        e.layer.openPopup();
                    });

                    markerLayer.on('mouseout', function(e) {
                        e.layer.closePopup();
                    });

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
                    	console.log(response);
                        if (response.status === 'success') {
                            window.location = '/thank-you-homes?interested_models='+response.interested_models+'&firstName='+response.firstName+'&lastName='+response.lastName+'&email='+response.email+'&phone='+response.phone+'&community='+response.community+'&comment='+response.comment+'&builders='+response.builders;
                        }
                    }
                });
            }
        });

        if ($('#homes_thanks').length) {
            var query = getUrlVars(),
                data = {},
                builders = query.builders;

            builders = builders.replace(/%20/g, '');
            builders = builders.replace(/\+/g, ' ');
            builders = builders.split(',');

            if (!builders || $.inArray('Toll Brothers', builders)) {
                data.firstName = query.firstName;
                data.lastName = query.lastName;
                data.email = query.email;
                data.phone = query.phone;
                data.comment = query.comment;

                data.type = 'toll';

                 $.ajax({
                    async: true,
                    type: 'POST',
                    url: property_finder.plugin_url+'/public/ajax.php',
                    data: data,
                    dataType: '',
                    success: function() {}
                });
            }
        }

        $('.reqInfo').click(function() {
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