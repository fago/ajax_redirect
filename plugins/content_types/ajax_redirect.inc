<?php

/**
 * @file
 * CTools content type plugin.
 */

$plugin = array(
  'title' => t('Ajax redirect'),
  'single' => TRUE,
  'description' => t('Checks for redirects via an Ajax request and issues determined redirects via Javascript.'),
  'icon' => 'icon_core_block.png',
  'category' => t('Miscellaneous'),
);

/**
 * Content type render callback.
 */
function ajax_redirect_ajax_redirect_content_type_render($subtype, $conf, $args) {
  $block = new stdClass();
  // Attach our behaviour and enable it.
  $block->content = array(
    '#attached' => array(
      'library' => array(
        array('system', 'jquery.cookie'),
        array('system', 'drupal.ajax'),
      ),
      'js' => array(drupal_get_path('module', 'ajax_redirect') . '/js/ajax_redirect.js'),
    ),
  );
  $block->content['#attached']['js'][] = array(
    'data' => array(
      'ajax_redirect_callback' => url('system/ajax_redirect'),
      // By default, forget about redirection after 1 day.
      'ajax_redirect_expires' => variable_get('ajax_redirect_expire', 1),
    ),
    'type' => 'setting'
  );
  return $block;
}

/**
 * Admin info callback,
 */
function ajax_redirect_ajax_redirect_content_type_admin_info($subtype, $conf) {
  $block = new stdClass;
  $block->title = t('Ajax redirect');
  $block->content = t('Checks for redirects via an Ajax request and issues determined redirects via Javascript.');
  return $block;
}

/**
 * Edit form.
 */
function ajax_redirect_ajax_redirect_content_type_edit_form($form, &$form_state) {

  return $form;
}
