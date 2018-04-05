/**
 * Bespoke animations for the site go here.
 *
 */

jQuery(document).ready((function($){


$("body" ).on( "tap",".canhover", function() {

if(!$(this).is(".canhover:hover")){

if($(this).hasClass("hover")){

$(this).removeClass('hover');

}

else{

event.preventDefault();


$(this).addClass('hover');


}
}
else{


}


 } )


var $grid = [];

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

 var $grid = $(this).isotope($isoargs);


 $grid.imagesLoaded().progress( function() {
$grid.isotope('layout');
});

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

if($('#filters').hasClass('initial-filter')){

var filterValue = $( '.filter-active' ).attr('data-filter');

$(".grid").isotope({ filter: filterValue });

}

})( jQuery ));
