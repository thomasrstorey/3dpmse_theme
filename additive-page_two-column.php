<div id="content-container" class="container">

  <?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ): the_post(); ?>

      <div id="left-column" class="one-half column">

			   <div id="content-row-<?php the_ID(); ?>" class="row">
				    <h2><?php the_title(); ?></h2>
				    <?php the_content(); ?>
			   </div>

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
            <?php
              $column_post_ID = get_post_meta($post->ID, 'additive_two_column_post', true);
              if($column_post_ID){
                $column_post = get_post($column_post_ID);
                if(get_post_type($column_post) == 'additive_column'){
                  echo apply_filters('the_content', $column_post->post_content);
                }
              }
            ?>
          </div>
        </div>
      </div>

  <?php endwhile; ?>
<?php endif; ?>
</div>
