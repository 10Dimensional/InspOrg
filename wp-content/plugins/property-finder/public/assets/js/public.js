var map = '',
    builder_layers = {
        'Beazer': 'http://166.78.0.133:8888/v2/beazer/{z}/{x}/{y}.png',
        'KB HOME': 'http://166.78.0.133:8888/v2/kb/{z}/{x}/{y}.png',
        'Necessities': 'http://166.78.0.133:8888/v2/neccessities/{z}/{x}/{y}.png',
        'Pardee': 'http://166.78.0.133:8888/v2/pardee/{z}/{x}/{y}.png',
        'Parks': 'http://166.78.0.133:8888/v2/parks/{z}/{x}/{y}.png',
        'Pools': 'http://166.78.0.133:8888/v2/pools/{z}/{x}/{y}.png',
        'schools': 'http://166.78.0.133:8888/v2/schools/{z}/{x}/{y}.png',
        'Toll Brothers': 'http://166.78.0.133:8888/v2/toll/{z}/{x}/{y}.png',
        'Trails': 'http://166.78.0.133:8888/v2/trails/{z}/{x}/{y}.png'
    };

 (function ( $ ) {
	"use strict";
   
	$(function () {
	    if ($('#searchMap').length) {
    	    map = L.map('searchMap', {minZoom: 2, maxZoom: 6});
            
            var markerLayer = L.mapbox.markerLayer().loadURL('/wp-content/themes/inspirada/markers.geojson');
            markerLayer.options.sanitizer = function(x) { return x; };
    	    var baselayer = L.tileLayer('http://166.78.0.133:8888/v2/base/{z}/{x}/{y}.png').addTo(map);
    	    
    	    map.setView([-77, 22.763671875], 4);
    	    map.touchZoom.disable();
            map.doubleClickZoom.disable();
            map.scrollWheelZoom.disable();
            if (map.tap) map.tap.disable();
    	    
            var mapgroup = L.layerGroup().addTo(map);
            
            
            mapgroup.addLayer(L.tileLayer(builder_layers['Parks']), 'Parks', 1);
            mapgroup.addLayer(L.tileLayer(builder_layers['Necessities']), 'Necessities', 1);
            
            
            markerLayer.setFilter(function(f) {
                return f.properties['category'] === 'Parks'; 
            }).addTo(map);

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
            	    mapgroup.addLayer(L.tileLayer(builder_layers['Parks']), 'Parks', 1);
                    mapgroup.addLayer(L.tileLayer(builder_layers['Necessities']), 'Necessities', 1);
            	    
            	    markerLayer.setFilter(function(f) {
                        return f.properties['category'] === 'Parks'; 
                    }).addTo(map);
            	    
            	    for (var b in response.builders) {
                        
                        if (builder_layers[response.builders[b]]) {
                            mapgroup.addLayer(L.tileLayer(builder_layers[response.builders[b]]), b, 1);
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