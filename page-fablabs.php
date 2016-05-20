<?php
/**
 * The fablabs template file
 *
 * @package Additive
 * @since 0.1.0
 */

get_header();

?>

<div id="content-container" class="container">
	<div id="fablabs-column" class="twelve columns">
  <div class="row">
    <?php if ( have_posts() ) : ?>
      <?php while ( have_posts() ): the_post(); ?>
        <h2><?php the_title(); ?></h2>
        <?php the_content(); ?>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>
    <?php
      $args = array('post_type' => 'additive_fab_lab');
      $fablabs_query = new WP_Query( $args );

      if ( $fablabs_query->have_posts() ) :
        while ( $fablabs_query->have_posts() ) : $fablabs_query->the_post();
        ?>
        <div class="fablab-row">
          <div class="one-half column">
								<div class="row">
									<a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
			            <?php
												// the_content();
												// get meta - location, list of capabilities, contact name and email.
												$location = get_post_meta($post->ID, 'location', true);
												$location_link = get_post_meta($post->ID, 'location_link', true);
												$capabilities = explode(",", get_post_meta($post->ID, 'capabilities', true));
												$contact_name = get_post_meta($post->ID, 'contact_name', true);
												$contact_email = get_post_meta($post->ID, 'contact_email', true);
												printf("<p><strong>Location:</strong> %s  <strong><a href='%s'><i class='fa fa-map-marker' aria-hidden='true'></i></a></strong></p>", $location, $location_link);
												echo "<p><strong>Capabilities:</strong> ";
												$keys = array_keys($capabilities);
												$last_key = end($keys);
												foreach ($capabilities as $key => $capability) {
													if($key == $last_key){
														printf("%s", $capability);
													} else {
														printf("%s, ", $capability);
													}
												}
												echo "</p>";
									 		 printf('<p><strong>Contact:</strong> %s  <strong><a href="mailto:%s"><i class="fa fa-envelope-o" aria-hidden="true"></i></strong></a></p>', $contact_name, $contact_email);
												?>
								</div>

          </div>
          <div class="one-half column fablabs-right">
							<div class="row fablabs-right">
            <?php
              if(has_post_thumbnail()){
											 $thumbnail = get_the_post_thumbnail_url($post->ID, 'full');
											 printf("<div class='fablabs-thumbnail' style='background-image: url(%s);'></div>", $thumbnail);
               }
             ?>
          </div>
						 </div>
        </div>
        <?php
        endwhile;
      endif;
      wp_reset_postdata();
    ?>

  </div>
</div>

<?php get_footer(); ?>
