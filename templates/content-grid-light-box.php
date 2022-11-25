<?php
namespace WTM\Helper;
$output = ''; 

$post_id = get_the_ID();

$job_title = get_post_meta($post_id,'tm_jtitle',true);

$thumb_image_size = (is_array($_wp_additional_image_sizes) && array_key_exists($image_size, $_wp_additional_image_sizes)) ? $image_size  : 'thumbnail';
?>

<div class="team-member-info">

  <?php //echo get_team_picture($post_id, $thumb_image_size, $image_layout);?>
 
  <?php //echo get_team_social_links($post_id, $social_size, $link_window);?>

 


  <div class="overlay-container">
  <!-- <img src="image.jpg" alt="Avatar" class="image"> -->
    <?php echo get_team_picture($post_id, $thumb_image_size, $image_layout);?>
    <div class="overlay">
      <div class="text">


        <div class="unitek-team-member-des">
          <h6 class="unitek-team-title"><?php the_title(); ?></h6>
          <?php
          if(!empty($job_title)){?>
            <p class="unitek-team-position"><?php echo esc_html($job_title);?></p>
          <?php }
          ?>
          <?php //the_content(); ?>
          <?php //echo get_team_other_infos($post_id); ?>
        </div>


      </div>
    </div>
  </div>




</div>
