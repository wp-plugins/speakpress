(function() {
	// Load plugin specific language pack
	tinymce.PluginManager.requireLangPack('SpeakR');
	
	tinymce.create('tinymce.plugins.SpeakR', {
		/**
		 * Initializes the plugin, this will be executed after the plugin has been created.
		 * This call is done before the editor instance has finished it's initialization so use the onInit event
		 * of the editor instance to intercept that event.
		 *
		 * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
		 * @param {string} url Absolute URL to where the plugin is located.
		 */
		init : function(ed, url) {
			// Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceExample');
			ed.addCommand('SpeakR', function() {
				ed.execCommand('mceReplaceContent',false,'<!--StartSpeech-->{$selection}<!--EndSpeech--><input onclick="speakTags()" value="Text vorlesen" type="button" />');
			});
			// Register button
			ed.addButton('SpeakR', {
				title : 'Vorlesen',
				cmd : 'SpeakR',
				image : url + '/../speakr.png'
			});
			// Add a node change handler, selects the button in the UI when a image is selected
			ed.onNodeChange.add(function(ed, cm, n) {
				cm.setActive('SpeakR', n.nodeName == 'IMG');
			});
		},
		getInfo : function() {
			return {
					longname  : 'SpeakR',
					author 	  : 'Felix Moche',
					authorurl : 'http://felix.moches.de',
					infourl   : 'http://www.avatr.net',
					version   : "1.0"
			};
		}
	});
	tinymce.PluginManager.add('SpeakR', tinymce.plugins.SpeakR);
})();

