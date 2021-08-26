<?php

/*

Template Name: Password Reset

*/

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $rId = $_POST["rid"];
    } else {
        $rId = $_GET["rid"];
    }


    $validVid = coreplus_is_GUID($rId);
    $htmlStr = "";

    if ($validVid) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $pwd1 = $_POST["password"];
            $pwd2 = $_POST["password-confirm"];

            if (($pwd1=$pwd2) && ($pwd1<> "" and $pwd2 <> "")) {
                // Post it to our web service

                //$data = "password=" . $pwd1 . "&password-confirm=" . $pwd2;

                $data = "{\"pwd1\": \"" . $pwd1 . "\",\"pwd2\": \"" . $pwd2 . "\"  }";
                $url = env('COREPLUS_APPLICATION_URL') . "/API1.0/OPMS/FreeTrial/pwdreset/" . $rId;

                $username = env('COREPLUS_API_USERNAME');
                $pwd1 = env('COREPLUS_API_PASSWORD');

                $result = coreplus_post($data, $url, $username, $pwd1);
                $result = str_replace("<string xmlns=\'http://schemas.microsoft.com/2003/10/Serialization/\'>", "", $result);
                $result = str_replace("</string>", "", $result);

                switch ($result) {
                    case false:
                        $htmlStr = "Your password was not reset successfully. Please contact our support team on 1300 66 89 88 for further help.";
                        break;
                    case true:
                        $htmlStr = "Your password has been reset successfully. You may now <a href=/intracore/redir.html>login</a> to coreplus.";
                        break;
                    default:
                        $htmlStr = "Your password was not reset successfully. Please contact our support team on 1300 66 89 88 for further help.";
                        break;
                }
            } else {
                $htmlStr = "Not all the information submitted was correct";
            }
        }
    } else {
        //print "debug redirect to home...";
        wp_redirect(site_url());
    }
?>
<style>
.wrapper--password-reset {
    padding-top: 150px !important;
}
</style>
<div class="v1-theme">
    <?php
        //TrueLib::getTemplatePart('page-banner');

        if (have_posts()) :
            while (have_posts()) : the_post();
    ?>

    <div id="main" class="wrapper wrapper--password-reset">
        <div id="primary" class="site-content">
            <div id="content" role="main">

                <div class="text-center" style="margin-bottom: 50px;">
                    <a class="" href="<?php echo home_url(); ?>/">
                        <img alt="coreplus"
                            src="<?=TrueLib::getImageURL('logo.png')?>" class="retina-image">
                    </a>
                </div>

                <div class="page-description trial-title entry-content" style="margin-bottom:20px">

                    <?php the_field('page_title')?>

                </div>

                <?php if ($htmlStr !="") { ?>

                <div class='page-description tc entry-content'>

                    <?php echo $htmlStr?>

                </div>

                <?php } else { ?>

                <script type="text/javascript">
                    jQuery(document).ready(function($) {
                            var strength = 0;
                            var minPasswordStrength = 3;
                            var passwordsMatch = false;

                            function checkStrength(password, $step) {
                                passwordLength = password.length;
                                strength = 0;
                                if (password.length < 6) {
                                    $step.find("#result").removeClass("password-error-container password-success-container");
                                    $step.find("#result").addClass("password-error-container");
                                    return "Too short";
                                }

                                if(!(/^[a-zA-Z0-9]*$/.test(password))) {
                                    $step.find("#result").removeClass("password-error-container password-success-container");
                                    $step.find("#result").addClass("password-error-container");
                                    return "No special characters (!,@,#@,$,etc)";
                                }

                                if (password.length > 7) strength += 1;
                                if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1;
                                if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 1;

                                var strengthRating = "weak";
                                switch (strength)
                                {
                                    case 0:
                                        strengthRating = "weak";
                                        break;

                                    case 1:
                                        strengthRating = "weak";
                                        break;

                                    case 2:
                                        strengthRating = "weak";
                                        break;

                                    case 3:
                                        strengthRating = "good";
                                        break;

                                    default:
                                        strengthRating = "strong";
                                        break;
                                }
                                switch (strengthRating) {
                                case "weak":
                                    $step.find("#result").removeClass("password-success-container");
                                    $step.find("#result").addClass("password-error-container");
                                    return "Not strong enough";
                                    break;

                                case "good":
                                    $step.find("#result").removeClass("password-error-container");
                                    $step.find("#result").addClass("password-success-container");
                                    return "Good";
                                    break;

                                case "strong":
                                    $step.find("#result").removeClass("password-error-container");
                                    $step.find("#result").addClass("password-success-container");
                                    return "Strong";
                                    break;
                                }
                            }

                            function checkMatch($step) {
                                if (strength >= minPasswordStrength && passwordLength >= 6) {
                                    if ($step.find("#password").val() == $step.find("#password-confirm").val()) {
                                        $step.find("#result-confirm").removeClass("password-error-container");
                                        $step.find("#result-confirm").addClass("password-success-container");
                                        passwordsMatch = true;
                                        if($('#trialForm').find(".trial-form__result").html() == 'These passwords do not match') {
                                            $('#trialForm').find(".trial-form__result").html('').hide();
                                        }
                                        return "Passwords match";
                                    } else {
                                        $step.find("#result-confirm").removeClass("password-success-container");
                                        $step.find("#result-confirm").addClass("password-error-container");
                                        passwordsMatch = false;
                                        return "Passwords don't match";
                                    }
                                } else {
                                    $step.find("#result-confirm").removeClass("password-error-container password-success-container");
                                    passwordsMatch = false;
                                    return "";
                                }
                            }

                            function validateForm()
                            {
                                var $form = $('#trialForm');
                                var matchResult = checkMatch($('#trialForm'));

                                $('.trial-form__result').show();

                                // Special characters test
                                if(!(/^[a-zA-Z0-9]*$/.test($form.find('#password').val()))) {
                                    $('.trial-form__result').html('Please do not include special characters (!,@,#@,$,etc) in your password.');
                                    $form.find("#password").closest(".form-group").addClass("has-error");
                                    return false;
                                }

                                if (strength < minPasswordStrength) {
                                    $('.trial-form__result').html('Your password is not strong enough. It should be atleast 8 characters long, one upper and lower case character, one digit and no special characters.');
                                    $form.find("#password").closest(".form-group").addClass("has-error");
                                    return false;
                                }
                                if (!passwordsMatch) {
                                    $('.trial-form__result').html('These passwords do not match');
                                    $form.find("#password-confirm").closest(".form-group").addClass("has-error");
                                    return false;
                                }

                                if (!passwordsMatch) {
                                    $('.trial-form__result').html(matchResult);
                                    return false;
                                } else if (strength < minPasswordStrength) {
                                    $('.trial-form__result').html(passwordStrength);
                                    return false;
                                } else {
                                    $('.trial-form__result').hide().empty();
                                    return true;
                                }
                            }

                            // Onload
                            $('#trialForm').find("#password").keyup(function() {
                                $('#trialForm').find("#result").html(checkStrength($('#trialForm').find("#password").val(), $('#trialForm')));
                                $('#trialForm').find("#result-confirm").html(checkMatch($('#trialForm')));
                            });
                            $('#trialForm').find("#password-confirm").keyup(function() {
                                $('#trialForm').find("#result-confirm").html(checkMatch($('#trialForm')));
                            });

                            // Onsubmit
                            $('#trialForm').submit(function(e)
                            {

                                if (!validateForm())
                                {
                                    e.preventDefault();
                                    return false;
                                }
                            });

                            // Add avent listener to submit button
                            $('#trialForm .button').click(function()
                            {
                                $('#trialForm').submit();
                            });

                        });

                </script>



                <div class="trial-form-container grid_container">

                    <form id='trialForm' name='trialForm' action="?rId=<?=$rId?>" method='post'>

                        <input type="hidden" name="rid" id="rid" value="<?=$rId?>" />

                        <input type="hidden" name="prOK" id="prOK" value="false" />

                        <div class="trial-form__result form-error-container"></div>

                        <table width='100%' id='trialTable' class='inputTable'>
                            <tr>
                                <th> New Password</th>
                                <td>
                                    <input type="password" id="password" name="password" size="50" value="" autocomplete="off">
                                    <div id='result' class=''></div>
                                </td>
                            </tr>

                            <tr>
                                <th>Confirm Password</th>
                                <td>
                                    <input type="password" id="password-confirm" name="password-confirm" size="50" value="" autocomplete="off">
                                    <div id='result-confirm' class=''></div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <p class="form-notice-container">
                                        <b>Your Password must be:</b><br>
                                        At least 8 characters<br>
                                        At least one upper and lower case character<br>
                                        At least one digit<br>
                                        No special characters (!,@,#@,$,etc)
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='2'>
                                    <a class='button' style='float:right;'>Submit</a>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <?php } ?>
            </div>
        </div>

    </div>
</div>
<?php endwhile; endif; ?>
<div class="text-center" style="margin-top: 50px;">
    <a class="btn btn--colour-orange"
        href="<?php echo home_url(); ?>/">
        Return to coreplus website
    </a>
</div>
