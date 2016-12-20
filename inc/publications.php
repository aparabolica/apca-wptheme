<?php

/*
* APCA Publications
*/

class APCA_Publications {
  function __construct() {
    add_action('init', array($this, 'register_field_group'));
  }
  function get_file_field() {
    $field = 'file';
    if(function_exists('qtranxf_generateLanguageSelectCode')) {
      $field = 'qtranslate_file';
    }
    return $field;
  }
  function register_field_group() {
    acf_add_local_field_group(array (
      'key' => 'group_publication',
      'title' => __('Publication', 'apca'),
      'fields' => array (
        array (
          'key' => 'field_publication_file',
          'label' => __('Publication file', 'apca'),
          'name' => 'publication_file',
          'type' => $this->get_file_field(),
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'return_format' => 'url',
          'library' => 'all',
          'min_size' => '',
          'max_size' => '',
          'mime_types' => '',
        ),
      ),
      'location' => array (
        array (
          array (
            'param' => 'post_category',
            'operator' => '==',
            'value' => 'category:publications',
          ),
        ),
      ),
      'menu_order' => 0,
      'position' => 'normal',
      'style' => 'default',
      'label_placement' => 'top',
      'instruction_placement' => 'label',
      'hide_on_screen' => '',
      'active' => 1,
      'description' => '',
    ));
  }
}
new APCA_Publications();
