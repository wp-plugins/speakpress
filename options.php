<?php
/**
 * @package SpeakR
 * @author AvatR OHG
 * @version 1.0
 */
$base_name = plugin_basename('speakr/options.php');
$base_page = 'admin.php?page='.$base_name;
$mode = trim(@$_GET['mode']);
$speakr_settings = array('speakr_options');
	$plugin_dir = basename(dirname(__FILE__));
	load_plugin_textdomain( 'speakr', 'wp-content/plugins/' . $plugin_dir, $plugin_dir );
// Update Options
if (!empty($_POST['Submit'])) {

	$speakr_options = array();
	$speakr_options['quality'] = intval(@$_POST['quality']);
	$speakr_options['speed'] = intval(@$_POST['speed']);
	$speakr_options['gender'] = addslashes(@$_POST['gender']);
	$speakr_options['language'] = addslashes(@$_POST['language']);
	$speakr_options['localechain'] = addslashes(@$_POST['localechain']);
	$speakr_options['theme'] = addslashes(@$_POST['theme']);
	$speakr_options['always_show'] = (bool) @$_POST['always_show'];
	$speakr_options['autostart'] = (bool) @$_POST['autostart'];
	$speakr_options['use_speakr_css'] = (bool) @$_POST['use_speakr_css'];
	$speakr_options['use_speakr_widget'] = (bool) @$_POST['use_speakr_widget'];
	$speakr_options['enable_widget_description'] = (bool) @$_POST['enable_widget_description'];
	$speakr_options['widget_description'] = addslashes(@$_POST['widget_description']);
	
	$update_speakr_queries = array();
	$update_speakr_text = array();
	$update_speakr_queries[] = update_option('speakr_options', $speakr_options);
	$update_speakr_text[] = __('SpeakR options', 'speakr');
	$i=0;
	$text = '';
	foreach ($update_speakr_queries as $update_speakr_query) {
		if ($update_speakr_query) {
			$text .= '<font color="green">'.$update_speakr_text[$i].' '.__('updated', 'speakr').'</font><br />';
		}
		$i++;
	}
	if (empty($text)) {
		$text = '<font color="red">'.__('No options updated', 'speakr').'</font>';
	}
}

$speakr_options = get_option('speakr_options');
?>
<?php if (!empty($text)) { echo '<!-- Last Action --><div id="message" class="updated fade"><p>'.$text.'</p></div>'; } ?>
<form method="post" action="<?php echo admin_url('admin.php?page='.plugin_basename(__FILE__)); ?>">
<div class="wrap">
	<?php screen_icon(); ?>
	<h2><?php _e('SpeakR options', 'speakr'); ?></h2>
	<h3><?php _e('SpeakR options', 'speakr'); ?></h3>	
	<table class="form-table">
		<tr>
			<th scope="row" valign="top"><?php _e('Quality', 'speakr'); ?></th>
			<td>
				<select name="quality" size="1">
					<option value="1"<?php selected('1', $speakr_options['quality']); ?>><?php _e('low', 'speakr'); ?></option>
					<option value="2"<?php selected('2', $speakr_options['quality']); ?>><?php _e('medium', 'speakr'); ?></option>
					<option value="3"<?php selected('3', $speakr_options['quality']); ?>><?php _e('hight', 'speakr'); ?></option>
				</select>
				<?php _e('Choose the quality of the downloaded stream.', 'speakr'); ?>
			</td>
		</tr>
		<tr>
			<th scope="row" valign="top"><?php _e('Speed', 'speakr'); ?></th>
			<td>
				<select name="speed" size="1">
					<option value="1"<?php selected('1', $speakr_options['speed']); ?>><?php _e('slow', 'speakr'); ?></option>
					<option value="2"<?php selected('2', $speakr_options['speed']); ?>><?php _e('medium', 'speakr'); ?></option>
					<option value="3"<?php selected('3', $speakr_options['speed']); ?>><?php _e('fast', 'speakr'); ?></option>
				</select>
				<?php _e('Choose the speed.', 'speakr'); ?>
			</td>
		</tr>
		<tr>
			<th scope="row" valign="top"><?php _e('Gender for voice', 'speakr'); ?></th>
			<td>
				<select name="gender" size="1">
					<option value="m"<?php selected('m', $speakr_options['gender']); ?>><?php _e('male', 'speakr'); ?></option>
					<option value="f"<?php selected('f', $speakr_options['gender']); ?>><?php _e('female', 'speakr'); ?></option>
				</select>
				<?php _e('Choose if you want to hear a male or female voice.', 'speakr'); ?>
			</td>
		</tr>
		<tr>
			<th scope="row" valign="top"><?php _e('Theme', 'speakr'); ?></th>
			<td>
				<select name="theme" size="1">
					<option value="cyan"<?php selected('cyan', $speakr_options['theme']); ?>><?php _e('cyan', 'speakr'); ?></option>
					<option value="green"<?php selected('green', $speakr_options['theme']); ?>><?php _e('green', 'speakr'); ?></option>
					<option value="orange"<?php selected('orange', $speakr_options['theme']); ?>><?php _e('orange', 'speakr'); ?></option>
					<option value="white"<?php selected('white', $speakr_options['theme']); ?>><?php _e('white', 'speakr'); ?></option>
				</select>
				<?php _e('Choose your colour theme.', 'speakr'); ?>
			</td>
		</tr>
		<tr>
			<th scope="row" valign="top"><?php _e('Language', 'speakr'); ?></th>
			<td>
				<select name="language" size="1">
					<option value="en"<?php selected('en', $speakr_options['language']); ?>><?php _e('english', 'speakr'); ?></option>
					<option value="de"<?php selected('de', $speakr_options['language']); ?>><?php _e('german', 'speakr'); ?></option>
				</select>
				<?php _e('Choose your preferred language for your texts.', 'speakr'); ?>
			</td>
		</tr>
		<tr>
			<th scope="row" valign="top"><?php _e('Interface language', 'speakr'); ?></th>
			<td>
				<select name="localechain" size="1">
					<option value="en_US"<?php selected('en_US', $speakr_options['localechain']); ?>><?php _e('english', 'speakr'); ?></option>
					<option value="de_DE"<?php selected('de_DE', $speakr_options['localechain']); ?>><?php _e('german', 'speakr'); ?></option>
				</select>
				<?php _e('Choose your preferred language for the SpeakR interface.', 'speakr'); ?>
			</td>
		</tr>
		<tr>
			<th scope="row" valign="top"><?php _e('Enable auto play?', 'speakr'); ?></th>
			<td>
				<input type="checkbox" name="autostart" value="1" <?php checked($speakr_options['autostart']); ?>>
				<?php _e('When checked, SpeakR will automatically read your texts after the page is loaded.', 'speakr'); ?>
			</td>
		</tr>
		<tr>
			<th scope="row" valign="top"><?php _e('Use speakr.css?', 'speakr'); ?></th>
			<td>
				<input type="checkbox" name="use_speakr_css" value="1" <?php checked($speakr_options['use_speakr_css']); ?>>
				<?php _e('When checked, the plugin\'s css file is used. Place own speakr.css in your template folder to override.', 'speakr'); ?>
			</td>
		</tr>
		<tr>
			<th scope="row" valign="top"><?php _e('Enable widget?', 'speakr'); ?></th>
			<td>
				<input type="checkbox" name="use_speakr_widget" value="1" <?php checked($speakr_options['use_speakr_widget']); ?>>
				<?php _e('Check to enable the widget and go to Theme-&gt;Widgets to activate it.', 'speakr'); ?>
			</td>
		</tr>
		<tr>
			<th scope="row" valign="top"><?php _e('Enable widget description?', 'speakr'); ?></th>
			<td>
				<input type="checkbox" name="enable_widget_description" value="1" <?php checked($speakr_options['enable_widget_description']); ?>>
				<?php _e('Check to enable a custom description on the widget.', 'speakr'); ?>
		</tr>
		<tr>
			<th scope="row" valign="top"><?php _e('Widget description', 'speakr'); ?></th>
			<td>
				<input type="text" name="widget_description" value="<?php echo stripslashes(htmlspecialchars($speakr_options['widget_description'])); ?>" size="90" /><br />
				<?php _e('Enter your widget description.', 'speakr'); ?>
		</tr>
		<tr>
			<th scope="row" valign="top"><?php _e('Embed SpeakR button after every post entry?', 'speakr'); ?></th>
			<td>
				<input type="checkbox" name="speakr_always_show" value="1" <?php checked($speakr_options['always_show']); ?>>
				<?php _e('When checked, every post is wrapped between &lt;div&gt; elements and a button will be added to automatically read your posts.', 'speakr'); ?>
			</td>			
		</tr>
	</table>
	<p class="submit">
		<input type="submit" name="Submit" class="button" value="<?php _e('Save options', 'speakr'); ?>" />
	</p>
</div>
</form>