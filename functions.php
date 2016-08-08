<?php

function apca_scripts() {
  wp_register_style('apca-main', get_stylesheet_directory_uri() . '/css/main.css', array('main'), '0.0.1');
  wp_enqueue_style('apca-main');
}
add_action('wp_enqueue_scripts', 'apca_scripts');

/*
 * Required plugins
 */
function apca_register_required_plugins() {
  $plugins = array(
    array(
      'name' => 'Advanced Custom Fields Repeater & Flexible Content Fields Collapser',
      'slug' => 'advanced-custom-field-repeater-collapser',
      'required' => true,
      'force_activation' => true
    )
  );
  if(defined('ACF_REPEATER_FIELD_KEY')) {
    $plugins[] = array(
      'name' => 'Advanced Custom Fields: Repeater Field',
      'slug' => 'repeater-field',
      'required' => true,
      'force_activation' => true,
      'source' => 'https://download.advancedcustomfields.com/' . ACF_REPEATER_FIELD_KEY . '/trunk/'
    );
  }
  if(defined('ACF_OPTIONS_PAGE_KEY')) {
    $plugins[] = array(
      'name' => 'Advanced Custom Fields: Options Page',
      'slug' => 'options-page',
      'required' => true,
      'force_activation' => true,
      'source' => 'https://download.advancedcustomfields.com/' . ACF_OPTIONS_PAGE_KEY . '/trunk/'
    );
  }
  $options = array(
    'default_path'  => '',
    'menu'      => 'apca-install-plugins',
    'has_notices'  => true,
    'dismissable'  => true,
    'dismiss_msg'  => '',
    'is_automatic'  => false,
    'message'    => ''
  );
  tgmpa($plugins, $options);
}
add_action('tgmpa_register', 'apca_register_required_plugins');

include_once(STYLESHEETPATH . '/inc/indicators.php');

function apca_disable_basins() {
  global $arp_basins;
  remove_action('init', array($arp_basins, 'register_post_type'));
  remove_action('init', array($arp_basins, 'register_field_group'));
  remove_filter('the_permalink', array($arp_basins, 'the_permalink'));
}
add_action('init', 'apca_disable_basins', 2);
