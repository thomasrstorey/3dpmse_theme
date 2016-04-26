<?php
namespace ThomasRStorey\Additive\Core;

/**
 * This is a very basic test case to get things started. You should probably rename this and make
 * it work for your project. You can use all the tools provided by WP Mock and Mockery to create
 * your tests. Coverage is calculated against your includes/ folder, so try to keep all of your
 * functional code self contained in there.
 *
 * References:
 *   - http://phpunit.de/manual/current/en/index.html
 *   - https://github.com/padraic/mockery
 *   - https://github.com/10up/wp_mock
 */

use ThomasRStorey\Additive as Base;

class Core_Tests extends Base\TestCase {

	protected $testFiles = [
		'functions/core.php'
	];

	/**
	 * Make sure all theme-specific constants are defined before we get started
	 */
	public function setUp() {
		if ( ! defined( 'ADDITIVE_TEMPLATE_URL' ) ) {
			define( 'ADDITIVE_TEMPLATE_URL', 'template_url' );
		}
		if ( ! defined( 'ADDITIVE_VERSION' ) ) {
			define( 'ADDITIVE_VERSION', '0.1.0' );
		}
		if ( ! defined( 'ADDITIVE_URL' ) ) {
			define( 'ADDITIVE_URL', 'url' );
		}

		parent::setUp();
	}

	/**
	 * Test setup method.
	 */
	public function test_setup() {
		// Setup
		\WP_Mock::expectActionAdded( 'after_setup_theme',  'ThomasRStorey\Additive\Core\i18n'        );
		\WP_Mock::expectActionAdded( 'wp_enqueue_scripts', 'ThomasRStorey\Additive\Core\scripts'     );
		\WP_Mock::expectActionAdded( 'wp_enqueue_scripts', 'ThomasRStorey\Additive\Core\styles'      );
		\WP_Mock::expectActionAdded( 'wp_head',            'ThomasRStorey\Additive\Core\header_meta' );
		\WP_Mock::expectActionAdded( 'after_setup_theme',  'ThomasRStorey\Additive\Core\additive_navmenus');
		\WP_Mock::wpFunction ( 'add_theme_support', array(
			'times' => 3
		) );
		// Act
		setup();

		// Verify
		$this->assertConditionsMet();
	}

	/**
	 * Test internationalization integration.
	 */
	public function test_i18n() {
		// Setup
		\WP_Mock::wpFunction( 'load_theme_textdomain', array(
			'times' => 1,
			'args' => array(
				'additive',
				ADDITIVE_PATH . '/languages'
			),
		) );

		// Act
		i18n();

		// Verify
		$this->assertConditionsMet();
	}

	/**
	 * Test scripts enqueue.
	 */
	public function test_scripts() {
		// Regular
		\WP_Mock::wpFunction( 'wp_enqueue_script', array(
			'times' => 1,
			'args' => array(
				'additive',
				'template_url/assets/js/additive.min.js',
				array(),
				'0.1.0',
				true,
			),
		) );

		scripts();
		$this->assertConditionsMet();

		// Debug Mode
		\WP_Mock::wpFunction( 'wp_enqueue_script', array(
			'times' => 1,
			'args' => array(
				'additive',
				'template_url/assets/js/additive.js',
				array(),
				'0.1.0',
				true,
			),
		) );
		\WP_Mock::onFilter( 'special_filter' )
		        ->with( 'additive_script_debug' )
		        ->reply( true );

		scripts();
		$this->assertConditionsMet();
	}

	/**
	 * Test style enqueue.
	 */
	public function test_styles() {
		// Regular
		\WP_Mock::wpFunction( 'wp_enqueue_style', array(
			'times' => 5,
		) );

		styles();
		$this->assertConditionsMet();

		// Debug Mode
		\WP_Mock::wpFunction( 'wp_enqueue_style', array(
			'times' => 1,
			'args' => array(
				'additive',
				'url/assets/css/additive.css',
				array(),
				'0.1.0',
			),
		) );
		\WP_Mock::onFilter( 'special_filter' )
		        ->with( 'additive_style_debug' )
		        ->reply( true );

		styles();
		$this->assertConditionsMet();
	}

	/**
	 * Test header meta injection
	 */
	public function test_header_meta() {
		// Setup
		$url = 'template_url/humans.txt';
		$meta = '<link type="text/plain" rel="author" href="template_url/humans.txt" />';
		\WP_Mock::onFilter( 'additive_humans' )->with( $url )->reply( $url );
		\WP_Mock::wpPassThruFunction( 'esc_url' );

		// Act
		ob_start();
		header_meta();
		$result = ob_get_clean();

		// Verify
		$this->assertConditionsMet();
		$this->assertEquals( $meta, $result );
	}
}
