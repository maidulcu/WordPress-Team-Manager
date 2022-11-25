<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * metabox Class
 */
class TM_CMB2_Metabox {

    /**
     * Define the metabox and field configurations.
    */
    public function __construct(){

        add_action( 'cmb2_init', [$this, 'create_wp_team_manager_metaboxes'] );

    }

    function create_wp_team_manager_metaboxes() {

        // General information begin
        $cmb_general = new_cmb2_box( 
            array(
                'id'            => 'wptm_cm2_metabox_general',
                'title'         =>  esc_html__( 'General Information', 'wp-team-manager' ),
                'object_types'  => ['team_manager'], // post type 
                'context'       => 'normal',
                'priority'      => 'high',
                'show_names'    => true
            ) 
        );

        /**
         * Job Title
         */
        $cmb_general->add_field( array(
            'name'       => esc_html__( 'Job Title', 'wp-team-manager' ),
            'desc'       => esc_html__( 'Job title of this team member', 'wp-team-manager' ),
            'id'         => 'tm_jtitle',
            'type'       => 'text',
        ) );

        /**
         * Telephone
         */
        $cmb_general->add_field( array(
            'name'       => esc_html__( 'Telephone', 'wp-team-manager' ),
            'desc'       => esc_html__( 'Telephone number of this team member', 'wp-team-manager' ),
            'id'         => 'tm_telephone',
            'type'       => 'text',
        ) );

        /**
         * Location
         */
        $cmb_general->add_field( array(
            'name'       => esc_html__( 'Location', 'wp-team-manager' ),
            'desc'       => esc_html__( 'Location of this team member', 'wp-team-manager' ),
            'id'         => 'tm_location',
            'type'       => 'text',
        ) );

        /**
         * Web URL
         */
        $cmb_general->add_field( array(
            'name'       => esc_html__( 'Web URL', 'wp-team-manager' ),
            'desc'       => esc_html__( 'Website url of this team member', 'wp-team-manager' ),
            'id'         => 'tm_web_url',
            'type'       => 'text',
        ) );

        /**
         * Image
         */
        $cmb_general->add_field( array(
            'name'    => 'Add File',
            'desc'    => 'Upload a File',
            'id'      => 'tm_vcard',
            'type'    => 'file',
            // Optional:
            'options' => array(
                //'url' => false, // Hide the text input for the url
                'url' => true, // Hide the text input for the url
            ),
            'text'    => array(
                'add_upload_file_text' => 'Add File' // Change upload button text. Default: "Add or Upload File"
            ),
            // query_args are passed to wp.media's library query.
            'preview_size' => 'medium', // Image size to use when previewing in the admin.
        ) );
        // General information end


        // Social profile begin
        $cmb_social = new_cmb2_box( 
            array(
                'id'            => 'wptm_cm2_metabox_social',
                'title'         =>  esc_html__( 'Social Profile', 'wp-team-manager' ),
                'object_types'  => ['team_manager'], // post type 
                'context'       => 'normal',
                'priority'      => 'high',
                'show_names'    => true
            ) 
        );

        /**
         * Facebook
         */
        $cmb_social->add_field( array(
            'name'       => esc_html__( 'Facebook', 'wp-team-manager' ),
            'desc'       => esc_html__( 'Job title of this team member', 'wp-team-manager' ),
            'id'         => 'tm_flink',
            'type'       => 'text',
        ) );

        /**
         * Twitter
         */
        $cmb_social->add_field( array(
            'name'       => esc_html__( 'Twitter', 'wp-team-manager' ),
            'desc'       => esc_html__( 'Twitter profile link', 'wp-team-manager' ),
            'id'         => 'tm_tlink',
            'type'       => 'text',
        ) );

        /**
         * LinkedIn
         */
        $cmb_social->add_field( array(
            'name'       => esc_html__( 'LinkedIn', 'wp-team-manager' ),
            'desc'       => esc_html__( 'LinkedIn profile link', 'wp-team-manager' ),
            'id'         => 'tm_llink',
            'type'       => 'text',
        ) );

        /**
         * Google Plus
         */
        $cmb_social->add_field( array(
            'name'       => esc_html__( 'Google Plus', 'wp-team-manager' ),
            'desc'       => esc_html__( 'Google Plus profile link', 'wp-team-manager' ),
            'id'         => 'tm_gplink',
            'type'       => 'text',
        ) );
        /**
         * Dribbble
         */
        $cmb_social->add_field( array(
            'name'       => esc_html__( 'Dribbble', 'wp-team-manager' ),
            'desc'       => esc_html__( 'Dribbble profile link', 'wp-team-manager' ),
            'id'         => 'tm_dribbble',
            'type'       => 'text',
        ) );
        /**
         * Youtube
         */
        $cmb_social->add_field( array(
            'name'       => esc_html__( 'Youtube', 'wp-team-manager' ),
            'desc'       => esc_html__( 'Youtube profile link', 'wp-team-manager' ),
            'id'         => 'tm_ylink',
            'type'       => 'text',
        ) );
        /**
         * Vimeo
         */
        $cmb_social->add_field( array(
            'name'       => esc_html__( 'Vimeo', 'wp-team-manager' ),
            'desc'       => esc_html__( 'Vimeo profile link', 'wp-team-manager' ),
            'id'         => 'tm_vlink',
            'type'       => 'text',
        ) );
        /**
         * Email
         */
        $cmb_social->add_field( array(
            'name'       => esc_html__( 'Email', 'wp-team-manager' ),
            'desc'       => esc_html__( 'Email address', 'wp-team-manager' ),
            'id'         => 'tm_emailid',
            'type'       => 'text',
        ) );

        // Social profile end
    }

}

new TM_CMB2_Metabox();