<?php
/**
 * @package Speakpress
 * @author AvatR OHG
 * @version 1.1.0
 */
/*
Plugin Name: Speakpress
Plugin URI: http://speakpress.avatr.net/en
Description: Text2Speech for your website
Author: AvatR OHG
Version: 1.1.0
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

define('SPEAKPRESS_URLPATH', WP_PLUGIN_URL.'/'.plugin_basename( dirname(__FILE__) ).'/' );
$plugin = plugin_basename(__FILE__);

include_once (dirname (__FILE__)."/quicktag.php");
include_once (dirname (__FILE__)."/tinymce.php");
include_once (dirname (__FILE__)."/widget.php");

//uninstall
function speakpress_uninstall(){
        delete_option('speakpress_options');
}

if (is_admin()){
        add_action('admin_menu', 'speakpress_add_pages');
        //add_action('wp_print_styles', 'speakpress_stylesheets');
        add_filter( 'plugin_action_links_' .$plugin, 'set_speakr_meta');
        register_uninstall_hook(__FILE__,'speakpress_uninstall');
}

//adding admin menus
function speakpress_add_pages(){
    // Add a new submenu under Options:
    add_options_page('Speakpress', 'Speakpress', 'manage_options', 'speakpress/options.php');
}

//set meta
function set_speakr_meta($links){
        $settings_link = '<a href="options-general.php?page=speakpress/options.php">' . __('Settings') . '</a>';
        array_unshift( $links, $settings_link );
         return $links;
}

//custom CSS
function speakpress_stylesheets(){
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
        if (!is_admin())
                wp_enqueue_style('speakpress', $css_file, false, '1.0', 'all');
}

//automatically insert button after each post
add_filter('the_content', 'add_speakpress_button');

function add_speakpress_button($content){
        global $post;
        $speakpress_options = get_option('speakpress_options');
        $buttoncaption = $speakpress_options['button_caption'];
        $stopbuttoncaption = $speakpress_options['stopbutton_caption'];
        if ( !is_feed() && !is_page() && intval($speakpress_options['speakpress_always_show']) ) {
        $postid = $post->ID;
        $start = '<div class="speakpress_container" id="speakpress-'.$postid.'">';
        $start .= $content;
        $start .= "\n"
                . '</div><input class="speakpress_btn" type="button" onclick="speakId(\'speakpress-' . $postid .'\')" value="'. $buttoncaption .'" />'
                . "\n";
        if ( !is_feed() && !is_page() && intval($speakpress_options['speakpress_always_show']) && intval($speakpress_options['speakpress_stopbutton_show']) ) {
        $start .= "\n"
                . '<input class="speakpress_btn" type="button" onclick="stopSpeak();" value="'. $stopbuttoncaption .'" />'
                . "\n";
        }

        return $start;
        }
        else
                return $content;
}

//JS integration
add_action('wp_print_scripts', 'speakpress_scripts_loader');

function speakpress_scripts_loader(){
        if (!is_admin()){
                wp_enqueue_script('speakpress_flashPluginInterface', WP_PLUGIN_URL . '/speakpress/js/flashPluginInterface.js','','1.0',false);
                wp_enqueue_script('speakpress_swfobject', WP_PLUGIN_URL . '/speakpress/js/swfobject.js','','1.0',false);
                wp_enqueue_script('speakpress_flashEvents', WP_PLUGIN_URL . '/speakpress/js/flashEvents.js','','1.0',false);
                wp_enqueue_script('speakpress_install', WP_PLUGIN_URL . '/speakpress/js/speakrInstall.js','','1.0',false);
        }
}

//init
add_action('admin_init', 'speakpress_init');
function speakpress_init(){
        $plugin_dir = basename(dirname(__FILE__));
        load_plugin_textdomain( 'speakpress', 'wp-content/plugins/'. $plugin_dir.'/languages', $plugin_dir.'/languages' );
        $speakpress_options = array(
                'theme' => 'white',
                'autostart' => 0,
                'quality' => '3',
                'language' => 'de',
                'localechain' => 'de_DE',
                'speed' => '2',
                'gender' => 'm',
                'use_speakpress_css' => 0,
                'use_speakpress_widget' => 1,
                'speakpress_always_show' => 1,
                'speakpress_stopbutton_show' => 0,
                'enable_widget_description' => 1,
                'domain_activated' => 0,
                'activation_request_confirmed' => 0,
                'activation_request_sent' => 0,
                'widget_description' => 'Click the read-button to activate this',
                'button_caption' => 'Read',
                'stopbutton_caption' => 'Stop'
        );
        add_option('speakpress_options', $speakpress_options);
        speakpress_check_domain_activation_status();
        speakpress_admin_warning();
}

//get remote file
function getRemoteFile($url) {
        //get host name and url path
        $parsedUrl = parse_url($url);
        $host = $parsedUrl['host'];
        if (isset($parsedUrl['path']))
                $path = $parsedUrl['path'];
        else
                $path = '/';
        if (isset($parsedUrl['query']))
                $path .= '?' . $parsedUrl['query'];
        if (isset($parsedUrl['port']))
                $port = $parsedUrl['port'];
        else
                $port = '80';
        $timeout = 10;
        $response = '';
        //connect to remote server
        $fp = @fsockopen($host, '80', $errno, $errstr, $timeout );
        if(!$fp)
                echo "Cannot retrieve $url";
        else {
                //send necessary headers to get the file
                fputs($fp, "GET $path HTTP/1.0\r\n" .
                        "Host: $host\r\n" .
                        "User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.0.3) Gecko/20060426 Firefox/1.5.0.3\r\n" .
                        "Accept: */*\r\n" .
                        "Accept-Language: en-us,en;q=0.5\r\n" .
                        "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7\r\n" .
                        "Keep-Alive: 300\r\n" .
                        "Connection: keep-alive\r\n" .
                        "Referer: http://$host\r\n\r\n");
                        //retrieve response from remote server
                while ($line = fread($fp,4096)) {
                        $response .= $line;
                }
                fclose( $fp );
                //strip headers
                $pos = strpos($response, "\r\n\r\n");
                $response = substr($response, $pos + 4);
        }
        //return file content
        return $response;
}

//check if domain is activated
function speakpress_check_domain_activation_status(){
        $speakpress_options = get_option('speakpress_options');
        if (isset($speakpress_options['domain_activated']) && intval($speakpress_options['domain_activated'])){
                        return;
        }
        else {
                $sp_blogurl = get_bloginfo('url');
                $registered = getRemoteFile("http://speakr.avatr.net/api/check_registration.php?url=$sp_blogurl");
                $regoutput = explode("_",$registered);

                //if domain activated by avatr
                if ($regoutput[0] == 'active') {
                        $speakpress_options['domain_activated'] = 1;
                        update_option('speakpress_options',$speakpress_options);
                }
                //if activation link clicked
                if ($regoutput[1] == 'confirmed') {
                        $speakpress_options['activation_request_confirmed'] = 1;
                        update_option('speakpress_options',$speakpress_options);
                }
                //if activation request sent
                elseif ($regoutput[1] == 'send') {
                        $speakpress_options['activation_request_sent'] = 1;
                        update_option('speakpress_options',$speakpress_options);
                }
        }
}

//warning if domain not activated yet
function speakpress_admin_warning(){
        $speakpress_options = get_option('speakpress_options');

        if (isset($speakpress_options['activation_request_sent']) && intval($speakpress_options['activation_request_sent']))
                $sp_requested = 1;
        else
                $sp_requested = 0;
        if (isset($speakpress_options['domain_activated']) && intval($speakpress_options['domain_activated']))
                $sp_activated = 1;
        else
                $sp_activated = 0;
        if (isset($speakpress_options['activation_request_confirmed']) && intval($speakpress_options['activation_request_confirmed']))
                $sp_confirmed = 1;
        else
                $sp_confirmed = 0;
        function speakpress_warning_request(){
                echo '<div class="updated fade">
                                <p><strong>'.__('Speakpress will not work yet.','speakpress').'</strong> '
                                .sprintf(__('You must <a href="%1$s">activate your domain</a> for it to work.','speakpress'),
                                'options-general.php?page=speakpress/options.php').'</p></div>';
        }
        function speakpress_warning_activation(){
                echo '<div class="updated fade"><p><strong>'.__('Speakpress will not work yet.','speakpress').'</strong> '
                                .__('Your activation request was sent but not yet accepted, please be patient.','speakpress').'</p></div>';
        }
        function speakpress_warning_confirmation(){
                echo '<div class="updated fade"><p><strong>'.__('Speakpress will not work yet.','speakpress').'</strong> '
                                .__('Your have to click the confirmation link in the email we sent you.','speakpress').'</p></div>';
        }
        if ($sp_requested == 0 && $sp_activated == 0)
                add_action('admin_notices', 'speakpress_warning_request');
        elseif ($sp_activated == 0 && $sp_confirmed == 0)
                add_action('admin_notices', 'speakpress_warning_confirmation');
        elseif ($sp_activated == 0 && $sp_confirmed == 1)
                add_action('admin_notices', 'speakpress_warning_activation');
        return;
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
        $output = '<script type="text/javascript"> var flashvars = {}; flashvars.defaultSpeed = "'.$speed.'";
                                flashvars.defaultLanguage = "'.$language.'";flashvars.localeChain = "'.$localechain.'";
                                flashvars.autostart = "'.$autostart.'"; flashvars.defaultGender = "'.$gender.'";
                                flashvars.defaultQuality = "'.$quality.'"; flashvars.theme = "'.$theme.'";
                                flashvars.installFolder = "'.WP_PLUGIN_URL.'/speakpress";
                                installSpeakR("'.WP_PLUGIN_URL.'/speakpress/SpeakR.swf", flashvars); </script>';
        $output .= '<div id="flashSpeakR"><a href="http://www.adobe.com/go/getflashplayer"
                                target="_blank"> <img src="http://www.adobe.com/macromedia/style_guide/images/160x41_Get_Flash_Player.jpg"
                                alt="' . __('Download Flash player','speakpress') .'"/></a><br /><small>'.__('Update Flash <a href="http://www.adobe.com/go/getflashplayer" target="_blank">here</a> to use SpeakR.','speakpress').'</small></div>';
        echo $output;
}?>