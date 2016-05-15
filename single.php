<?php
/**
 * The single post template file
 *
 * @package Additive
 * @since 0.1.0
 */

get_header();

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
