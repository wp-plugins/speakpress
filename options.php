<?php
/**
 * @package Speakpress
 * @author AvatR OHG
 * @version 1.0.3
 */
 
$base_name = plugin_basename('speakpress/options.php');
$base_page = 'admin.php?page='.$base_name;
$mode = trim(@$_GET['mode']);
$speakpress_settings = array('speakpress_options');
$plugin_dir = basename(dirname(__FILE__));
load_plugin_textdomain( 'speakpress', 'wp-content/plugins/' . $plugin_dir, $plugin_dir );

// update options
if (!empty($_POST['Submit'])) {
	$speakpress_options = array();
	$speakpress_options['quality'] = intval(@$_POST['quality']);
	$speakpress_options['speed'] = intval(@$_POST['speed']);
	$speakpress_options['gender'] = addslashes(@$_POST['gender']);
	$speakpress_options['language'] = addslashes(@$_POST['language']);
	$speakpress_options['localechain'] = addslashes(@$_POST['localechain']);
	$speakpress_options['theme'] = addslashes(@$_POST['theme']);
	$speakpress_options['speakpress_always_show'] = (bool) @$_POST['speakpress_always_show'];
	$speakpress_options['speakpress_stopbutton_show'] = (bool) @$_POST['speakpress_stopbutton_show'];
	$speakpress_options['autostart'] = (bool) @$_POST['autostart'];
	$speakpress_options['use_speakpress_css'] = (bool) @$_POST['use_speakpress_css'];
	$speakpress_options['use_speakpress_widget'] = (bool) @$_POST['use_speakpress_widget'];
	$speakpress_options['enable_widget_description'] = (bool) @$_POST['enable_widget_description'];
	$speakpress_options['button_caption'] = addslashes(@$_POST['button_caption']);
	$speakpress_options['stopbutton_caption'] = addslashes(@$_POST['stopbutton_caption']);
	$speakpress_options['widget_description'] = addslashes(@$_POST['widget_description']);
	$test = get_option('speakpress_options');
	$speakpress_options['activation_request_sent'] = $test['activation_request_sent'];
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
if (!empty($text)) echo '<div id="message" class="updated fade"><p>'.$text.'</p></div>';
?>

<div class="wrap">
	<?php screen_icon(); ?>
	<h2><?php _e('Speakpress options', 'speakpress'); ?></h2>	
	<h3><?php _e('Activate domain', 'speakpress'); ?></h3>
	<?php
	//get domain and admin-email
	$sp_adminemail = get_bloginfo('admin_email');
	$sp_blogurl = get_bloginfo('url');
	if ( isset($speakpress_options['domain_activated']) && intval($speakpress_options['domain_activated']) )	
		$sp_activated = 1;
	else
		$sp_activated = 0;
	//show activation form if not already activated
	if ($sp_activated == 1)
		_e('Domain activated, Speakpress can be used.','speakpress');
	//activation request sent but not activated yet
	elseif (isset($speakpress_options['activation_request_sent']) && intval($speakpress_options['activation_request_sent']))
		_e('Domain activation request sent. Please be patient.','speakpress');
	//not activated	
	else {
		if (isset($_REQUEST['email'])){
			$email = $_REQUEST['email'] ;
			$subject = 'Speakpress activation request' ;
			$message = $_REQUEST['domain'] ;
			if (mail( "felix@moches.de", "$subject",$message, "From: $email" )) {
				$text = '<font color="green">'.__('Activation request sent.','speakpress').'</font>';
				$speakpress_options['activation_request_sent'] = 1;
				update_option('speakpress_options',$speakpress_options);
			}
			else
				$text = '<font color="red">'.__('Sending activation request failed. Please manually send an email with your domain to speakr@avatr.net.','speakpress').'</font>';
			echo '<div class="updated fade"><p>'.$text.'</p></div>';
		}
		else { 
			_e('Your domain must be activated in order to use Speakpress. <br />Please use the following form to request activation and wait until we accepted your request.','speakpress');?>
			<form method="post" action="<?php echo admin_url('admin.php?page='.plugin_basename(__FILE__)); ?>">
			<table class="form-table">
				<tr>
					<th>Email:</th>
					<td><input name="email" type="text" value="<?php echo $sp_adminemail ?>" /></td>
				</tr>
				<tr>
					<th>Domain:</th>
					<td><input name="domain" type="text" value="<?php echo $sp_blogurl; ?>" /></td>
				</tr>
			</table>
			<p class="submit">
				<input type="submit" class="button" value="<?php _e('Activate domain', 'speakpress'); ?>" />
			</p>
			</form>
		<?php }
	}?>
	<h3><?php _e('Speakpress options', 'speakpress'); ?></h3>
	<form method="post" action="<?php echo admin_url('admin.php?page='.plugin_basename(__FILE__)); ?>">
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
		<tr>
			<th scope="row" valign="top"><?php _e('Embed Speakpress stop button after every post entry?', 'speakpress'); ?></th>
			<td>
				<input type="checkbox" name="speakpress_stopbutton_show" value="1" <?php checked($speakpress_options['speakpress_stopbutton_show']); ?>>
				<?php _e('When checked, also a stop-button will be added to all your posts.', 'speakpress'); ?>
			</td>	
		</tr>
		<tr>
			<th scope="row" valign="top"><?php _e('Button caption', 'speakpress'); ?></th>
			<td>
				<input type="text" name="button_caption" value="<?php echo stripslashes(htmlspecialchars($speakpress_options['button_caption'])); ?>" size="90" /><br />
				<?php _e('Enter caption for Speakpress buttons.', 'speakpress'); ?>
		</tr>
		<tr>
			<th scope="row" valign="top"><?php _e('Stop button caption', 'speakpress'); ?></th>
			<td>
				<input type="text" name="stopbutton_caption" value="<?php echo stripslashes(htmlspecialchars($speakpress_options['stopbutton_caption'])); ?>" size="90" /><br />
				<?php _e('Enter caption for Stop buttons.', 'speakpress'); ?>
		</tr>
	</table>
	<p class="submit">
		<input type="submit" name="Submit" class="button" value="<?php _e('Save options', 'speakpress'); ?>" />
	</p>
</form>
<div style="background-color:#FFFFE0;border:1px solid #E6DB55;margin:5px 0 15px;padding:0 0.6em;">
	<p style="margin:0.5em 0;padding:2px;"><?php _e('You can find news about Speakpress at <a href="http://twitter.com/AvatRDev">our Twitter channel</a> and via hashtag <a href="http://twitter.com/search?q=%23Speakpress">#Speakpress</a>.','speakpress');
	_e('<br />Speakpress is free - but we would really appriciate it if you would donate to help developing this plugin.','speakpress'); ?>
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="hosted_button_id" value="PRU68HXRTP2H4">
			<input type="image" src="https://www.paypal.com/de_DE/DE/i/btn/btn_donateCC_LG.gif" border="0" name="submitpp" alt="<?php _e('Donate via Paypal','speakpress');?>">
			<img alt="" border="0" src="https://www.paypal.com/de_DE/i/scr/pixel.gif" width="1" height="1">
		</form>
	</p>
</div>
</div>