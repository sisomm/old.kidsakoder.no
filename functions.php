<?php

/**
 *  Use Advanced Custom Field as a part of theme
 *
 */

define( 'ACF_LITE', true );
include_once('advanced-custom-fields/acf.php');

/**
 *  Install Add-ons
 *
 *  The following code will include all 4 premium Add-Ons in your theme.
 *  Please do not attempt to include a file which does not exist. This will produce an error.
 *
 *  The following code assumes you have a folder 'add-ons' inside your theme.
 *
 *  IMPORTANT
 *  Add-ons may be included in a premium theme/plugin as outlined in the terms and conditions.
 *  For more information, please read:
 *  - http://www.advancedcustomfields.com/terms-conditions/
 *  - http://www.advancedcustomfields.com/resources/getting-started/including-lite-mode-in-a-plugin-theme/
 */

// Add-ons
// include_once('add-ons/acf-repeater/acf-repeater.php');
// include_once('add-ons/acf-gallery/acf-gallery.php');
// include_once('add-ons/acf-flexible-content/acf-flexible-content.php');
// include_once( 'add-ons/acf-options-page/acf-options-page.php' );

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
  
  
/**
 *  Register Custom taxonomy
 *
 */
 
function custom_taxonomy()  {

	$labels = array(
		'name'                       => _x( 'Locations', 'Taxonomy General Name', 'lkk' ),
		'singular_name'              => _x( 'Location', 'Taxonomy Singular Name', 'lkk' ),
		'menu_name'                  => __( 'Locations', 'lkk' ),
		'all_items'                  => __( 'All Locations', 'lkk' ),
		'parent_item'                => __( 'Parent Location', 'lkk' ),
		'parent_item_colon'          => __( 'Parent Location:', 'lkk' ),
		'new_item_name'              => __( 'New Location', 'lkk' ),
		'add_new_item'               => __( 'Add New Location', 'lkk' ),
		'edit_item'                  => __( 'Edit Location', 'lkk' ),
		'update_item'                => __( 'Update Location', 'lkk' ),
		'separate_items_with_commas' => __( 'Separate locations with commas', 'lkk' ),
		'search_items'               => __( 'Search locations', 'lkk' ),
		'add_or_remove_items'        => __( 'Add or remove locations', 'lkk' ),
		'choose_from_most_used'      => __( 'Choose from the most used locations', 'lkk' ),
	);
	$rewrite = array(
		'slug'                       => 'location',
		'with_front'                 => true,
		'hierarchical'               => true,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'query_var'                  => 'lkk_location',
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'lkk_location', 'post', $args );

}

// Hook into the 'init' action
add_action( 'init', 'custom_taxonomy', 0 );


/**
 * Adds Groups_Posts_Widget widget.
 */
 
class LKK_Group_Posts_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'lkk_group_posts_widget', // Base ID
			__('(LKK) Group Posts', 'lkk'), // Name
			array( 'description' => __( 'Pulls blogpost from same location as group', 'lkk' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from  database.
	 */
	 
	public function widget( $args, $instance ) {		
		
		$group_slug_with_hirarchy = bp_get_current_group_slug();
		$group_slug = array_pop(explode('/', $group_slug_with_hirarchy));
		$group_location = str_replace('kodeklubben-', '', $group_slug);
		
		$group_location_name = get_term_by( 'slug', $group_location, 'lkk_location', 'ARRAY_A' )['name'];
    
    if($group_location_name) {
  
  		$title = __('News from ', 'lkk').' '.$group_location_name;
  		
      echo $args['before_widget'];
      
      echo $args['before_title'] . $title . $args['after_title'];
  		
      $loction_args = array( 'lkk_location' => $group_location, 'posts_per_page' => 5 );
      $location_posts = new WP_Query($loction_args);
      
      if($location_posts->have_posts()) {
           
        ?>
        
          <ul>
        
        <?php        
        
        while($location_posts->have_posts()) : 
          $location_posts->the_post();   
          
        ?>
          <li><a href="<?php the_permalink() ?>"><?php the_title() ?></a></li>
        <?php        
        
        endwhile;
        
        ?>
          </ul>
          
          <p>
            <a href="<?php echo get_term_link($group_location, 'lkk_location') ?>"><?php _e('View all posts from', 'lkk')?> <?php echo $group_location_name ?></a>
          </p>
        
        <?php        
        
      } else {
          _e('No news from', lkk); echo ' '.$group_location_name.'.';
      }
      
      echo $args['after_widget'];
    }
    
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

    ?>
		<p>
      <?php _e('This widget will create a list of posts from the same location as the group, if possible.', 'lkk')?>
		</p>
		<?php 
	}

} // class Group_Posts_Widget

// register Group_Posts_Widget widget
function register_lkk_group_posts_widget() {
    register_widget( 'LKK_Group_Posts_Widget' );
}

add_action( 'widgets_init', 'register_lkk_group_posts_widget' );

/**
 * Adds Codeclub_Posts_Widget widget.
 */
 
class LKK_Codeclub_Posts_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'lkk_codeclub_posts_widget', // Base ID
			__('(LKK) Codeclub Posts', 'lkk'), // Name
			array( 'description' => __( 'Pulls blogpost about codeclub if the group is a codeclub', 'lkk' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from  database.
	 */
	 
	public function widget( $args, $instance ) {		
		
		$group_slug_with_hirarchy = bp_get_current_group_slug();
		$group_slug = array_pop(explode('/', $group_slug_with_hirarchy));
    $group_is_codeclub = strpos($group_slug,'kodeklubb') !== false;
    
    if($group_is_codeclub) {
  
  		$title = __('News from Kodeklubben', 'lkk');
  		
      echo $args['before_widget'];
      
      echo $args['before_title'] . $title . $args['after_title'];
  		
      $codeclub_args = array( 'category_name' => 'kodeklubben', 'posts_per_page' => 5 );
      $codeclub_posts = new WP_Query($codeclub_args);
      
      if($codeclub_posts->have_posts()) {
           
        ?>
        
          <ul>
        
        <?php        
        
        while($codeclub_posts->have_posts()) : 
          $codeclub_posts->the_post();   
          
        ?>
          <li><a href="<?php the_permalink() ?>"><?php the_title() ?></a></li>
        <?php        
        
        endwhile;
        
        ?>
          </ul>
          
          <p>
            <a href="<?php echo get_term_link('kodeklubben', 'category') ?>"><?php _e('View all posts from Kodeklubben', 'lkk')?></a>
          </p>
        
        <?php        
        
      } else {
          _e('No news from', lkk); echo ' '.$group_location_name.'.';
      }
      
      echo $args['after_widget'];
    }
    
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

    ?>
		<p>
      <?php _e('This widget lists blogpost about codeclub if the group is a codeclub, if possible.', 'lkk')?>
		</p>
		<?php 
	}

} // class Group_Posts_Widget

// register Group_Posts_Widget widget
function register_lkk_codeclub_posts_widget() {
    register_widget( 'LKK_Codeclub_Posts_Widget' );
}

add_action( 'widgets_init', 'register_lkk_codeclub_posts_widget' );