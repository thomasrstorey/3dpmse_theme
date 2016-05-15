<?php
/**
 * The knowledge base template file
 *
 * @package Additive
 * @since 0.1.0
 */

get_header();

?>

<div id="content-container" class="container">
	<div id="questions-column" class="twelve columns">
    <?php if ( have_posts() ) : ?>
      <?php while ( have_posts() ): the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>
</div>

<?php get_footer(); ?>
