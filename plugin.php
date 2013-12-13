<?php
/*
Plugin Name: [ram108] SAPE Links
Plugin URI: http://wordpress.org/plugins/ram108-sape/
Description: SAPE.RU ссылки для веб-мастеров. Добавляет виджет, макрос [sape] и контекстные ссылки на страницы сайта.
Version: 0.3
Author: ram108
Author URI: http://profiles.wordpress.org/ram108
Author Email: plugin@ram108.ru
License: GPL2
License URI: http://www.gnu.org/licenses/gpl-2.0.html
===========================================================
Copyright 2013 by Kirill Borodin plugin@ram108.ru
http://www.ram108.ru/donate
*/

// PHP VERSION CHECK

if ( version_compare( PHP_VERSION, '5.0', '<' ) ) {
	add_action( 'admin_notices', 'ram108_php_warning' );
	function ram108_php_warning(){ ?><div class="error"><p><b>[ram108] SAPE Links</b>: Для работы планига требуется <strong>PHP 5.0</strong> и выше.</p></div><?php }
	return;
}

// DEFINE

define( '_RAM108_SAPE', __FILE__ );
define( '_RAM108_SAPE_DIR', dirname( __FILE__ ) );
define( '_RAM108_SAPE_VER', '0.3' );

// LIBRARY

require( _RAM108_SAPE_DIR.'/library/settings.php' );
require( _RAM108_SAPE_DIR.'/library/plugin.php' );

// INCLUDE

require( _RAM108_SAPE_DIR.'/include/ram108_sape.php' );
require( _RAM108_SAPE_DIR.'/include/ram108_sape_widget.php' );
require( _RAM108_SAPE_DIR.'/include/plugin_admin.php' );