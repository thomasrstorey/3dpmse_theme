<?php
/**
 * The main template file
 *
 * @package Additive
 * @since 0.1.0
 */

get_header(); ?>
<div id="content-container" class="container">
	<div id="post-list-left-column" class="one-half column">
	<h2><?php wp_title(''); ?></h2>
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ): the_post(); ?>
			<div id="content-row-<?php the_ID(); ?>" class="row post-list-row">
				<a class="post-list-title-link" href="<?php the_permalink() ?>"><h2><?php the_title(); ?></h2></a>
				<a class="post-list-img-link" href="<?php the_permalink() ?>">
				<div class="post-list-featured-img" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>);"></div>
			 </a>
				<?php
				the_excerpt();
				?>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>
		</div>
		<div id="right-column" class="one-half column">
			<div id="sidebar-primary-row" class="row">
        <div id="sidebar-primary" class="sidebar">
          <?php dynamic_sidebar('sidebar-2'); ?>
        </div>
      </div>
		</div>
</div>

<?php get_footer();
