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
