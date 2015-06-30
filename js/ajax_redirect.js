(function($) {

Drupal.behaviors.ajax_redirect = {
  attach: function(context, settings) {

    // Only do something if enabled and redirection was not applied yet.
    if (settings['ajax_redirect_callback'] && !$.cookie('ajax_redirect')) {

      // Define a custom event and trigger it to init ajax.
      $(context).on('AjaxInit',function() {
        $.cookie('ajax_redirect', '1', { expires: parseInt(settings['ajax_redirect_expires']), path: '/' });
      });

      var ajax = new Drupal.ajax(null, $(context), {
        url: settings['ajax_redirect_callback'],
        settings: {},
        prevent: false,
        keypress: false,
        event: 'AjaxInit'
      });

      ajax.options.data['url'] = window.location.href;

      $(context).trigger('AjaxInit');
    }
  }
};

})(jQuery);
