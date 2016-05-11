<div id="content-container" class="container">
  <?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); ?>
  <?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ): the_post(); ?>

      <?php if(get_post_meta($post->ID, 'additive_two_column_post', true)) { ?>
      <div id="left-column" class="one-half column">
      <?php } else { ?>
      <div id="left-column" class="twelve columns">

        <?php
          $imgurl =  get_bloginfo('template_url').'/default_img.jpg';
          if(has_post_thumbnail()){
  					   $imgurl = get_the_post_thumbnail_url();
            printf('<div class="row left-column-page-row"><img id="left-column-page-featured-img" class="single-img" src="%s"/></div>', $imgurl);
          }
        ?>

      <?php }; ?>

			   <div id="content-row-<?php the_ID(); ?>" class="row">
				    <h2><?php the_title(); ?></h2>
				    <?php the_content(); ?>
			   </div>

      </div>



      <?php if(get_post_meta($post->ID, 'additive_two_column_post', true)) { ?>
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
              if ( is_plugin_active( 'additive-double-post/additive-two-column-post.php' ) ) {
                //plugin is activated
                $column_post = get_post($column_post_ID);
                if(get_post_type($column_post) == 'additive_column'){
                  echo apply_filters('the_content', $column_post->post_content);
                }
              }
            }
            ?>
          </div>
        </div>
      </div>

    <?php }; ?>

  <?php endwhile; ?>
<?php endif; ?>
</div>

<?php get_footer(); ?>
