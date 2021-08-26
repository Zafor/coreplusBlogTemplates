<?php
/*
Template Name: Validate
*/
    $reason = '';
    if(isset($_GET['vid']))
    {
        coreplus_trial_validate($_GET['vid']);
    }
    
    if(isset($_GET['reason']))
    {
        $reason = $_GET['reason'];
    }
    
    //get all the response types
    $message = '';
    if(get_field('response_messages'))
    {
        $responses = get_field('response_messages');
        
        $messageList = array();
        foreach($responses as $response)
        {
            $messageList[trim($response['response_code'])] = $response['response_message'];
        }
        
        if(isset($messageList[$reason]))
        {
            $message = $messageList[$reason];
        } else {
            $message = 'An unknown error occured.';
        }
    }
?>
<div class="v1-theme">
<?php 

    if (have_posts()) : 
        while (have_posts()) : the_post(); 
            ?>
            <div id="main" class="wrapper">
                <?php createTrueBreadcrumb()?>  
                <div id="primary" class="site-content">
                    <div id="content" role="main">
                        <div class="success-title trial-title">
                            <?php the_field('page_title')?>
                        </div>
                        <div class='page-description tc entry-content'>
                            <?php echo $message?>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
        endwhile; 
    endif;
?>
</div>