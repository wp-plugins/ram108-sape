<?php

// LOAD SETTINGS

$sape_settings = get_option('ram108-sape');

// CHECK PHP

if ( version_compare(PHP_VERSION, '5.3.0', '<') ) {

    add_action('admin_notices', function(){
        echo '<div class="error"><p><b>SAPE Links</b>: Для работы плагина требуется верся <strong>PHP 5.3</strong> и выше. Ваша версия: '.phpversion().'.</p></div>';
    });

    $sape_settings['user'] = '';

    return;
}

// CHECK SETTINGS

if ( !$sape_settings['user'] ) {

    add_action('admin_notices', function(){
        echo '<div class="updated"><p><b>SAPE Links</b>: Необходима активация плагина на <a href="'.admin_url('options-general.php?page=ram108-sape').'">странице настроек</a>.</p></div>';
    });

    return;
}

// CHECK SAPE FILE

$sape_settings['file'] = realpath($_SERVER['DOCUMENT_ROOT']).'/'.$sape_settings['user'].'/sape.php';

if ( !file_exists( $sape_settings['file'] ) ) {

    add_action('admin_notices', function(){
        echo '<div class="error"><p><b>SAPE Links</b>: Файл не найден <b>'.$GLOBALS['sape_settings']['file'].'</b> | <a href="'.admin_url('options-general.php?page=ram108-sape').'">Настройки</a></p></div>';
    });

    $sape_settings['user'] = '';

    return;
}

// CHECK DEBUG

if ( @$sape_settings['force_show_code'] || @$sape_settings['verbose'] || @$sape_settings['debug'] ) {

    add_action('admin_notices', function(){
        echo '<div class="error"><p><b>SAPE Links</b>: Включен режим отладки sape. Смотрите HTML-код страницы (Ctrl-U) | <a href="'.admin_url('options-general.php?page=ram108-sape').'">Настройки</a></p></div>';
    });
}
