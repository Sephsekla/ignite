/**
 * Bespoke animations for the site go here.
 *
 */


jQuery(document).ready((function($){


pageno = false;

$('#loadmore').click(

function(event){

  $('#loadmore').addClass('loading');

console.log(ajaxpagination.max_page);


  if(pageno == false){

pageno = ajaxpagination.query_page;

if(pageno == 0 || pageno == null){

  pageno = 1;
//console.log("Let's add one");

}

  }

  //console.log(pageno);

  pageno++;

  event.preventDefault();
	$.ajax({
		url: ajaxpagination.ajaxurl,
		type: 'post',
		data: {
			action: 'ajax_pagination',
      query_vars: ajaxpagination.query_vars,
      query_page: pageno
		},
		success: function( result ) {

      // jQuery

      var $grid = $('.grid').data('isotope');
      var $items = $(result);
// append items to grid
$('.grid').append( $items )
  // add and lay out newly appended items
  .isotope( 'appended', $items );

  $('#loadmore').removeClass('loading');

if(ajaxpagination.max_page <= pageno){

$('#loadmore').remove();

}


		}
	})
}

);




})( jQuery ));
