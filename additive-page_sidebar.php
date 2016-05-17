<div id="content-container" class="container">

      <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ): the_post();

        if(get_post_format() == 'gallery') :
        ?>
          <div id="left-column" class="twelve columns">
        <?php else : ?>
          <div id="left-column" class="one-half column">
        <?php endif; ?>

			   <div id="content-row-<?php the_ID(); ?>" class="row">
				    <h2><?php the_title(); ?></h2>
				    <?php the_content(); ?>
			   </div>

       <?php endwhile; ?>
     <?php endif; ?>

      </div>
    <?php if(get_post_format() != 'gallery') : ?>
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
            <?php dynamic_sidebar('-sidebar'); ?>
          </div>
        </div>
      </div>
    <?php endif ?>
</div>
