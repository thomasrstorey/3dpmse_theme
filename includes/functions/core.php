<?php
namespace ThomasRStorey\Additive\Core;

/**
 * Set up theme defaults and register supported WordPress features.
 *
 * @since 0.1.0
 *
 * @uses add_action()
 * @uses add_theme_support()
 * @uses register_nav_menus()
 *
 * @return void
 */
function setup() {
	$n = function( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	add_action( 'after_setup_theme',  $n( 'i18n' )                 );
	add_action( 'wp_enqueue_scripts', $n( 'scripts' )              );
	add_action( 'wp_enqueue_scripts', $n( 'styles' )               );
	add_action( 'wp_head',            $n( 'header_meta' )          );
	add_action( 'after_setup_theme',  $n( 'additive_navmenus' )    );
	add_action( 'widgets_init',       $n( 'additive_widgets_init' ));
  add_action( 'init',               $n( 'register_fablabs_post_type' ) );

  add_filter( 'post_gallery', 			$n('additive_gallery'), 10, 3);
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );

	add_theme_support('post-thumbnails', array('post', 'page', 'additive_fab_lab'));

}

/**
 * Registers navigation menus
 *
 * @uses register_nav_menus
 * @since 0.1.0
 * @return void
 */

function additive_navmenus() {
		register_nav_menus( array(
			'top' => __( 'Top Menu', 'additive' )
		) );
}

/**
 * Registers sidebars
 *
 * @uses register_sidebar
 * @since 0.1.0
 * @return void
 */

function additive_widgets_init() {
	register_sidebar( array(
			'name'          => __( 'Primary Sidebar', 'additive' ),
			'id'            => 'primary-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
	) );

    register_sidebar( array(
        'name'          => __( 'News Sidebar', 'additive' ),
        'id'            => 'news-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

		register_sidebar( array(
        'name'          => __( 'Search Sidebar', 'additive' ),
        'id'            => 'search-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

		register_sidebar( array(
        'name'          => __( 'Footer Sidebar', 'additive' ),
        'id'            => 'footer-sidebar',
        'before_widget' => '<div id="footer-widget-%1$s" class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5 class="footer-widget-title">',
        'after_title'   => '</h5>',
    ) );
}

/**
 * Makes WP Theme available for translation.
 *
 * Translations can be added to the /lang directory.
 * If you're building a theme based on WP Theme, use a find and replace
 * to change 'wptheme' to the name of your theme in all template files.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 *
 * @since 0.1.0
 *
 * @return void
 */
function i18n() {
	load_theme_textdomain( 'additive', ADDITIVE_PATH . '/languages' );
 }

/**
 * Enqueue scripts for front-end.
 *
 * @uses wp_enqueue_script() to load front end scripts.
 *
 * @since 0.1.0
 *
 * @return void
 */
function scripts() {
	/**
	 * Flag whether to enable loading uncompressed/debugging assets. Default false.
	 *
	 * @param bool additive_script_debug
	 */
	$debug = apply_filters( 'additive_script_debug', false );
	$min = ( $debug || defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_script(
		'additive',
		ADDITIVE_TEMPLATE_URL . "/assets/js/additive{$min}.js",
		array(),
		ADDITIVE_VERSION,
		true
	);
}

/**
 * Enqueue styles for front-end.
 *
 * @uses wp_enqueue_style() to load front end styles.
 *
 * @since 0.1.0
 *
 * @return void
 */
function styles() {
	/**
	 * Flag whether to enable loading uncompressed/debugging assets. Default false.
	 *
	 * @param bool additive_style_debug
	 */
	$debug = apply_filters( 'additive_style_debug', false );
	$min = ( $debug || defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_style( 'additive-fonts',
		"https://fonts.googleapis.com/css?family=Arvo:400,700|Lato:300,400,700",
		array(),
		null
	);

	wp_enqueue_style(
		'normalize',
		ADDITIVE_URL . "/assets/css/normalize{$min}.css",
		array(),
		ADDITIVE_VERSION
	);

	wp_enqueue_style(
		'skeleton',
		ADDITIVE_URL . "/assets/css/skeleton{$min}.css",
		array(),
		ADDITIVE_VERSION
	);

	wp_enqueue_style(
		'additive',
		ADDITIVE_URL . "/assets/css/additive{$min}.css",
		array(),
		ADDITIVE_VERSION
	);

	wp_enqueue_style(
		'font-awesome',
		ADDITIVE_URL . "/assets/css/font-awesome{$min}.css",
		array(),
		ADDITIVE_VERSION
	);
}

/**
 * Add humans.txt to the <head> element.
 *
 * @uses apply_filters()
 *
 * @since 0.1.0
 *
 * @return void
 */
function header_meta() {
	/**
	 * Filter the path used for the site's humans.txt attribution file
	 *
	 * @param string $humanstxt
	 */
	$humanstxt = apply_filters( 'additive_humans', ADDITIVE_TEMPLATE_URL . '/humans.txt' );

	echo '<link type="text/plain" rel="author" href="' . esc_url( $humanstxt ) . '" />';
}

/**

*/
function additive_gallery($output, $attr, $instance) {
	$post = get_post();
	$atts = shortcode_atts( array(
		'order' 		 => 'ASC',
		'orderby' 	 => 'menu_order ID',
		'id'				 => $post ? $post->ID : 0,
		'itemtag'		 => 'figure',
		'icontag'		 => 'div',
		'captiontag' => 'figcaption',
		'columns'		 => 3,
		'size'			 => 'thumbnail',
		'include' 	 => '',
		'exclude' 	 => '',
		'link'			 => ''
	), $attr, 'gallery');

	$id = intval($atts['id']);

	if(!empty($atts['include'])){
		$_attachments = get_posts( array(
			'include' => $atts['include'],
			'post_status' => 'inherit',
			'post_type' => 'attachment',
			'post_mime_type' => 'image',
			'order' => $atts['order'],
			'orderby' => $atts['orderby'] ) );
		$attachments = array();
		foreach($_attachments as $key => $val){
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif(!empty($atts['exclude'])){
		$attachments = get_children( array(
			'post_parent' => $id,
			'exclude' => $atts['exclude'],
			'post_status' => 'inherit',
			'post_type' => 'attachment',
			'post_mime_type' => 'image',
			'order' => $atts['order'],
			'orderby' => $atts['orderby'] ) );
	} else {
		$attachments = get_children( array(
			'post_parent' => $id,
			'post_status' => 'inherit',
			'post_type' => 'attachment',
			'post_mime_type' => 'image',
			'order' => $atts['order'],
			'orderby' => $atts['orderby'] ) );
	}

	if(empty($attachments)){
		return '';
	}

	$itemtag = tag_escape($atts['itemtag']);
	$captiontag  = tag_escape($atts['captiontag']);
	$icontag = tag_escape($atts['icontag']);
	$valid_tags = wp_kses_allowed_html( 'post' );
	if ( ! isset( $valid_tags[ $itemtag ] ) ) {
		$itemtag = 'figure';
	}
	if ( ! isset( $valid_tags[ $captiontag ] ) ) {
		$captiontag = 'figcaption';
	}
	if ( ! isset( $valid_tags[ $icontag ] ) ) {
		$icontag = 'div';
	}

	$columns = intval( $atts['columns'] );
	$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
	$selector = "additive-gallery-{$instance}";
	$size_class = sanitize_html_class( $atts['size'] );

	$gallery_div = "<div id='$selector' class='gallery galleryid-{$id} ";
	$gallery_div .="gallery-columns-{$columns} gallery-size-{$size_class}'>";

	$output .= $gallery_div;
	$current_col = 0;
	$i = 0;
	foreach ($attachments as $id => $attachment) {
		if ($current_col == 0) { //first column
			if($i > 0){
				$output .= "</div>";
			}
			$output .= "<div class='row'>";
		}
		$attr = ( trim( $attachment->post_excerpt ) ) ? array( 'aria-describedby' => "$selector-$id" ) : '';
		if ( ! empty( $atts['link'] ) && 'file' === $atts['link'] ) {
			$image_output = wp_get_attachment_link( $id, $atts['size'], false, false, false, $attr );
		} elseif ( ! empty( $atts['link'] ) && 'none' === $atts['link'] ) {
			$image_output = wp_get_attachment_image( $id, $atts['size'], false, $attr );
		} else {
			$image_output = wp_get_attachment_link( $id, $atts['size'], true, false, false, $attr );
		}
		$image_meta  = wp_get_attachment_metadata( $id );

		$orientation = '';
		if ( isset( $image_meta['height'], $image_meta['width'] ) ) {
			$orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
		}

		$output .= "<{$itemtag} class='gallery-item'>";
		$output .= "
			<{$icontag} class='gallery-icon {$orientation}'>
				$image_output
			</{$icontag}>";
		if ( $captiontag && trim($attachment->post_excerpt) ) {
			$output .= "
				<{$captiontag} class='wp-caption-text gallery-caption' id='$selector-$id'>
				" . wptexturize($attachment->post_excerpt) . "
				</{$captiontag}>";
		}
		$output .= "</{$itemtag}>";

		$current_col = ($current_col + 1) % $columns;
		$i++;
	}
	$output .= "</div></div>";
	return $output;
}

function register_fablabs_post_type () {
	//register facilities post type
	$labels = array(
        'name'               => _x( 'Fab Labs', 'post type general name', 'additive_tcp' ),
        'singular_name'      => _x( 'Fab Lab', 'post type singular name', 'additive_tcp' ),
        'menu_name'          => _x( 'Fab Labs', 'admin menu', 'additive_tcp' ),
        'name_admin_bar'     => _x( 'Fab Lab', 'add new on admin bar', 'additive_tcp' ),
        'add_new'            => _x( 'Add New', 'fablab', 'additive_tcp' ),
        'add_new_item'       => __( 'Add New Fab Lab', 'additive_tcp' ),
        'new_item'           => __( 'New Fab Lab', 'additive_tcp' ),
        'edit_item'          => __( 'Edit Fab Lab', 'additive_tcp' ),
        'view_item'          => __( 'View Fab Lab', 'additive_tcp' ),
        'all_items'          => __( 'All Fab Labs', 'additive_tcp' ),
        'search_items'       => __( 'Search Fab Labs', 'additive_tcp' ),
        'parent_item_colon'  => __( 'Parent Fab Lab:', 'additive_tcp' ),
        'not_found'          => __( 'No fab labs found.', 'additive_tcp' ),
        'not_found_in_trash' => __( 'No fab labs found in Trash.', 'additive_tcp' )
    );
	register_post_type('additive_fab_lab', array(
		'labels' => $labels,
		'description' => 'Fab Labs which will appear on the Fab Labs page.',
		'public' => true,
		'hierarchical' => false,
		'capability_type' => 'post',
		'supports' => array('title', 'editor', 'custom-fields', 'thumbnail')
	));
}
