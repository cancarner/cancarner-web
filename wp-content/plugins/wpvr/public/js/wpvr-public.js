(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
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

})( jQuery );

function wpvrhotspot(hotSpotDiv, args) {
	var argst = args.replace(/\\/g, '');
	jQuery(document).ready(function($){
		$(hotSpotDiv.target).parent().siblings(".custom-ifram").html(argst);
		$(hotSpotDiv.target).parent().siblings(".custom-ifram").fadeToggle();
		$(hotSpotDiv.target).parent().parent(".pano-wrap").toggleClass("show-modal");
        
	});
    console.log(hotSpotDiv);
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
    
	$(".cross").on("click", function(e){
		e.preventDefault();
		$(this).siblings(".custom-ifram").fadeOut();
		$(this).parent(".pano-wrap").removeClass("show-modal");
		$('iframe').attr('src', $('iframe').attr('src'));
	 });
 });
// jQuery(document).ready(function($){
// 	$('.pnlm-orientation-button').hide();        
// });



