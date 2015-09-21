<?php

/**
 * @file
 * Contains code to answer ajax requests.
 */

/**
 * Alter the direct URL.
 *
 * @param string|null $url
 *   The redirection target. Either an absolute URL, a Drupal system path, or
 *   NULL to skip redirecting.
 * @param array $options
 *   An array of options used for generating the url via url().
 * @param array $current_url
 *   The URL of the page triggering the AJAX request, represented as array as
 *   returned from parse_url().
 */
function hook_ajax_redirect_url_alter(&$url, array &$options, array $current_url) {
  // Customize the response on a special page.
  if ($current_url['path'] == 'special-page' && $GLOBALS['language']->langcode) {
    $url = 'de/special-page';
  }
}

/**
 * Alter redirection ajax commands.
 *
 * @param array $commands
 *   An array of ajax commands to be sent to the client.
 * @param array $current_url
 *   The URL of the page triggering the AJAX request, represented as array as
 *   returned from parse_url().
 */
function hook_ajax_redirect_commands_alter(&$commands, array $current_url) {
  // Customize the response on a special page.
  if ($current_url['path'] == 'special-page') {
    unset($commands[0]);
  }
}

/**
 * Alter ajax redirect JS settings.
 *
 * @param array $settings
 *   All Drupal JS settings forwarded to ajax redirect javascript. Interesting
 *   setting values are:
 *     - ajax_redirect_required_cookie_value: The required cookie value for the
 *     current page. Cookies not having the given value will be ignored and
 *     redirection triggered. If a cookie is written, the given value is used.
 *     The value defaults to 1.
 */
function hook_ajax_redirect_settings_alter(&$settings) {
  if (drupal_is_front_page()) {
    $settings['ajax_redirect_required_cookie_value'] = 'front';
  }
}
