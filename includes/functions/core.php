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

	add_filter( 'use_default_gallery_style', false);
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

	add_theme_support('post-thumbnails', array('post', 'page'));
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
        'id'            => 'sidebar-1',
        'before_widget' => '<div id="%1$s" class="additive-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

		register_sidebar( array(
        'name'          => __( 'Posts Page Sidebar', 'additive' ),
        'id'            => 'sidebar-2',
        'before_widget' => '<div id="%1$s" class="additive-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
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
