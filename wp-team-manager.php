<?php
/*
Plugin Name: WordPress Team Manager
Plugin URI: http://www.dynamicweblab.com/
Description: This plugin allows you to manage the members of your team or staff and display them using shortcode.
Author: Maidul
Version: 1.6.1
Author URI:http://www.dynamicweblab.com/
Text Domain: wp-team-manager
Domain Path: /languages/
License: GPL2
*/

final class WordPress_Team_Manager {

	/**
	 * Plugin Version
	 *
	 * @since 1.2.1
	 * @var string The plugin version.
	 */
	const VERSION = '1.6.1';



	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {

		// Init Plugin
		add_action( 'plugins_loaded', [ $this, 'init' ] );

        add_action('init', [ $this, 'after_init' ]);

	}

    /**
	 * Initialize the plugin
	 *
	 * Validates that Elementor is already loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed include the plugin class.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function init() {

        //include Post Type
        require_once dirname(__FILE__) . '/inc/post-type.php';

        // include cmb2 metabox
        require_once dirname(__FILE__) . '/lib/cmb2/init.php';

        //include Post Type
        require_once dirname(__FILE__) . '/inc/functions.php';

        //include Shortcode Generator
        require_once dirname(__FILE__) . '/shortcode-generator.php';

        //include Settings
        require_once dirname(__FILE__) . '/shortcodes.php';

        //include Settings
        require_once dirname(__FILE__) . '/settings.php';



        // include CMB 2 class
        require_once dirname(__FILE__) . '/inc/metaboxes/CMB2_Metabox.php';

        $this->load_textdomain();

    }

    //include language

    public function load_textdomain()
    {
    // Localization

    load_plugin_textdomain('wp-team-manager', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

    }

    /**
     * Check if the current theme have feature image support.If not then enable the support
     *
     * @since 1.0.0
     * 
     * 
     */
    function after_init() {
        if(!current_theme_supports('post-thumbnails')) {
        add_theme_support( 'post-thumbnails', array( 'team_manager' ) );
        }
    
    }
    

}

// Instantiate WordPress_Team_Manager.
new WordPress_Team_Manager();



function tm_custom_upload_mimes ( $existing_mimes=array() ) {
    // add your extension to the array
    $existing_mimes['vcf'] = 'text/x-vcard';
    return $existing_mimes;
}

// add VCF file type upload support

add_filter('upload_mimes', 'tm_custom_upload_mimes');

/**
 * Get feature image from team_manager post type
 *
 * @since 1.0
 *
 *
 */
function wptm_get_featured_image($post_ID) {
    $post_thumbnail_id = get_post_thumbnail_id($post_ID);
    if ($post_thumbnail_id) {
        $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'thumbnail');
        return $post_thumbnail_img[0];
    }
}
/**
 * Add new feature image column
 *
 * @since 1.5
 *
 *
 */
function wptm_columns_head($defaults) {
    $defaults['featured_image'] = __('Featured Image');
    return $defaults;
}
 /**
 * Show feature image on the admin
 *
 * @since 1.5
 *
 *
 */
function wptm_columns_content($column_name, $post_ID) {
    if ($column_name == 'featured_image') {
        $post_featured_image = wptm_get_featured_image($post_ID);
        if ($post_featured_image) {
            echo '<img src="' . $post_featured_image . '" />';
        }
    }
}

add_filter('manage_team_manager_posts_columns', 'wptm_columns_head');
add_action('manage_team_manager_posts_custom_column', 'wptm_columns_content', 10, 2);

 /**
 * Show team member id on the admin section
 *
 * @since 1.5
 *
 *
 */

function team_manager_posts_columns_id($defaults){
    $defaults['wps_post_id'] = __('ID');
    return $defaults;
}
function team_manager_posts_custom_id_columns($column_name, $id){
  if($column_name === 'wps_post_id'){
          echo $id;
    }
}

add_filter('manage_team_manager_posts_columns', 'team_manager_posts_columns_id', 5);
add_action('manage_team_manager_posts_custom_column', 'team_manager_posts_custom_id_columns', 5, 2);


 /**
 * Get the custom template if is set
 *
 * @since 1.0
 */
 
function team_manager_get_template_hierarchy( $template ) {
 
    // Get the template slug
    $template_slug = rtrim( $template, '.php' );
    $template = $template_slug . '.php';
 
    // Check if a custom template exists in the theme folder, if not, load the plugin template file
    if ( $theme_file = locate_template( array( 'team_template/' . $template ) ) ) {
        $file = $theme_file;
    }
    else {
        $file = dirname(__FILE__) . '/templates/' . $template;
    }
 
    return apply_filters( 'team_manager_template_' . $template, $file );
}
 
 
/**
 * Returns template file
 *
 * @since 1.6.1
 */
 
add_filter( 'template_include', 'team_manager_template_chooser');

function team_manager_template_chooser( $template ) {
 
    // Post ID
    $post_id = get_the_ID();
 
    // For all other CPT
    if ( get_post_type( $post_id ) != 'team_manager' ) {
        return $template;
    }
 
    // Else use custom template
    if ( is_single() ) {
        return team_manager_get_template_hierarchy( 'single' );
    }
 
}
