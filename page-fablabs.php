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
            <h3><?php the_title(); ?></h3>
            <p><?php the_content(); ?></p>
          </div>
          <div class="one-half column">
            <?php
              if(has_post_thumbnail()){
    					   $imgurl = get_the_post_thumbnail_url();
                 printf('<img id="fablab-featured-img" class="single-img" src="%s"/>', $imgurl);
               }
             ?>
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
