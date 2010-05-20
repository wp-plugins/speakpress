=== Speakpress ===
Contributors: MOmann, niba
Donate link: http://speakr.avatr.net/en
Tags: SpeakR, read, tts, audio, streaming
Requires at least: 2.7
Tested up to: 2.9.2
Stable tag: 1.0

Speakpress offers a way to read every kind of german and english text (blogposts, static pages, hidden text-fragments) to your visitor.

== Description ==

Speakpress is a wordpress plugin using SpeakR, a Flash Control enabling easy to use TTS functions to any german or english website.
Therfore, SpeakR queries a Webservice that synthesizes text to high quality spoken audio streams.

To check out SpeakR, explore http://speakr.avatr.net/en 
Speakpress offers a simple way to install and configure SpeakR files to any wordpress blog. 
We also offer a standalone SpeakR installation. Have a look at a detailed installation manual at http://doc.avatr.net/doku.php?id=en:speakr

You need to register at http://speakr.avatr.net/en in order to run this plugin properly. We need this step
to activate your blog domain in our webservice. The SpeakR service is free by default and will remain free until you reach a certain PI 
number with your blog. We will inform you if your blog exceed our "free" criterias. 


== Installation ==

1. Uncompress the zip file and upload the folder 'speakr' to the '/wp-content/plugins/' directory. (DO NOT upload the entire 'speakpress' folder! DO upload the 'speakr' folder within the 'speakpress' folder!)
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Active the widget under the 'Themes' -> 'Widget' menu or put <?php embed_speakr(); ?> in your template file
4. Configure Speakpress under 'Settings' -> 'SpeakR'
5. Edit a post via 'Posts' -> 'Edit'. Mark a fragment of text and hit the 'SpeakR' button. Voila - now the fragment is TTS-enabled. (NOTE: pressing the 'SpeakR' button will also add a HTML input for you).  
6. Don't forget to register at http://speakr.avatr.net/en or send a mail with your domain-name to speakr@avatr.net

== Frequently Asked Questions ==

= The SpeakR widget shows up fine, but nothing happens when I hit the "Play" button. Whats wrong? =

There are two common mistakes:

1. You forgot to register your domain at http://speakr.avatr.net/en
2. You forgot to add speech tags to your blog.

Please make sure you did the last two steps of the installation. If something is still sort of weird: don't hesitate, CONTACT US!

= How to use? =

Install Speakrpress as described. Don't forget to enable speech tags for your blog posts via 'Settings' -> 'SpeakR' or using the 'SpeakR' button in the wordpress post-editor.
Finally, request a free SpeakR account at http://speakr.avatr.net/en or request one via mail (speakr@avatr.net)

= What languages are supported? =

SpeakR currently supports: german and english. 

= Do you offer different voices? =

Yes. Both german and english language comes with a male and female voice.

= Why register? =

We need to know your domain-name to set up a proper SpeakR account. Without this activation, neighter Speakpress nor SpeakR will work.

== Screenshots ==

1. The look of the SpeakR control (green theme, german locale). This is a 245px wide flash component.
2. The settings screen (german version).
3. The HTML editor is extended by a button. Mark a text-fragment and hit this button to enable speech output for the selected region. 
Will also add a "Read" button below the selection.  

== Changelog ==

= 1.0 =
* Initial release with SpeakR version 0.7.3

== Upgrade Notice ==

= 1.0 =
Initial release of Speakpress using SpeakR version 0.7.3