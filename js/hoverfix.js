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



 $('.grid').each( function(){

if($(this).hasClass('match-equal')){

$isoargs = {
  // options
  itemSelector: '.grid-item',
  columnWidth: '.grid-item',
  percentPosition: true,
  //gutter: 10,
  horizontalOrder: true,
  layoutMode : 'fitRows'
}


}

else if($(this).hasClass('image-grid')){

$isoargs = {
  // options
  itemSelector: '.grid-item',
  columnWidth: '.grid-item',
  percentPosition: true,
  //gutter: 10,
  horizontalOrder: true,
  layoutMode : 'masonry'
}


}

else{

  $isoargs = {
    // options
    itemSelector: '.grid-item',
    columnWidth: '.grid-item',
    percentPosition: true,
    //gutter: 10,
    horizontalOrder: true,
    layoutMode : 'masonry'
  }

}

 $(this).isotope($isoargs);

})

 $('.match-equal .grid-item .masonry-inner').matchHeight({

property: 'height',
byRow: false,

 });

 // bind filter button click
$('#filters').on( 'click', 'button', function() {
  var filterValue = $( this ).attr('data-filter');
  $(".filter-active").removeClass('filter-active');
  $(".grid").isotope({ filter: filterValue });
  $(this).addClass('filter-active');
});



})( jQuery ));
