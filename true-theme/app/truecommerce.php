<?php

/**
 * Woocommerce Files
 *
 * @author TrueAgency <developers@trueagency.com.au>
 */
class Truecommerce 
{
    /**
     * Load Truecommerce
     *
     */
    public static function init()
    {
        //Declare Woocommerce support
        add_action( 'after_setup_theme', function()
        {
            add_theme_support( 'woocommerce' );
        });
    }
}