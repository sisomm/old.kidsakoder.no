<?php 

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