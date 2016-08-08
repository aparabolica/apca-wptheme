<?php

/*
 * APCA Indicators
 */

class APCA_Indicators {

  function __construct() {
    $this->register_options_page();
    add_action('init', array($this, 'register_post_type'));
    add_action('init', array($this, 'register_field_group'));
    add_action('init', array($this, 'register_options_field_group'));
    // add_action('init', array($this, 'register_options_page'), 100);
    add_action('pre_get_posts', array($this, 'pre_get_posts'));
  }

  function register_post_type() {

    $labels = array(
      'name'               => _x( 'Indicators', 'post type general name', 'apca' ),
      'singular_name'      => _x( 'Indicator', 'post type singular name', 'apca' ),
      'menu_name'          => _x( 'Indicators', 'admin menu', 'apca' ),
      'name_admin_bar'     => _x( 'Indicator', 'add new on admin bar', 'apca' ),
      'add_new'            => _x( 'Add new', 'indicator', 'apca' ),
      'add_new_item'       => __( 'Add new indicator', 'apca' ),
      'new_item'           => __( 'New indicator', 'apca' ),
      'edit_item'          => __( 'Edit indicator', 'apca' ),
      'view_item'          => __( 'View indicator', 'apca' ),
      'all_items'          => __( 'All indicators', 'apca' ),
      'search_items'       => __( 'Search indicators', 'apca' ),
      'parent_item_colon'  => __( 'Parent indicators:', 'apca' ),
      'not_found'          => __( 'No indicators found.', 'apca' ),
      'not_found_in_trash' => __( 'No indicators found in Trash.', 'apca' )
    );

    $args = array(
      'labels'             => $labels,
      'description'        => __( 'APCA Indicators', 'apca' ),
      'public'             => true,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'show_in_nav_menus'  => true,
      'show_in_menu'       => true,
      'query_var'          => true,
      'rewrite'            => array( 'slug' => 'indicators' ),
      'capability_type'    => 'post',
      'has_archive'        => true,
      'hierarchical'       => false,
      'menu_position'      => 5,
      'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' )
    );

    register_post_type( 'indicator', $args );

  }

  function get_wysiwyg_field() {
    $field = 'wysiwyg';
    if(function_exists('qtranxf_generateLanguageSelectCode')) {
      $field = 'qtranslate_wysiwyg';
    }
    return $field;
  }
  function get_textarea_field() {
    $field = 'textarea';
    if(function_exists('qtranxf_generateLanguageSelectCode')) {
      $field = 'qtranslate_textarea';
    }
    return $field;
  }
  function get_text_field() {
    $field = 'text';
    if(function_exists('qtranxf_generateLanguageSelectCode')) {
      $field = 'qtranslate_text';
    }
    return $field;
  }

  function get_status_image_url($post_id = false) {
    global $post;
    $post_id = $post_id ? $post_id : $post->ID;
    $status_field = get_field_object('indicator_status');
    $status_value = get_field('indicator_status');
    $img = get_stylesheet_directory_uri() . '/img';
    switch ($status_value) {
      case 1:
        $img .= '/indicator_01_.png';
        break;
      case 2:
        $img .= '/indicator_02_.png';
        break;
      case 3:
        $img .= '/indicator_03_.png';
        break;
      default:
        $img = '';
        break;
    }
    return $img;
  }


  function register_field_group() {
    if(function_exists("register_field_group")) {
    	register_field_group(array (
    		'id' => 'acf_indicator_data',
    		'title' => __('Indicator data', 'apca'),
    		'fields' => array (
    			array (
    				'key' => 'field_indicator_status_text',
    				'label' => __('Indicator status text', 'apca'),
    				'name' => 'indicator_status_text',
    				'type' => $this->get_textarea_field(),
    				'default_value' => '',
    				'placeholder' => '',
    				'maxlength' => '',
    				'rows' => '',
    				'formatting' => 'br',
    			),
    			array (
    				'key' => 'field_indicator_status',
    				'label' => __('Indicator status', 'apca'),
    				'name' => 'indicator_status',
    				'type' => 'select',
    				'choices' => array (
    					1 => __('Not accomplished', 'apca'),
    					2 => __('Partially accomplished', 'apca'),
    					3 => __('Accomplished', 'apca'),
    				),
    				'default_value' => 1,
    				'allow_null' => 0,
    				'multiple' => 0,
    			),
          array (
            'key' => 'field_indicator_links',
            'label' => __('Indicator links', 'apca'),
            'name' => 'indicator_links',
            'type' => 'repeater',
            'instructions' => __('Add custom links to the indicator', 'apca'),
            'sub_fields' => array (
              array (
                'key' => 'field_link_url',
                'label' => __('Link URL', 'apca'),
                'name' => 'link_url',
                'type' => 'text',
                'required' => 1,
                'column_width' => '',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
              ),
              array (
                'key' => 'field_link_title',
                'label' => __('Link title', 'apca'),
                'name' => 'link_title',
                'type' => 'text',
                'required' => 1,
                'column_width' => '',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
              ),
            ),
            'row_min' => '',
            'row_limit' => '',
            'layout' => 'table',
            'button_label' => __('Add Row', 'apca'),
          ),
    		),
    		'location' => array (
    			array (
    				array (
    					'param' => 'post_type',
    					'operator' => '==',
    					'value' => 'indicator',
    					'order_no' => 0,
    					'group_no' => 0,
    				),
    			),
    		),
    		'options' => array (
    			'position' => 'normal',
    			'layout' => 'no_box',
    			'hide_on_screen' => array (
    			),
    		),
    		'menu_order' => 0,
    	));
    }
  }

  function register_options_page() {
    if(function_exists('acf_add_options_sub_page')) {
      acf_add_options_sub_page(array(
        'title' => __('Indicator settings', 'apca'),
        'parent' => 'edit.php?post_type=indicator'
      ));
    }
  }

  function register_options_field_group() {
    if(function_exists("register_field_group")) {
    	register_field_group(array (
    		'id' => 'acf_indicator-settings',
    		'title' => 'Indicator Settings',
    		'fields' => array (
    			array (
    				'key' => 'field_indicator_page_content',
    				'label' => __('Page content', 'apca'),
    				'name' => 'indicator_page_content',
    				'type' => $this->get_wysiwyg_field(),
    				'default_value' => '',
    				'toolbar' => 'full',
    				'media_upload' => 'yes',
    			),
    			array (
    				'key' => 'field_indicator_page_disclaimer',
    				'label' => __('Page disclaimer', 'apca'),
    				'name' => 'indicator_page_disclaimer',
    				'type' => $this->get_wysiwyg_field(),
    				'default_value' => '',
    				'toolbar' => 'full',
    				'media_upload' => 'yes',
    			),
    		),
    		'location' => array (
    			array (
    				array (
    					'param' => 'options_page',
    					'operator' => '==',
    					'value' => 'acf-options-indicator-settings',
    					'order_no' => 0,
    					'group_no' => 0,
    				),
    			),
    		),
    		'options' => array (
    			'position' => 'normal',
    			'layout' => 'no_box',
    			'hide_on_screen' => array (
    			),
    		),
    		'menu_order' => 0,
    	));
    }

  }

  function pre_get_posts($query) {
    if($query->get('post_type') == 'indicator' || $query->get('post_type') == array('indicator')) {
      $query->set('orderby', 'name');
      $query->set('order', 'ASC');
    }
  }
}

$apca_indicators = new APCA_Indicators();

function apca_get_indicator_status_image_url($post_id = false) {
  global $apca_indicators;
  return $apca_indicators->get_status_image_url($post_id);
}
