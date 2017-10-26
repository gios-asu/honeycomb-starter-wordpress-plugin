<?php
namespace HoneycombStarter\Shortcodes;
use Honeycomb\Wordpress\Hook;

/** Honeycomb_Starter_Shortcodes
 * provides the shortcode [hello-world]
 */
class Honeycomb_Starter_Shortcodes extends Hook {

  public function __construct() {
    $this->define_hooks();
  }

  public function define_hooks() {
    $this->add_shortcode( 'hello-world', $this, 'hello_world' );
  }

  public function hello_world( $atts, $content = '' ) {
    return 'Hello from the Honeycomb Starter Plugin';
  }

}
