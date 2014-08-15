<?php

class Tools
{
    public static function curl_download($Url, $fields = null, $type = 'post')
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

        // Download the given URL, and return output
        $output = curl_exec($ch);

        // Close the cURL resource, and free system resources
        curl_close($ch);

        return $output;
    }
    
    public static function curlMulti($nodes)
    {
        try {    
        $node_count = count($nodes);
       // echo $node_count;
        } catch (Exception $e)
        {
            ErrorLog::log($e->getMessage(), __DIR__, __CLASS__, __FUNCTION__, 21, $e->getLine());
        }
            //var_dump($nodes[0]['fields']);
            //die();
            $running = 0;
            $curl_arr = array();
            $master = curl_multi_init();
            for($i = 0; $i < $node_count; $i++)
            {
                $url =$nodes[$i]['url'];
                $curl_arr[$i] = curl_init($url);
                $fields = $nodes[$i]['fields'];
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
                                    $fields_string .= urlencode($key).'='.urlencode($value2).'&';
                                }
                            }
                        } else
                        {
                            if (!is_null($value))
                            {
                                $fields_string .= urlencode($key).'='.urlencode($value).'&';
                            }

                        }

                    }
                    rtrim($fields_string,'&');
                    //set the number of POST vars, POST data
                    curl_setopt($curl_arr[$i],CURLOPT_POST,1);
                    curl_setopt($curl_arr[$i],CURLOPT_POSTFIELDS,$fields_string);
                }
                curl_setopt($curl_arr[$i], CURLOPT_RETURNTRANSFER, true);
                // stop the verification of certificate
                curl_setopt($curl_arr[$i], CURLOPT_SSL_VERIFYPEER, FALSE);
                // Timeout in seconds
                curl_setopt($curl_arr[$i], CURLOPT_TIMEOUT, 5);
                curl_multi_add_handle($master, $curl_arr[$i]);
            }

            do {
                curl_multi_exec($master,$running);
            } while($running > 0);


            for($i = 0; $i < $node_count; $i++)
            {
                $response = curl_multi_getcontent  ( $curl_arr[$i]  );
                if (isset($nodes[$i]['name']))
                {
                    $results[$nodes[$i]['name']] = $response;
                }  else {
                    $results[] = $response;
                }
                
            }
            return $results;
    }
    
    public static function whois43($domain)
    {
	$cmd = escapeshellcmd('whois -h whois.registry.net.za '. $domain);
	
	$status = exec($cmd, $result);
	$domain =array();
	for ($i = 0; $i < count($result); $i++)
	{
	    //echo $i;
	    $line = trim($result[$i]);
	    if ($line == "Domain Name:")
	    {
		$domain['name'] = trim($result[$i+1]);
	    }
	    if ($line == "Registrant:")
	    {
		$domain['registrant'] = trim($result[$i+1]);
		$domain['registrantEmail'] = trim(str_replace("Email:", '', $result[$i+2]));
		$domain['registrantContactNumber'] = trim(str_replace("Tel:", '', $result[$i+3]));
		$domain['registrantFax'] = trim(str_replace("Fax:", '', $result[$i+4]));
	    }
	    if ($line == "Registrant's Address:")
	    {
		//echo 3;
	    }
	    if ($line == "Registrar:")
	    {
		$$domain['clId'] = trim($result[$i+1]);
	    }
	    if ($line == "Relevant Dates:")
	    {
		$domain['crDate'] = strtotime(trim(str_replace("Registration Date:", '', $result[$i+1]))); 
		$domain['exDate'] = strtotime(trim(str_replace("Renewal Date:", '', $result[$i+2])));
	    }
	    if ($line == "Domain Status:")
	    {
		$status = array();
		$statuses = explode(',', $result[$i+1]);
		$domain['autorenew'] = 'false';
		foreach ($statuses as $stat)
		{
		    $stat = trim($stat);
		    if ($stat == 'autorenew')
		    {
			$domain['autorenew'] = 'true';
		    } else
		    {
			$status[] = $stat;
		    }
		}
		$domain['status'] = $status;

	    }
	    if ($line == "Pending Timer Events:")
	    {
		//echo 7;
	    }
	    if ($line == "Name Servers:")
	    {
		$domain['ns1'] = trim($result[$i+1]);
		$domain['ns2'] = trim($result[$i+2]);
		if (trim($result[$i+3]) != '') 
		{
		    $domain['ns3'] = trim($result[$i+3]);
		    if (trim($result[$i+4]) != '') 
		    {
			$domain['ns4'] = trim($result[$i+4]);
			if (trim($result[$i+5]) != '') 
			{
			    $domain['$this->ns5'] = trim($result[$i+5]);
			}
		    }
		}
	    }
	}
	return $domain;
    }
    
    public static function whois($domain, $server = "")
    {
        if ($server != "")
        {
            $server = "-h {$server} ";
        }
	$cmd = escapeshellcmd("whois {$server}{$domain}");
	
	$status = exec($cmd, $result);
        return $result;
    }
    
    public static function whoisRegistrant($domain)
    {
        //$cmd = escapeshellcmd("whois {$domain} | grep Registrant | grep Email");
	$cmd = sprintf('whois %s | grep Registrant | grep Email',$domain);
	$status = exec($cmd, $result);
        return $result;
    }
    
    public static function whoisAdmin($domain)
    {
        //$cmd = escapeshellcmd("whois {$domain} | grep Registrant | grep Email");
	$cmd = sprintf('whois %s | grep Admin | grep Email',$domain);
	$status = exec($cmd, $result);
        return $result;
    }
    
    public static function nsCheck($ns, $domain)
    {
	$cmd = escapeshellcmd('dig +short @'.$ns.' '.$domain.' NS');
	
	$status = exec($cmd, $result);
        if (count($result) < 1)
        {
            return false;
        } else
        {
            return true;
        }
	
    }
    
    public static function checkMissingValues($data, $values)
    {
	$missing_values = array();
	foreach ($values as $val)
	{
	    if (!array_key_exists($val, $data))
	    {
		$missing_values[] = $val;
	    }
	}
	if (empty($missing_values))
	{
	    return 1;
	} else
	{
	    $message = CODE10 . ": ";
	    foreach ($missing_values as $value)
	    {
		if ($message != CODE10 . ": ")
		{
		    $message = "{$message} ,{$value}";
		} else
		{
		    $message = "{$message}{$value}";
		}
	    }
	    return $message;
	}
    }
    
    public static function validateValue($value, $possiblities)
    {
	if (!in_array($value, $possiblities))
	{
	    return false;
	} else
	{
	    return true;
	}
    }
    
    public static function generatePassword($length = 9, $add_dashes = false, $available_sets = 'luds')
{
	$sets = array();
	if(strpos($available_sets, 'l') !== false)
		$sets[] = 'abcdefghjkmnpqrstuvwxyz';
	if(strpos($available_sets, 'u') !== false)
		$sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
	if(strpos($available_sets, 'd') !== false)
		$sets[] = '23456789';
	if(strpos($available_sets, 's') !== false)
		$sets[] = '!@#$%&*?';
 
	$all = '';
	$password = '';
	foreach($sets as $set)
	{
		$password .= $set[array_rand(str_split($set))];
		$all .= $set;
	}
 
	$all = str_split($all);
	for($i = 0; $i < $length - count($sets); $i++)
		$password .= $all[array_rand($all)];
 
	$password = str_shuffle($password);
 
	if(!$add_dashes)
		return $password;
 
	$dash_len = floor(sqrt($length));
	$dash_str = '';
	while(strlen($password) > $dash_len)
	{
		$dash_str .= substr($password, 0, $dash_len) . '-';
		$password = substr($password, $dash_len);
	}
	$dash_str .= $password;
	return $dash_str;
}
    
    public static function currentExchangeRate($currencyBase = 'USD', $currencyForeign = 'ZAR')
    {
	$url = 'http://download.finance.yahoo.com/d/quotes.csv?s='.$currencyBase .$currencyForeign .'=X&f=l1';
	$rate = Tools::curl_download($url);
	//http://rate-exchange.appspot.com/currency?from=USD&to=EUR
	//http://www.ecb.int/stats/eurofxref/eurofxref-daily.xml
	return sprintf('%.2f', $rate);
    }
    
    public static function mail($to,$from,$subject, $content,$sender_name = null,$smtp = null, $username = null, $password = null, $port = null, $type = "html")
    {
        if (is_null($from))
        {
            $from = DEFAULT_EMAIL;
        }
        if (TEST_MODE && $to != "dave@diamatrix.co.za")
            {
                return 1;
            }
            require_once PATH. 'libs/externals/swift/lib/swift_required.php';
	    
            if (is_null($smtp) || is_null($port))
            {
                $transport = Swift_SmtpTransport::newInstance();
            } else
            {
                $transport = Swift_SmtpTransport::newInstance($smtp, $port);
            }
	    
	    if (isset($username))
	    {
		$transport->setUsername($username);
	    }
	    if (isset($password))
	    {
		$transport->setPassword($password);
	    }
            
            $mailer = Swift_Mailer::newInstance($transport);
	    //$transport = Swift_MailTransport::newInstance();
	    //$mailer = Swift_Mailer::newInstance($transport);
	    // Create the message

	    $message = Swift_Message::newInstance();
	    // Give the message a subject
	    $message->setSubject($subject);

	    // Set the From address with an associative array
	    if ($sender_name != null)
	    {
		$message->setFrom(array($from => $sender_name));
	    } else
	    {
		$message->setFrom(array($from));
	    }
            
	    // Set the To addresses with an associative array
	    $message->setTo(array($to));
            if ($type == 'text') {
                $t = 'text/plain';
            } else {
                $t = 'text/html';
            }
	    // Give it a body
	    $message->setBody($content, $t);
	    // Send the message
	    $result = $mailer->send($message);
	    return $result;
    }
    
    public static function getFeed($feed_url) {  
      
	$content = file_get_contents($feed_url);  
	$x = new SimpleXmlElement($content);  

	echo "<ul>";  

	foreach($x->channel->item as $entry) {  
	    echo "<li><a href='$entry->link' title='$entry->title'>" . $entry->title . "</a></li>";  
	}  
	echo "</ul>";  
    } 
    // http://stackoverflow.com/questions/408405/easy-way-to-test-a-url-for-404-in-php
    public static function is_404($url) {
        $handle = curl_init($url);
        curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($handle,  CURLOPT_NOBODY, TRUE);

        /* Get the HTML or whatever is linked in $url. */
        $response = curl_exec($handle);

        /* Check for 404 (file not found). */
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        curl_close($handle);

        /* If the document has loaded successfully without any redirection or error */
        if ($httpCode >= 200 && $httpCode < 300) {
            return false;
        } else {
            return true;
        }
    }
    // seperates the sld and tld. this functionality was brought to you by Dave
    public static function getSldTld($domain) {
        $fields = array();
        $d = explode(".", $domain);
        $fields['sld'] = $d[0];
        unset($d[0]);
        $fields['tld'] = implode(".", $d);
        return $fields;
    }
    
    public static function generateCltrid($action, $user_id) 
    {
        return $action."-". uniqid(substr($user_id,0,4))."-" . rand(10000, 100000).time();
    }
    // https://www.perturb.org/display/1051_PHP_function_to_test_if_an_IP_is_an_IPV6_address.html
    public static function isIpv6($ip) {
	// If it contains anything other than hex characters, periods, colons or a / it's not IPV6
	if (!preg_match("/^([0-9a-f\.\/:]+)$/",strtolower($ip))) { return false; }

	// An IPV6 address needs at minimum two colons in it
	if (substr_count($ip,":") < 2) { return false; }

	// If any of the "octets" are longer than 4 characters it's not valid
	$part = preg_split("/[:\/]/",$ip);
	foreach ($part as $i) { if (strlen($i) > 4) { return false; } }

	return true;
}
}

?>