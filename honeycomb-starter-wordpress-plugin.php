<?php

/*
Plugin Name: Honeycomb Starter WordPress Plugin
Plugin URI: http://github.com/gios-asu/honeycomb-starter-wordpress-plugin
Description: A starter WordPress plugin for building your own Honeycomb-based plugins
Version: 0.0.1
Author: Julie Ann Wrigley Global Institute of Sustainability
License: Copyright 2016

GitHub Plugin URI: https://github.com/gios-asu/honeycomb-starter-wordpress-plugin
GitHub Branch: production
*/


if ( ! function_exists( 'add_filter' ) ) {
  header( 'Status: 403 Forbidden' );
  header( 'HTTP/1.1 403 Forbidden' );
  exit();
}

define( 'HONEYCOMB_STARTER_PLUGIN_VERSION', '1.1.2' );

require __DIR__ . '/vendor/autoload.php';

$registry = new \Honeycomb\Services\Register();
$registry->register(
    require __DIR__ . '/src/registry/wordpress-registry.php'
);
