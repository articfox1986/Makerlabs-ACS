<?php
//-----------------------------------------------------------------------------------------------------
//   _________                         __        _____   __________ .___ 
//  /   _____/______  _____   _______ |  | __   /  _  \  \______   \|   |
//  \_____  \ \____ \ \__  \  \_  __ \|  |/ /  /  /_\  \  |     ___/|   |
//  /        \|  |_> > / __ \_ |  | \/|    <  /    |    \ |    |    |   |
// /_______  /|   __/ (____  / |__|   |__|_ \ \____|__  / |____|    |___|
//         \/ |__|         \/              \/         \/                 
//                                                                      
// Spark API
//
// The MIT License (MIT)
// 
// Copyright (c) 2013 Artic - devin@blackhat.co.za - Last update 7/3/2013
// 
// Permission is hereby granted, free of charge, to any person obtaining a copy
// of this software and associated documentation files (the "Software"), to deal
// in the Software without restriction, including without limitation the rights
// to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
// copies of the Software, and to permit persons to whom the Software is
// furnished to do so, subject to the following conditions:
// 
// The above copyright notice and this permission notice shall be included in
// all copies or substantial portions of the Software.
// 
// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
// IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
// FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
// AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
// LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
// OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
// THE SOFTWARE.
//
//-----------------------------------------------------------------------------------------------------

// Spark Device Class
class SparkDevice
{
    // cloud server url
    var $url = 'https://api.sprk.io/';
    // list of available pins
    var $pins = array('D0','D1','D2','D3','D4','D5','D6','D7','A0','A1','A2','A3','A4','A5','A6','A7');
    // list of available levels
    var $levels = array('0','1','LOW','HIGH');
    // name of the device
    var $deviceName = 'elroy'; // 'elroy', 'george' or 'astro' for demo api
    
    public function __construct($deviceName = 'elroy') {
        $this->deviceName = $deviceName;
    }
    
    // SPARK API "Setting Pins High/Low"
    function digitalWrite($pin, $level)
    {
        $usage = "USAGE: digigtalWrite(D7, HIGH);";
        // check if pin is in the possible values list
        if (!in_array($pin, $this->pins))
        {
            return "Invalid Pin Number {$pin} {$usage}";
        }
        // check if pin level is in the possible values list
        if (!in_array($level, $this->levels))
        {
            return "Invalid Pin Level {$usage}";
        }
        // make sure the level is uppercase
        $level = strtoupper($level);
        // if the level is set to 1 or 0 change it to HIGH or LOW
        if ($level == 0)
        {
            $level = 'LOW';
        }
        if ($level == 1)
        {
            $level = 'HIGH';
        }
        // set the values being sent to the spark cloud
        $fields['pin'] = $pin;
        $fields['level'] = $level;
        $result = $this->curlSpark('devices',$fields);
        $response = json_decode($result);
        if ($response->ok)
        {
            return true;
        } else
        {
            return "No Response";
        }
    }
    // SPARK API "Sending a Custom Message"
    function sendMessage($msg)
    {
        $fields['message'] = $msg;
        $result = $this->curlSpark('devices',$fields);
        $response = json_decode($result);
        if ($response->ok)
        {
            return true;
        } else
        {
            return "No Response";
        }
    }
    
    // SPARK API "Create a group"
    function createGroup($name, $devices)
    {
        $fields['name'] = $name;
        $fields['devices'] = $devices;
        $result = $this->curlSpark('groups',$fields);
        var_dump($result);
        $response = json_decode($result);
        if ($response->ok)
        {
            return true;
        } else
        {
            return "No Response";
        }
    }
    
    private function curlSpark($type = 'devices',$fields = null)
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
                            $fields_string .= $key.'[]='.$value2.'&';
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
            var_dump($fields_string);
            //set the number of POST vars, POST data
            curl_setopt($ch,CURLOPT_POST,1);
            curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
        }
        // construct the url for curl
        if ($type == 'devices')
        {
            $url = $this->url . "v1/{$type}/{$this->deviceName}";
        }
        if ($type == 'groups')
        {
            $url = $this->url . "v1/{$type}";
        }
        
        


        // Now set some options (most are optional)
        // Set URL to download
        curl_setopt($ch, CURLOPT_URL, $url);

        // stop the verification of certificate
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        // Set a referer
        curl_setopt($ch, CURLOPT_REFERER, "http://www.sparktest.co/");

        // User agent
        curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");

        // Include header in result? (0 = yes, 1 = no)
        curl_setopt($ch, CURLOPT_HEADER, 0);

        // Should cURL return or print out the data? (true = return, false = print)
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Timeout in seconds
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        // Download the given URL, and return output
        $output = curl_exec($ch);

        // Close the cURL resource, and free system resources
        curl_close($ch);

        return $output;
    }
}
define('HIGH', 'HIGH');
define('LOW', 'LOW');
define('D0', 'D0');
define('D1', 'D1');
define('D2', 'D2');
define('D3', 'D3');
define('D4', 'D4');
define('D5', 'D5');
define('D6', 'D6');
define('D7', 'D7');
define('A0', 'A0');
define('A1', 'A1');
define('A2', 'A2');
define('A3', 'A3');
define('A4', 'A4');
define('A5', 'A5');
define('A6', 'A6');
define('A7', 'A7');

//==================================================================
// Spark API Examples for writing to a pin
//==================================================================
//
// initiate the device
$spark = new SparkDevice('elroy');
// Using strings
//echo $spark->digitalWrite('D0', 'HIGH');
//$spark->digitalWrite('D1', 'LOW');
//
// Using numbers for levels (1=HIGH, 0=LOW)
//$spark->digitalWrite('D2', 1);
//$spark->digitalWrite('D3', 0);
//
// Using predefined global constants
//$spark->digitalWrite(D4, HIGH);
//$spark->digitalWrite(D5, LOW);
//
// Example with callback (validating the response from the server)
// $result = $spark->digitalWrite('D6', HIGH);
// if ($result == true) echo '[ D6 was set HIGH ]';
//  else echo '[ ERROR: D6 was not set HIGH ]';
//
// Try uncommenting one of these errors at a time
//digitalWrite(0);
//digitalWrite(D13, 0);
//digitalWrite(D7);
//digitalWrite('D14', 0);
//digitalWrite('D7', 4);

//echo $spark->sendMessage('test');
echo $spark->createGroup('test', array('elroy','george'));
?>
