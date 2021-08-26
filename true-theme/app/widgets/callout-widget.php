<?php

    class CalloutWidget extends WP_Widget
    {
        public function __construct()
        {
            $widget_ops = array('classname' => 'CalloutWidget', 'description' => 'Displays a Callout' );
            parent::__construct('CalloutWidget', 'Callout Widget', $widget_ops);
        }


        public function widget($args, $instance)
        {
            extract($args, EXTR_SKIP);
            echo $before_widget; ?>
            <div class="callout-widget-text">
                <div class="text-inner">
                    <?=nl2br(get_option('callout-widget-text')) ?>
                </div>
                <a href="<?=get_permalink(612)?>" class="button">Get An Assessment</a>
            </div>
            <?php
            echo $after_widget;
        }
    }

    function register_callout_widget()
    {
        return register_widget("CalloutWidget");
    }
    add_action('widgets_init', 'register_callout_widget');
