<?php

/**
 *
 * A wrapper for using Validator class from Laravel (illuminate/validation)
 *
 * Usage:
 * $v = Validator::init();
 *
 * $v->make($data, $rules);
 *
 * @see http://laravel.com/docs/validation
 *
 * @author Jofry HS
 */



class CoreplusAPI
{
    public static function post($packet, $url, $username, $password)
    {
        $ctx = stream_context_create(
            array(
                                        'http'=>array(
                                        'header'=>  "Content-type: application/JSON\r\n".
                                        "Content-length: ".strlen($packet)."\r\n".
                                        "Authorization: Basic " . base64_encode("$username:$password").
                                        "User-Agent: XMLHTTP/1.0",
                                        'method'=>'POST',
                                        'content'=>$packet
                                        )
                                    )
        );

        return file_get_contents($url, 0, $ctx);
    }

    public static function get($url, $username, $password)
    {
        $ctx = stream_context_create(
            array(
                                        'http'=>array(
                                        'header'=>  "Content-type: application/x-www-form-urlencoded\r\n".
                                        "Content-length: 0\r\n".
                                        "Authorization: Basic " . base64_encode("$username:$password").
                                        "User-Agent: XMLHTTP/1.0",
                                        'method'=>'GET'
                                        )
                                    )
        );

        return file_get_contents($url, 0, $ctx);
    }

    public static function isGUID($strGUID)
    {
        if (preg_match("/^\{?[a-zA-Z0-9]{8}-[a-zA-Z0-9]{4}-[a-zA-Z0-9]{4}-[a-zA-Z0-9]{4}-[a-zA-Z0-9]{12}\}?$/", $strGUID)) {
            return true;
        } else {
            return false;
        }
        return false;
    }


    public static function sendMail($to, $subject, $body)
    {
        // Subject of email
        if ($subject == "") {
            $subject = "coreplus Contact Message";
        }

        // Email sender
        $header = "from: no-reply@coreplus.com.au";

        // Send off the email
        $send_contact = mail($to, $subject, $body, $header);
        if ($send_contact == 1) {
            //header("Location: ?sent=true");
        }
    }

    public static function register($firstname, $lastname, $email, $promocode = '')
    {
        $cn = "newtrialaccount_placeholder";
        $fn = trim($firstname);
        $ln = trim($lastname);

        $repeatemail = '';

        $ph = "00000000";
        $source = "13";
        $referrerDesc = "-+None+-";
        $init = "true";
        $av = "true";

        // send an email to sales
        $to = "sales@coreplus.com.au";
        $message = '';
        $subject = "coreplus free trial request received from " . $cn;
        $message .= "COMPANY DETAILS: ". "\n\n";
        ;
        $message .= "Company Name:  " . $cn. "\n\n";
        $message .= "Contact Name:  "  . $fn . " " . $ln.   "\n\n";
        $message .= "Contact Email:  " . trim($email) .   "\n\n";
        $message .= "Contact Phone:  " . $ph.  "\n\n";
        $message .= "Referrer:  " . $source. ": " . $referrerDesc .  "\n\n";
        $message .= "Promocode:  " . trim($promocode) . "\n\n";

        // Post it to our web service
        $data = json_encode([
            'cn' => $cn,
            'fn' => $fn,
            'ln' => $ln,
            'email' => $email,
            'repeatemail' => $repeatemail,
            'ph' => $ph,
            "promocode" => $promocode,
            "source" => $source,
            'init' => $init,
            'AutomaticValidation' => $av
        ]);

        $url = env('COREPLUS_APPLICATION_URL') . "/API1.0/OPMS/FreeTrial/new";
        $username = env('COREPLUS_API_USERNAME');
        $password = env('COREPLUS_API_PASSWORD');

        $result = coreplus_post($data, $url, $username, $password);
        if (($response = json_decode($result, true)) !== null) {
            $url = CoreplusAPI::getRegisterResponseUrl($response, $email);

            return $url;
        }
    }


    public static function getRegisterResponseUrl($response, $email)
    {
        $url = '';
        $code = 0;
        foreach ($response as $obj) {
            //var_dump($obj);
            //die;
            // ## Means we probably have a username/ password
            if ($obj == 'Invalid email address') {
                //var_dump('Your email address was invalid. Please try again.');
                //var_dump('2');
                //die;
                $url = "/trial/?sent=true&reason=2";
                $code = 2;
            } elseif ($obj == '3') {
                //var_dump('Your already have an account with coreplus. A link to reset your password has been sent to ' . $email);
                //var_dump('3');
                //die;
                $url = "/trial/?sent=true&reason=3";
                $code = 3;
            } elseif (($jsonResponse = json_decode($obj, true)) !== null) {

                //$auth = $jsonResponse['username'].':'.$jsonResponse['password'];
                $auth = $jsonResponse['username'].':RTYGHJ888'; // ## Temp perm password :/

                date_default_timezone_set('Australia/Melbourne');
                $timestamp = date('Ymd');
                $plaintext = utf8_encode(base64_encode($auth));
                $cipher = "aes-256-cbc";
                $ivlen = openssl_cipher_iv_length($cipher);
                $iv = utf8_encode("01234567".$timestamp);
                $key = utf8_encode("akshayakshayakshakshayakshayaksh");
                $ciphertext = openssl_encrypt($plaintext, $cipher, $key, $options=0, $iv);
                $ciphertextFinal = utf8_encode(base64_encode($ciphertext));
                setrawcookie('nginxauth', $ciphertextFinal, 0, '/', '.coreplus.com.au', true, true);

                $url = env('COREPLUS_APPLICATION_URL') . '/coreplus/?r='.time();

                //$url = COREPLUS_APPLICATION_URL . '/CookieAuth.dll?Logon?flags=0&forcedownlevel=0&formdir=1&trusted=0&username=' . $jsonResponse['username'] . '&password=' . $jsonResponse['password'] . '&curl=Z2FcoreplusZ2F';

                $code = 1;
            } else {
                //var_dump('4');
                //die;
                $url = "/trial/?sent=true&reason=4";
                $code = 4;
                //var_dump("An unexpected error occurred! " . $obj);
            }
        }

        return [
            'url' => $url,
            'code' => $code
        ];
    }


    public static function validateTrial($vId)
    {
        // Validate the parsed GUID and then post to the web service
        if (preg_match("/^\{?[a-zA-Z0-9]{8}-[a-zA-Z0-9]{4}-[a-zA-Z0-9]{4}-[a-zA-Z0-9]{4}-[a-zA-Z0-9]{12}\}?$/", $vId)) {
            // Get the data
            $url = env('COREPLUS_APPLICATION_URL') . "/API1.0/OPMS/FreeTrial/vId=".$vId;
            $username = COREPLUS_API_USERNAME;
            $password = COREPLUS_API_PASSWORD;

            $result = self::get($url, $username, $password);
            $result = str_replace('</string>', '', str_replace('<string xmlns="http://schemas.microsoft.com/2003/10/Serialization/">', '', $result));
            if (!is_numeric($result)) {
                $result = "";
            }
            // Redirect to prevent re-posting of data
            header("Location: ?reason=".$result);
            die;
        }
        header("Location: ?reason=99");
        die;
    }
}
