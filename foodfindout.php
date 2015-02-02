<?php

/**
*Plugin Name: foodfindout
*Plugin URI: http://wordpress.org/plugins/foodfindout/
*Description: gets restaurant info from foodfindout server
*Author: Sunny
*Version: 1.0.0
*/

require_once (__DIR__.'/Twig-1.18.0/lib/Twig/Autoloader.php');
Twig_Autoloader::register();

function insert_rest_info($atts){      
       $loader = new Twig_Loader_Filesystem(__DIR__);
       $twig = new Twig_Environment($loader);
       $template = $twig->loadTemplate('template.html');	
       $a = shortcode_atts( array('name' => 'default'), $atts );
       $jsonarray=json_decode(file_get_contents("http://api.foodfindout.com/api/menu/".$a['name']));
       echo $template->render(array ('restaurant' =>$jsonarray     ));  
}
add_shortcode( 'restaurantinfo', 'insert_rest_info' );

?>