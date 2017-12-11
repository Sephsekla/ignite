/**
 * Bespoke animations for the site go here.
 *
 */


jQuery(document).ready((function($){

$(".canhover" ).on( "tap", function( event ) {

if($(this).is(":hover")){

return false;

}

else if($(this).hasClass("hover")){

$(this).removeClass('hover');

}

else{

event.preventDefault();

$(this).addClass('hover');


}

 } )

 $('.grid').masonry({
   // options
   itemSelector: '.grid-item',
   columnWidth: '.grid-item',
   percentPosition: true,
   //gutter: 10,
   horizontalOrder: true
 });


})( jQuery ));
