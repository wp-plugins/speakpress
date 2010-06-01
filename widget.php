<?php
/**
 * @package Speakpress
 * @author Felix Moche
 * @version 1.0.1
 */

add_action( 'widgets_init', 'load_widget' );

function load_widget() {
	$speakpress_options = get_option('speakpress_options');
	if ( isset($speakpress_options['use_speakpress_widget']) && !intval($speakpress_options['use_speakpress_widget']) )
	return;	
	else { register_widget( 'Speakpresswidget' );}
}

class Speakpresswidget extends WP_Widget {
	function Speakpresswidget() {
		$widget_ops = array( 'classname' => 'speakpress', 'description' => __('Text2Speech Widget.', 'speakpress') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'speakpress-widget' );
		$this->WP_Widget( 'speakpress-widget', __('Speakpress Widget', 'speakpress'), $widget_ops, $control_ops );
	}
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$speakpress_options = get_option('speakpress_options');
		$quality = $speakpress_options['quality'];
		$speed = $speakpress_options['speed'];
		$language = $speakpress_options['language'];
		$theme = $speakpress_options['theme'];
		$gender = $speakpress_options['gender'];
		$localechain = $speakpress_options['localechain'];
		if ( isset($speakpress_options['autostart']) && intval($speakpress_options['autostart']) )
			$autostart = 'true';
		else
			$autostart = 'false';	
		echo "\n\n" . $before_widget . $before_title . $instance['title'] . $after_title . "\n";
		echo '<script type="text/javascript"> var flashvars = {}; flashvars.defaultSpeed = "'.$speed.'"; flashvars.defaultLanguage = "'.$language.'";flashvars.localeChain = "'.$localechain.'";flashvars.autostart = "'.$autostart.'"; flashvars.defaultGender = "'.$gender.'";flashvars.defaultQuality = "'.$quality.'"; flashvars.theme = "'.$theme.'";flashvars.installFolder = "'.WP_PLUGIN_URL.'/speakpress"; installSpeakR("'.WP_PLUGIN_URL.'/speakpress/SpeakR.swf", flashvars); </script>';
		echo '<div id="flashSpeakR"><a href="http://www.adobe.com/go/getflashplayer"
target="_blank"> <img src="http://www.adobe.com/macromedia/
style_guide/images/160x41_Get_Flash_Player.jpg" alt="Flash Player herunterladen"/>
</a> </div>';
		if (intval($speakpress_options['enable_widget_description'])) echo '<p class="speakr_description">' . $speakpress_options['widget_description'] . '</p>';
		echo $after_widget . "\n\n";
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		//strip input elements
		$instance['title'] = strip_tags( $new_instance['title'] );
		//don't strip checkboxes
		$instance['quality'] = $new_instance['quality'];
		$instance['gender'] = $new_instance['gender'];
		$instance['language'] = $new_instance['language'];
		$instance['speed'] = $new_instance['speed'];
		return $instance;
	}
	function form( $instance ) {
		$defaults = array( 'title' => __('Speakpress', 'speakpress') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'hybrid'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
	<?php
	}
}
?>