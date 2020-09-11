<?php
class Api
{
    private $config;

    public function __construct()
    {
        $this->config = require __DIR__ . '/config.php';
    }
    public function getConfig($type)
    {
        return $this->config["$type"];      
    }
    public function get($file, $page_id)
    {
        return include "$file.php";
    }

    public function requirePassword($username){
	    $url = call_user_func_array('sprintf', array(
        '%s/requirePassword',
        rtrim($this->config['api_url'])
        ));
        $data = array(

            'username' => $username,

        );
        $response = $this->curl($url, 'POST', json_encode($data));
        return $response;
    }

    public function getToken($username, $password)
    {
        $url = call_user_func_array('sprintf', array(
        '%s/token',
        rtrim($this->config['api_url'])
        ));
        $data = array(

            'username' => $username,
            'password' => $password

        );
        $response = $this->curl($url, 'POST', json_encode($data));
        return $response;
    }
    public function getLastErrors()
    {
        if (!empty($GLOBALS['lastErrors'])) {
            return $GLOBALS['lastErrors'];
        }
        return false;
    }
    private function curl($url, $method = 'GET', $postFields = null)
    {
        $ch = curl_init();
        $requestHeaders = array();
        $GLOBALS['curlHeaders'] = array();
        curl_setopt($ch, CURLOPT_URL, $url);
        switch ($method) {
            case 'GET':
                // default is GET
                break;
            case 'POST':
                curl_setopt($ch, CURLOPT_POST, true);
                break;
            default:
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
                break;
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        if (is_array($postFields)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postFields));
        } elseif (is_string($postFields)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        foreach ($curlOptions as $option => $value) {
            curl_setopt($ch, $option, $value);
        }
        $body = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($httpCode === 0) {
            $body = curl_error($ch);
        }
        $result = curl_exec($ch);

        curl_close($ch);

        return $result;
    }

}
