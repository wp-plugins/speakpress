<?php
/**
 * @package SpeakR
 * @author AvatR OHG
 * @version 1.0
 */
/*
Plugin Name: SpeakR
Plugin URI: http://speakr.avatr.net/en
Description: Text2Speech for your website
Author: AvatR OHG
Version: 1.0
Author URI: http://speakr.avatr.net/en


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

todo:
	-transient
	-icon
	-andere auto-include-fktn
	-"SpeakR Optionen updated"				
	-activation hook?
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
register_deactivation_hook(__FILE__,'speakr_deactivate');

function speakr_deactivate(){
	//delete_transient('speakr_transient');
	delete_option('speakr_options');
}

// adding admin menus
add_action('admin_menu', 'speakr_add_pages');

function speakr_add_pages() {
    // Add a new submenu under Options:
    add_options_page('SpeakR', 'SpeakR', 'manage_options', 'speakr/options.php');
}

// custom CSS
add_action('wp_print_styles', 'speakr_stylesheets');
function speakr_stylesheets() {
	$speakr_options = get_option('speakr_options');

	if ( isset($speakr_options['use_speakr_css']) && !intval($speakr_options['use_speakr_css']) )
		return;
	if (@file_exists(STYLESHEETPATH.'/speakr.css')) {
		$css_file = get_stylesheet_directory_uri() . '/speakr.css';
	} elseif (@file_exists(TEMPLATEPATH.'/speakr.css')) {
		$css_file = get_template_directory_uri() . '/speakr.css';
	} else {
		$css_file = plugins_url('speakr.css', __FILE__);
	}
	wp_enqueue_style('speakr', $css_file, false, '1.0', 'all');
}

// JS integration
wp_enqueue_script('speakr_flashPluginInterface', WP_PLUGIN_URL . '/speakr/js/flashPluginInterface.js','','1.0',false);
wp_enqueue_script('speakr_swfobject', WP_PLUGIN_URL . '/speakr/js/swfobject.js','','1.0',false);
wp_enqueue_script('speakr_flashEvents', WP_PLUGIN_URL . '/speakr/js/flashEvents.js','','1.0',false);
wp_enqueue_script('speakr_install', WP_PLUGIN_URL . '/speakr/js/speakrInstall.js','','1.0',false);

//automatically insert button after each post
add_filter('the_content', 'add_speakr_button');

function add_speakr_button($content) {
	global $post;
	$speakr_options = get_option('speakr_options');
	if ( !is_feed() && !is_page() && intval($speakr_options['always_show']) ) {
	$postid = $post->ID;
	$start = '<div class="speakr_container" id="speakr-'.$postid.'">';
	$start .= $content;
	$start .= "\n"
		. '</div><input class="speakr_btn" type="button" onclick="speakId(\'speakr-' . $postid .'\')" value="Text vorlesen" />'
		. "\n";			
	return $start;
	}
	else return $content;
}

//init
add_action('admin_init', 'speakr_init');
function speakr_init() {
	$plugin_dir = basename(dirname(__FILE__));
	load_plugin_textdomain( 'speakr', 'wp-content/plugins/'. 
	$plugin_dir.'/languages', $plugin_dir.'/languages' );
	$speakr_options = array(
		'theme' => 'white',
		'autostart' => 1,
		'quality' => '3',
		'language' => 'de',
		'localechain' => 'de_DE',
		'speed' => '2',
		'gender' => 'm',
		'use_speakr_css' => 0,
		'use_speakr_widget' => 1,
		'always_show' => 0,
		'enable_widget_description' => 1,
		'widget_description' => 'Click the read-button to activate this'
	);
	add_option('speakr_options', $speakr_options, 'SpeakR options');
}


function embed_speakr(){
	$speakr_options = get_option('speakr_options');
	$quality = $speakr_options['quality'];
	$speed = $speakr_options['speed'];
	$language = $speakr_options['language'];
	$theme = $speakr_options['theme'];
	$gender = $speakr_options['gender'];
	$localechain = $speakr_options['localechain'];
	
	if ( isset($speakr_options['autostart']) && intval($speakr_options['autostart']) )
		$autostart = 'true';
	else
		$autostart = 'false';	
	$output = '<script type="text/javascript"> var flashvars = {}; flashvars.defaultSpeed = "'.$speed.'"; flashvars.defaultLanguage = "'.$language.'";flashvars.localeChain = "'.$localechain.'";flashvars.autostart = "'.$autostart.'"; flashvars.defaultGender = "'.$gender.'";flashvars.defaultQuality = "'.$quality.'"; flashvars.theme = "'.$theme.'";flashvars.installFolder = "'.WP_PLUGIN_URL.'/speakr"; installSpeakR("'.WP_PLUGIN_URL.'/speakr/SpeakR.swf", flashvars); </script>';
	$output.= '<div id="flashSpeakR"><a href="http://www.adobe.com/go/getflashplayer"
target="_blank"> <img src="http://www.adobe.com/macromedia/
style_guide/images/160x41_Get_Flash_Player.jpg" alt="Flash Player herunterladen"/>
</a> </div>';
	echo $output;
}
?>
