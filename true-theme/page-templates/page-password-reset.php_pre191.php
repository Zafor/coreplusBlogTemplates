<?php

/*

Template Name: Password Reset

*/

    if ($_SERVER["REQUEST_METHOD"] == "POST")

    {

        $rId = $_POST["rid"];

    }

    else

        $rId = $_GET["rid"];



    $validVid = coreplus_is_GUID($rId);

    $htmlStr = "";



    if ($validVid)

    {

        if ($_SERVER["REQUEST_METHOD"] == "POST")

        {

            $pwd1 = $_POST["pwd1"];

            $pwd2 = $_POST["pwd1"];



            if (($pwd1=$pwd2) && ($pwd1<> "" and $pwd2 <> "")) 

            {

                // Post it to our web service

                //$data = "pwd1=" . $pwd1 . "&pwd2=" . $pwd2;

				$data = "{\"pwd1\": \"" . $pwd1 . "\",\"pwd2\": \"" . $pwd2 . "\"  }";
				
                $url = "https://go.coreplus.com.au/API1.0/OPMS/FreeTrial/pwdreset/" . $rId;


				$username = "intracore\coreplus_website";
				$password = "ng!GPE8_1h";


                $result = coreplus_post($data, $url, $username, $password);



                $result = str_replace("<string xmlns=\'http://schemas.microsoft.com/2003/10/Serialization/\'>", "",$result);

                $result = str_replace("</string>", "", $result);



                switch($result)

                {

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



<?php 

    

    get_header(); 

    //TrueLib::getTemplatePart('page-banner');



    if (have_posts()) : 

        while (have_posts()) : the_post(); 

            ?>

            <div id="main" class="wrapper">

                <?php createTrueBreadcrumb()?>  

                <div id="primary" class="site-content">

                    <div id="content" role="main">

                        <div class="page-description trial-title entry-content" style="margin-bottom:20px">

                            <?php the_field('page_title')?>

                        </div>

                        <?php 

                            if( $htmlStr != "") 

                            {

                                ?>

                                <div class='page-description tc entry-content'>

                                    <?php echo $htmlStr?>

                                </div>

                                <?php

                            } else { 

                                ?>

                                <script type="text/javascript">

                                    jQuery( document ).ready(function( $ ) 

                                    {
                                        //var regx = /^[A-Za-z0-9]+$/;
										var regx = /^[A-Za-z0-9-_#$!%*&@?^\[\]\(\)\=\+\|\{\}\,\<\>\~]+$/;	
										
                                        function validateForm()

                                        {

                                            $('#pwd1, #pwd2').removeClass('errored');

                                            if ((document.getElementById("pwd1").value == document.getElementById("pwd2").value)&&(document.getElementById("pwd1").value != ""))

                                            {
                                                var newPassword = $("#pwd1").val();
                                                if(newPassword.length > 8 && regx.test(newPassword))
                                                {
                                                    return true;
                                                }

                                                $('#pwd1, #pwd2').addClass('errored');
                                                return false;
        
                                            } else {

                                                $('#pwd1, #pwd2').addClass('errored');

                                                return false;

                                            }

                                        }

                                        

                                        $('#trialForm').submit(function(e)

                                        {

                                            if (validateForm()) 

                                            {

                                                

                                            } else {

                                                alert("Please enter matching passwords, greater than 8 characters.");

                                                e.preventDefault();

                                            }

                                        });

                                        

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

                                        <table width='100%' id='trialTable' class='inputTable'>

                                            <tr>

                                                <th> New Password:</th>

                                                <td>

                                                    <input type="password" id="pwd1" name="pwd1" size="50" value="">

                                                </td>

                                            </tr>

                                            

                                            <tr>

                                                <th>Confirm Password:</th>

                                                <td>

                                                    <input type="password" id="pwd2" name="pwd2" size="50" value="">

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

                                <?php

                            }

                        ?>

                        

                    </div>

                </div>

            </div>

            <?php 

        endwhile; 

    endif;



?>

<?php get_footer(); ?>