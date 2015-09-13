<?php
/**
 * Description of SparkAPI
 *
 * @author devin
 */
class SparkAPI {

    private $sparkUrl;
    private $token;
    private $fkTokenId;
    private $name;
    private $deviceId;
    private $isEnabled;

    function __construct($token = '', $sparkUrl = "https://api.spark.io/v1/") {
        //parent::__construct();
        $this->token = $token;
        $this->sparkUrl = $sparkUrl;
    }
    
    function getCores()
    {
        $url = $this->sparkUrl . "devices?access_token=" . $this->token;
        //var_dump($url);
        $service = json_decode($this->curl_download($url, $fields, 'get'));
        //var_dump($service);
        if (is_null($service)) {
            return false;
        }
        return $service;
    }
    
    function getCoreDetails($coreId)
    {
        //$fields = array('name' = $);
        $url = $this->sparkUrl . "devices/{$coreId}/?access_token=" . $this->token;
        $service = json_decode($this->curl_download($url, $fields, 'get'));
        if (is_null($service)) {
            return false;
        }
        return $service;
    }
    
    function getVariable($coreId, $variableName)
    {
        //$fields = array('name' = $);
        $url = $this->sparkUrl . "devices/{$coreId}/{$variableName}?access_token=" . $this->token;
        $service = json_decode($this->curl_download($url, $fields, 'get'));
        if (is_null($service)) {
            return false;
        }
        return $service;
    }
    
    function getWebhooks()
    {
        $url = $this->sparkUrl . "webhooks?access_token=" . $this->token;
        $service = json_decode(Tools::curl_download($url, $fields, 'get'));
        if (is_null($service)) {
            return false;
        }
        return $service;
    }
    
    function getTokens($username, $password)
    {
        $url = $this->sparkUrl . "access_tokens";
        $service = json_decode(Tools::curl_download($url, $fields, 'get', 'basic', $username, $password));
        //var_dump($service);
        if (isset($service->ok) && $service->ok == false) {
            return false;
        }
        return $service;
    }
    
    function createToken($username, $password)
    {
        // create token
        $fields = array('grant_type' => 'password', 'username' => $username, 'password' => $password);
        $url = "https://api.spark.io/oauth/token";
        $service = json_decode(Tools::curl_download($url, $fields, 'post', 'basic', 'spark', 'spark'));
        if (is_null($service)) {
            return false;
        }
        return $service;
    }
    
    function deleteToken($username, $password, $token)
    {
        // delete token
        //$token = "178c6bdef901ea3db1d3dd2e8fc65866ceed4c09";
        $url = $this->sparkUrl . "access_tokens/$token";
        $service = json_decode(Tools::curl_download($url, $fields, 'delete', 'basic', $username, $password));
        if (is_null($service)) {
            return false;
        }
        return $service;/* */
        //var_dump($service->ok);/* */
    }
    
    function setToken($token)
    {
        $this->token = $token;
    }
    
    private function curl_download($Url, $fields = null, $type = 'post', $authType = 'none', $username = '', $password = '')
    {
	$fields_string = null;
        // is cURL installed yet?
        if (!function_exists('curl_init'))
        {
            die('Sorry cURL is not installed!');
        }

        // OK cool - then let's create a new cURL resource handle
        $ch = curl_init();
        if (!empty($fields))
        {
            //url-ify the data for the POST
            foreach($fields as $key=>$value) 
            { 
                if (is_array($value))
                {
                    foreach($value as $value2)
                    {
                        if (!is_null($value2))
			{
			    $fields_string .= $key.'='.$value2.'&';
			}
                    }
                } else
                {
                    if (!is_null($value))
		    {
			$fields_string .= $key.'='.$value.'&';
		    }
		    
                }
                
            }
            rtrim($fields_string,'&');
            //set the number of POST vars, POST data
            if ($type == 'post') {
            curl_setopt($ch,CURLOPT_POST,1);
            curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
            }
        }
        if ($type == 'delete') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        }

        // Now set some options (most are optional)
        // Set URL to download
        curl_setopt($ch, CURLOPT_URL, $Url);
        
        // stop the verification of certificate
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        // Set a referer
        curl_setopt($ch, CURLOPT_REFERER, "http://www.domains.co.za/curl.htm");

        // User agent
        curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");

        // Include header in result? (0 = yes, 1 = no)
        curl_setopt($ch, CURLOPT_HEADER, 0);

        // Should cURL return or print out the data? (true = return, false = print)
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Timeout in seconds
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        
        // basic auth
        if ($authType == 'basic') {
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
        }
        
        // Download the given URL, and return output
        $output = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        //var_dump($httpCode);
        // Close the cURL resource, and free system resources
        curl_close($ch);

        return $output;
    }
    
}