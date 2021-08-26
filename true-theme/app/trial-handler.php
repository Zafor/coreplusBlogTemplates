<?php

use Illuminate\Support\Fluent;

class TrialHandler
{
    /**
     * Keep this clean, limited to calling functions
     * or adding hooks/filters instead
     * @return [type] [description]
     */
    public static function init()
    {
        add_action('wp_ajax_trial_validate_form', array(__CLASS__, 'onValidateForm'));
        add_action('wp_ajax_nopriv_trial_validate_form', array(__CLASS__, 'onValidateForm'));
        add_action('wp_ajax_trial_submit', array(__CLASS__, 'onSubmit'));
        add_action('wp_ajax_nopriv_trial_submit', array(__CLASS__, 'onSubmit'));
    }

    /**
     * AJAX handler for initial form validation
     *
     * @return JsonResponse
     */
    public static function onValidateForm()
    {
        $inputs = static::getAndValidateInputs();
        if ($inputs->has_error) {
            return wp_send_json_error([
                'errors' => $inputs->errors
            ]);
        }
        return wp_send_json_success([
            'success' => 'OK'
        ]);
    }

    /**
     * AJAX handler for CoreplusAPI integration
     *
     * @return JsonResponse
     */
    public static function onSubmit()
    {
        $inputs = static::getAndValidateInputs();
        if ($inputs->has_error) {
            return wp_send_json_error([
                'errors' => $inputs->errors
            ]);
        }
        if (env('TRIAL_MOCK_RESPONSE') === true && env('APP_ENV') === 'local') {
            $response = [
                'code' => intval(env('TRIAL_MOCK_RESPONSE_CODE')),
                'url' => 'https://coreplus.test',
            ];
        } else {
            $response = CoreplusApi::register(
                stripslashes($inputs->firstname),
                stripslashes($inputs->lastname),
                $inputs->email,
                $inputs->promocode,
            );
        }

        switch ($response['code']) {
            // Success
            case 1:
                return wp_send_json_success([
                    'redirect' => $response['url']
                ]);
                break;
            // Error: Email address is not accepted
            case 2:
                return wp_send_json_error([
                    'errors' => [
                        'email' => 'Invalid email address'
                    ],
                    'response' => $response,
                ]);
                break;
            // Error: Account already exists, reset password sent
            case 3:
                return wp_send_json_error([
                    'is_account_exists' => true,
                ]);
                break;
            // Error: Unexpected error
            case 4:
            default:
                return wp_send_json_error([
                    'is_unexpected_error' => true,
                    'response' => $response,
                ]);
                break;
        }
    }

    /**
     * Create input object with validation information
     *
     * @return \Illuminate\Support\Fluent
     */
    public static function getAndValidateInputs()
    {
        $fluent = new Fluent();
        $names = [
            'nonce',
            'firstname',
            'lastname',
            'email',
            'promocode',
            'accept_terms',
            // 'accept_clickwrap',
        ];
        $hasError = false;
        $errors = [];
        foreach ($names as $key) {
            $value = \Illuminate\Support\Arr::get($_POST, $key);
            $fluent[$key] = $value;
            switch ($key) {
                case 'firstname':
                case 'lastname':
                    $isValid = static::validateRequired($value, 'Please fill the required field.');
                    if ($isValid !== true) {
                        $hasError = true;
                        $errors[$key] = $isValid;
                    }
                    break;
                case 'nonce':
                    $isValid = static::validateNonce($value, 'trial', 'There is an issue with your submission, please try reloading the page.');
                    if ($isValid !== true) {
                        $hasError = true;
                        $errors[$key] = $isValid;
                    }
                    break;
                case 'token':
                    $isValid = static::validateRecaptcha($value, 'There is an issue with your submission, please double check your entries.');
                    if ($isValid !== true) {
                        $hasError = true;
                        $errors[$key] = $isValid;
                    }
                    break;
                case 'email':
                    $isValid = static::validateEmail($value, 'Please enter valid email address.');
                    if ($isValid !== true) {
                        $hasError = true;
                        $errors[$key] = $isValid;
                    }
                    break;
                case 'accept_terms':
                    $isValid = static::validateCheckboxTrue($value, "You must accept coreplus's Terms of Use, Privacy Policy and Clickwrap Licence Agreement in order to start your Free Trial.");
                    if ($isValid !== true) {
                        $hasError = true;
                        $errors[$key] = $isValid;
                    }
                    break;
                // case 'accept_clickwrap':
                //     $isValid = static::validateCheckboxTrue($value, "You must accept coreplus's Clickwrap Licence Agreement in order to start your Free Trial.");
                //     if ($isValid !== true) {
                //         $hasError = true;
                //         $errors[$key] = $isValid;
                //     }
                //     break;
                default:
                    break;
            }
        }
        $fluent['has_error'] = $hasError;
        $fluent['errors'] = $errors;
        return $fluent;
    }

    /**
     * Run 'required' validation check
     *
     * @param mixed $value
     * @param string $errorMessage
     * @return boolean|string
     */
    public static function validateRequired($value, $errorMessage)
    {
        if (empty($value)) {
            return $errorMessage;
        }
        if (trim($value) === '') {
            return $errorMessage;
        }
        return true;
    }

    /**
     * Run 'email' validation check
     *
     * @param mixed $value
     * @param string $errorMessage
     * @return boolean|string
     */
    public static function validateEmail($value, $errorMessage)
    {
        if (empty($value)) {
            return $errorMessage;
        }
        $result = filter_var($value, FILTER_VALIDATE_EMAIL);
        if ($result === false) {
            return $errorMessage;
        }
        return true;
    }

    /**
     * Run checkbox validation check, requiring user to 'tick' given checkbox
     *
     * @param mixed $value
     * @param string $errorMessage
     * @return boolean|string
     */
    public static function validateCheckboxTrue($value, $errorMessage)
    {
        if ($value !== 'yes') {
            return $errorMessage;
        }
        return true;
    }

    /**
     * Run WordPress nonce validation check
     *
     * @param mixed $value
     * @param string $nonceKey
     * @param string $errorMessage
     * @return boolean|string
     */
    public static function validateNonce($value, $nonceKey, $errorMessage)
    {
        $result = wp_verify_nonce($value, $nonceKey);
        if ($result === false) {
            return $errorMessage;
        }
        return true;
    }

    /**
     * Run Google RECAPTCHA validation check
     *
     * @param mixed $value
     * @param string $errorMessage
     * @return boolean|string
     */
    public static function validateRecaptcha($value, $errorMessage)
    {
        $post_data = http_build_query(
            array(
                'secret' => env('RECAPTCHA_SECRET_KEY'),
                'response' => $value,
                'remoteip' => $_SERVER['REMOTE_ADDR']
            )
        );
        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $post_data
            )
        );
        $context  = stream_context_create($opts);
        $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
        $result = json_decode($response);
        if (!$result->success) {
            return $errorMessage;
        }
        return true;
    }
}

TrialHandler::init();
