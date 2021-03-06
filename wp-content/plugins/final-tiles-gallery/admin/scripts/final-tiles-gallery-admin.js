var FTG = function ($) {
	var _loading = null;

	return {
		show_loading: function () {
			_loading = $("<div><p class='loading'></div>").dialog({
                modal: true,
                dialogClass: "noTitle"
            });
		},
		hide_loading: function () {
			if(_loading) {
				_loading.dialog("destroy");
				_loading = null;
			}
		},
		delete_image: function (id) {
			FTG.show_loading();
			$.post(ajaxurl, {
                action: 'delete_image',                
                FinalTiles_gallery: $('#FinalTiles_gallery').val(),
                id: id
            }, function () {
                FTG.load_images();
            });
		},
		load_images: function () {
			if(!_loading)
				FTG.show_loading();

			$.post(ajaxurl, {
                action: 'list_images',
                FinalTiles_gallery: $('#FinalTiles_gallery').val(),
                gid: $("#gallery-id").val()
            }, function (html) {
                $("#image-list").empty().append(html).sortable({
                    update: function () {
                        FTG.show_loading();
                        var ids = [];
                        $("#image-list .item").each(function () {
                            ids.push($(this).data("id"));
                        });
                        var data = {
                            action: 'sort_images',
                            FinalTiles_gallery: $('#FinalTiles_gallery').val(),
                            ids: ids.join(',')
                        };
                        $.post(ajaxurl, data, function () {
                            FTG.hide_loading();
                        });
                    }
                });

                $("#image-list .remove").click(function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    var $item = $(this).parents(".item:first");
                    var id = $item.data("id");

                    var data = {
                        action: 'delete_image',
                        FinalTiles_gallery: $('#FinalTiles_gallery').val(),
                        id: id
                    };

                    FTG.show_loading();
                    $.post(ajaxurl, data, function () {
                        $item.remove();
                        FTG.hide_loading();                        
                    });
                });

                $("#image-list .checkbox").click(function () {
                    $(this).toggleClass("checked");
                    $(this).parents(".item:first").toggleClass("selected");
                });
                
                FTG.hide_loading();
            });
		},
		edit_image: function(form) {
			var data = {};
            form.find("input[type=text], input:checked, textarea, input[type=hidden]").each(function() {
                data[$(this).attr("name")] = $(this).val();
            });
            data.action = 'save_image';
            data.type = 'edit';
            data.FinalTiles_gallery = $('#FinalTiles_gallery').val();

            FTG.show_loading();
            $.ajax({
                url: ajaxurl,
                data: data,
                dataType: "json",
                type: "post",
                error: function(a,b,c) {
                    FTG.hide_loading();
                },
                success: function(r) {                        
                    if(r.success) {
                        FTG.load_images();
                    } else {
                    	FTG.hide_loading();
                    }
                }
            });
		},
		add_image: function () {
			var data = {};
            $("#add_image_form input[type=text], #add_image_form input:checked, #add_image_form textarea, #add_image_form input[type=hidden]").each(function() {
                data[$(this).attr("name")] = $(this).val();
            });
            data.action = 'save_image';
            data.type = $(this).data("type");
            if(data.img_id == "") {
                var p = $("<div title='Attention'>Select an image to add</div>").dialog({
                    modal: true,
                    buttons: {
                        Close: function () {
                            p.dialog("destroy");
                        }
                    }
                });
                return false;
            }

            FTG.show_loading();
            $.ajax({
                url: ajaxurl,
                data: data,
                dataType: "json",
                type: "post",
                error: function(a,b,c) {
                    FTG.hide_loading();
                },
                success: function(r) {                        
                    if(r.success) {
                        FTG.load_images();
                        $("#add_image_form .img img").remove();
                        $("[name=img_id],[name=img_url],[name=url],[name=image_caption]").val("");
                    }
                }
            });
		},
        update_filters: function() {
            var ff = [];
            $(".filters .f").each(function () {
                var val = $.trim($(this).val());
                if(val.length > 0 && $.inArray(val, ff) < 0) {
                    ff.push(val);
                }
            });
            $(".filters [name=filters]").val(ff.join('|'));
        },
        add_filter: function (value) {            
            var row = $("<p style='display:none'><a href='#' class='button alert del'>x</a> <input class='f' type='text' /></p>");
            if(value)
                row.find(".f").val(value);

            $(".filters .text").append(row);
            row.slideDown();
            row.find(".del").click(function (e) {
                e.preventDefault();
                row.slideUp(function () {
                    $(this).remove();
                });
                FTG.update_filters();
            });
        },
        init_gallery: function () {
            var ff = $(".filters [name=filters]").val().split('|');
            
            if(ff.length == 0 || ff[0] == "") {
                FTG.add_filter();
            } else {
                for(var i=0; i < ff.length; i++) {
                    if(ff[i].length > 0)
                        FTG.add_filter(ff[i]);
                }
            }

        },
        save_gallery: function() {
            var data = {};
            data.action = 'save_gallery';
            FTG.update_filters();
            $("#gallery_form").find("input[type=text], select, input:checked, input[type=hidden], textarea").each(function () {
                data[$(this).attr("name")] = $(this).val();
            });

            if(parseInt(data.gridCellSize) < 2)
                data.gridCellSize = 2;
            
            if(data.galleryName == "") {
                var p = $("<div title='Attention'>Insert a name for the gallery</div>").dialog({
                    modal: true,
                    buttons: {
                        Close: function () {
                            p.dialog("destroy");
                        }
                    }
                });
                return false;
            }

            FTG.show_loading();

            $.ajax({
                url: ajaxurl,
                data: data,
                dataType: "json",
                type: "post",
                error: function(a,b,c) {
                    FTG.hide_loading();
                },
                success: function(r) {
                    if(data.ftg_gallery_edit)
                        FTG.hide_loading();
                    else
                        location.href = "?page=edit-gallery";                     
                }
            });
        },
		bind: function () {			
			$("#add-submit").click(function (e) {
                e.preventDefault();
                FTG.add_image();
            });
            $("#add-gallery, #edit-gallery").click(function (e) {
                e.preventDefault();
                FTG.save_gallery();
            });
            $(".filters a").click(function (e) {
                e.preventDefault();
                FTG.add_filter();
            });
            $("#image-list").on("click", ".item .thumb", function () {
	            $(this).parents(".item").toggleClass("selected");
	            $(this).parents(".item").find(".checkbox").toggleClass("checked");
            });
            $("#image-list").on("click", ".edit", function () {
                var $item = $(this).parents(".item");
                var panel = $("#image-panel-model").clone().attr("id", "image-panel");
                panel.css({
                    marginTop: $(window).scrollTop() - (246 / 2),
                    marginLeft: -(600 / 2)
                });

                $(".figure", panel).append($("img", $item).clone());
                $(".sizes", panel).append($("select", $item).clone());
                $("textarea", panel).val($("pre", $item).text());
                $(".copy", $item).clone().appendTo(panel);
                $("[name=blank]", panel).get(0).checked = $("[name=blank]", $item).val() == "T";

                var selFilters = $item.find("[name=filters]").val().split('|');
                var filters = $("[name=filters]").val().split('|');
                for(var i=0; i < filters.length; i++) {
                    if($.trim(filters[i]).length > 0) {
                        var ft = $("<div class='checkbox'>" + $.trim(filters[i]) + "</div>");
                        if($.inArray(filters[i], selFilters) > -1)
                            ft.addClass("checked");

                        $(".filters", panel).append(ft);
                    }
                }
                
                $(".filters .checkbox", panel).click(function() {
                    $(this).toggleClass("checked");
                });
                
                $("body").append("<div class='overlay' style='display:none' />");
                $(".overlay").fadeIn();
                panel.appendTo("body").fadeIn();

                var link = $item.find("[name=link]").val();
                var zoom = $item.find("[name=zoom]").val();

                if(zoom == "T")
                    $("[value=zoom]", panel).get(0).checked = true;
                if(link) {
                    $("[value=url]", panel).get(0).checked = true;
                    $("[name=url]", panel).val(link);
                }

                $(".buttons a", panel).click(function (e) {
                    e.preventDefault();
                    
                    switch($(this).data("action")) {
                        case "save":
                            var data = {
                                action : 'save_image',
                                FinalTiles_gallery : $('#FinalTiles_gallery').val()
                            };
                            $("input[type=text], input[type=hidden], input[type=radio]:checked, input[type=checkbox]:checked, textarea, select", panel).each(function () {
                                if($(this).attr("name"))
                                    data[$(this).attr("name")] = $(this).val();
                            });

                            var savFilters = [];
                            $(".filters .checked", panel).each(function(i, o) {
                                savFilters.push($(o).text());
                            });
                            data.filters = savFilters.join("|");

                            $("#image-panel .close").trigger("click");
                            FTG.show_loading();
                            $.ajax({
                                url: ajaxurl,
                                data: data,
                                dataType: "json",
                                type: "post",
                                error: function(a,b,c) {
                                	console.log(a,b,c);
                                    FTG.hide_loading();
                                },
                                success: function(r) {    
                                	console.log("ok");                                
                                    FTG.hide_loading();
                                    FTG.load_images();
                                }
                            });                            
                            break;
                        case "cancel":
                            $("#image-panel .close").trigger("click");
                            break;
                    }
                });

                $("#image-panel .close, .overlay").click(function (e) {
                    e.preventDefault();
                    panel.fadeOut(function () {
                        $(this).remove();
                    });
                    $(".overlay").fadeOut(function () {
                        $(this).remove();
                    });
                });

                $(".sizes select", panel).chosen({
                    disable_search_threshold: 10,
                    width: 100
                });
            });
            $("body").on("click", "[name=click_action]", function () {
                if($(this).val() == "url") {
                    $(this).siblings("[name=url]").get(0).disabled = false;
                } else {
                    $(this).siblings("[name=url]").val("").get(0).disabled = true;
                }
            });

            $(".bulk a").click(function (e) {
                e.preventDefault();

                var $bulk = $(".bulk");

                switch($(this).data("action"))
                {
                    case "select":
                        $("#images .item").addClass("selected");
                        $("#images .item .checkbox").addClass("checked");
                        break;
                    case "deselect":
                        $("#images .item").removeClass("selected");
                        $("#images .item .checkbox").removeClass("checked");
                        break;
                    case "toggle":
                        $("#images .item").toggleClass("selected");
                        $("#images .item .checkbox").toggleClass("checked");
                        break;
                    case "filter":
                        var selected = [];
                        $("#images .item.selected").each(function (i, o) {
                            selected.push($(o).data("id"));
                        });
                        if(selected.length == 0) {
                            alert("No images selected");
                        } else {
                            $(".panel", $bulk).hide();
                            $(".panel strong", $bulk).text("Select filters");
                            $(".panel .text", $bulk).text("");
                            
                            var filters = $("[name=filters]").val().split('|');
                            for(var i=0; i < filters.length; i++) {
                                if($.trim(filters[i]).length > 0) {
                                    var ft = $("<div class='checkbox'>" + $.trim(filters[i]) + "</div>");
                                    $(".panel .text", $bulk).append(ft);
                                }
                            }
                            
                            $(".panel .checkbox", $bulk).click(function() {
                                $(this).toggleClass("checked");
                            });

                            $(".cancel", $bulk).unbind("click").click(function (e) {
                                e.preventDefault();
                                $(".panel", $bulk).slideUp();
                            });

                            $(".proceed", $bulk).unbind("click").click(function (e) {
                                e.preventDefault();

                                var filters = [];
                                $(".panel .checked", $bulk).each(function (i, o) {
                                    filters.push($(o).text());
                                });

                                $(".panel", $bulk).slideUp();

                                var data = {
                                    action: 'assign_filters',
                                    FinalTiles_gallery: $('#FinalTiles_gallery').val(),
                                    filters: filters.join("|"),
                                    id: selected.join(",")
                                };

                                FTG.show_loading();
                                $.post(ajaxurl, data, function () {
                                    FTG.hide_loading();                        
                                });
                            });

                            $(".panel", $bulk).slideDown();
                        }
                        break;
                    case "remove":
                        var selected = [];
                        $("#images .item.selected").each(function (i, o) {
                            selected.push($(o).data("id"));
                        });
                        if(selected.length == 0) {
                            alert("No images selected");
                        } else {
                            $(".panel", $bulk).hide();
                            $(".panel strong", $bulk).text("Confirm");
                            $(".panel .text", $bulk).text("You selected " + selected.length + " images to remove, proceed ?");

                            $(".cancel", $bulk).unbind("click").click(function (e) {
                                e.preventDefault();
                                $(".panel", $bulk).slideUp();
                            });

                            $(".proceed", $bulk).unbind("click").click(function (e) {
                                e.preventDefault();
                                $(".panel", $bulk).slideUp();

                                var data = {
                                    action: 'delete_image',
                                    FinalTiles_gallery: $('#FinalTiles_gallery').val(),
                                    id: selected.join(",")
                                };

                                FTG.show_loading();
                                $.post(ajaxurl, data, function () {
                                    $("#images .item.selected").remove();
                                    FTG.hide_loading();                        
                                });
                            });

                            $(".panel", $bulk).slideDown();
                        }
                        break;
                }
            });

            $(".open-media-panel").on("click", function() {
                tgm_media_frame = wp.media.frames.tgm_media_frame = wp.media({
                    multiple: true,
                    library: {
                        type: 'image'
                    }
                });

                tgm_media_frame.on('select', function() {
                    var selection = tgm_media_frame.state().get('selection');
                    var images = [];                    
                    selection.map( function( attachment ) {
                        attachment = attachment.toJSON();
                        var obj = {
                            description: attachment.caption,
                            imageId: attachment.id
                        };
                        
                        if(attachment.sizes.medium)
                            obj.imagePath = attachment.sizes.medium.url
                        else
                            obj.imagePath = attachment.url;

                        if(attachment.sizes.full)
                            obj.altImagePath = attachment.sizes.full.url;

                        images.push(obj);
                    });

                    var data = {
                        action : 'add_image',
                        enc_images : JSON.stringify(images),
                        galleryId: $("#gallery-id").val(),
                        FinalTiles_gallery : $('#FinalTiles_gallery').val()
                    };

                    FTG.show_loading();
                    $.ajax({
                        url: ajaxurl,
                        data: data,
                        dataType: "json",
                        type: "post",
                        error: function(a,b,c) {
                            FTG.hide_loading();
                            alert("error adding images");
                        },
                        success: function(r) {                        
                            if(r.success) {
                                FTG.hide_loading();
                                FTG.load_images();
                            }
                        }
                    });
                });

                tgm_media_frame.open();
            });
		}
	}
}(jQuery);
jQuery(function () {
	FTG.bind();

    if(jQuery("#wpbody").height() < jQuery("#wpwrap").height()) {
        jQuery("#wpbody").height(jQuery("#wpwrap").height());
    }
});