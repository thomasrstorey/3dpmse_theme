<?php
/**
 * The attachement template file
 *
 * @package Additive
 * @since 0.1.0
 */

get_header(); ?>
<div id="content-container" class="container">
	<div id="left-column" class="one-half column">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ): the_post();
      $alt = get_post_meta($post->ID, '_wp_attachment_image_alt', true);
      $image_title = $post->post_title;
      $caption = $post->post_excerpt;
      $description = $post->post_content;
      $img_src_array = wp_get_attachment_image_src($post->ID, 'full', false);
      ?>
			<div class="row">
				<?php printf("<img class='attachment-image' src='%s' />", $img_src_array[0]); ?>
			</div>

  </div>
		<div id="right-column" class="one-half column">
      <h3><?php echo $image_title; ?></h3>
			<div class="row">
        <h5>Caption</h5>
        <p>
          <?php echo $caption; ?>
        </p>
		 </div>
    <div class="row">
      <h5>Description</h5>
      <p>
        <?php echo $description; ?>
      </p>
   </div>
</div>
	<?php endwhile; ?>
	<?php endif; ?>

</div>

<?php get_footer(); ?>
