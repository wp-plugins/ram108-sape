<?php

// ACTIVATE / DEACTIVATE

register_activation_hook( _RAM108_SAPE, function(){

    update_option( 'ram108-sape', array(
	    'user'              => '',
	    'charset'           => 'UTF-8',
	    'verbose'           => 0,
	    'force_show_code'   => 0,
	    'context'           => '1',
	    'context_except'    => '0',
	));
});

register_deactivation_hook( _RAM108_SAPE, function(){

    delete_option( 'ram108-sape' );
});


// SETTINGS LINK

add_filter('plugin_action_links_' . plugin_basename( _RAM108_SAPE ), function( $links ){

    return array_merge( array('<a href="'.admin_url('options-general.php?page=ram108-sape').'">Настройки</a>'), $links );
});


// ADMIN OPTIONS

add_action( 'admin_init', function(){

	register_setting('ram108-sape', 'ram108-sape'); //, 'ram108_sape_settings_validate');
});

if ( is_admin() ) add_action('admin_menu', function(){

	add_options_page('SAPE Links settings', 'SAPE Links', 'manage_options', 'ram108-sape', 'ram108_sape_settings');
});

function ram108_sape_settings() {
	
	$options = get_option('ram108-sape');
	?>
	<div class="wrap">

		<form method="post" action="options.php">

			<?php settings_fields('ram108-sape'); ?>

			<h2>Настройки SAPE Links</h2>

			<table class="form-table">
				<tr valign="top"><th scope="row"><strong>Идентификатор _SAPE_USER</strong></th>
					<td><input class="regular-text" type="text" name="ram108-sape[user]" value="<?php echo $options['user']; ?>" /></td>
				</tr>
				<tr valign="top"><th scope="row">Контекстные ссылки в тексте</th>
					<td><input type="checkbox" name="ram108-sape[context]" value="1"<?php checked( $options['context'] );?> /></td>
				</tr>
				<tr valign="top"><th scope="row">Контекстные ссылки в цитате</th>
					<td><input type="checkbox" name="ram108-sape[context_except]" value="1"<?php checked( $options['context_except'] );?> /></td>
				</tr>
			</table>

			<h3 class="title">Дополнительные настройки</h3>

			<table class="form-table">
				<tr valign="top"><th scope="row">Кодировка</th>
					<td><input class="regular-text" type="text" name="ram108-sape[charset]" value="<?php echo $options['charset']; ?>" /></td>
				</tr>
			</table>

			<h3 class="title">Режим отладки sape</h3>

			<table class="form-table">
				<tr valign="top"><th scope="row">verbose</th>
					<td><input type="checkbox" name="ram108-sape[verbose]" value="1"<?php checked( $options['verbose'] );?> /></td>
				</tr>
				<tr valign="top"><th scope="row">force_show_code</th>
					<td><input type="checkbox" name="ram108-sape[force_show_code]" value="1"<?php checked( $options['force_show_code'] );?> /></td>
				</tr>
			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
			</p>
		</form>

		<h2>Использование плагина</h2>

		<p>1. <a href="<?php echo admin_url('widgets.php');?>">Виджет SAPE Links</a> для размещения ссылок в области виджетов сайта.
		<p>2. <strong>Макрос для отображения ссылок</strong> на страницах сайта. Использование: <strong>[sape]</strong> или [sape count=3].</p>
		<p>3. Автоматические <strong>контекстные ссылки</strong> при включенных настройках. Вывод ссылок в цитате <strong>не рекомендуется</strong>.</p>
		<p>4. Вывод ссылок в теме оформления. Вставьте код <strong>&lt;?php do_shortcode('[sape count=3'); ?&gt;</strong> там, где вы желаете выводить ссылки.</p>

		<h2>Настройка и активация плагина</h2>

		<h3>1. Регистрация в sape</h3>
		<p><a href="http://www.sape.ru/r.zPvHCvTdOj.php" target="_blank">Переходим на сайт Sape</a>&rarr;Регистрация. Следуем подсказкам сайта для создания аккаунта.<p>

		<h3>2. Добавление площадки и установка кода</h3>
		<p><a href="http://www.sape.ru/r.zPvHCvTdOj.php" target="_blank">Переходим на сайт Sape</a>&rarr;Веб-мастеру&rarr;Добавить площадку. Следуем инструкциям <strong>"Для хостинга с поддержкой PHP"</strong>.</p>

		<h3>3. Получение идентификатора _SAPE_USER</h3>
		<p><a href="http://www.sape.ru/r.zPvHCvTdOj.php" target="_blank">Переходим на сайт Sape</a>&rarr;Веб-мастеру&rarr;<img style="vertical-align:middle" src="//static.sape.ru/www/img/icon_options.gif">Настройки площадки&rarr;Код. На странице найдите строку вида <strong>4c6b4b2fd754b696a5672e5248cd2985</strong> и скопируйте ее в настройки плагина. Это и есть идентификатор _SAPE_USER.</p>

		<h2>Сообщения об ошибках</h2>

		<h3>Файл /.../sape.php не найден</h3>
		<p><strong>Папка с кодом sape.php</strong> должена находиться в корне сайта. Название папки соответствует идентификатору <strong>_SAPE_USER</strong>. На папку устанавливаются права <strong>777</strong>. Идентификатор _SAPE_USER указывается в настройках плагина. Папку с кодом вы можете <a href="http://www.sape.ru/get_user_files.php" target="_blank">скачать по ссылке</a> с сайта sape.

		<h3>Включен режим отладки Sape</h3>
		<p>На рабочем сайте оба параметра в настройках <strong>режима отладки Sape</strong> должны быть отключены.</p>

		<h2>Благодарность</h2>
		<p>Понравился плагин SAPE Links? <a href="http://wordpress.org/plugins/ram108-sape/" target="_blank">Оцените его</a> в каталоге плагинов Wordpress или напишите <strong>обзор плагина</strong> на своем сайте.</p>
		
	</div>
	<?php
}

function ram108_sape_settings_validate(){
}
