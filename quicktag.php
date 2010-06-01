<?php
/**
 * @package Speakpress
 * @author Felix Moche
 * @version 1.0.2
 */
function speakpress_quicktaginit() {
	global $pagenow;
	if (in_array($pagenow,array('page.php', 'page-new.php', 'post.php', 'post-new.php'))) {
		add_action('admin_print_footer_scripts', 'speakpress_quicktag_js');
	}
}

add_action('init', 'speakpress_quicktaginit');

// Quicktag
function speakpress_quicktag_js() {
	echo '<script type="text/javascript">
	jQuery(function($) {
		var spnpEdLength = edButtons.length; 
		edButtons[spnpEdLength] = new edButton("ed_speakpress","page","<!--StartSpeech-->","<!--EndSpeech--><input class=\"speakpress_btn\" onclick=\"speakTags()\" type=\"button\" value=\"Text vorlesen\" />","p",-1);

		$("<input type=\"button\" />")
			.attr("id","ed_speakpress")
			.attr("name",spnpEdLength)
			.attr("value","Speakpress")
			.attr("title","Insert Speakpress Tag")
			.addClass("ed_button")
			.click(function(){
				edInsertTag(edCanvas,$(this).attr("name"));
				return false;
			})
			.appendTo(jQuery("#ed_toolbar"));
	});
</script>';
}?>