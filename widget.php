<?php

class ram108_sape_widget extends WP_Widget {

function __construct() {

	$this->WP_Widget('ram108-swidget', 'SAPE Links', array(
			'classname'		=> 'ram108-swidget',
			'description'	=> 'Размещает ссылки SAPE на сайте. Используйте несколько копий виджета, чтобы отобразить ссылки в разных частях сайта.'
	));
}

function form( $instance ){
	extract( wp_parse_args( (array) $instance, array( 'title' => '', 'count' => '' ) ) ); 
	?>
	<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
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

function update( $new_instance, $old_instance ) {
	$instance = $old_instance;
	$instance['title'] = strip_tags( $new_instance['title'] );
	$instance['count'] = (int) $new_instance['count'];
	return $instance;
}

function widget( $args, $instance ) {
	extract($args); extract($instance);
	echo $before_widget;
	echo $title ? $before_title . apply_filters('widget_title', $title) . $after_title : '';
	echo do_shortcode( "[sape count=$count]" );
	echo $after_widget;
}

}

add_action('widgets_init', function(){
	register_widget('ram108_sape_widget');
});