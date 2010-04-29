/**
 * Javascript interface for Flash playback control.
 * This file defines function that primarily sends data to the
 * SpeakR Player.
 * 
 * Visit SpeakR at http://speakr.avatr.net
 */
 
//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\
// PUBLIC
//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\

// Description: Speak out a text
// -------------------------------------------------------------------------------------
// param (string) text: the text to speak
function speakText(text) {
    // get flash plugin
    var flexControl = getFlexApp();
    if (flexControl)
        flexControl.SpeakText(text);
}

// Description: Speak out a text
// by passing text, language, gender, speed and quality
// -------------------------------------------------------------------------------------
// param (string) text: the text to speak
// param (string) language: 2 character language code, ie "de"
// param (char) gender: char specify the gender, 'm' for male, 'f' for female
// param (int) speed: speed, value from 1 (slow) to ? (fast)
// param (int) quality: quality of tts output, 1=poor, 2=medium, 3=best
function speakTextByLanguageGenderSpeedQuality(text, language, gender, speed, quality) {
    // get flash plugin
    var flexControl = getFlexApp();
    if (flexControl)
        flexControl.SpeakTextByLanguageGenderSpeedQuality(language, gender, speed, quality);
}

// Description: Speak out a text
// by passing text, language, gender, and speed
// -------------------------------------------------------------------------------------
// param (string) text: the text to speak
// param (string) language: 2 character language code, ie "de"
// param (char) gender: char specify the gender, 'm' for male, 'f' for female
// param (int) speed: speed, value from 1 (slow) to ? (fast)
function speakTextByLanguageGenderSpeed(text, language, gender, speed) {
    // get flash plugin
    var flexControl = getFlexApp();
    if (flexControl)
        flexControl.SpeakTextByLanguageGenderSpeed(text, language, gender, speed);
}

// Description: Speak out a text
// by passing text, language and gender
// -------------------------------------------------------------------------------------
// param (string) text: the text to speak
// param (string) language: 2 character language code, ie "de"
// param (char) gender: char specify the gender, 'm' for male, 'f' for female
function speakTextByLanguageGender(text, language, gender) {
    // get flash plugin
    var flexControl = getFlexApp();
    if (flexControl)
        flexControl.SpeakTextByLanguageGender(text, language, gender);
}

// Description: Speak out a text
// by passing text, language and gender
// -------------------------------------------------------------------------------------
// param (string) text: the text to speak
// param (string) language: 2 character language code, ie "de"
function speakTextByLanguage(text, language) {
    // get flash plugin
    var flexControl = getFlexApp();
    if (flexControl)
        flexControl.SpeakTextByLanguage(text, language);
}


// Description: Speak selected elements in the browser
// by passing language, gender, speed and quality
// -------------------------------------------------------------------------------------
// param (string) language: 2 character language code, ie "de"
// param (char) gender: char specify the gender, 'm' for male, 'f' for female
// param (int) speed: speed, value from 1 (slow) to ? (fast)
// param (int) quality: quality of tts output, 1=poor, 2=medium, 3=best
function speakSelectionByLanguageGenderSpeedQuality(language, gender, speed, quality) {
    speakTextByLanguageGenderSpeedQuality(getSelectionText(),language, gender, speed, quality);
}

// Description: Speak selected elements in the browser
// by passing language, gender and speed
// -------------------------------------------------------------------------------------
// param (string) language: 2 character language code, ie "de"
// param (char) gender: char specify the gender, 'm' for male, 'f' for female
// param (int) speed: speed, value from 1 (slow) to ? (fast)
function speakSelectionByLanguageGenderSpeed(language, gender, speed) {
    speakTextByLanguageGenderSpeed(getSelectionText(), language, gender, speed);
}

// Description: Speak selected elements in the browser
// by passing language and gender
// -------------------------------------------------------------------------------------
// param (string) language: 2 character language code, ie "de"
// param (char) gender: char specify the gender, 'm' for male, 'f' for female
function speakSelectionByLanguageGender(language, gender) {
    speakTextByLanguageGender(getSelectionText(), language, gender);
}

// Description: Speak selected elements in the browser
// by passing language
// -------------------------------------------------------------------------------------
// param (string) language: 2 character language code, ie "de"
function speakSelectionByLanguage(language) {
    speakTextByLanguage(getSelectionText(),language);
}

// Description: Speak out selected text in the browser
// -------------------------------------------------------------------------------------
function speakSelection() {
    speakText(getSelectionText());
}

// Description: Speak out by passing element id, language code and gender.
// -------------------------------------------------------------------------------------
// param (string) id: id of the html element to speak out
// param (string) language: 2 character language code, ie "de"
// param (char) gender: char specify the gender, 'm' for male, 'f' for female
function speakIdByLanguageGender(id, language, gender){
	var contentToSpeak = getInnerHtml(id);
	speakTextByLanguageGender(contentToSpeak, language, gender)
}

// Description: Speak out by passing element id, language code, gender, and speed.
// -------------------------------------------------------------------------------------
// param (string) id: id of the html element to speak out
// param (string) language: 2 character language code, ie "de"
// param (char) gender: char specify the gender, 'm' for male, 'f' for female
// param (int) speed: speed, value from 1 (slow) to ? (fast)
function speakIdByLanguageGenderSpeed(id, language, gender, speed) {
    var contentToSpeak = getInnerHtml(id);
	speakTextByLanguageGenderSpeed(contentToSpeak, language, gender, speed);
}

// Description: Speak out by passing element id, language code, gender, speed and quality.
// -------------------------------------------------------------------------------------
// param (string) id: id of the html element to speak out
// param (string) language: 2 character language code, ie "de"
// param (char) gender: char specify the gender, 'm' for male, 'f' for female
// param (int) speed: speed, value from 1 (slow) to ? (fast)
// param (int) quality: quality of tts output, 1=poor, 2=medium, 3=best
function speakIdByLanguageGenderSpeedQuality(id, language, gender, speed, quality) {
    var contentToSpeak = getInnerHtml(id);
	speakTextByLanguageGenderSpeedQuality(contentToSpeak, language, gender, speed, quality);
}

// Description: Speak out by passing element id and language code.
// -------------------------------------------------------------------------------------
// param (string) id: id of the html element to speak out
// param (string) language: 2 character language code, ie "de"
function speakIdByLanguage(id, language) {
    var contentToSpeak = getInnerHtml(id);
    speakTextByLanguage(contentToSpeak,language);
}

// Description: Speak out by passing element id.
// -------------------------------------------------------------------------------------
// param (string) id: id of the html element to speak out
function speakId(id) {
    var contentToSpeak = getInnerHtml(id);
	speakText(contentToSpeak);
}

// Description: Speak out by speech tags <!--StartSpeech--> <!--EndSpeech-->
// by passing language, gender, speed and quality
// -------------------------------------------------------------------------------------
// param (string) language: 2 character language code, ie "de"
// param (char) gender: char specify the gender, 'm' for male, 'f' for female
// param (int) speed: speed, value from 1 (slow) to ? (fast)
// param (int) quality: quality of tts output, 1=poor, 2=medium, 3=best
function speakTagsByLanguageGenderSpeedQuality(language, gender, speed, quality) {
	var flexControl = getFlexApp();
    if (flexControl)
        flexControl.SpeakTagsByLanguageGenderSpeedQuality(language, gender, speed, quality);
}

// Description: Speak out by speech tags <!--StartSpeech--> <!--EndSpeech-->
// by passing language, gender and speed
// -------------------------------------------------------------------------------------
// param (string) language: 2 character language code, ie "de"
// param (char) gender: char specify the gender, 'm' for male, 'f' for female
// param (int) speed: speed, value from 1 (slow) to ? (fast)
function speakTagsByLanguageGenderSpeed(language, gender, speed) {
	var flexControl = getFlexApp();
    if (flexControl)
        flexControl.SpeakTagsByLanguageGenderSpeed(language, gender, speed);
}

// Description: Speak out by speech tags <!--StartSpeech--> <!--EndSpeech-->
// by passing language and gender
// -------------------------------------------------------------------------------------
// param (string) language: 2 character language code, ie "de"
// param (char) gender: char specify the gender, 'm' for male, 'f' for female
function speakTagsByLanguageGender(language, gender) {
	var flexControl = getFlexApp();
    if (flexControl)
        flexControl.SpeakTagsByLanguageGender(language, gender);
}

// Description: Speak out by speech tags <!--StartSpeech--> <!--EndSpeech-->
// by passing the language of the texts
// -------------------------------------------------------------------------------------
// param (string) language: 2 character language code, ie "de"
function speakTagsByLanguage(language) {
	var flexControl = getFlexApp();
    if (flexControl)
        flexControl.SpeakTagsByLanguage(language);
}

// Description: Speak out by speech tags <!--StartSpeech--> <!--EndSpeech-->
// -------------------------------------------------------------------------------------
function speakTags() {
	var flexControl = getFlexApp();
    if (flexControl)
        flexControl.SpeakTags();
}

// Description: Stops current reading operation, if there is one.
// -------------------------------------------------------------------------------------
function stopSpeak() {
    var flexControl = getFlexApp();
    if (flexControl)
        flexControl.StopSpeak();
}


// Description: Prefetch all speech enabled elements.
// -------------------------------------------------------------------------------------
function prefetch()
{
    var defaultTtsClassName = "speakable";

    // get all elements that could use speak
    var array = getElementsByClassName(defaultTtsClassName);
    var innerHtmlArray = getInnerHtmlOfElements(array);

   var flexControl = getFlexApp();
   if (flexControl)
        flexControl.Prefetch(innerHtmlArray);
}


//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\
// PRIVATE
//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\

// private helper to get our Flex app from the current document
function getFlexApp()
{
	var appName = "SpeakR";
	if (navigator.appName.indexOf ("Microsoft") !=-1)
  	{
   		return window[appName];
  	}
  	else
  	{
   		return document[appName];
  	}
}

// get selction of the browser document
function getSelectionText() {
    // see: http://stackoverflow.com/questions/10478/getting-selected-text-in-a-browser-cross-platform/169873#169873
    var str = (window.getSelection) ? window.getSelection() : document.selection.createRange();
    str = str.text || str;
    str = str + ''; 
    return str;
}

function /*string[]*/getInnerHtmlOfElements(/*object[]*/objectArray) {
    var innerHtmlResults = [];
    var element;
    for (var i = 0; (element = objectArray[i]) != null; i++)
    {
        var innerHtml = element.innerHTML;
        if (innerHtml == "")
            innerHtml = element.innerText;
        innerHtmlResults.push(innerHtml);
    }
    return innerHtmlResults;
}

function getInnerHtml(id) {
    var object = document.getElementById(id);

    if (object.tagName == "TEXTAREA")
        return object.value;
    else
        return object.innerHTML;
}

function getBodyInnerHtml() {
    var ret = document.body.innerHTML;
    return ret;
}

// defines a functions that returns alls elements of class xyz
// we need this, because IE doesn not support this function by default,
// see: http://forums.devshed.com/showpost.php?p=2182479&postcount=4
function getElementsByClassName(className) {
    var hasClassName = new RegExp("(?:^|\\s)" + className + "(?:$|\\s)");
    var allElements = document.getElementsByTagName("*");
    var results = [];
    var element;
    for (var i = 0; (element = allElements[i]) != null; i++) {
        var elementClass = element.className;
        if (elementClass && elementClass.indexOf(className) != -1 && hasClassName.test(elementClass))
            results.push(element);
    }
    return results;
}

function getCurrentUri(){
	return document.location.href;
}