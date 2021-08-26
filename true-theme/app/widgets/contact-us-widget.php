<?php

    class ContactUsWidget extends WP_Widget
    {
        public function __construct()
        {
            $widget_ops = array('classname' => 'ContactUsWidget', 'description' => 'Displays Address details in the footer' );
            parent::__construct('ContactUsWidget', 'Contact Us Widget', $widget_ops);
        }


        public function widget($args, $instance)
        {
            extract($args, EXTR_SKIP);
            echo $before_widget;
            echo $before_title . 'Contact Us' . $after_title; ?>
            <div class="contactus-widget-text">
                <?=nl2br(get_option('contact-us')) ?>
            </div>
            <?php
            echo $after_widget;
        }
    }

    function register_contact_widget()
    {
        return register_widget("ContactUsWidget");
    }
    add_action('widgets_init', 'register_contact_widget');
