(function($) {
  "use strict";
  // toggle mobile menu
  $('#hamburger').click(function() {
    $(this).toggleClass('active');
    $('#header .menu').toggleClass('active');
  });
}(jQuery));
