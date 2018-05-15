/**
 * Bespoke animations for the site go here.
 *
 */

( function( $ ) {

/*********
Add functions There
*********/

function smoothscroll(){

// Select all links with hashes
$('a[href*="#"]')
  // Remove links that don't actually link to anything
  .not('[href="#"]')
  .not('[href="#0"]')
  .click(function(event) {
    // On-page links
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
      &&
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();

if($('#site-navigation').hasClass("toggled")){

$('#site-navigation').removeClass("toggled")

$('.menu-toggle').attr('aria-expanded',false);

}


        $('html, body').animate({
          scrollTop: target.offset().top
        }, 700, function() {
          // Callback after animation
          // Must change focus!
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          };
        });
      }
    }
  });

}

function scrollOnLoad() {

  try {
		//take HREF and split at anchor
		var $_elem = $('#' + $(location).attr('href').split('#')[1]);
		//find class of anchor element
		var $_others = $('.' + $_elem.attr('class'));
		//measure window height and element height
		//if the window height is smaller that twice the element height, then use regular offset
		//if not, use calculated window height
		var wHeight = ($(window).height() < ($_elem.height() * 2)) ? 0 : $(window).height() - ($_elem.height() * 2);
		var offset = $_elem.offset();
		var offsetTop = offset.top - wHeight;

		//console.log(wHeight);

		$(window).load(function () {
			$('body, html').scrollTop(0);
			$('body, html').delay(500).animate({ opacity: 1, scrollTop: offsetTop }, 'slow', function () {
				$_others.not($_elem).animate({ opacity: '.3' }).delay(5000).animate({ opacity: '1' }).stop();
			});
		});

	} catch (err) {

		return false;

	}
}

$(document).ready(function(){smoothscroll();


scrollOnLoad();

});



} )( jQuery );
