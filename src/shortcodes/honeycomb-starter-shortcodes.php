<?php
namespace HoneycombStarter\Shortcodes;
use Honeycomb\Wordpress\Hook;


// Avoid direct calls to this file
if ( ! defined( 'HONEYCOMB_STARTER_PLUGIN_VERSION' ) ) {
  header( 'Status: 403 Forbidden' );
  header( 'HTTP/1.1 403 Forbidden' );
  exit();
}

/**
 * Honeycomb_Starter_Shortcodes
 * provides the shortcode [hello-world]
 */
class Honeycomb_Starter_Shortcodes extends Hook {
  use \HoneycombStarter\Options_Handler_Trait;

  private $path_to_views;

  const EXAMPLE_CLASS_CONSTANT  = 'Example Class Constant Value';

  public function __construct() {
    parent::__construct( 'honeycomb-starter-shortcodes', HONEYCOMB_STARTER_PLUGIN_VERSION );
    $this->path_to_views = __DIR__ . '/../views/';
    $this->define_hooks();
  }

  /**
   * Register plugin functionality through WP hooks
   *
   * Uncomment action lines when that action is useful for your plugin
   */
  public function define_hooks() {
    // $this->add_action( 'wp_enqueue_scripts', $this, 'wp_enqueue_scripts' );
    // $this->add_action( 'init', $this, 'setup_rewrites' );
    // $this->add_action( 'wp', $this, 'add_http_cache_header' );
    // $this->add_action( 'wp_head', $this, 'add_html_cache_header' );

    $this->add_shortcode( 'hello-world', $this, 'hello_world' );
  }

  /**
   * Shorthand view wrapper to make rendering a view using Nectary's factories easier in this plugin
   */
  private function view( $template_name ) {
    return new \Nectary\Factories\View_Factory( $template_name, $this->path_to_views );
  }

  /**
   * Do not cache any sensitive form data - ASU Web Application Security Standards
   */
  public function add_html_cache_header() {
    if ( $this->current_page_has_hello_world_shortcode() ) {
      echo '<meta http-equiv="Pragma" content="no-cache"/>
            <meta http-equiv="Expires" content="-1"/>
            <meta http-equiv="Cache-Control" content="no-store,no-cache" />';
    }
  }

  /**
   * Do not cache any sensitive form data - ASU Web Application Security Standards
   * This call back needs to hook after send_headers since we depend on the $post variable
   * and that is not populated at the time of send_headers.
   */
  public function add_http_cache_header() {
    if ( $this->current_page_has_hello_world_shortcode() ) {
      header( 'Cache-Control: no-Cache, no-Store, must-Revalidate' );
      header( 'Pragma: no-Cache' );
      header( 'Expires: 0' );
    }
  }

  /**
   * Returns true if the page is using the [hello-world] shortcode, else false
   *
   * Don't enqueue any scripts or stylesheets provided by this plugin,
   * unless we are actually rendering the shortcode
   */
  private function current_page_has_hello_world_shortcode() {
    global $post;
    return ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'hello-world' ) );
  }

  /**
   * Set up any url rewrites: Enable if needed
   *
   * WordPress requires that you tell it that you are using
   * additional parameters in the url.
   */
  // public function setup_rewrites() {
  //   add_rewrite_tag( '%param1%' , '([^&]+)' );
  //   add_rewrite_tag( '%param2%' , '([^&]+)' );
  // }

  /**
   * Enqueue CSS and JS
   * Hooks onto `wp_enqueue_scripts`.
   */
  public function wp_enqueue_scripts() {
    if ( $this->current_page_has_hello_world_shortcode() ) {
      $url_to_css_file = plugin_dir_url( dirname( dirname( __FILE__ ) ) ) . 'assets/css/honeycomb-starter.css';
      wp_enqueue_style( $this->plugin_slug, $url_to_css_file, array(), $this->version );

      // alternately, if you use Bower or another dependency manager to load needed library assets, point to that location
      $url_to_script_example = plugin_dir_url( dirname( dirname( __FILE__ ) ) ) . 'assets/css/honeycomb-starter.js';
      wp_enqueue_script( 'script-example', $url_to_script_example, array( 'js' ), '1.0.0', false );
    }
  }

  public function hello_world( $atts, $content = '' ) {
    return 'Hello from the Honeycomb Starter Plugin';
  }

}
