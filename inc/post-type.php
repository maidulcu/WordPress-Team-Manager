<?php
namespace WTM;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * metabox Class
 */
class Custom_Post_Type {


    public function __construct(){

        add_action( 'init', [$this, 'register_team_manager'] );

    }
    
//register the custom post type for the team manager
function register_team_manager() {

    $labels = array( 
        'name' => _x( 'Team', 'wp-team-manager' ),
        'singular_name' => _x( 'Team Member', 'wp-team-manager' ),
        'add_new' => _x( 'Add New Member', 'wp-team-manager' ),
        'add_new_item' => _x( 'Add New ', 'wp-team-manager' ),
        'edit_item' => _x( 'Edit Team Member ', 'wp-team-manager' ),
        'new_item' => _x( 'New Team Member', 'wp-team-manager' ),
        'view_item' => _x( 'View Team Member', 'wp-team-manager' ),
        'search_items' => _x( 'Search Team Members', 'wp-team-manager' ),
        'not_found' => _x( 'Not found any Team Member', 'wp-team-manager' ),
        'not_found_in_trash' => _x( 'No Team Member found in Trash', 'wp-team-manager' ),
        'parent_item_colon' => _x( 'Parent Team Member:', 'wp-team-manager' ),
        'menu_name' => _x( 'Team', 'wp-team-manager' ),
    );
	
    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,        
        'supports' => array( 'title', 'thumbnail','editor','page-attributes'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,       
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post',
		'menu_icon' => plugins_url( '../img/icon16.png',__FILE__),
		'rewrite' => array( 'slug' => 'team-details' )

    );

    register_post_type( 'team_manager', $args );

    //register custom category for the team manager

    $labels = array(
        'name'                       => _x( 'Groups', 'wp-team-manager' ),
        'singular_name'              => _x( 'Group', 'wp-team-manager' ),
        'search_items'               => _x( 'Search Groups', 'wp-team-manager' ),
        'popular_items'              => _x( 'Popular Groups', 'wp-team-manager' ),
        'all_items'                  => _x( 'All Groups', 'wp-team-manager' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => _x( 'Edit Group', 'wp-team-manager' ),
        'update_item'                => _x( 'Update Group', 'wp-team-manager' ),
        'add_new_item'               => _x( 'Add New Group', 'wp-team-manager' ),
        'new_item_name'              => _x( 'New Group Name', 'wp-team-manager' ),
        'separate_items_with_commas' => _x( 'Separate Groups with commas', 'wp-team-manager' ),
        'add_or_remove_items'        => _x( 'Add or remove Groups', 'wp-team-manager' ),
        'choose_from_most_used'      => _x( 'Choose from the most used Groups', 'wp-team-manager' ),
        'not_found'                  => _x( 'No Groups found.', 'wp-team-manager' ),
        'menu_name'                  => _x( 'Team Groups', 'wp-team-manager' ),
    );

    $args = array(
        'hierarchical'          => true,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'team_groups' ),
    );

    register_taxonomy( 'team_groups', 'team_manager', $args );

}


}

new Custom_Post_Type();