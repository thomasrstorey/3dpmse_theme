<div id="content-container" class="container">
  <div id="left-column" class="one-half column">

	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ): the_post(); ?>
			<div id="content-row-<?php the_ID(); ?>" class="row">
				<h2><?php the_title(); ?></h2>
				<?php the_content(); ?>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>
    </div>
    <div id="right-column" class="one-half column">
      <?php

        $imgurl =  get_bloginfo('template_url').'/default_img.jpg';
        if(has_post_thumbnail()){
					   $imgurl = get_the_post_thumbnail_url();
          printf('<div class="row right-column-page-row"><img id="right-column-page-featured-img" class="single-img" src="%s"/></div>', $imgurl);
        }
      ?>

      <div id="sidebar-primary-row" class="row">
        <div id="sidebar-primary" class="sidebar">
          <?php dynamic_sidebar('sidebar-1'); ?>
        </div>
      </div>
    </div>
</div>

<?php get_footer(); ?>
