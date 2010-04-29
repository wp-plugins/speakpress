=== Speakpress ===
Contributors: MOmann, niba
Donate link: http://speakr.avatr.net/
Tags: SpeakR, read, tts, audio, streaming
Requires at least: 2.7
Tested up to: 2.9.2
Stable tag: 1.0

Speakpress offers a way to read every kind of german and english text (blogposts, static pages, hidden text-fragments) to your visitor.

== Description ==

Speakpress is a wordpress plugin using SpeakR, a Flash Control enabling easy to use TTS functions to any german or english website.
Therfore, SpeakR queries a Webservice that synthesizes text to high quality spoken audio streams.

To check out SpeakR, explore http://speakr.avatr.net 
TO BE CLEAR: Speakpress offers a simple way to install and configure SpeakR files to any wordpress blog. 
We also offer a standalone SpeakR installation. We ship the SpeakR manual (german only right now) with Speakpress
(have a look at the "doc_de" folder).

You need to register at http://speakr.avatr.net in order to run this plugin properly. We need this step
to activate your blog domain in our webservice. The SpeakR service is free by default and will remain free until you reach a certain PI 
number with your blog. We will inform you if your blog exceed our "free" criterias. 


== Installation ==

1. Uncompress the zip file and upload the folder 'speakr' to the '/wp-content/plugins/' directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Active the widget under the 'Themes' -> 'Widget' menu or put <?php embed_speakr(); ?> in your template file
4. Configure Speakpress under 'Settings' -> 'SpeakR'
5. Don't forget to register at http://speakr.avatr.net or send a mail with your domain-name to speakr@avatr.net

== Frequently Asked Questions ==

= What languages are supported? =

SpeakR currently supports: german and english. 

= Do you offer different voices? =

Yes. Both german and english language comes with a male and female voice.

= How to use? =

Install Speakrpress as described. Enable the widget or use the build-in editor in Wordpress.
Finally, request a free SpeakR account at http://speakr.avatr.net or request one via mail (speakr.avatr.net)

= Why register? =

We need to know your domain-name to set up a proper SpeakR account. Without this activation, neighter Speakpress nor SpeakR will work.

== Screenshots ==

1. The look of the SpeakR control (green theme). This is a 245px wide flash component.
2. The settings screen (german version).
3. The HTML editor is extended by a button. Mark a text-fragment and hit this button to enable speech output for the selected region. 
Will also add a "Read" button below the selection.  


== Changelog ==

= 1.0 =
* Initial release with SpeakR version 0.7.3

== Upgrade Notice ==

= 1.0 =
Initial release of Speakpress using SpeakR version 0.7.3