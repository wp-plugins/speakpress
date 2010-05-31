<?php
/**
 * @package SpeakR
 * @author Felix Moche
 * @version 1.0
 */
function speakr_quicktaginit() {
	global $pagenow;
	if (in_array($pagenow,array('page.php', 'page-new.php', 'post.php', 'post-new.php'))) {
		add_action('admin_print_footer_scripts', 'speakr_quicktag_js');
	}
}

add_action('init', 'speakr_quicktaginit');

// Quicktag
function speakr_quicktag_js() {
	echo '<script type="text/javascript">
	jQuery(function($) {
		var spnpEdLength = edButtons.length; 
		edButtons[spnpEdLength] = new edButton("ed_speakr","page","<!--StartSpeech-->","<!--EndSpeech--><input class=\"speakr_btn\" onclick=\"speakTags()\" type=\"button\" value=\"Text vorlesen\" />","p",-1);

		$("<input type=\"button\" />")
			.attr("id","ed_speakr")
			.attr("name",spnpEdLength)
			.attr("value","SpeakR")
			.attr("title","Insert SpeakR Tag")
			.addClass("ed_button")
			.click(function(){
				edInsertTag(edCanvas,$(this).attr("name"));
				return false;
			})
			.appendTo(jQuery("#ed_toolbar"));
	});
</script>';
}?>