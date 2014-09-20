jQuery(function($) {

//	$('.front section.main-content').html();
	
	
	/* Kalender */

	$('.view-kalender .date-prev a').addClass('button');
	$('.view-kalender .date-next a').addClass('button');

	$('.view-kalender .date-next').click(function () {
		setTimeout(function() {
			$('.view-kalender .date-next a').addClass('button');
		}, 5000);
	});

	$('#views_slideshow_controls_text_previous_slideblocks-block').html('<div class="slidecontrols_prev"><ul class="flex-direction-nav"><li><a class="flex-prev" href="#">Zurück</a></li></ul></div>');
	$('#views_slideshow_controls_text_next_slideblocks-block').html('<div class="slidecontrols_next"><ul class="flex-direction-nav"><li><a class="flex-next" href="#">Weiter</a></li></ul></div>');
	$('#views_slideshow_controls_text_previous_slideblocks-block_1').html('<div class="slidecontrols_prev"><ul class="flex-direction-nav"><li><a class="flex-prev" href="#">Zurück</a></li></ul></div>');
	$('#views_slideshow_controls_text_next_slideblocks-block_1').html('<div class="slidecontrols_next"><ul class="flex-direction-nav"><li><a class="flex-next" href="#">Weiter</a></li></ul></div>');
	
	
	/* Hessen Highlight */
	
	$('.field-collection-container .field-item .field-name-field-bundesland .field-item').each(function() {
	
	var thisOne=$(this).html();
	var papi=$(this).parent('.field-items').parent('.field-name-field-bundesland').parent('.content').parent('.field-collection-item-field-kontakt');
	papi.addClass(thisOne);
	});
	

	
});


