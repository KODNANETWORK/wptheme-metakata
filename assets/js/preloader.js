/**
 * File preloader.js.
 *
 * @summary Preloading element before page is fully loaded
 *
 * @author KODNA.net
 * @package
 * @since
 */

( function($){
// 5
  var duration = 2;
  var loaded = null;
  var loadListener = function(){
  	document.body.className += " loaded";
  }
  window.setTimeout(function(){
  	if(loaded == true)loadListener();
  },duration*1000);
  window.addEventListener("load",function(){
  	if(loaded == null)loaded = true;
  		else loadListener();
  });

})(jQuery);
