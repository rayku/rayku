<?php
class xml
{
    	 public $xmlRpcHost;
		 public $webXmlRpcDir;
         public $logonXmlRpcWebServiceUrl;
		 public $agencyXmlRpcWebServiceUrl; 
		 public $publisherRpcWebServiceUrl;
		 public $zoneRpcWebServiceUrl; 
		 public $username;
		 public $password;		
	            
	    function init($publisherName)
    	{
			 //Set the environment
			 if (!@include('XML/RPC.php')) {
					die('Error: cannot load the PEAR XML_RPC class');
			 }
			 $this->xmlRpcHost='avtrexx.net';
			 $this->webXmlRpcDir='/www/api/v1/xmlrpc';
			 $this->logonXmlRpcWebServiceUrl=$this->webXmlRpcDir.'/LogonXmlRpcService.php';
			 $this->agencyXmlRpcWebServiceUrl=$this->webXmlRpcDir . '/AgencyXmlRpcService.php';
			 $this->publisherRpcWebServiceUrl=$this->webXmlRpcDir . '/PublisherXmlRpcService.php';
			 $this->zoneRpcWebServiceUrl=$this->webXmlRpcDir . '/ZoneXmlRpcService.php';
			 $this->username = 'admin';
			 $this->password = 'admin765';
			 $returnParms=array();		   
			//Log on and get the session ID:
			 $aParams = array(new XML_RPC_Value($this->username, 'string'),new XML_RPC_Value($this->password, 'string'));
			 $oMessage  = new XML_RPC_Message('logon', $aParams);
			 $oClient   = new XML_RPC_Client($this->logonXmlRpcWebServiceUrl, $this->xmlRpcHost);
			 $oResponse = $oClient->send($oMessage);
			 if (!$oResponse) {
				 die('Communication error: ' . $oClient->errstr);
			 }
					
			 $sessionId = $this->returnXmlRpcResponseData($oResponse);
			 echo 'User logged on with session Id : ' . $this->sessionId . '<br>';
			
			 //Create Publisher
			 $publisherID = $this->createPublisher($sessionId,$publisherName);		
			 $returnParms['publisher']=$publisherName;
			 $returnParms[$publisherID]=$publisherID;
			 
			
		
		}
		  //XML -RPC response
		function returnXmlRpcResponseData($oResponse)
		{
			 if (!$oResponse->faultCode()) {
				  $oVal = $oResponse->value();
				  $data = XML_RPC_decode($oVal);
				  return $data;
			 } else {
			 die('Fault Code: ' . $oResponse->faultCode() . "\n" .
				 'Fault Reason: ' . $oResponse->faultString() . "\n");
			 }
		}
		
		//create Publisher /Vortex
		
		function createPublisher($sessionId,$publisherName)
		{
			// Add new Publisher
			 $oPublisher	= new XML_RPC_VALUE(array(
							'agencyid'       =>new XML_RPC_Value(1,'int'),
							'publisherName' => new XML_RPC_Value($publisherName,'string'),
							'contactName'   => new XML_RPC_Value('Ian','string'),
							'emailAddress'  => new XML_RPC_Value('ian@reatlimematrix.com','string'),
							'username'      => new XML_RPC_Value('rishad','string'),
							'password'      => new XML_RPC_Value('rishad','string')),
							'struct');
											
			$aParams1    = array(
			    			new XML_RPC_Value($sessionId,'string'),
							$oPublisher
							);
			$oMessage1   = new XML_RPC_Message('addPublisher',$aParams1);
			
			$oClient1    = new XML_RPC_Client($this->publisherRpcWebServiceUrl, $this->xmlRpcHost);
			$oResponse1  = $oClient1->send($oMessage1);
			$publisherID  = $this->returnXmlRpcResponseData($oResponse1);
			echo 'Publisher'.$publisherID.'<br>';
			return $publisherID;
		}
		
		

}

?>
