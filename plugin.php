<?php
/*
Plugin Name: SAPE Links
Plugin URI: http://wordpress.org/plugins/ram108-sape/
Description: SAPE.RU ссылки для веб-мастеров. Добавляет виджет, макрос [sape], а также контекстные ссылки на страницы сайта.
Version: 0.1
Author: Кирилл Бородин
Author URI: http://profiles.wordpress.org/ram108
License: GPL2
*/

// SETTINGS

define( '_RAM108_SAPE', __FILE__ );
require( 'plugin_admin.php' );
require( 'settings.php' );


// PLUGIN ERROR - exit

if ( !$sape_settings['user'] ) return;


// INIT SAPE

if ( !defined('_SAPE_USER') ) {

    define('_SAPE_USER', $sape_settings['user']);
    require_once( realpath ($_SERVER['DOCUMENT_ROOT']).'/'._SAPE_USER.'/sape.php');
}

$sape = new SAPE_client( $sape_settings );
$sape_context = new SAPE_context( $sape_settings );


// SAPE CONTEXT

if ( $sape_settings['context'] ) {
    // remove_filter('the_content', 'wptexturize');
    add_filter('the_content', 'ram108_sape_context');
}

if ( $sape_settings['context_excerpt']) {
    // remove_filter('the_excerpt', 'wptexturize');
    add_filter('the_excerpt', 'ram108_sape_context');
}

function ram108_sape_context( $text ){
    global $sape_context;
    return $sape_context->replace_in_text_segment( $text );
}


// SAPE SHORTCODE

add_filter('widget_text', 'do_shortcode');
add_filter('the_excerpt', 'do_shortcode');

add_shortcode('sape', function( $args ){
    global $sape;
    extract( shortcode_atts(array('count' => 0), $args) );
    return '<div class="slink">'. ( $count ? $sape->return_links( $count ) : $sape->return_links() ) .'</div>';
});


// SAPE WIDGET

require( 'widget.php' );
