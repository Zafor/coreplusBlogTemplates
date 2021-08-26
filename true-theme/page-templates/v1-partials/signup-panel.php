			</div><!-- /content -->
		</div><!-- /primary -->
	</div><!-- /main -->
<?php
	global $signupPanelCompact;
	$compactBox = '';
	if(isset($signupPanelCompact))
	{
		$compactBox = 'compact';
	}

	$sourceJSON = coreplus_get_referrers();
?>

<div class="sign-up-panel <?=$compactBox?>">
	<div class="wrapper">
		<div class="site-content">
			<h2 class="bold-title tc">I'm ready to explore the free, untimed trial...</h2>
			<form id="trialForm" method="POST" action="/trial/?submit=true">
				<div class="signup-field">
					<input type="text" name='firstname' placeholder="First name" class='required'>
				</div>
				<div class="signup-field">
					<input type="text" name='surname' placeholder="Last name" class='required'>
				</div>
				<!--<div class="signup-field last">
					<input type="text" name='phone' placeholder="Phone" class='required numeric'>
				</div>-->

				<!-- Row 2 -->
				<div class="signup-field last">
					<input type="text" name='email' placeholder="Email" class='required email'>
				</div>
				<!--<div class="signup-field">
					<input type="text" name='company' placeholder="Company" class='required'>
				</div>
				<div class="signup-field last">
					<select class="required" data-placeholder="Referred By" name='referrer' id="referrer"></select>
					<input type='hidden' name='referrerDesc' id='referrerDesc' value='' />
				</div>-->
				<div class="form-buttons">
					<div class="signup-field small">
						<input type="text" name="promocode" placeholder="Promo Code" id="promocode">
					</div>
					<div class="signup-field small">
						<input type="submit" value="Start Now">
					</div>
					<div class="clear"></div>
				</div>
			</form>
		</div>	
	</div>
</div>

<script type="text/javascript">   
    $( document ).ready(function( $ ) 
    {
        window.referrerJSON = $.parseJSON('<?php echo $sourceJSON ?>');
        function validEmail(emailStr)
        {
            var filter = /^[a-zA-Z][\w\.-]*[a-zA-Z0-9]@[a-zA-Z0-9][\w\.-]*[a-zA-Z0-9]\.[a-zA-Z][a-zA-Z\.]*[a-zA-Z]$/
            if (filter.test(emailStr) == false) {
                return false
            }
            else {
                return true
            }
        }
        
        
        function validatedForm(){
            var validated = true
            $('form input, form textarea').each(function(k,inputObj){
                if(($(this).hasClass('required') && !$(this).val()) || $(this).hasClass('invalid')){
                    $(this).addClass('errored')
                    if($(this).attr('id') != 'repeatemail'){
                        validated = false
                    }
                }
                else if(!$(this).hasClass('invalid')){
                    $(this).removeClass('errored')
                }
                if($(this).hasClass('email') && !validEmail($(this).val())){
                    $(this).addClass('errored erroredEmail')
                    $(this).next('img').fadeOut()
                    if($(this).attr('id') != 'repeatemail'){
                        validated = false
                    }
                }
                else if($(this).hasClass('email') && $(this).val()){
                    $(this).removeClass('errored erroredEmail')
                }
            })
            return validated
        }
        
        $('#trialForm').submit(function(e)
        {
            if (validatedForm()) {
                $('input[name=referrerDesc]').val($("#referrer option:selected").text());
            } else {
                e.preventDefault();
            }
        });
        
        $('#trialForm .button').click(function()
        {
            $('#trialForm').submit();
          
        });
    });
</script>

<div class="wrapper">
	<div class="site-content" style="margin-top:0px">
		<div>
