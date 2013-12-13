<?php

add_action('widgets_init', create_function('', "register_widget('ram108_sape_widget');" ) );

class ram108_sape_widget extends WP_Widget {

	function __construct() {

		$this->WP_Widget('ram108-swidget', '[ram108] SAPE Links', array(

				'classname'		=> 'ram108-swidget',
				'description'	=> 'Размещает ссылки SAPE на сайте. Используйте несколько копий виджета для выводы ссылок в разных частях сайта. Идеально — одна ссылка в одном месте и не более 3 ссылок на странице.'
		));
	}

	function form( $data ){

		extract( wp_parse_args( (array) $data, array( 'title' => '', 'count' => '' ) ) ); 
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Заголовок:</label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>">Количество ссылок:</label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" size="1">
				<?php for ($i = 0; $i <= 5; $i++) { echo '<option value="'.$i.'"'.( $i == $count ? ' selected="selected"' : '' ).'>'.( $i == 0 ? 'Все' : $i ).'</option>';} ?>
			</select>
		</p>
		<?php 
	}

	function update( $data, $old_data ) {

		$data['title'] = strip_tags( $data['title'] );
		$data['count'] = (int) $data['count'];

		return $data;
	}

	function widget( $args, $data ) {

		extract($args);

		$text = '';
		$text .= $data['title'] ? $before_title . apply_filters( 'widget_title', $data['title'] ) . $after_title : '';
		$text .= $shortcode = do_shortcode( $data['count'] ? "[sape count={$data['count']}]" : "[sape]" );

		echo (bool)$shortcode ? $before_widget.$text.$after_widget : '';
	}
}