<?php
/**
 * @package Speakpress
 * @author AvatR OHG
 * @version 1.0
 */
$base_name = plugin_basename('speakpress/options.php');
$base_page = 'admin.php?page='.$base_name;
$mode = trim(@$_GET['mode']);
$speakpress_settings = array('speakpress_options');
	$plugin_dir = basename(dirname(__FILE__));
	load_plugin_textdomain( 'speakpress', 'wp-content/plugins/' . $plugin_dir, $plugin_dir );
// Update Options
if (!empty($_POST['Submit'])) {

	$speakpress_options = array();
	$speakpress_options['quality'] = intval(@$_POST['quality']);
	$speakpress_options['speed'] = intval(@$_POST['speed']);
	$speakpress_options['gender'] = addslashes(@$_POST['gender']);
	$speakpress_options['language'] = addslashes(@$_POST['language']);
	$speakpress_options['localechain'] = addslashes(@$_POST['localechain']);
	$speakpress_options['theme'] = addslashes(@$_POST['theme']);
	$speakpress_options['speakpress_always_show'] = (bool) @$_POST['speakpress_always_show'];
	$speakpress_options['autostart'] = (bool) @$_POST['autostart'];
	$speakpress_options['use_speakpress_css'] = (bool) @$_POST['use_speakpress_css'];
	$speakpress_options['use_speakpress_widget'] = (bool) @$_POST['use_speakpress_widget'];
	$speakpress_options['enable_widget_description'] = (bool) @$_POST['enable_widget_description'];
	$speakpress_options['widget_description'] = addslashes(@$_POST['widget_description']);
	
	$update_speakpress_queries = array();
	$update_speakpress_text = array();
	$update_speakpress_queries[] = update_option('speakpress_options', $speakpress_options);
	$update_speakpress_text[] = __('Speakpress options', 'speakpress');
	$i=0;
	$text = '';
	foreach ($update_speakpress_queries as $update_speakpress_query) {
		if ($update_speakpress_query) {
			$text .= '<font color="green">'.$update_speakpress_text[$i].' '.__('updated', 'speakpress').'</font><br />';
		}
		$i++;
	}
	if (empty($text)) {
		$text = '<font color="red">'.__('No options updated', 'speakpress').'</font>';
	}
}

$speakpress_options = get_option('speakpress_options');
?>
<?php if (!empty($text)) { echo '<!-- Last Action --><div id="message" class="updated fade"><p>'.$text.'</p></div>'; } ?>
<form method="post" action="<?php echo admin_url('admin.php?page='.plugin_basename(__FILE__)); ?>">
<div class="wrap">
	<?php screen_icon(); ?>
	<h2><?php _e('Speakpress options', 'speakpress'); ?></h2>
	<h3><?php _e('Speakpress options', 'speakpress'); ?></h3>	
	<table class="form-table">
		<tr>
			<th scope="row" valign="top"><?php _e('Quality', 'speakpress'); ?></th>
			<td>
				<select name="quality" size="1">
					<option value="1"<?php selected('1', $speakpress_options['quality']); ?>><?php _e('low', 'speakpress'); ?></option>
					<option value="2"<?php selected('2', $speakpress_options['quality']); ?>><?php _e('medium', 'speakpress'); ?></option>
					<option value="3"<?php selected('3', $speakpress_options['quality']); ?>><?php _e('high', 'speakpress'); ?></option>
				</select>
				<?php _e('Choose the quality of the downloaded stream.', 'speakpress'); ?>
			</td>
		</tr>
		<tr>
			<th scope="row" valign="top"><?php _e('Speed', 'speakpress'); ?></th>
			<td>
				<select name="speed" size="1">
					<option value="1"<?php selected('1', $speakpress_options['speed']); ?>><?php _e('slow', 'speakpress'); ?></option>
					<option value="2"<?php selected('2', $speakpress_options['speed']); ?>><?php _e('medium', 'speakpress'); ?></option>
					<option value="3"<?php selected('3', $speakpress_options['speed']); ?>><?php _e('fast', 'speakpress'); ?></option>
				</select>
				<?php _e('Choose the speed.', 'speakpress'); ?>
			</td>
		</tr>
		<tr>
			<th scope="row" valign="top"><?php _e('Gender for voice', 'speakpress'); ?></th>
			<td>
				<select name="gender" size="1">
					<option value="m"<?php selected('m', $speakpress_options['gender']); ?>><?php _e('male', 'speakpress'); ?></option>
					<option value="f"<?php selected('f', $speakpress_options['gender']); ?>><?php _e('female', 'speakpress'); ?></option>
				</select>
				<?php _e('Choose if you want to hear a male or female voice.', 'speakpress'); ?>
			</td>
		</tr>
		<tr>
			<th scope="row" valign="top"><?php _e('Theme', 'speakpress'); ?></th>
			<td>
				<select name="theme" size="1">
					<option value="cyan"<?php selected('cyan', $speakpress_options['theme']); ?>><?php _e('cyan', 'speakpress'); ?></option>
					<option value="green"<?php selected('green', $speakpress_options['theme']); ?>><?php _e('green', 'speakpress'); ?></option>
					<option value="orange"<?php selected('orange', $speakpress_options['theme']); ?>><?php _e('orange', 'speakpress'); ?></option>
					<option value="white"<?php selected('white', $speakpress_options['theme']); ?>><?php _e('white', 'speakpress'); ?></option>
				</select>
				<?php _e('Choose your colour theme.', 'speakpress'); ?>
			</td>
		</tr>
		<tr>
			<th scope="row" valign="top"><?php _e('Language', 'speakpress'); ?></th>
			<td>
				<select name="language" size="1">
					<option value="en"<?php selected('en', $speakpress_options['language']); ?>><?php _e('english', 'speakpress'); ?></option>
					<option value="de"<?php selected('de', $speakpress_options['language']); ?>><?php _e('german', 'speakpress'); ?></option>
				</select>
				<?php _e('Choose your preferred language for your texts.', 'speakpress'); ?>
			</td>
		</tr>
		<tr>
			<th scope="row" valign="top"><?php _e('Interface language', 'speakpress'); ?></th>
			<td>
				<select name="localechain" size="1">
					<option value="en_US"<?php selected('en_US', $speakpress_options['localechain']); ?>><?php _e('english', 'speakpress'); ?></option>
					<option value="de_DE"<?php selected('de_DE', $speakpress_options['localechain']); ?>><?php _e('german', 'speakpress'); ?></option>
				</select>
				<?php _e('Choose your preferred language for the Speakpress interface.', 'speakpress'); ?>
			</td>
		</tr>
		<tr>
			<th scope="row" valign="top"><?php _e('Enable auto play?', 'speakpress'); ?></th>
			<td>
				<input type="checkbox" name="autostart" value="1" <?php checked($speakpress_options['autostart']); ?>>
				<?php _e('When checked, Speakpress will automatically read your texts after the page is loaded.', 'speakpress'); ?>
			</td>
		</tr>
<!--
		<tr>
			<th scope="row" valign="top"><?php _e('Use speakpress.css?', 'speakpress'); ?></th>
			<td>
				<input type="checkbox" name="use_speakpress_css" value="1" <?php checked($speakpress_options['use_speakpress_css']); ?>>
				<?php _e('When checked, the plugin\'s css file is used. Place own speakpress.css in your template folder to override.', 'speakpress'); ?>
			</td>
		</tr>
-->
		<tr>
			<th scope="row" valign="top"><?php _e('Enable widget?', 'speakpress'); ?></th>
			<td>
				<input type="checkbox" name="use_speakpress_widget" value="1" <?php checked($speakpress_options['use_speakpress_widget']); ?>>
				<?php _e('Check to enable the widget and go to Theme-&gt;Widgets to activate it.', 'speakpress'); ?>
			</td>
		</tr>
		<tr>
			<th scope="row" valign="top"><?php _e('Enable widget description?', 'speakpress'); ?></th>
			<td>
				<input type="checkbox" name="enable_widget_description" value="1" <?php checked($speakpress_options['enable_widget_description']); ?>>
				<?php _e('Check to enable a custom description on the widget.', 'speakpress'); ?>
		</tr>
		<tr>
			<th scope="row" valign="top"><?php _e('Widget description', 'speakpress'); ?></th>
			<td>
				<input type="text" name="widget_description" value="<?php echo stripslashes(htmlspecialchars($speakpress_options['widget_description'])); ?>" size="90" /><br />
				<?php _e('Enter your widget description.', 'speakpress'); ?>
		</tr>
		<tr>
			<th scope="row" valign="top"><?php _e('Embed Speakpress button after every post entry?', 'speakpress'); ?></th>
			<td>
				<input type="checkbox" name="speakpress_always_show" value="1" <?php checked($speakpress_options['speakpress_always_show']); ?>>
				<?php _e('When checked, every post is wrapped between &lt;div&gt; elements and a button will be added to automatically read your posts.', 'speakpress'); ?>
			</td>			
		</tr>
	</table>
	<p class="submit">
		<input type="submit" name="Submit" class="button" value="<?php _e('Save options', 'speakpress'); ?>" />
	</p>
</div>
</form>