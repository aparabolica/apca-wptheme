<?php

class APCA_Countries {

  function __construct() {
    add_action('init', array($this, 'register_taxonomy'));
    add_action('save_post', array($this, 'save_post'));
  }

  function register_taxonomy() {
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
      'name'              => _x( 'Countries', 'taxonomy general name', 'apca' ),
      'singular_name'     => _x( 'Country', 'taxonomy singular name', 'apca' ),
      'search_items'      => __( 'Search Countries', 'apca' ),
      'all_items'         => __( 'All Countries', 'apca' ),
      'parent_item'       => __( 'Parent Country', 'apca' ),
      'parent_item_colon' => __( 'Parent Country:', 'apca' ),
      'edit_item'         => __( 'Edit Country', 'apca' ),
      'update_item'       => __( 'Update Country', 'apca' ),
      'add_new_item'      => __( 'Add New Country', 'apca' ),
      'new_item_name'     => __( 'New Country Name', 'apca' ),
      'menu_name'         => __( 'Countries', 'apca' ),
    );

    $args = array(
      'hierarchical'      => false,
      'labels'            => $labels,
      'show_ui'           => true,
      'show_admin_column' => true,
      'query_var'         => true,
      'rewrite'           => array( 'slug' => 'country' ),
    );

    register_taxonomy( 'country', array( 'post' ), $args );
  }

  function save_post($post_id) {

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
      return;
    // AJAX? Not used here
    if ( defined( 'DOING_AJAX' ) && DOING_AJAX )
      return;
    // Check user permissions
    if ( ! current_user_can( 'edit_post', $post_id ) )
      return;
    if ( wp_is_post_revision( $post_id ) )
      return;

    $post_countries = wp_get_post_terms($post_id, 'country', array(
      'orderby' => 'name',
      'order' => 'ASC'
    ));

    $countries = array();

    foreach($post_countries as $country) {
      $countries[] = $country->name;
    }

    update_post_meta($post_id, '_countries', implode(',', $countries));

  }

}

new APCA_Countries();
