<?php

    function coreplus_post($packet, $url, $username, $password)
    {
        $ctx = stream_context_create(
            [
                'http' => [
                    'header' => "Content-type: application/JSON\r\n".
                        "Content-length: ".strlen($packet)."\r\n".
                        "Authorization: Basic " . base64_encode("$username:$password").
                        "User-Agent: XMLHTTP/1.0",
                    'method' => 'POST',
                    'content' => $packet
                ]
            ]
        );
        return file_get_contents($url, 0, $ctx);
    }

    function coreplus_get($url, $username, $password)
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

    function coreplus_get_referrers()
    {
        $url = env('COREPLUS_APPLICATION_URL') . "/API1.0/OPMS/FreeTrial/sources/";
        $username = COREPLUS_API_USERNAME;
        $password = COREPLUS_API_PASSWORD;

        $sourceJSON = coreplus_get($url, $username, $password);
        $sourceJSON = str_replace('</string>', '', str_replace('<string xmlns="http://schemas.microsoft.com/2003/10/Serialization/">', '', $sourceJSON));
        return $sourceJSON;
    }


    function coreplus_trial_subscribe()
    {
        $cn = "newtrialaccount_placeholder";
        $fn = stripslashes($_POST['firstname']);
        $ln = stripslashes($_POST['surname']);
        $email = $_POST['email'];
        $repeatemail = $_POST['repeatemail'];
        $promocode = stripslashes($_POST['promocode']);

        $ph = "00000000";
        $source = "13";
        $referrerDesc = "-+None+-";
        $init = "true";
        $av = "true";


        $blacklist = ['@mailed.ro', '@e.wupics.com', '@e.4pet.ro', '@mor19.uu.gl', '@vmail.me', '@e.l5.ca'];
        $invalid = false;

        for ($i=0; $i < count($blacklist); $i++) {
            $detect = strpos($email, $blacklist[$i]);

            if ($detect !== false) {
                $invalid = true;
                break;
            }
        }

        if ($invalid) {
            header("Location: ?sent=invalid");
            die;
            return;
        }

        $length = strlen('.ro');
        if ((substr($email, -$length) === '.ro')) {
            header("Location: ?sent=invalid");
            die;
            return;
        }


        // send an email to sales
        $to = "sales@coreplus.com.au";
        $subject = "coreplus free trial request received from " . $cn;
        $message .= "COMPANY DETAILS: ". "\n\n";
        ;
        $message .= "Company Name:  " . $cn. "\n\n";
        $message .= "Contact Name:  "  . $fn . " " . $ln.   "\n\n";
        $message .= "Contact Email:  " . $email.   "\n\n";
        $message .= "Contact Phone:  " . $ph.  "\n\n";
        $message .= "Referrer:  " . $source. ": " . $referrerDesc .  "\n\n";
        $message .= "Promocode:  " . $promocode. "\n\n";

        if ($repeatemail == "") {
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
            $username = COREPLUS_API_USERNAME;
            $password = COREPLUS_API_PASSWORD;

            $result = coreplus_post($data, $url, $username, $password);

            //### Response JSON examples ####//
            //$result = '{"DoWebServicePOSTResult":"{\"username\":\"tetetest\",\"password\":\"5711534\"}"}';
            //$result = '{"DoWebServicePOSTResult":"Invalid email address"}';
            //$result = '{"DoWebServicePOSTResult":"3"}';

            if (($response = json_decode($result, true)) !== null) {
                $response['url'] = CoreplusAPI::getRegisterResponseUrl($response, $email);

                header('Location: ' . $response['url']);
            } else {
                //die;
                //coreplus_mail("dev@coreplus.com.au","FREE TRIAL ERROR WHEN SUBMITTING TO UAC", "Data: " . $data . "\r\nResult: ". $result);
                //var_dump("Else! " . $result);
            }
        }
        //header("Location: ?sent=true&reason=".$result);
        die;
    }

    function coreplus_trial_validate($vId)
    {
        // Validate the parsed GUID and then post to the web service
        if (preg_match("/^\{?[a-zA-Z0-9]{8}-[a-zA-Z0-9]{4}-[a-zA-Z0-9]{4}-[a-zA-Z0-9]{4}-[a-zA-Z0-9]{12}\}?$/", $vId)) {
            // Get the data
            $url = env('COREPLUS_APPLICATION_URL') . "/API1.0/OPMS/FreeTrial/vId=".$vId;

            $username = COREPLUS_API_USERNAME;
            $password = COREPLUS_API_PASSWORD;


            $result = coreplus_get($url, $username, $password);
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


    function coreplus_mail($to, $subject, $body)
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
            header("Location: ?sent=true&reason=4");
        }
    }

    function get_promo_codes()
    {
        if (isset($_POST['promocode'])) {
            $promoCode = $_POST['promocode'];
            if ($promoCode != '') {
                $url = env('COREPLUS_APPLICATION_URL') . "/API1.0/OPMS/FreeTrial/validpromoCode/".$promoCode;

                $username = COREPLUS_API_USERNAME;
                $password = COREPLUS_API_PASSWORD;

                $content = coreplus_get($url, $username, $password);
                $content = str_replace('</boolean>', '', str_replace('<boolean xmlns="http://schemas.microsoft.com/2003/10/Serialization/">', '', $content));
                echo $content;
                die;
            }
        }
        echo 'false';
        die;
    }

    add_action('wp_ajax_get_promo_codes', 'get_promo_codes');
    add_action('wp_ajax_nopriv_get_promo_codes', 'get_promo_codes');


    function coreplus_is_GUID($strGUID)
    {
        if (preg_match("/^\{?[a-zA-Z0-9]{8}-[a-zA-Z0-9]{4}-[a-zA-Z0-9]{4}-[a-zA-Z0-9]{4}-[a-zA-Z0-9]{12}\}?$/", $strGUID)) {
            return true;
        } else {
            return false;
        }
        return false;
    }
