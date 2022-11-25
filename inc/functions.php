<?php
namespace WTM\Helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function get_team_picture($post_id, $thumb_image_size, $image_layout)
{
    $output = '';

    $thumbnail_id = get_post_thumbnail_id( $post_id );

    if (isset($thumbnail_id)) {

        $output .= '<a href="'.get_permalink().'">';
      
        $output .=  wp_get_attachment_image( $thumbnail_id,  $thumb_image_size, "", array( "class" => "team-picture image" ) );
      
        $output .= '</a>';

       }
      else{
        
        $output .= "<img class='team-picture ".esc_attr($image_layout)."' src='".plugins_url( 'img/demo.gif',__FILE__)."' width='150' title='Team Picture' alt='Team Picture'/>";
      
      }

      return $output;

}

function get_team_social_links($post_id,$social_size,$link_window)
{

    $output = '';

    $facebook = get_post_meta($post_id,'tm_flink',true);
    $twitter = get_post_meta($post_id,'tm_tlink',true);
    $linkedIn = get_post_meta($post_id,'tm_llink',true);
    $googleplus = get_post_meta($post_id,'tm_gplink',true);
    $dribbble = get_post_meta($post_id,'tm_dribbble',true);
    $youtube = get_post_meta($post_id,'tm_ylink',true);
    $vimeo = get_post_meta($post_id,'tm_vlink',true);
    $emailid = get_post_meta($post_id,'tm_emailid',true);


    $output .= '<ul class="team-member-socials size-'.esc_attr($social_size).'">';

    if (!empty($facebook)) {
    $output .= '<li><a class="facebook-'.esc_attr($social_size).'" href="' .esc_url($facebook) . '" '.esc_attr($link_window).' title="'.__('Facebook','wp-team-manager').'">'.__('Facebook','wp-team-manager').'</a></li>';
    }
    if (!empty($twitter)) {
    $output .= '<li><a class="twitter-'.esc_attr($social_size).'" href="' . esc_url($twitter). '" '.esc_attr($link_window).' title="'.__('Twitter','wp-team-manager').'"> '.__('Twitter','wp-team-manager').'</a></li>';
    }
    if (!empty($linkedIn)) {
    $output .= '<li><a class="linkedIn-'.esc_attr($social_size).'" href="' . esc_url($linkedIn). '" '.esc_attr($link_window).' title="'.__('LinkedIn','wp-team-manager').'"> '.__('LinkedIn','wp-team-manager').'</a></li>';
    }
    if (!empty($googleplus)) {
    $output .= '<li><a class="googleplus-'.esc_attr($social_size).'" href="' . esc_url($googleplus). '" '.esc_attr($link_window).' title="'.__('Google Plus','wp-team-manager').'">'.__('Google Plus','wp-team-manager').'</a></li>';
    }
    if (!empty($dribbble)) {
    $output .= '<li><a class="dribbble-'.esc_attr($social_size).'" href="' . esc_url($dribbble). '" '.esc_attr($link_window).' title="'.__('Dribbble','wp-team-manager').'">'.__('Dribbble','wp-team-manager').'</a></li>';
    }        
    if (!empty($youtube)) {
    $output .= '<li><a class="youtube-'.esc_attr($social_size).'" href="' . esc_url($youtube). '" '.esc_attr($link_window).' title="'.__('Youtube','wp-team-manager').'">'.__('Youtube','wp-team-manager').'</a></li>';
    }
    if (!empty($vimeo)) {
    $output .= '<li><a class="vimeo-'.esc_attr($social_size).'" href="' . esc_url($vimeo). '" '.esc_attr($link_window).' title="'.__('Vimeo','wp-team-manager').'">'.__('Vimeo','wp-team-manager').'</a></li>';
    }
    if (!empty($emailid)) {
    $output .= '<li><a class="emailid-'.esc_attr($social_size).'" href="mailto:' .sanitize_email($emailid). '" title="'.__('Email','wp-team-manager').'">'.__('Email','wp-team-manager').'</a></li>';
    } 


    $output .= '</ul>';

    return $output;

}

function get_team_other_infos($post_id)
{
    
    $output = '';

    $telephone = get_post_meta($post_id,'tm_telephone',true);
    $location = get_post_meta($post_id,'tm_location',true);
    $web_url = get_post_meta($post_id,'tm_web_url',true);
    $vcard = get_post_meta($post_id,'tm_vcard',true);

    $output .= '<ul class="team-member-other-info">';

    if (!empty($telephone)) {
    $output .= '<li><span> '.__('Tel:','wp-team-manager').' </span><a href="tel://'.esc_html($telephone).'">'.esc_html($telephone).'</a></li>';
    }
    if (!empty($location)) {
    $output .= '<li><span> '.__('Location:','wp-team-manager').' </span>'.esc_html($location).'</li>';
    }
    if (!empty($web_url)) {
    $output .= '<li><span> '.__('Website:','wp-team-manager').' </span><a href="'. esc_url($web_url).'" target="_blank">Link</a></li>';
    }
    if (!empty($vcard)) {
    $output .= '<li><span> '.__('Vcard:','wp-team-manager').' </span><a href="'.esc_url($vcard).'" > '.__('Download','wp-team-manager').'</a></li>';
    }   
                                                
    $output .= '</ul>';

    return $output;

}