=== Speakpress ===
Contributors: MOmann, niba
Donate link: http://speakr.avatr.net/en
Tags: SpeakR, read, tts, audio, streaming
Requires at least: 2.7
Tested up to: 3.0 RC1
Stable tag: 1.0.3

Speakpress offers a way to read every kind of german and english text (blog posts, static pages, hidden text-fragments) to your visitor.

== Description ==

Speakpress is a WordPress plugin using SpeakR, a Flash control enabling easy to use TTS (Text To Speech) functions to any german or english website.
Therefore, SpeakR queries a webservice that synthesizes text to high quality spoken audio streams.

To check out SpeakR, explore http://speakr.avatr.net/en 
Speakpress offers a simple way to install and configure SpeakR files to any WordPress blog. 
We also offer a standalone SpeakR installation. Have a look at a detailed installation manual at http://doc.avatr.net/doku.php?id=en:speakr

You need to register via the build in form or at http://speakr.avatr.net/en in order to run this plugin properly. We need this step
to activate your blog domain in our webservice. The SpeakR service is free by default and will remain free until you reach a certain PI 
number with your blog. We will inform you if your blog exceeds our "free" criterias. 

Once you requested activation of your domain via the form under 'Settings' -> 'Speakpress' you should see the status. Please be patient until your domain is activated.

== Installation ==

1. Uncompress the zip file and upload the folder 'speakpress' to the '/wp-content/plugins/' directory.
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Active the widget under the 'Themes' -> 'Widget' menu. If you don't use widgets, you can put the following template tag in a theme file:
<?php if (function_exists('embed_speakpress'))
 embed_speakpress(); ?>
4. Configure Speakpress under 'Settings' -> 'Speakpress'
5. Edit a post via 'Posts' -> 'Edit'. Mark a fragment of text and hit the 'Speakpress' button. Voila - now the fragment is TTS-enabled. (NOTE: pressing the 'Speakpress' button will also add a HTML input for you). Alternatively you can use the auto embed function in the settings which will add a Speakpress button after every post.
6. Don't forget to register via the activation form, at http://speakr.avatr.net/en or send a mail with your domain-name to speakr@avatr.net

== Frequently Asked Questions ==

= The Speakpress widget shows up fine, but nothing happens when I hit the "Play" button. Whats wrong? =

There are two common mistakes:

1. You forgot to register your domain at http://speakr.avatr.net/en
2. You forgot to add speech tags to your blog.

Please make sure you did the last two steps of the installation. If something is still sort of weird: don't hesitate, CONTACT US!

= How to use? =

Install Speakpress as described. Don't forget to enable speech tags for your blog posts via 'Settings' -> 'Speakpress' or using the 'Speakpress' button in the WordPress editor.
Finally, request a free SpeakR account at http://speakr.avatr.net/en or request one via mail (speakr@avatr.net).

= What languages are supported? =

Speakpress currently supports: german and english. 

= Do you offer different voices? =

Yes. Both german and english language come with a male and female voice.

= Why register? =

We need to know your domain-name to set up a proper SpeakR account. Without this activation, neighter Speakpress nor SpeakR will work.

== Screenshots ==

1. The look of the SpeakR control (green theme, german locale). This is a 245px wide flash component.
2. The settings screen (german version).
3. The HTML editor is extended by a button. Mark a text fragment and hit this button to enable speech output for the selected region. 
This will also add a "Read" button below the selection.

== Changelog ==

= 1.0.3 =
* added domain activation form
* include js files only if not admin
* checking for user rights for activation hooks
* added uninstall hook
* added plugin meta
* added admin warning if domain not activated
* added checking for domain activation status
* fixed minor things

= 1.0.2 =
* installation bugfix

= 1.0.1 =
* Some bugfixes
* Consistent options and variable names
* renamed function embed_speakr() to embed_speakpress()

= 1.0 =
* Initial release with SpeakR version 0.7.3

== Upgrade Notice ==

= 1.0 =
Initial release of Speakpress using SpeakR version 0.7.3