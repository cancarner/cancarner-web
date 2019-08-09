var header = 80;

jQuery(document).ready(function(){
    jQuery("div:not(.hide-desktop).sticky-shortcode").sticky({topSpacing: header + 5, bottomSpacing: 50});
    jQuery(".participa-link").click(function(ev){
        ev.preventDefault();
        jQuery('html, body').animate({
            scrollTop: jQuery('#titols-participatius').offset().top - header
        }, 1200);
    })
});
