<?php
/**

 * @package EnablonCommunity

 */
/*
  Plugin Name: Vendmy Wordpress Scroll Down Plugin
  Plugin URI: https://www.vendmy.com
  Description: Ajouter un bouton scroll down sur n importe quelle partie du site
  Version: 1.0
  Author: Vendmy
  Author URI: http://Vendmy.com

 */

define('WSD_PLUGIN_FILE',__FILE__);
define('WSD_DIR', plugin_dir_path(__FILE__));
 
define('WSD_URL', plugin_dir_url(__FILE__));

define('WSD_URL_SITE', get_site_url() . "/");


class WpScrollDown {
    function __construct() {
        add_shortcode('WIDGET_HTML_SCROLL_BOTTOM', array($this, 'get_form_scroll'));   
        add_action( 'plugins_loaded', array($this, 'vc_mapping') );
        
    }   

    /*
     * INit LINKS
     */
    
    /*
     * ADD ACTION
     */


    /*
     * VISUAL COMPOSER INTEGRATION
     */

    function vc_mapping(){
        if(function_exists ('vc_map')){
            vc_map( 
                 array(
                    'base' => 'WIDGET_HTML_SCROLL_BOTTOM',
                    'name' =>__(  "SCROLL DOWN ", 'js_composer'  ),
                    'class' => '',
                    'icon' =>'iw-default',// 'icon-heart',
                    'params' => array(array(
                          "type" => "colorpicker",
                          "holder" => "Couleur du widget",
                          "class" => "",
                          "heading" => "Couleur",
                          "param_name" => "couleur",
                          "value" => __( "#fff", "my-text-domain" ),
                          "description" => "La couleur pour personnaliser le kit" 
                        )
                    )
                ) 
            );
        }
    }

    /*
     * SHORCODE INTEGRATION
     */
    function get_form_scroll($atts = [], $content = null, $tag = ''){
        // normalize attribute keys, lowercase
        $atts = array_change_key_case((array)$atts, CASE_LOWER);
            // override default attributes with user attributes
         $wporg_atts = shortcode_atts(
            [
                'kecouleury'=>  "#fff"
            ], $atts, $tag);
         $couleur = $wporg_atts['couleur'];
        if ( is_admin() ) {
                echo "Integration Bon de visite ";
        } else {
            $message =  "<link rel='stylesheet' href='".WSD_URL."template/css/style.css'>".
            "<div class='wp-scroll-down bk-scroller'>".
                "<div class='scroller_set _element'>".
                    "<div class='scroller_shape'>".
                        "<svg height='20' width='10'>".
                            "<circle class='scroller-c1' cx='5' cy='15' r='2'></circle>".
                            "<circle class='scroller-c2' cx='5' cy='15' r='2'></circle>".
                        "</svg>".
                    "</div>".
                "</div>".
                "<div class='text-scroll'>".
                    "<!-- <a href='javascript:void()'> SCROLLEZ POUR EN SAVOIR PLUS </a>     -->".
                "</div>  ".
            "</div>".
            "<style type='text/css'>".
                ".scroller_set {width: 25px;height: 40px;}".
                ".scroller_shape {border: 3px solid #fff;border-radius: 50px!important;-webkit-border-radius:50px !important;}".
               ".scroller-c1, .scroller-c2 {fill: #fff;}".
            "</style>";
             echo $message;
        }
    }
}

new WpScrollDown();