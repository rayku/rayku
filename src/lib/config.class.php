<?php

class config {

	function curl_get($path_to_cookie,$browser_agent,$url,$follow, $debug){
	    //global $path_to_cookie, $browser_agent;
		//echo $path_to_cookie.' hh ';
		$ch=curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);              
		curl_setopt($ch,CURLOPT_COOKIEJAR,$path_to_cookie);
		curl_setopt($ch,CURLOPT_COOKIEFILE,$path_to_cookie);
		curl_setopt($ch,CURLOPT_FOLLOWLOCATION,$follow);
		curl_setopt($ch,CURLOPT_USERAGENT, $browser_agent);
		$result=curl_exec($ch);
		curl_close($ch);
		
		if($debug==1){
		echo "<textarea rows=30 cols=120>".$result."</textarea>";       
		}
		if($debug==2){
		echo "<textarea rows=30 cols=120>".$result."</textarea>";       
		echo $result;
		}
		return $result;
		}
		
		function curl_post($path_to_cookie,$browser_agent,$url,$postal_data,$follow, $debug){
		//global $path_to_cookie, $browser_agent;
		//echo $postal_data.' jj ';
		$ch=curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS,$postal_data);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);              
		curl_setopt($ch,CURLOPT_COOKIEJAR,$path_to_cookie);
		curl_setopt($ch,CURLOPT_COOKIEFILE,$path_to_cookie);
		curl_setopt($ch,CURLOPT_FOLLOWLOCATION,$follow);
		curl_setopt($ch,CURLOPT_USERAGENT, $browser_agent);
		$result=curl_exec($ch);
		curl_close($ch);
		
		if($debug==1){
		echo "<textarea rows=30 cols=120>".$result."</textarea>";       
		}
		if($debug==2){
		echo "<textarea rows=30 cols=120>".$result."</textarea>";       
		echo $result;
		}
		return $result;
	}

}
?>