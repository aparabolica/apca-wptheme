<?php

/*
 * APCA
 * Custom featured image
 */

class APCA_Custom_Featured_Image {

  function __construct() {
    add_action('init', array($this, 'register_field_group'));
    add_filter('get_post_metadata', array($this, 'get_custom_thumbnail_id'), 100, 4);
  }

  function register_field_group() {
    if(function_exists("register_field_group")) {
    	register_field_group(array (
    		'id' => 'acf_featured-image',
    		'title' => __('Featured image for lists', 'apca'),
    		'fields' => array (
    			array (
    				'key' => 'field_featured_image',
    				'label' => __('Image', 'apca'),
    				'name' => 'featured_image',
    				'type' => 'image',
    				'save_format' => 'object',
    				'preview_size' => 'thumbnail',
    				'library' => 'all',
    			),
    		),
    		'location' => array (
    			array (
    				array (
    					'param' => 'post_type',
    					'operator' => '==',
    					'value' => 'post',
    					'order_no' => 0,
    					'group_no' => 0,
    				),
    			),
    		),
    		'options' => array (
    			'position' => 'side',
    			'layout' => 'default',
    			'hide_on_screen' => array (
    			),
    		),
    		'menu_order' => 0,
    	));
    }
  }

  function get_custom_thumbnail_id($metadata, $object_id, $meta_key, $single) {
    if($meta_key == '_thumbnail_id') {
      remove_filter('get_post_metadata', array($this, 'get_custom_thumbnail_id'));
      $custom = get_field('featured_image');
      if(!is_single() && $custom) {
        $metadata = $custom['id'];
      }
      add_filter('get_post_metadata', array($this, 'get_custom_thumbnail_id'), 100, 4);
    }
    return $metadata;
  }

}

new APCA_Custom_Featured_Image();
