jQuery(document).ready(function() {
  jQuery(window).load(function() {
    jQuery('.video-bg').each(function(index, el) {
      jQuery(el).data('vide').getVideoObject().play();
    });
  });
});