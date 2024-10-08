<?php
/**
 * Theme media-service functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package media-service
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function media_service_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on media-service, use a find and replace
		* to change 'media-service' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'media-service', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'media-service' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'media_service_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'media_service_setup' );

/**
 * Enqueue scripts and styles.
 */
function mytheme_enqueue_scripts() {
	// Enqueue the custom JavaScript file.
	wp_enqueue_script( 'mytheme-custom-js', get_template_directory_uri() . '/custom/js/custom.js', array(), '1.0.0', true ); // Ensure script is enqueued.

	// // Enqueue the custom CSS file.
	// wp_enqueue_style( 'mytheme-custom-style', get_template_directory_uri() . '/custom/style.css', array(), '1.0.0', 'all' ); // Ensure style is enqueued.
}
add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_scripts' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function media_service_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'media_service_content_width', 640 );
}
add_action( 'after_setup_theme', 'media_service_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function media_service_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'media-service' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'media-service' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">aaaa',
			'after_widget'  => 'zzzz</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'media_service_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function media_service_scripts() {
	wp_enqueue_style( 'media-service-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'media-service-style', 'rtl', 'replace' );

  // Enqueue the custom CSS file.
	wp_enqueue_style( 'mytheme-custom-style', get_template_directory_uri() . '/custom/style.css', array(), '1.0.0', 'all' ); // Ensure style is enqueued.

	wp_enqueue_script( 'media-service-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'media_service_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


/**
 * Register custom block styles.
 */
function media_service_register_block_styles() {
  register_block_style(
      'core/quote',
      array(
          'name'         => 'fancy-quote',
          'label'        => __('Fancy Quote', 'media-service'),
      )
  );
}
add_action( 'init', 'media_service_register_block_styles' );

/**
 * Register custom block patterns.
 */
function media_service_register_block_patterns() {
  register_block_pattern(
      'media-service/my-custom-pattern',
      array(
          'title'       => __('Custom Pattern', 'media-service'),
          'description' => _x('A simple custom pattern', 'Block pattern description', 'media-service'),
          'content'     => "<!-- wp:paragraph --><p>" . __('Your custom pattern content here.', 'media-service') . "</p><!-- /wp:paragraph -->",
      )
  );
}
add_action( 'init', 'media_service_register_block_patterns' );

/**
 * Add theme support for various block features.
 */
function media_service_add_theme_supports() {
  add_theme_support( 'wp-block-styles' );
  add_theme_support( 'responsive-embeds' );
  add_theme_support( 'align-wide' );
}
add_action( 'after_setup_theme', 'media_service_add_theme_supports' );

/**
 * Add editor styles to match front-end design.
 */
function media_service_add_editor_styles() {
  add_editor_style( 'style-editor.css' ); // 'style-editor.css' はエディタースタイルのCSSファイルです。
}
add_action( 'after_setup_theme', 'media_service_add_editor_styles' );


function custom_logo_width_height($html) {
  // Set your desired width and height
  $width = 470;
  $height = 48;

  // Replace the width and height attributes
  $html = preg_replace('/width="\d+"/', 'width="' . $width . '"', $html);
  $html = preg_replace('/height="\d+"/', 'height="' . $height . '"', $html);

  return $html;
}
add_filter('get_custom_logo', 'custom_logo_width_height');


function add_class_to_last_menu_item($items, $args) {
  if (!empty($items)) {
      $items[count($items)]->classes[] = 'last-menu-item';
  }
  return $items;
}
add_filter('wp_nav_menu_objects', 'add_class_to_last_menu_item', 10, 2);

function enqueue_noto_sans() {
  wp_enqueue_style( 'noto-sans', 'ttps://fonts.googleapis.com/css2?family=IBM+Plex+Sans+JP&family=Noto+Sans+JP:wght@100..900&display=swap', array(), null );
}
add_action( 'wp_enqueue_scripts', 'enqueue_noto_sans' );

function enqueue_ibm_plex_sans_jp() {
  wp_enqueue_style( 'ibm-plex-sans-jp', 'https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+JP:wght@100;200;300;400;500;600;700&display=swap', array(), null );
}
add_action( 'wp_enqueue_scripts', 'enqueue_ibm_plex_sans_jp' );


