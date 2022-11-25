<?php
namespace WTM;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

  // Add Shortcode
  function shortcode_callback ($atts, $content = null) {

    ob_start();
	
    // get social settings
    $social_size = (false !== get_option('tm_social_size')) ? get_option('tm_social_size') : 16;

    // get link new window settings
    $link_window = (false !== get_option('tm_link_new_window')  && 'True' == get_option('tm_link_new_window')) ? 'target="_blank"' : '';

    //var_dump($link_window);

    extract( shortcode_atts( array(
      'team_groups' => '',
      'orderby' => 'menu_order',
      'layout' => 'grid',
      'image_layout' => 'rounded',
      'image_size' => 'thumbnail'

    ), $atts ) );

    $asc_desc = 'DESC';

    if ($atts['orderby'] == 'title' || $atts['orderby'] == 'menu_order') {
      $asc_desc = 'ASC';
    }

    $posts_per_page = ($atts['limit'] >= 1) ? $atts['limit'] : -1 ;
    
    // if($atts['limit'] >= 1) { 
    // $posts_per_page = $atts['limit'];//convert to tenary
    // } 

    $layout = isset($atts['layout']) ? $atts['layout'] : '';

    $image_layout = isset($atts['image_layout']) ? $atts['image_layout'] : ''; 
    $image_size = isset($atts['image_size']) ? $atts['image_size'] : '';   

    $args = array( 
             'post_type' => 'team_manager',
             'team_groups'=> $atts['category'] ,  
             'posts_per_page'=> $posts_per_page, 
             'orderby' => $atts['orderby'], 
             'order' => $asc_desc
            ); 

          if($atts['exclude'] != '0' && $atts['exclude'] != '') {

           $postnotarray = explode(',', $atts['exclude']);

           if(is_array($postnotarray) && $postnotarray[0]!='') { 

            $args['post__not_in'] = $postnotarray;

            }
          }

          if($atts['post__in'] != '0' && $atts['post__in'] != '') {

           $postarray = explode(',', $atts['post__in']);

           if(is_array($postarray) && $postnotarray[0]!='') { 

            $args['post__in'] = $postarray;

            }

          }    

    $tm_loop = new \WP_Query( $args );      


    // The Loop
    if ( $tm_loop->have_posts() ) { 

     echo '<div class="team-list">';

     echo '<div class="'.esc_attr($layout).'">';

      while ( $tm_loop->have_posts() ) {
        $tm_loop->the_post();

        //
        if($layout == 'grid') {
           include plugin_dir_path( __FILE__ ) . 'templates/content-grid.php';
          
        }

        if($layout == 'list') {
          include plugin_dir_path( __FILE__ ) . 'templates/content-list.php';
          // echo "list";
        }

        if($layout == 'grid-light-box') {
          include plugin_dir_path( __FILE__ ) . 'templates/content-grid-light-box.php';
          // echo "unitek";
        } 
      }

      echo '</div>';

      echo '</div>';
     // $output .= '</div>';

    } else {
      // no posts found
    }

    // echo '</div>';

    // echo '</div>';
    
    /* Restore original Post Data */
    wp_reset_postdata();

    return ob_get_clean();

  }
  add_shortcode( 'team_manager', 'WTM\shortcode_callback' );