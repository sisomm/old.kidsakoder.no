<?php

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
		
		$group_location_name = get_term_by( 'slug', $group_location, 'lkk_location')->name;
    
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
          <p>
        
        <?php _e(sprintf('Add more news by adding a post with location <strong>%s</strong>.', $group_location_name), lkk);  ?>
        
        </p>
        
      <?php
        
      } else {
          
          _e(sprintf('Add news by writing a post with location set to <strong>%s</strong>.', $group_location_name), lkk);
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

