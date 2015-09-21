(function($) {

Drupal.behaviors.ajax_redirect = {
  attach: function(context, settings) {

    // Only do something if enabled and redirection was not applied yet.
    if (!settings['ajax_redirect_callback']) {
      return;
    }
    if ($.cookie('ajax_redirect') != settings['ajax_redirect_required_cookie_value']) {
      var element = $(document.body);

      // Define a custom event and trigger it to init ajax.
      $(element).on('AjaxInit',function() {
      });

      function writeCookie() {
        $.cookie('ajax_redirect', settings['ajax_redirect_required_cookie_value'], {
          expires: parseInt(settings['ajax_redirect_expires']),
          path: '/'
        });
      }

      var ajax = new Drupal.ajax(null, $(element), {
        url: settings['ajax_redirect_callback'],
        settings: {},
        prevent: false,
        keypress: false,
        event: 'AjaxInit'
      });

      ajax.options.data['url'] = window.location.href;
      ajax.options.complete = function (response, status) {
        // Write cookie in any case, then invoke regular error handling.
        writeCookie();

        ajax.ajaxing = false;
        if (status == 'error' || status == 'parsererror') {
          return ajax.error(response, ajax.url);
        }
      };

      $(element).trigger('AjaxInit');
    }
  }
};

})(jQuery);
