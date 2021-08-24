<div class="cta-section">
    <div class="cta-section-content blog-width  row flex-column-reverse flex-lg-row flex-md-row">
        <div class="col-md-6 col-md-push-6 cta-image">
            <img src="https://qa-web.coreplus.com.au/wp-content/uploads/2021/06/cta-img2.png" alt="">
        </div>
        <div class="cta-button col-md-6 col-md-pull-6 margin-top-40">
            <p id="successText">Don’t Want to Miss Coreplus Stories & Updates!</p>
            <form id="subscription-form" method="POST" name="subscriber-email" action="<?php echo admin_url('admin-ajax.php'); ?>">
                <input type="text" name="blog-subscriber-email" id="subscriptionInput" class="btn blog-subscriber-email no-wrap" required placeholder="Enter your Email Address">
                <input type="hidden" name="action" value="create_subscriber">
                <input type="submit" id="subscriptionButton" value="Subscribe" class="btn section-button-white">
            </form>
            <script type="text/javascript">
                jQuery(document).ready(function($) {
                    $('#subscription-form').ajaxForm({
                        success: function(response) {
                            // 						console.log(response);
                            document.getElementById("successText").innerHTML = "Thanks! You're subscribed to coreplus stories & updates";
                            document.getElementById("subscriptionInput").placeholder = response.data;
                            document.getElementById("subscriptionInput").style.border = '1px solid #61c5ba';
                            document.getElementById("subscriptionButton").style.border = '1px solid #61c5ba';
                            document.getElementById("subscriptionButton").type = "image";
                            document.getElementById("subscriptionButton").src = "https://qa-web.coreplus.com.au/wp-content/uploads/2021/08/check-circle-regular.png";
                            document.getElementById("subscriptionButton").style.height = '41px';
                            document.getElementById("subscriptionButton").style.width = 'auto';
                            document.getElementById("subscriptionButton").disabled = true;
                            document.getElementById("subscriptionInput").disabled = true;

                        },
                        resetForm: true
                    });
                });
            </script>
        </div>


    </div>
</div>