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
    $this->add_shortcode( 'hello-world', $this, 'hello_world' );
  }

  public function hello_world( $atts, $content = '' ) {
    return 'Hello from the Honeycomb Starter Plugin';
  }

}
