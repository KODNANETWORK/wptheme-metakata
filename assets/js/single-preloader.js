/**
 * File animations.js.
 *
 * @summary Preloading element before page is fully loaded
 *
 * @author KODNA.net
 * @package MetaKata
 * @since 0
 */

( function($){

$(window).load(function() {
$(".loader").delay(2000).fadeOut("slow");
$("#overlayer").delay(2000).fadeOut("slow");
});

})(jQuery);
