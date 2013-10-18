<?php
/*
Plugin Name: Eshopbox check cod on product detail page
Plugin URI: http://www.eshopbox.com
Description: Eshopbox check cod on product detail page
Version: 0.9
Author: vaibhav sharma
Author URI: http://www.eshopbox.com
*/

/**
 * Copyright (c) `date "+%Y"` Vaibhav Sharma. All rights reserved.
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * **********************************************************************
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class eshopcheckcod{
    public function __construct(){
        add_action( 'wp_ajax_nopriv_myajax-submiting', array(&$this,'myajax_submit') );
        add_action( 'wp_ajax_myajax-submiting', array(&$this,'myajax_submit') );
        
         add_action( 'woocommerce_after_single_product_summary', array($this, 'add_coupons_templates'));
       
       // wp_localize_script( 'my-ajax-request', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
     //   add_action('wp_ajax_nopriv_checkcod', array(&$this, 'checkcod_callback'));

    //    add_action( 'woocommerce_after_my_account', array($this, 'add_coupons_template'));
         
         
         // embed the javascript file that makes the AJAX request
wp_enqueue_script( 'my-ajax-request', plugin_dir_url( __FILE__ ) . 'assets/app.js', array( 'jquery' ) );
 
// declare the URL to the file that handles the AJAX request (wp-admin/admin-ajax.php)
wp_localize_script( 'my-ajax-request', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
        

               
        
    }

    function myajax_submit(){
        global $wpdb;
if($_POST['whataction'] == 'checkZipcode'){
	$zipcode = $_POST['zipcode'];
        $checkara =  stripslashes(get_option( 'woocommerce_cod_aramex_ena' ));
        if($checkara=='Yes'){
        $aramex = $wpdb->get_var("SELECT count(*) as  aramexcount FROM ".$wpdb->prefix."cod_aramex WHERE pincode = ".$zipcode);
        }
        $checkdtdc =  stripslashes(get_option( 'woocommerce_cod_dtdc_ena' ));
         if($checkdtdc=='Yes'){
        $dtdc = $wpdb->get_var("SELECT count(*) as dtdccount FROM ".$wpdb->prefix."cod_dtdc WHERE pincode = '".$zipcode."'");
         }
        $checkqua =  stripslashes(get_option( 'woocommerce_cod_quantium_ena' ));
          if($checkqua=='Yes'){
	$quantium = $wpdb->get_var("SELECT count(*) as quantiumcount FROM  ".$wpdb->prefix."cod_quantium WHERE pincode = ".$zipcode);
          }
        if($aramex < 1 && $dtdc < 1 && $quantium < 1){
		echo 0;exit;
	}else{
		echo 1; exit;
	}
}
        
    }
    
    
  function add_coupons_templates(){
      global $woocommerce;
      
       global $wpdb;
        
       echo '<div class="freeshipping_block ">
        <p>COD Availability</p>
        <div class="devivery_returns freeshipping_block2">
       
        <p>Enter your pincode to know the
COD availablity for your area.</p>
<form id ="shipment_form" onsubmit="return false;">
<input type="text" id="pinc" name ="pinc">
<input type="button" name="check_button" id="pinbutton" value="CHECK">
</form>
        </div>
        <!-- dilivey_returns -->
        <ul class="messages_ship">
            <li id="ship_avial" style="display:none">Prepaid and Cash on Delivery options are available</li>
            <li id="ship_not_avial" style="display:none">Prepaid and Cash on Delivery options are not available</li>
        </ul>

        </div>';
       

    
    }  
      
  
    
function checkcod_callback() {
	global $woocommerce, $post,$wpdb;
	global $woocommerce, $post;
       
        echo 'testy'; exit;
        print_r($_GET);
        print_r($_POST);
        
}




/**
     * Get the plugin url.
     *
     * @access public
     * @return string
     */
    public function plugin_url() {
        if ( $this->plugin_url ) return $this->plugin_url;
        return $this->plugin_url = untrailingslashit( plugins_url( '/', __FILE__ ) );
    }


    /**
     * Get the plugin path.
     *
     * @access public
     * @return string
     */
    public function plugin_path() {
        if ( $this->plugin_path ) return $this->plugin_path;

        return $this->plugin_path = untrailingslashit( plugin_dir_path( __FILE__ ) );
    }

}
new eshopcheckcod();
