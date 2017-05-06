$(document).ready(function(){
			jQuery('.ambitios_slider').fadeIn(300);
			if ($("#s4").length) {
			$.fn.cycle.defaults.timeout = 6000;
					$(function() {
					// run the code in the markup!
					$('#s4').before('<div id="nav" class="nav">').cycle({
						fx:     'fade',
						speed:  'slow',
						autostopCount:   4,
						autostop:   4,
						timeout: 6000,
						pager:  '#nav'
					});
					});
				};
		    if ($("#featureCarousel").length) {
			$(document).ready(function() {
								$("#featureCarousel").featureCarousel({
								});
			});
			};
			$.fn.equalHeight = function() {
				var group = this;
				$(window).bind('resize', function(){
				var tallest = 0;
				$(group).height('auto').each(function() {
				tallest = Math.max(tallest, $(this).height());
				}).height(tallest);
				}).trigger('resize');
			}
			// prettyPhoto
			if ($(".ambitios_lightbox_image").length) {
			$("a[rel^='prettyPhoto']").prettyPhoto({theme:'facebook'});
			};		
			// lightbox image
			$(".ambitios_lightbox_image").append("<span></span>")
					
			$(".ambitios_lightbox_image").hover(function(){
				$(this).find("img").stop().animate({opacity:0.5}, "normal")
			}, function(){
				$(this).find("img").stop().animate({opacity:1}, "normal")
			});
			$(".ambitios_lightbox_video").append("<span></span>")
				
			$(".ambitios_lightbox_video").hover(function(){
				$(this).find("img").stop().animate({opacity:0.5}, "normal")
			}, function(){
				$(this).find("img").stop().animate({opacity:1}, "normal")
			});

			$('#toc a').click(function(){//$.scrollTo works EXACTLY the same way, but scrolls the whole screen
				$.scrollTo( this.hash, 1500);
				$(this.hash).find('#options-examples').text( this.title );
				return false;
			});
			$(".ambitios_height").equalHeight();
						jQuery('ul.ambitios_menu').superfish();
						
						function ajaxContact(theForm) {
		var $ = jQuery;
	
        $('#loader').fadeIn();

        var formData = $(theForm).serialize(),
			note = $('#Note');
	
        $.ajax({
            type: "POST",
            url: "send.php",
            data: formData,
            success: function(response) {
				if ( note.height() ) {			
					note.fadeIn('fast', function() { $(this).hide(); });
				} else {
					note.hide();
				}

				$('#LoadingGraphic').fadeOut('fast', function() {
					//$(this).remove();
					if (response === 'success') {
						$('.field').animate({opacity: 0},'fast');
					}

					// Message Sent? Show the 'Thank You' message and hide the form
					result = '';
					c = '';
					if (response === 'success') { 
						result = 'Your message has been sent. Thank you!';
						c = 'success';
					}

					note.removeClass('success').removeClass('error').text('');
					var i = setInterval(function() {
						if ( !note.is(':visible') ) {
							note.html(result).addClass(c).slideDown('fast');
							clearInterval(i);
						}
					}, 40);    
				});
            }
        });

        return false;
    }
	if ($("#contactform").length) {
	jQuery("#contactform").validate({
			submitHandler: function(form) {				
				ajaxContact(form);
				return false;
			},
			 messages: {
    		 formname: "Please specify your name.",
			 formcomments: "Please enter your message.",
    		 formemail: {
      			 required: "We need your email address to contact you.",
      			 email: "Your email address must be in the format of name@domain.com"
    		 }
  		 }
		});
		 }
	});
	
	
	$(document).ready(function(){
	 function ajaxContact(theForm) {
		var $ = jQuery;
	
        $('#loader2').fadeIn();

        var formData = $(theForm).serialize(),
			note = $('#Note2');
	
        $.ajax({
            type: "POST",
            url: "send.php",
            data: formData,
            success: function(response) {
				if ( note.height() ) {			
					note.fadeIn('fast', function() { $(this).hide(); });
				} else {
					note.hide();
				}

				$('#LoadingGraphic2').fadeOut('fast', function() {
					//$(this).remove();
					if (response === 'success') {
						$('.field2').animate({opacity: 0},'fast');
						$('.ambitios_input').animate({opacity: 0},'fast');
					}

					// Message Sent? Show the 'Thank You' message and hide the form
					result = '';
					c = '';
					if (response === 'success') { 
						result = 'Your message has been sent. Thank you!';
						c = 'success';
					}

					note.removeClass('success').removeClass('error').text('');
					var i = setInterval(function() {
						if ( !note.is(':visible') ) {
							note.html(result).addClass(c).slideDown('fast');
							clearInterval(i);
						}
					}, 40);    
				});
            }
        });

        return false;
    }
	if ($("#contactform2").length) {
	jQuery("#contactform2").validate({
			submitHandler: function(form) {				
				ajaxContact(form);
				return false;
			},
			 messages: {
    		 formname: "Please specify your name.",
			 formcomments: "Please enter your message.",
    		 formemail: {
      			 required: "We need your email address to contact you.",
      			 email: "Your email address must be in the format of name@domain.com"
    		 }
  		 }
		});
		 }
	});