<div class="sub-menu-section">
    <div class="sub-menu blog-width">
        <?php get_template_part( 'partials/blog', 'menu' ); ?>
    </div>
</div>

        
        <div class="section blog-width">
          <div class="blog-title-area row equal">
            <div class="col-lg-6 col-md-6 col-sm-12 blog-details-image">
				<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );?>
				<div class="post-image-cover">
			<div class="post-image" > 
				<img src="<?php echo $url; ?>"/>
			</div>
			</div>
            </div>
			  
            <div class="blog-detail-feature col-lg-6 col-md-6 col-sm-12">
              <div>
                <p class="blog-detail-category">
					<?php $category = get_the_category();
					$firstCategory = $category[0]->cat_name;
					echo $firstCategory;?>
				</p>
                <p class="blog-detail-title"><?php the_title() ?></p>
                <p class="blog-detail-excerpt">
					<?php// the_excerpt() ?>
					<?php echo get_field('sub_heading'); ?>
				  </p>
              </div>
              <div>
                <p class="blogging-info">
				
                <span class="blogger-thumbnail">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 42 ); ?>
					
				</span>			
                <?php get_template_part('partials/author-name-and-date') ?>
            </p>
              </div>
              <div class="blog-tags">
				  <?php
							$categories = get_the_category();
							$separator = ' ';
							$output = '';
							if($categories){
								foreach($categories as $category) {
								$output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
								}
								echo trim($output, $separator);
							}?>
              </div>
            </div>
          </div>
        </div>

        <div class="section blog-width">
          <div class="blog-hyperlinks">
			  
            <span class="left-line">
              <hr class="left-line">
            </span>
           <div class="social">
            		<?php
            		$attributes = "";            		
            		$customURL = get_permalink();
            		$customTitle = the_title_attribute( 'echo=0' );
            		if($customURL != '')
            		{
                		$attributes = 'addthis:url="' . $customURL . '" ';
                		$attributes .= ' addthis:counturl="' . $customURL . '" ';
            		}
            		
            		 if($customTitle != '')
            		{
                		$attributes .= 'addthis:title="' . $customTitle .'"';
            		}
            
            		?>
            		<!-- AddThis Button BEGIN addthis_32x32_style -->
					<div class="addthis_toolbox addthis_default_style"  <?=$attributes?>>
						<a class="addthis_button_facebook"><img alt="Facebook Social Icon" class="retina-icon" src="https://qa-web.coreplus.com.au/wp-content/uploads/2021/08/facebook.png"></a>
                    <a class="addthis_button_linkedin"><img alt="LinkedIn Social Icon" class="retina-icon" src="https://qa-web.coreplus.com.au/wp-content/uploads/2021/08/linkedin.png"></a>
                    <a class="addthis_button_more"><img alt="More Social Icon" class="retina-icon" src="https://qa-web.coreplus.com.au/wp-content/uploads/2021/08/link.png"></a>
						
<!-- 						<a class="addthis_counter addthis_bubble_style"></a> -->
					</div>
					<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js"></script>
					<!-- AddThis Button END -->
            	</div>
            <span class="middle-line">
              <hr>
            </span>
            <span class="reading-time">
              <i class="far fa-clock"></i>
              <span>
				  <?php 
				  $words =  prefix_wcount(); 
				  $reading_time = ceil($words/250);
				  echo $reading_time. " Min Read";
				  ?>
				</span>
            </span>
            <span class="right-line">
              <hr>
            </span>
          </div>
        </div>

       <div class="section blog-width row">
          <?php get_template_part( 'content'); ?>
	   </div>

        <div class="section blog-width prev-next-blogs">
          <div class="prev-blog">
            <p><i class="fas fa-arrow-left"></i> Previous</p>
            <a href="" class="links previous-blog-link"><?php previous_post_link(); ?></a>
          </div>
          <div class="next-blog">
            <p>Next <i class="fas fa-arrow-right"></i> </p>
            <a href="" class="links next-blog-link"><?php next_post_link(); ?></a>
          </div>
        </div>

        <div class="section blog-width">
          <div class="feedback-section">
            <p id="helpfulText">Was this post useful?</p>
			 <div>
				 <img id="popperImage" src="https://qa-web.coreplus.com.au/wp-content/uploads/2021/08/party-popper-joypixels.gif" style="height:100px;margin-bottom:10px;display:none;margin-left: auto;margin-right: auto;">
			  </div>
			  
            <div class="feedback-buttons">
	
              <button id="yesButton" class="btn feedback-button"> Yes, Thanks!</button>
				<p id="gotIt" style="display:none">
					Got it!
				</p>
				<p id="yesButtonFeedback" style="display:none">
					Thanks a lot for your feedback!
				</p>
              <button id="noButton" class="btn feedback-button"> Not sure</button>
		<form id="feedback-form" method="POST" name="subscriber-email" action="<?php echo admin_url('admin-ajax.php'); ?>">
					<textarea id="visitorFeedback" rows="4" cols="150" style="margin-top:30px;margin-bottom:20px;text-align:left;display:none" class="btn blog-subscriber-email no-wrap" name="visitor-feedback" required placeholder="Sorry about that! How can we make it better?"></textarea>
					<br>
				<input type="hidden" name="action" value="blog_feedback" >
				<input type="submit" style="display:none;margin-left:auto;margin-right:auto" id="feedbackButton" value="Submit Your Feedback" class="btn feedback-button">
			</form>
            </div>
			  
			  <script type="text/javascript">
				  document.getElementById("yesButton").addEventListener("click", function() {
					  document.getElementById("yesButton").style.display='none';
					  document.getElementById("noButton").style.display='none';
					  document.getElementById("helpfulText").style.display='none';
					  document.getElementById("popperImage").style.display='block';
					  document.getElementById("yesButtonFeedback").style.display='block';
					  
					});
				   document.getElementById("noButton").addEventListener("click", function() {
					   document.getElementById('yesButton').setAttribute("disabled","disabled");
					  document.getElementById("visitorFeedback").style.display='block';
					  document.getElementById("feedbackButton").style.display='block';
					  
					  
					});
				  
			  </script>
			  
			  <script type="text/javascript">
			jQuery(document).ready(function($){
				$('#feedback-form').ajaxForm({
					success:function(response){
// 						console.log(response);
						document.getElementById("yesButtonFeedback").style.display = 'block';
						document.getElementById("gotIt").style.display = 'block';
						document.getElementById("yesButtonFeedback").innerHTML = "Thanks for your feedback.";
						document.getElementById("yesButton").style.display = 'none';
						document.getElementById("noButton").style.display = 'none';
						document.getElementById("visitorFeedback").style.display = 'none';
						document.getElementById("feedbackButton").style.display = 'none';
						document.getElementById("helpfulText").style.display = 'none';
					},
					resetForm:true
				});
			});
			</script>

          </div>
        </div>
        
        <div class="section blog-width recent-stories">
          <p>Recent Stories</p>
           <hr class="line-opacity">
        </div>
        <div class="section-blogs blog-width row">
          
			<?php 
	$args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => 3,
);
$arr_posts = new WP_Query( $args );
 
if ( $arr_posts->have_posts() ) :
 
    while ( $arr_posts->have_posts() ) :
        $arr_posts->the_post();
        ?>
		<div class="section-blog col-lg-4 col-md-6 col-sm-12">
		
			<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
			?>
			<div class="post-image-cover">
			<div class="post-image" > 
				<img src="<?php echo $url; ?>"/>
			</div>
			</div>
            <p class="blog-category">
               <?php $category = get_the_category();
					$firstCategory = $category[0]->cat_name;
					echo $firstCategory;?>
            </p>
            <p class="section-blog-title">
                <a class="section-blog-title" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
            </p>
			<p>
					<?php the_excerpt(); ?>
				</p>
            <p class="blogging-info">
				
                <span class="blogger-thumbnail">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 42 ); ?>
				</span>			
                <?php get_template_part('partials/author-name-and-date') ?>
            </p>
        </div>
		
		     <?php
    endwhile;
endif;
	wp_reset_postdata();
	?>
         
        </div>
        <div class="s-button-div">
          <a href="<?php echo home_url('/blog') ?>" class="btn feedback-button">Read More &nbsp;&#8594; </a>
        </div>
<!--  -->
        <?php get_template_part('partials/subscribe-for-blogs'); ?>
<!--  -->
