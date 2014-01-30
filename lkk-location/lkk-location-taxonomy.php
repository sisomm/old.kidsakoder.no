<?php

/**
 *  Register Custom taxonomy
 *
 */
 
function lkk_location_taxonomy()  {

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
add_action( 'init', 'lkk_location_taxonomy', 0 );