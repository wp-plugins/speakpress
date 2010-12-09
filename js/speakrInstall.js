/**
 * Javascript file to offer a easy way to install SpeakR
 * on websites. Uses swfobject.js version 2.2 as known from: http://code.google.com/p/swfobject
 * 
 * Visit SpeakR at http://speakr.avatr.net
 */

// Description: Speak out a text
// -------------------------------------------------------------------------------------
// param (string) speakrSwfPath: path to SpeakR swf file
// param (array) flashVars: input vars (flashvars) for object tag
function installSpeakR(speakrSwfPath, flashVars) {
   	var params = {};
	params.menu = "false";
	params.wmode = "transparent";
	var attributes = {};
	attributes.id = "SpeakR";
	attributes.name = "SpeakR";
	swfobject.embedSWF(speakrSwfPath,"flashSpeakR", "190", "50", "10.1.0",null,flashVars, params, attributes);
}