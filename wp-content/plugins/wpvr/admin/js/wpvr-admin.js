(function( $ ) {
	'use strict';
	var j= 1;
	var color='#00b4ff';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	jQuery(document).ready(function($){


		j= $('#scene-1').find('.hotspot-nav li').eq(-2).find('span').attr('data-index');
	 	var ajaxurl = wpvr_obj.ajaxurl;
		$('#panolenspreview').on('click', function(e){			
			e.preventDefault();
			var postid = $("#post_ID").val();
			var autoload = $("input[name='autoload']:checked").val();
			var compass = $("input[name='compass']:checked").val();
			var control = $("input[name='controls']:checked").val();
			var defaultscene = $("input[name='default-scene-id']").val();
			var preview = $("input[name='preview-attachment-url']").val();
			var scenefadeduration = $("input[name='scene-fade-duration']").val();
			var rotation = $("input[name='autorotation']:checked").val();
			var autorotation = $("input[name='auto-rotation']").val();
			var autorotationinactivedelay = $("input[name='auto-rotation-inactive-delay']").val();
			var autorotationstopdelay = $("input[name='auto-rotation-stop-delay']").val();

			var panodata = $('.scene-setup').repeaterVal();
			var panolist = JSON.stringify(panodata);
		  	jQuery.ajax({
			    type:    "POST",
			    url:     ajaxurl,
			    data: { 
			      action: "wpvr_preview",
			      postid: postid,
			      compass: compass,
			      control: control,
			      autoload: autoload,
			      panodata: panolist,
			      defaultscene: defaultscene,
			      rotation: rotation,
			      autorotation: autorotation,
			      autorotationinactivedelay: autorotationinactivedelay,
			      autorotationstopdelay: autorotationstopdelay,

			      preview: preview,
			      scenefadeduration: scenefadeduration,
			    },
		    	
			    success: function( response ){
			    	if (response.success == true) {
			    		$('#error_occured').hide();
			    		$('#error_occuredpub').hide();
			    		$('#'+response.data[0]["panoid"]).empty();
			    		var scenes = response.data[1];

			    		if (scenes) {
				    		$.each(scenes.scenes, function (i) {		
							    $.each(scenes.scenes[i]['hotSpots'], function (key, val) {						
							        if (val["clickHandlerArgs"] != "") {
							        	val["clickHandlerFunc"] = wpvrhotspot;
							        }
							        if (val["createTooltipArgs"] != "") {
							        	val["createTooltipFunc"] = wpvrtooltip;
							        }								 
							    });
							});
			    		}
			    		var panoshow = pannellum.viewer(response.data[0]["panoid"], scenes);	
			    	}
			    	else {
			    		$('#error_occured').show();
                    	$('#error_occured').html(response.data);
                    	$('#error_occuredpub').show();
                    	$('#error_occuredpub').html(response.data);
                    	$('body').addClass('error-overlay');
                    	$('html, body').animate({
		                    scrollTop: $("#error_occured").offset().top
		                }, 500);
			    	}
		  		}
			});
		});
	}); 

	jQuery(document).ready(function($){
	 	var ajaxurl = wpvr_obj.ajaxurl;
		$('#videopreview').on('click', function(e){			
			e.preventDefault();
			var postid = $("#post_ID").val();
			var videourl = $("input[name='video-attachment-url']").val();
			var vidautoplay = $("input[name='playvideo']:checked").val();
			var vidcontrol = $("input[name='playcontrol']:checked").val();			
		  	jQuery.ajax({
			    type:    "POST",
			    url:     ajaxurl,
			    data: { 
			      action: "wpvrvideo_preview",
			      postid: postid,
			      videourl: videourl,
			      vidautoplay: vidautoplay,
			      vidcontrol: vidcontrol,
			    },
		    	
			    success: function( response ){
			    	if (response.success == true) {
			    		$('#'+response.data["panoid"]).empty();
			    		$('#'+response.data["panoid"]).html(response.data["panodata"]);
			    		if (response.data['vidtype'] == 'selfhost') {
			    			videojs(response.data["vidid"], {
							    plugins: {
							        pannellum: {}
							    }
							});
			    		}
			    	}
			    	else {

			    	}
		  		}
			});
		});
	});

	jQuery(document).ready(function($){

		var flag_ok = false;
		$('#publish').on('click', function(e){
		var x =	$(this).val();
			if ( ! flag_ok ) {
		        e.preventDefault();
				var postid = $("#post_ID").val();
				var panovideo = $("input[name='panovideo']:checked").val();
				var videourl = $("input[name='video-attachment-url']").val();
				var autoload = $("input[name='autoload']:checked").val();
				var control = $("input[name='controls']:checked").val();
				var compass = $("input[name='compass']:checked").val();
				var defaultscene = $("input[name='default-scene-id']").val();
				var preview = $("input[name='preview-attachment-url']").val();
				var rotation = $("input[name='autorotation']:checked").val();
				var autorotation = $("input[name='auto-rotation']").val();
				var autorotationinactivedelay = $("input[name='auto-rotation-inactive-delay']").val();
				var autorotationstopdelay = $("input[name='auto-rotation-stop-delay']").val();

				var scenefadeduration = $("input[name='scene-fade-duration']").val();
			
				if ($('.scene-setup')[0]) {
				    var panodata = $('.scene-setup').repeaterVal();
				    var panolist = JSON.stringify(panodata);
				} else {
					var panodata = '';
					var panolist = '';
				}
			  	jQuery.ajax({

				    type:    "POST",
				    url:     ajaxurl,
				    data: { 
				      action: "wpvr_save",
				      postid: postid,
				      panovideo: panovideo,
				      videourl: videourl,
				      control: control,
				      compass: compass,
				      autoload: autoload,
				      panodata: panolist,
				      defaultscene: defaultscene,
				      preview: preview,
				      rotation: rotation,
				      autorotation: autorotation,
		      		  autorotationinactivedelay: autorotationinactivedelay,
		      		  autorotationstopdelay: autorotationstopdelay,
				      scenefadeduration: scenefadeduration,
				      },
	    	
			    	success: function( response ){
			    		if (response.success == false) {
			    			$('#error_occured').show();
                			$('#error_occured').html(response.data);
                			$('#error_occuredpub').show();
                			$('#error_occuredpub').html(response.data);

                			$('body').addClass('error-overlay');
                			$('html, body').animate({
			                    scrollTop: $("#error_occured").offset().top
			                }, 500);
			    		}
			    		else {
			    			flag_ok = true;
			      			$('#publish').trigger('click');
			    		}
		    		}
		  		});
		    }   
		});	
    });

    jQuery(document).ready(function($){
	    $("body").on("click", function(e){
           $("#error_occured").hide();
           $('body').removeClass('error-overlay');
        });
        
	   $("#panolenspreview, #error_occured").on("click", function(e){
           e.stopPropagation();
        });
    });  

    jQuery(document).ready(function($){

		var flag_ok = false;
		$('#save-post').on('click', function(e){
		var x =	$(this).val();
			if ( ! flag_ok ) {
		        e.preventDefault();
				var postid = $("#post_ID").val();
				var panovideo = $("input[name='panovideo']:checked").val();
				var videourl = $("input[name='video-attachment-url']").val();
				var autoload = $("input[name='autoload']:checked").val();
				var control = $("input[name='controls']:checked").val();
				var compass = $("input[name='compass']:checked").val();
				var defaultscene = $("input[name='default-scene-id']").val();
				var preview = $("input[name='preview-attachment-url']").val();
				var rotation = $("input[name='autorotation']").val();
				var autorotation = $("input[name='auto-rotation']").val();
				var autorotationinactivedelay = $("input[name='auto-rotation-inactive-delay']").val();
				var autorotationstopdelay = $("input[name='auto-rotation-stop-delay']").val();

				var scenefadeduration = $("input[name='scene-fade-duration']").val();
			
				if ($('.scene-setup')[0]) {
				    var panodata = $('.scene-setup').repeaterVal();
				    var panolist = JSON.stringify(panodata);
				} else {
					var panodata = '';
					var panolist = '';
				}
			  	jQuery.ajax({

				    type:    "POST",
				    url:     ajaxurl,
				    data: { 
				      action: "wpvr_save",
				      postid: postid,
				      panovideo: panovideo,
				      videourl: videourl,
				      control: control,
				      compass: compass,
				      autoload: autoload,
				      panodata: panolist,
				      defaultscene: defaultscene,
				      preview: preview,
				      rotation: rotation,
				      autorotation: autorotation,
		      		  autorotationinactivedelay: autorotationinactivedelay,
		      		  autorotationstopdelay: autorotationstopdelay,
				      scenefadeduration: scenefadeduration,
				      },
	    	
			    	success: function( response ){
			    		if (response.success == false) {
			    			$('#error_occured').show();
                			$('#error_occured').html(response.data);
                			$('#error_occuredpub').show();
                			$('#error_occuredpub').html(response.data);

                			$('body').addClass('error-overlay');
                			$('html, body').animate({
			                    scrollTop: $("#error_occured").offset().top
			                }, 500);
			    		}
			    		else {
			    			flag_ok = true;
			      			$('#save-post').trigger('click');
			    		}
		    		}
		  		});
		    }   
		});	
    }); 

    function wpvrhotspot(hotSpotDiv, args) {
	    var argst = args.replace(/\\/g, '');
    	$("#custom-ifram").html(argst);
    	$("#custom-ifram").fadeToggle();
    	$(".iframe-wrapper").toggleClass("show-modal");
	}

	function wpvrtooltip(hotSpotDiv, args) {
	    hotSpotDiv.classList.add('custom-tooltip');
	    var span = document.createElement('span');
	    args = args.replace(/\\/g, "");
	    span.innerHTML = args;
	    hotSpotDiv.appendChild(span);
	    span.style.marginLeft = -(span.scrollWidth - hotSpotDiv.offsetWidth) / 2 + 'px';
	    span.style.marginTop = -span.scrollHeight - 12 + 'px';
	}

	jQuery(document).ready(function($){
	   $("#cross").on("click", function(e){
           e.preventDefault();
           $("#custom-ifram").fadeOut();
           $(".iframe-wrapper").removeClass("show-modal");
           $('iframe').attr('src', $('iframe').attr('src'));
        });
    });

	jQuery(document).ready(function($){

        var i = $('.scene-nav li').eq(-2).find('span').attr('data-index');
        i = parseInt(i);
            
		$('.scene-setup').repeater({
            
	        defaultValues: {
	        	'scene-type': 'equirectangular',
				'dscene': 'off',
				'ptyscene': 'off',
				'cvgscene': 'off',
				'chgscene': 'off',
				'czscene': 'off',
	        },
	        show: function () {

	        	if( $(this).parents(".scene-setup").attr("data-limit").length > 0 ){
	        		
					if( $(this).parents(".scene-setup").find("div[data-repeater-item]:not(.hotspot-setup div[data-repeater-item])").length <= $(this).parents(".scene-setup").attr("data-limit") ){
						
						$(this).slideDown();
						$(this).removeClass('active');

		                i=i+1;
		                var scene = 'scene-'+i;
		                
		                $(this).find(".title .scene-num").html(i);
		                
		                $('<li><span data-index="'+ i +'" data-href="#'+ scene +'"><i class="fa fa-image"></i></span></li>').insertBefore($(this).parent().parent('.scene-setup').find('.scene-nav ul li:last-child'));
		                
		                $(this).attr('id', scene);
		                changehotspotid(i);
		                $(this).siblings('.active').removeClass('active');
		                $(this).addClass('active');
		                setTimeout(changeicon, 1000);
					} else {
                        $('.pano-alert > p').html('You can only add 5 scenes for free version');
                        $('.pano-alert').show();
						$(this).remove();
					}
				} else {
					jQuery(this).slideDown();
	                $(this).removeClass('active');
	                
	                i=i+1;
	                var scene = 'scene-'+i;

	                
	                $(this).find(".title .scene-num").html(i);
	                
	                $('<li><span data-index="'+ i +'" data-href="#'+ scene +'"><i class="fa fa-image"></i></span></li>').insertBefore($(this).parent().parent('.scene-setup').find('.scene-nav ul li:last-child'));
	                
	                $(this).attr('id', scene);
	                changehotspotid(i);
				}

				$(this).hide();
	        },
	        hide: function (deleteElement) {
               
                var hide_id = $(this).attr("id");
                hide_id = "#"+hide_id;
                
                var current = $(this).attr('id');
                var fchild = $('.single-scene:nth-child(2)').attr('id');
                
	            if(confirm('Are you sure you want to delete?')) {
	                jQuery(this).slideUp(deleteElement);
                    if(current == fchild){
                        $(this).next().addClass("active");
                        $(this).parent().parent('.scene-setup').find('.scene-nav li span[data-href="'+hide_id+'"]').parent("li").next().addClass("active");
                        $(this).parent().parent('.scene-setup').find('.scene-nav li span[data-href="'+hide_id+'"]').parent("li").next().children("span").trigger( "click" );

                    }
                    else {
                        $(this).prev().addClass("active");
                        $(this).parent().parent('.scene-setup').find('.scene-nav li span[data-href="'+hide_id+'"]').parent("li").prev().addClass("active");
                        $(this).parent().parent('.scene-setup').find('.scene-nav li span[data-href="'+hide_id+'"]').parent("li").prev().children("span").trigger( "click" );
                    }
                    $(this).parent().parent('.scene-setup').find('.scene-nav li span[data-href="'+hide_id+'"]').parent("li").remove();
                    setTimeout(deleteinfodata, 1000);
	            }     
	        },

	        repeaters: [{
	            selector: '.hotspot-setup',
	            defaultValues: {
			        'hotspot-type': 'info',
			        'hotspot-customclass-pro': 'none',
		        },
	            show: function () {

	            	if( $(this).parents(".hotspot-setup").attr("data-limit").length > 0 ){
		        		
						if( $(this).parents(".hotspot-setup").find("div[data-repeater-item]").length <= $(this).parents(".hotspot-setup").attr("data-limit") ){

							$(this).slideDown();
							$(this).removeClass('active');
							$(this).siblings('.active').removeClass('active');
		                	$(this).addClass('active');
		                    j = parseInt(j);
		                    j=j+1;
		                    var parent_scene = $(this).parent().parent().parent('.single-scene.active').attr('id');  
		                    var hotspot = parent_scene+'-hotspot-'+ j;
		                    
		                    var replace_string =parent_scene.replace("scene-", "");
		                      
		                    $(this).find(".title .hotspot-num").html(j);
		                    $(this).find(".title .scene-num").html(replace_string);
		                
		                    $('<li><span data-index="'+ j +'" data-href="#'+ hotspot +'"><i class="far fa-dot-circle"></i></span></li>').insertBefore($(this).parent().parent('.hotspot-setup').find('.hotspot-nav ul li:last-child'));

		                    $(this).attr('id', hotspot);
		                    
		                    setTimeout(changeicon, 1000);
						} else {
                            $('.pano-alert > p').html('You can only add 5 hotspots for free version');
                            $('.pano-alert').show();
							$(this).remove();
						}
					} else {
						jQuery(this).slideDown();
	                    $(this).removeClass('active');
	                    j = parseInt(j);
	                    j=j+1;
	                    var parent_scene = $(this).parent().parent().parent('.single-scene.active').attr('id');  
	                    var hotspot = parent_scene+'-hotspot-'+ j;
	                    
	                    var replace_string =parent_scene.replace("scene-", "");
	                      
	                    $(this).find(".title .hotspot-num").html(j);
	                    $(this).find(".title .scene-num").html(replace_string);
	                
	                    $('<li><span data-index="'+ j +'" data-href="#'+ hotspot +'"><i class="far fa-dot-circle"></i></span></li>').insertBefore($(this).parent().parent('.hotspot-setup').find('.hotspot-nav ul li:last-child'));

	                    $(this).attr('id', hotspot);
					}
		        },
		        hide: function (deleteElement) {

                    var hotspot_hide_id = $(this).attr("id");
                    hotspot_hide_id = "#"+hotspot_hide_id;
                   

                    var hotspot_current = $(this).attr('id');
                    var hotspot_fchild = $(this).parent().children(":first").attr('id');

                        jQuery(this).slideUp(deleteElement);
                        if(hotspot_current == hotspot_fchild){
                            $(this).next().addClass("active");
                            $(this).parent().parent('.hotspot-setup').find('.hotspot-nav li span[data-href="'+hotspot_hide_id+'"]').parent("li").next().addClass("active");
                            
                        }
                        else {
                            $(this).prev().addClass("active");
                            $(this).parent().parent('.hotspot-setup').find('.hotspot-nav li span[data-href="'+hotspot_hide_id+'"]').parent("li").prev().addClass("active");
                        }
                    
                        $(this).parent().parent('.hotspot-setup').find('.hotspot-nav li:not(:last-child) span[data-href="'+hotspot_hide_id+'"]').parent("li").remove();
		        },

	        }]
	    });       
	}); 
    

	var file_frame;
	var parent;
    $(document).on("click",".scene-upload",function(event) {
		event.preventDefault();
        parent = $(this).parent( '.form-group' );	

        if ( file_frame ) {
            file_frame.open();
            return;
        }
        
        file_frame = wp.media.frames.file_frame = wp.media({
            title: $( this ).data( 'uploader_title' ),
            button: {
                text: $( this ).data( 'uploader_button_text' ),
            },
            library: {
                type: [ 'image']
            },
            multiple: false 
        });

        file_frame.on( 'select', function() {

            var attachment = file_frame.state().get('selection').first().toJSON();
            parent.find('.scene-attachment-url').val(attachment.url);
            parent.find( 'img' ).attr( 'src', attachment.url).show();
        });

        file_frame.open();
    });

    var file_frames;
    $(document).on("click",".video-upload",function(event) {
		event.preventDefault();

        parent = $(this).parent( '.form-group' );	

        if ( file_frames ) {
            file_frames.open();
            return;
        }
        
        file_frames = wp.media.frames.file_frames = wp.media({
            title: $( this ).data( 'uploader_title' ),
            button: {
                text: $( this ).data( 'uploader_button_text' ),
            },
            library: {
                type: [ 'video/mp4']
            },
            multiple: false 
        });

        file_frames.on( 'select', function() {
            var attachment = file_frames.state().get('selection').first().toJSON();
            parent.find('.video-attachment-url').val(attachment.url);
        });

        file_frames.open();
    });

    var file_fram;

    $(document).on("click",".preview-upload",function(event) {
		event.preventDefault();


        parent = $(this).parent( '.form-group' );	

        if ( file_fram ) {
            file_fram.open();
            return;
        }
        
        file_fram = wp.media.frames.file_fram = wp.media({
            title: $( this ).data( 'uploader_title' ),
            button: {
                text: $( this ).data( 'uploader_button_text' ),
            },
            library: {
                type: [ 'image']
            },
            multiple: false 
        });

        file_fram.on( 'select', function() {
            var attachment = file_fram.state().get('selection').first().toJSON();
            parent.find('.preview-attachment-url').val(attachment.url);
            parent.find( 'img' ).attr( 'src', attachment.url).show();
        });

        file_fram.open();
    });


    $(document).on("change","select[name*=hotspot-type]",function(event) {

    	var getparent = $(this).parent();

    	var getvalue = $(this).val();
    	if (getvalue == 'info') {
    		getparent.find('.hotspot-scene').hide();
    		getparent.find('.hotspot-url').show();
    		getparent.find('.hotspot-content').show();
    	}
    	else {
    		getparent.find('.hotspot-scene').show();
    		getparent.find('.hotspot-url').hide();
    		getparent.find('.hotspot-content').hide();
    	}
	});

$(document).on("change","input[type=radio][name=panovideo]",function(event) {
    	var getvalue = $(this).val();
    	if (getvalue == 'on') {
    		$(".video-setting").show();
    		$("li.general").hide();
    		$("li.scene").hide();
    		$("li.hotspot").hide();
    	}
    	else {
    		$(".video-setting").hide();
    		$("li.general").show();
    		$("li.scene").show();
    		$("li.hotspot").show();
    	}
	});

	jQuery(document).ready(function($){
	   var viddata = $("input[name='panovideo']:checked").val();
	   if (viddata == 'on') {
	   		$("li.general").removeClass('active');
	   		$(".rex-pano-tab.general").removeClass('active');
	   		$("li.video").addClass('active');
	   		$(".rex-pano-tab.video").addClass('active');
	   		$(".video-setting").show();
    		$("li.general").hide();
    		$("li.scene").hide();
    		$("li.hotspot").hide();
	   }
	   else {
	   		$(".video-setting").hide();
    		$("li.general").show();
    		$("li.scene").show();
    		$("li.hotspot").show();
	   }
    });

    $(document).on("change","select[name*=hotspot-customclass-pro]",function(event) {
    	var getval = $(this).val();
    	$(this).parent('.hotspot-setting').children('span.change-icon').html('<i class="'+getval+'"></i>');
    	
	});

    $(document).on("change",".hotspot-customclass-color",function(event) {
    	var getcolor = $(this).val();
    	color = getcolor;
    	$('.hotspot-customclass-color-icon-value').val(getcolor);
    	$('.hotspot-customclass-color').val(getcolor);
	});

	jQuery(document).ready(function($){
		if ($(".icon-found-value")[0]){
		    color = $('.hotspot-customclass-color-icon-value.icon-found-value').val();
		} else {
		   color = '#00b4ff';
		}
    });

    function changeicon(){
    	$('.hotspot-customclass-color-icon-value').val(color);
    	$('.hotspot-customclass-color').val(color);
	}

    //------------panolens tab js------------------
  
    
     $(document).on("click",".scene-nav ul li:not(:last-child) span",function() {
         
        var scene_id = $(this).data('index');
        scene_id = '#scene-'+ scene_id;
        
        j = $(scene_id).find('.hotspot-nav li').eq(-2).find('span').attr('data-index');
        
        $([$(this).parent()[0], $($(this).data('href'))[0]]).addClass('active').siblings('.active').removeClass('active');

    });

    //add click
    $(document).on("click",".scene-nav ul li:last-child span",function() {
    	var scene_id = $(this).parent('li').prev().children("span").data('index');
        scene_id = '#scene-'+ scene_id;
        j = $(scene_id).find('.hotspot-nav li').eq(-2).find('span').attr('data-index');
    	$('.scene-nav ul li.active').removeClass('active');
        $(this).parent('li').prev().addClass('active');
        var sceneinfo = $('.scene-setup').repeaterVal();
		var infodata = sceneinfo['scene-list'];
		$('.hotspotscene').find('option').remove();
		$('.hotspotscene').append("<option value='none'>None</option>");
		for (var i in infodata) {
			var optiondata = infodata[i]['scene-id'];
			if (optiondata != '') {
				$('.hotspotscene').append("<option value='" + optiondata + "'>"+optiondata+"</option>");
			}
		}
		$('.hotspot-customclass-pro-select').fontIconPicker();
		$('span.change-icon').hide();
    });

    //end add click
    
    $(document).on("click",".hotspot-nav ul li:not(:last-child) span",function() {
        $([$(this).parent()[0], $($(this).data('href'))[0]]).addClass('active').siblings('.active').removeClass('active');

    });

    $(document).on("click",".hotspot-nav ul li:last-child span",function() {
		$(this).parent('li').siblings('.active').removeClass('active');
    	$(this).parent('li').prev().addClass('active');
    	var sceneinfo = $('.scene-setup').repeaterVal();
		var infodata = sceneinfo['scene-list'];
		$('.hotspotscene').find('option').remove();
		$('.hotspotscene').append("<option value='none'>None</option>");
		for (var i in infodata) {
			var optiondata = infodata[i]['scene-id'];
			if (optiondata != '') {
				$('.hotspotscene').append("<option value='" + optiondata + "'>"+optiondata+"</option>");
			}
		}
	    $('.trtr').trigger('change');
	    $('.hotspot-customclass-pro-select').fontIconPicker();
	    $('span.change-icon').hide();
	    
    });

    function changehotspotid(id){
        var scene_id = '#scene-'+ id;
        var hotspot_id = 'scene-'+ id +'-hotspot-1'; 
        $(scene_id).find('.hotspot-nav li span').attr('data-href', '#'+hotspot_id+'');
        $(scene_id).find('.single-hotspot').attr('id', hotspot_id);
      
    }
    
    $(document).on("click",".rex-pano-nav-menu.main-nav ul li span",function() {
        $([$(this).parent()[0], $($(this).data('href'))[0]]).addClass('active').siblings('.active').removeClass('active');
    });
    
    //----------alert dismiss--------//
    $(document).on("click","body",function() {
        $('.pano-alert').hide();
    });
    $(document).on("click",".pano-alert > .destroy",function() {
        $('.pano-alert').hide();
    });
    $(document).on("click",".pano-alert, .rex-pano-sub-tabs .rex-pano-tab-nav li.add",function(e) {
        e.stopPropagation();
    });
    
    
    $(document).on("click",".main-nav li.hotspot span",function() {
        $(".hotspot-setup.rex-pano-sub-tabs").show();
        $(".scene-setup > nav.scene-nav").hide();
        $(".scene-setup .single-scene > .scene-content").hide();
        $(".scene-setup .delete-scene").hide();
    });
    
    $(document).on("click",".main-nav li.scene span",function() {
        $(".hotspot-setup.rex-pano-sub-tabs").hide();
        $(".scene-setup > nav.scene-nav").show();
        $(".scene-setup .single-scene > .scene-content").show();
        $(".scene-setup .delete-scene").show();
    });

    $(document).on("change",".dscen",function() {
    	var dscene = $(this).val();
        $(".dscen").not(this).each(function() {
        	var oth_scene = $(this).val();
        	if (dscene == 'on' && oth_scene == 'on') {
        		alert('Default scene updated.');
        		$(this).val('off');
        	}
		});
	});

	$(document).on("change",".sceneid",function() {
		var sceneinfo = $('.scene-setup').repeaterVal();
		var infodata = sceneinfo['scene-list'];
		$('.hotspotscene').find('option').remove();
		$('.hotspotscene').append("<option value='none'>None</option>");
		for (var i in infodata) {
			var optiondata = infodata[i]['scene-id'];
			if (optiondata != '') {
				$('.hotspotscene').append("<option value='" + optiondata + "'>"+optiondata+"</option>");
			}
		}
	});
	function deleteinfodata(){
		var sceneinfo = $('.scene-setup').repeaterVal();
		var infodata = sceneinfo['scene-list'];
		$('.hotspotscene').find('option').remove();
		$('.hotspotscene').append("<option value='none'>None</option>");
		for (var i in infodata) {
			var optiondata = infodata[i]['scene-id'];
			if (optiondata != '') {
				$('.hotspotscene').append("<option value='" + optiondata + "'>"+optiondata+"</option>");
			}
		}
	}

	$(document).on("change",".hotspotscene",function() {
		
		var chanheghtptpval = $(this).val();
		if(chanheghtptpval != "none") {
			$(this).parent('.hotspot-scene').siblings('.hotspot-scene').children('.hotspotsceneinfodata').val(chanheghtptpval);
		}
		else {
			$(this).parent('.hotspot-scene').siblings('.hotspot-scene').children('.hotspotsceneinfodata').val('');
		}
	});

	$(document).on("click",".hotpitch",function(event) {
		var datacoords = $('#panodata').text().split(',');
		var pitchsplit = datacoords[0]; 
		var pitch = pitchsplit.split(':');
		$(this).parent().parent('.hotspot-setting').children('.hotspot-pitch').val(pitch[1]);
	});

	$(document).on("click",".hotyaw",function(event) {
		var datacoords = $('#panodata').text().split(',');
		var yawsplit = datacoords[1]; 
		var yaw = yawsplit.split(':');
		$(this).parent().parent('.hotspot-setting').children('.hotspot-yaw').val(yaw[1]);
	});

	jQuery(document).ready(function($){

		if ($(".scene-setup").length > 0) {
	        var sceneinfo = $('.scene-setup').repeaterVal();
			var infodata = sceneinfo['scene-list'];
			$('.hotspotscene').find('option').remove();
			$('.hotspotscene').append("<option value='none'>None</option>");
			for (var i in infodata) {
				var optiondata = infodata[i]['scene-id'];
				if (optiondata != '') {
					$('.hotspotscene').append("<option value='" + optiondata + "'>"+optiondata+"</option>");
				}
			}
	    }
    });

    $(document).on("click",".toppitch",function(event) {
		var datacoords = $('#panodata').text().split(','); 
		var pitchsplit = datacoords[0]; 
		var pitch = pitchsplit.split(':');
		var yawsplit = datacoords[1]; 
		var yaw = yawsplit.split(':'); 
		
		$('div.single-scene.rex-pano-tab.active').children('div.hotspot-setup.rex-pano-sub-tabs').children('div.rex-pano-tab-content').children('div.single-hotspot.rex-pano-tab.active.clearfix').find('.hotspot-pitch').val(pitch[1]);
		$('div.single-scene.rex-pano-tab.active').children('div.hotspot-setup.rex-pano-sub-tabs').children('div.rex-pano-tab-content').children('div.single-hotspot.rex-pano-tab.active.clearfix').find('.hotspot-yaw').val(yaw[1]);
	});
	jQuery(document).ready(function($) {
	    $('.hotspot-customclass-pro-select').fontIconPicker();
	});
	jQuery(document).ready(function($) {
	    $('span.change-icon').hide();
	});

	jQuery(document).ready(function($) {
	    var autrotateset = $("input[name='autorotation']:checked").val();
	    if (autrotateset == 'off') {
	    	$('.autorotationdata').hide();
	    }
	    else {
	    	$('.autorotationdata').show();
	    }
	});

	$(document).on("change","input[name='autorotation']",function(event) {
    	var autrotateset = $(this).val();
    	if (autrotateset == 'off') {
	    	$('.autorotationdata').hide();
	    }
	    else {
	    	$('.autorotationdata').show();
	    }
	});

	$(document).on("change",".ptyscene",function(event) {
    	var ptyscene = $(this).val();
    	if (ptyscene == 'off') {
	    	$(this).parent('.single-settings').siblings('.ptyscenedata').hide();
	    }
	    else {
	    	$(this).parent('.single-settings').siblings('.ptyscenedata').show();
	    }
	});

	$(document).on("change",".cvgscene",function(event) {
    	var cvgscene = $(this).val();
    	if (cvgscene == 'off') {
	    	$(this).parent('.single-settings').siblings('.cvgscenedata').hide();
	    }
	    else {
	    	$(this).parent('.single-settings').siblings('.cvgscenedata').show();
	    }
	});

	$(document).on("change",".chgscene",function(event) {
    	var chgscenedata = $(this).val();
    	if (chgscenedata == 'off') {
	    	$(this).parent('.single-settings').siblings('.chgscenedata').hide();
	    }
	    else {
	    	$(this).parent('.single-settings').siblings('.chgscenedata').show();
	    }
	});

	$(document).on("change",".czscene",function(event) {
    	var czscene = $(this).val();
    	if (czscene == 'off') {
	    	$(this).parent('.single-settings').siblings('.czscenedata').hide();
	    }
	    else {
	    	$(this).parent('.single-settings').siblings('.czscenedata').show();
	    }
	});

})( jQuery );