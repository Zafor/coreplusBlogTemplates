<?php

    /**
     * Template Name: Forgot Password
     *
     */


    $htmlStr = "";

    function post($packet, $url, $username, $password, $contentType)
    {
        $ctx = stream_context_create(
            array(
                                        'http'=>array(
                                        'header'=>  "Content-type: application/". $contentType . "\r\n".
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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Google Validate
        $captchaData = "secret=6LdgcRsUAAAAAPdtfVvMBo_Xxiux9S5F4QEgzi_A&response=" . $_POST["g-recaptcha-response"];
        $captchaURL = "https://www.google.com/recaptcha/api/siteverify";
        $captchResult = post($captchaData, $captchaURL, '', '', 'x-www-form-urlencoded');
        //var_dump($captchResult);
        // if(($captchaResponse = json_decode($captchResult, true)) !== null) {
        //     if($captchaResponse["success"] == 'true') {

        // coreplus UAC API Call
        $username = env('COREPLUS_API_USERNAME');
        $password = env('COREPLUS_API_PASSWORD');

        $un = $_POST['username'];
        $url = env('COREPLUS_APPLICATION_URL') . "/API1.0/OPMS/UAC/resetpassword1/" . $un;
        $result = post($un, $url, $username, $password, 'json');

        if (($response = json_decode($result, true)) !== null) {
            if ($response["DoWebServiceResetPasswordByUsernameResult"] != "") {
                $htmlStr = "An email has been sent to <b>" . $response["DoWebServiceResetPasswordByUsernameResult"] . "</b> with instructions on how to reset your password.";
            } else {
                $htmlStr = "Your account could not be found. Please contact support on 1300 66 89 88 or try again.";
            }
        } else {
            $htmlStr = "Your account could not be found. Please contact support on 1300 66 89 88 or try again.";
        }
        //     }
        //     else {
        //         $htmlStr = "Captcha not validated. Please contact support on 1300 66 89 88 or try again.";
        //     }
        // }
    }
?>
<script type='text/javascript'>
var captchaTicked = true

jQuery( document ).ready(function( $ ) {

    $('#trialForm').on('submit', function() {

        $('.form-error-container').html('')
        $('.form-error-container').hide();

        if($('#username').val() == '') {
            showMessage("Please enter a username");
            return false;
        }
        if(captchaTicked == false) {
            showMessage("Please click 'I am not a robot'");
            return false;
        }
    });


    function showMessage(msg) {
        $('.form-error-container').html(msg)
        $('.form-error-container').show();
    }


});

var imNotARobot = function() {
    captchaTicked = true
}

</script>


<script src='https://www.google.com/recaptcha/api.js'></script>

<div class="v1-theme">
    <?php
        TrueLib::getTemplatePart('page-banner');
    ?>
    <div id="main" class="wrapper">
        <?php createTrueBreadcrumb()?>
        <div id="primary" class="site-content">
            <div id="content" role="main">
                <div class="forgot-password-container">
                    <?php
                    if ($htmlStr != "" and strpos($htmlStr, "email has been sent to") > 0) {
                        ?>
                    <div class="form-success-container"><?php echo $htmlStr?></div>
                    <?php
                    } else {
                        ?>
                    <script type='text/javascript'>
                        jQuery( document ).ready(function( $ ) {
                            if("<?php echo $htmlStr?>" != "") {
                                $('.form-error-container').show();
                            }
                        });
                    </script>

                    <?=get_field('page_content')?>

                    <form id="trialForm" name="trialForm" action="?submit=true" method="post">

                        <table id="trialTable" class="inputTable" width="100%">
                                <tr>
                                    <th></th>
                                    <td>
                                        <div class="form-error-container"><?php echo $htmlStr?></div>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="padding-right:10px;">Username</th>
                                    <td>
                                        <input name="username" id="username" type="text" autocomplete="off">
                                    </td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td>
                                        <div style="padding-top:25px;" data-callback="imNotARobot" class="g-recaptcha" data-sitekey="6LdgcRsUAAAAAFBnQCeqm3gMxQNgEUSS_LchRiyj"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <br>
                                        <button type="submit" class="button btn-block btn--colour-pink">Reset Password</button>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                    <?php
                    }
                    ?>
                </div>
            </div><!-- #content -->
        </div><!-- #primary -->
    </div>
</div>
