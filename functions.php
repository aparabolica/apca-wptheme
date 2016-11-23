<?php

function apca_scripts() {
  wp_register_style('apca-main', get_stylesheet_directory_uri() . '/css/main.css', array('main'), '0.1.2');
  wp_enqueue_style('apca-main');
}
add_action('wp_enqueue_scripts', 'apca_scripts');

/*
 * Setup theme
 */
function apca_setup_theme() {
  load_child_theme_textdomain('apca', get_stylesheet_directory() . '/languages');
}
add_action('after_setup_theme', 'apca_setup_theme');

/**
 * Register our sidebars and widgetized areas.
 *
 */
function apca_widgets_init() {

	register_sidebar( array(
		'name'          => __('Footer sidebar', 'apca'),
		'id'            => 'footer',
		'before_widget' => '<div class="widget-item">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'apca_widgets_init' );

include_once(STYLESHEETPATH . '/inc/countries.php');
include_once(STYLESHEETPATH . '/inc/indicators.php');
include_once(STYLESHEETPATH . '/inc/custom-featured-image.php');

function apca_disable_basins() {
  global $arp_basins;
  remove_action('init', array($arp_basins, 'register_post_type'));
  remove_action('init', array($arp_basins, 'register_field_group'));
  remove_filter('the_permalink', array($arp_basins, 'the_permalink'));
}
add_action('init', 'apca_disable_basins', 2);

function apca_country_post_meta() {
  the_terms(get_the_ID(), 'country', '<p class="country"><span class="fa fa-globe"></span>', ', ', '</p>');
}
add_action('arp_pre_single_post_meta', 'apca_country_post_meta');

function apca_country_ordered_query($query) {
  $cats = array(
    'policy-documents',
    'public-policies'
  );
  $country_ordered = false;
  if(!is_admin() && $query->is_category()) {
    // Country ordered cat
    foreach($cats as $cat) {
      if($query->is_category($cat))
        $country_ordered = true;
    }
    if(!$country_ordered) {
      // Country ordered subcat
      $term = $query->get_queried_object();
      if($term->parent) {
        $parent = get_term($term->parent);
        if(in_array($parent->slug, $cats)) {
          $country_ordered = true;
        }
      }
    }
  }
  if($country_ordered) {
    $query->set('orderby', 'meta_value');
    $query->set('meta_key', '_countries');
    $query->set('order', 'ASC');
  }
}
add_action('pre_get_posts', 'apca_country_ordered_query');
