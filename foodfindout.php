
/**
 *Plugin Name: foodfindout
 *Plugin URI: http://wordpress.org/plugins/foodfindout/
 *Description: gets restaurant info from foodfindout server
 *Author: Sunny
 *Version: 1.0.1
 */

if(class_exists('Twig_Autoloader')==false){
    require_once(__DIR__.'/Twig-1.18.0/lib/Twig/Autoloader.php');
}
Twig_Autoloader::register();

function insert_rest_info($atts){
    $loader = new Twig_Loader_Filesystem($_SERVER['DOCUMENT_ROOT']."/templates");
    $twig = new Twig_Environment($loader,array('cache' => $_SERVER['DOCUMENT_ROOT']."/templates/cache",));
    $a = shortcode_atts( array('name' => 'default','template'=>'default'), $atts );
    $template = $twig->loadTemplate($a['template']);
    $jsonarray=json_decode(file_get_contents("http://api.foodfindout.com/api/menu/".$a['name']));
    echo $template->render(array ('restaurant' =>$jsonarray ));
}
add_shortcode( 'restaurantinfo', 'insert_rest_info' );

?>