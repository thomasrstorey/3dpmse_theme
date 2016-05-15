<?php
/**
 * The front page template file
 *
 * @package Additive
 * @since 0.1.0
 */

get_header(); ?>

<?php

function frontpage_get_featured_image_url () {
	$media = get_attached_media('image');
	foreach ($media as $key => $value) {
		if( wp_attachment_is_image($value->ID) ) {
			return wp_get_attachment_image_url($value->ID, 'large', false);
		}
	}
}

?>

<div id="font-page-jumbotron-container" class="container">
	<div id="front-page-jumbotron" class="jumbotron">
		<?php
		 	$jumbotronQuery = new WP_Query(array( 'tag' => 'jumbotron'));
			$coltype = "third";
			$counter = 0;
			if(sizeof($jumbotronQuery->posts) < 3 ){
				$coltype = "half";
			} elseif (sizeof($jumbotronQuery->posts) < 2) {
				$coltype = "full";
			}
			while( $jumbotronQuery->have_posts() && $counter < 3 ){
				$jumbotronQuery->the_post();
				$counter++;
				$pid = get_the_ID();
				$imgurl = get_bloginfo('template_url').'/default_img.jpg';
				if(has_post_thumbnail()){
					$imgurl = get_the_post_thumbnail_url();
				}
				$meta = get_post_meta(get_the_ID());
				$icon = '<i class="fa fa-star" aria-hidden="true"></i>';
				$blurb = the_title('', '', false);
				$color = '#6C9AC3';
				if($meta["icon"]){
					$icon = $meta["icon"][0];
				}
				if(isset($meta["blurb"])){
					$blurb = $meta["blurb"][0];
				}
				if(isset($meta["jumbotron-color"])){
					$color = $meta["jumbotron-color"][0];
				}
				$jumbo = sprintf('<a href="%s"><div id="jumbotron-column-post-%d" class="jumbotron-column %s">', get_permalink(), $pid, $coltype);
				$jumbo .= sprintf('<div id="jumbotron-column-color-post-%d" class="jumbotron-column-color">', $pid);
				$jumbo .= sprintf('<div id="jumbotron-column-blurb-post-%d" class="jumbotron-column-blurb"><div class="jumbotron-column-icon">%s</div>%s</div></div>', $pid, $icon, $blurb);
				$jumbo .= sprintf('<div id="jumbotron-column-image-post-%d" class="jumbotron-column-image" style="background-image: url(%s);">', $pid, $imgurl);
				$jumbo .= '</div></div></a>';
				echo $jumbo;
			}
			wp_reset_postdata();
		?>
	</div>
</div>

<?php
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	$plugin_active = is_plugin_active( 'additive-double-post/additive-two-column-post.php' );
	$has_second_column = get_post_meta($post->ID, 'additive_two_column_post', true);

	if ( $plugin_active && $has_second_column ) {
	  include_once "additive-page_two-column.php";
	} else {
	  include_once "additive-page_sidebar.php";
	}

	get_footer();
?>
