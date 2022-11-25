<?php
namespace WTM\Helper;
$output = ''; 

$post_id = get_the_ID();

$job_title = get_post_meta($post_id,'tm_jtitle',true);

$thumb_image_size = (is_array($_wp_additional_image_sizes) && array_key_exists($image_size, $_wp_additional_image_sizes)) ? $image_size  : 'thumbnail';
?>

<div class="team-member-info">



  <?php echo get_team_picture($post_id, $thumb_image_size, $image_layout); ?>
  <?php //$output .= get_team_social_links($post_id, $social_size, $link_window);?>
  

  <div class="team-member-des">
    <h3 class="team-title"><?php the_title(); ?></h3>
    <?php
    if(!empty($job_title)){
      // $output .= '<h4 class="team-position">'.esc_html($job_title).'</h4>';
      ?>
      <h4 class="team-position"><?php echo esc_html($job_title);?></h4>
    <?php }
    ?>
    <?php the_content(); ?>
    <?php echo get_team_other_infos($post_id); ?>
  </div>

</div>
