<?php 

/**
 *  Register Field Groups
 *
 *  The register_field_group function accepts 1 array which holds the relevant data to register a field group
 *  You may edit the array as you see fit. However, this may result in errors if the array is not compatible with ACF
 */

  if(function_exists("register_field_group"))
  {

    register_field_group(array (
      'id' => 'acf_feature-block-extention',
      'title' => 'Feature block extention',
      'fields' => array (
        array (
          'key' => 'field_5232c844cf203',
          'label' => 'Link',
          'name' => 'link',
          'type' => 'text',
          'instructions' => 'Where should this block lead to? Both relative and absolute urls are allowed.',
          'default_value' => '',
          'placeholder' => '',
          'prepend' => '',
          'append' => '',
          'formatting' => 'none',
          'maxlength' => '',
        ),
      ),
      'location' => array (
        array (
          array (
            'param' => 'post_type',
            'operator' => '==',
            'value' => 'st_hpfeatures',
            'order_no' => 0,
            'group_no' => 0,
          ),
        ),
      ),
      'options' => array (
        'position' => 'acf_after_title',
        'layout' => 'no_box',
        'hide_on_screen' => array (
        ),
      ),
      'menu_order' => 0,
    ));
  }
  
  