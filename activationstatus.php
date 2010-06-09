<?php
/**
 * @package Speakpress
 * @author AvatR OHG
 * @version 1.0.3
 */
class SpeakrWebserviceClient
{
	var $useNuSoap = false;
	var $client;
	var $SpeechServiceWsdlUrl = "http://avatr.net:8081/SpeechService?wsdl";
	var $NuSoapRelPath = "lib/nusoap.php";
	var $timeout = 60;
	var $resTimeout = 60;

	// constrruct     
	function SpeakrWebserviceClient()
	{
		// check for SoapClient (PHP 5+)
    	if(class_exists("SoapClient"))
      		$this->useNuSoap = false;
      	// use fallback -> NuSoap lib
      	else
      		$this->useNuSoap = true;
    } // eof SpeakrWebserviceClient

	function checkRegistration($url, $echoDebug = false)	
	{
		// use SoapClient (PHP 5+)
   		if($this->useNuSoap == false)
   		{
   			if(!isset($this->client))
   			{
    			$this->client = new SoapClient($this->SpeechServiceWsdlUrl);
      		}
      		$result = $this->client->IsSpeakRClientRegistered(array('url' => $url));
      		if ($result->IsSpeakRClientRegisteredResult == 1)
        		return true;
      		return false;
   		}
   		// fallback -> NuSoap
   		else
   		{
   			// mixed return var
   			$ret;
   			
   			if(!isset($this->client))
    		{
    			require_once($this->NuSoapRelPath);
    			$this->client = new nusoap_client($this->SpeechServiceWsdlUrl,true,false,false,false,false,$this->timeout,$this->resTimeout,'');
       			$this->client->decodeUTF8(false);
       		}
       		$utf8Url = iconv("ISO-8859-1", "UTF-8", $url);
       		$result = $this->client->call('IsSpeakRClientRegistered', array('url' => $utf8Url));
       
       		if ($this->client->fault) 
			{
    			// Error Handling
    			if($echoDebug)
    			{
    				echo '<h2>Fault</h2><pre>';
    				print_r($result);
    				echo '</pre>';
    			}
    			$ret = -1;
			} 
			else 
			{
    			// Check for errors
   	 			$err = $this->client->getError();
    			if ($err) 
    			{
        			// Error Handling
        			if($echoDebug)
        				echo '<h2>Error</h2><pre>' . $err . '</pre>';
    				$ret = -1;
    			}
    			else 
    			{
        			// Display the result
        			if($echoDebug)
					{
	        			echo '<h2>Result</h2><pre>';
	        			print_r($result);
	    				echo '</pre>';
		    		}
		    		
		    		// return result
		    		$strIsReg = $result['IsSpeakRClientRegisteredResult'];
		    		if($strIsReg == "true")
		    			$ret = true;
		    		else if($strIsReg == "false")
		    			$ret = false;
				}	
			}	
		
			// detailed debug output
			if($echoDebug)
			{
				echo '<h2>Request</h2>';
				echo '<pre>' . htmlspecialchars($this->client->request, ENT_QUOTES) . '</pre>';
				echo '<h2>Response</h2>';
				echo '<pre>' . htmlspecialchars($this->client->response, ENT_QUOTES) . '</pre>';
				// Display the debug messages
				echo '<h2>Debug</h2>';
				echo '<pre>' . htmlspecialchars($this->client->debug_str, ENT_QUOTES) . '</pre>';
			}
			
			return $ret;
		}	
	} // eof checkRegistration(..)

	function classExistsSensitive( $classname )
	{
   		return ( class_exists( $classname ) 
   				&& in_array( $classname, get_declared_classes() ) );
	} // eof classExistsSensitive()

} // eoc SpeakrWebserviceClient

?>