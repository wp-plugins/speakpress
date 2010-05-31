<?php
/**
 * @package Speakpress
 * @author AvatR OHG
 * @version 1.0
 */
/*
Plugin Name: Speakpress
Plugin URI: http://speakpress.avatr.net/en
Description: Text2Speech for your website
Author: AvatR OHG
Version: 1.0
Author URI: http://speakpress.avatr.net/en


This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

if ( ! defined( 'WP_CONTENT_DIR' ) )
	define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
if ( ! defined( 'WP_PLUGIN_DIR' ) )
	define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );
if ( ! defined( 'PLUGINDIR' ) )
	define( 'PLUGINDIR', 'wp-content/plugins' );

define('SPEAKR_URLPATH', WP_PLUGIN_URL.'/'.plugin_basename( dirname(__FILE__) ).'/' );

include_once (dirname (__FILE__)."/quicktag.php");
include_once (dirname (__FILE__)."/tinymce.php");
include_once (dirname (__FILE__)."/widget.php");

//uninstall
register_deactivation_hook(__FILE__,'speakpress_deactivate');

function speakpress_deactivate(){
	//delete_transient('speakpress_transient');
	delete_option('speakpress_options');
}

// adding admin menus
add_action('admin_menu', 'speakpress_add_pages');

function speakpress_add_pages() {
    // Add a new submenu under Options:
    add_options_page('Speakpress', 'Speakpress', 'manage_options', 'speakpress/options.php');
}

// custom CSS
add_action('wp_print_styles', 'speakpress_stylesheets');
function speakpress_stylesheets() {
	$speakpress_options = get_option('speakpress_options');

	if ( isset($speakpress_options['use_speakpress_css']) && !intval($speakpress_options['use_speakpress_css']) )
		return;
	if (@file_exists(STYLESHEETPATH.'/speakpress.css')) {
		$css_file = get_stylesheet_directory_uri() . '/speakpress.css';
	} elseif (@file_exists(TEMPLATEPATH.'/speakpress.css')) {
		$css_file = get_template_directory_uri() . '/speakpress.css';
	} else {
		$css_file = plugins_url('speakpress.css', __FILE__);
	}
	wp_enqueue_style('speakpress', $css_file, false, '1.0', 'all');
}

// JS integration
wp_enqueue_script('speakpress_flashPluginInterface', WP_PLUGIN_URL . '/speakpress/js/flashPluginInterface.js','','1.0',false);
wp_enqueue_script('speakpress_swfobject', WP_PLUGIN_URL . '/speakpress/js/swfobject.js','','1.0',false);
wp_enqueue_script('speakpress_flashEvents', WP_PLUGIN_URL . '/speakpress/js/flashEvents.js','','1.0',false);
wp_enqueue_script('speakpress_install', WP_PLUGIN_URL . '/speakpress/js/speakpressInstall.js','','1.0',false);

//automatically insert button after each post
add_filter('the_content', 'add_speakpress_button');

function add_speakpress_button($content) {
	global $post;
	$speakpress_options = get_option('speakpress_options');
	$buttoncaption = $speakpress_options['button_caption'];
	if ( !is_feed() && !is_page() && intval($speakpress_options['speakpress_always_show']) ) {
	$postid = $post->ID;
	$start = '<div class="speakpress_container" id="speakpress-'.$postid.'">';
	$start .= $content;
	$start .= "\n"
		. '</div><input class="speakpress_btn" type="button" onclick="speakId(\'speakpress-' . $postid .'\')" value="'. $buttoncaption .'" />'
		. "\n";			
	return $start;
	}
	else return $content;
}

//init
add_action('admin_init', 'speakpress_init');
function speakpress_init() {
	$plugin_dir = basename(dirname(__FILE__));
	load_plugin_textdomain( 'speakpress', 'wp-content/plugins/'. 
	$plugin_dir.'/languages', $plugin_dir.'/languages' );
	$speakpress_options = array(
		'theme' => 'white',
		'autostart' => 1,
		'quality' => '3',
		'language' => 'de',
		'localechain' => 'de_DE',
		'speed' => '2',
		'gender' => 'm',
		'use_speakpress_css' => 0,
		'use_speakpress_widget' => 1,
		'speakpress_always_show' => 0,
		'enable_widget_description' => 1,
		'widget_description' => 'Click the read-button to activate this',
		'button_caption' => 'Read'
	);
	add_option('speakpress_options', $speakpress_options);
}

//embedding
function embed_speakpress(){
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
	$output = '<script type="text/javascript"> var flashvars = {}; flashvars.defaultSpeed = "'.$speed.'"; flashvars.defaultLanguage = "'.$language.'";flashvars.localeChain = "'.$localechain.'";flashvars.autostart = "'.$autostart.'"; flashvars.defaultGender = "'.$gender.'";flashvars.defaultQuality = "'.$quality.'"; flashvars.theme = "'.$theme.'";flashvars.installFolder = "'.WP_PLUGIN_URL.'/speakpress"; installSpeakR("'.WP_PLUGIN_URL.'/speakpress/SpeakR.swf", flashvars); </script>';
	$output.= '<div id="flashSpeakR"><a href="http://www.adobe.com/go/getflashplayer"
target="_blank"> <img src="http://www.adobe.com/macromedia/
style_guide/images/160x41_Get_Flash_Player.jpg" alt="Flash Player herunterladen"/>
</a> </div>';
	echo $output;
}
?>
