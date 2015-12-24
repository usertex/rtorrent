<?php

class BroadcasTheAccount extends commonAccount
{
	public $url = "http://broadcasthe.net";

	protected function isOK($client)
	{
		return(strpos($client->results, '<form name="loginform" id="loginform" method="post"')===false);
	}
	protected function login($client,$login,$password,&$url,&$method,&$content_type,&$body,&$is_result_fetched)
	{                                                                   
	        $is_result_fetched = false;
		if($client->fetch( $this->url."/login.php" ))
		{
                        $client->setcookies();
			$client->referer = $this->url."/login.php";

        		if($client->fetch( $this->url."/login.php","POST","application/x-www-form-urlencoded", 
				"username=".rawurlencode($login)."&password=".rawurlencode($password)."&keeplogged=1&login=Log+In%21" ))
			{
				$client->setcookies();
				return(true);
			}
		}
		return(false);
	}
        public function test($url)
        {
                return(preg_match( "`^http(s)?://broadcasthe.net`si", $url ));
        }
}
