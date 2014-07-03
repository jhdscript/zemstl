<?php

/*
  Plugin Name: ZeM STL
  Plugin URI: http://www.zem.fr/
  Description: The best STL Viewer for WordPress which supports binary and ascii STL files without requiring any preprocessing, all the parsing is done on the client in javascript. The plugin is based on Thingiview.js library.
  Version: 1.0
  Author: jhd
  Author URI: http://www.zem.fr/
  License: GNU GPLv3 or later
  Options:
    width: width of the render contener (default: 400)
    height: height of the render contener (default: 350)
    planes: show (1) or hide (0) the 100x100 grid plane under the object (default: 1).
    rotation: object rotate slowly (1) or doesn't rotate (0) around the z axis (default: 1).
    color: sets the object's color (default: #C0D8F0)
    bgcolor: sets the background color of the viewer's container (default: #FFFFFF).
    material: sets the object's material. Possible values are solid or wireframe (default: solid).
    url: stl file url. Not mandatory if embedded stl is used.
  Options Commented (don't work):
    camera: sets the camera view to the desired angle. Possible values are top, side, bottom, diagonal (default: diagonal);
    zoom: positive number to zoom the camera in or a negative number to zoom out (default: 4).
  Examples: add these line in your editor
    Small: [zemstl url="http://pathtoyour.stl"/]
    Full: [zemstl width="400" height="300" planes="1" rotation="1" camera="diagonal" zoom="5" color="#C0D8F0" bgcolor="#FFFFFF" material="wireframe" url="http://path-to-your.stl"/]
    Inline: [zemstl url="http://pathtoyour.stl"]put-stl-code-here[/zemstl]
 */

function zemstl_activation() {

}

register_activation_hook(__FILE__, 'zemstl_activation');

function zemstl_deactivation() {

}

register_deactivation_hook(__FILE__, 'zemstl_deactivation');



/***************************
* Register des fichiers JS *
***************************/

add_action('wp_enqueue_scripts', 'zemstl_scripts');

function zemstl_scripts() {
    global $post;

    wp_enqueue_script('jquery');

    wp_register_script('zemstljs_three', plugins_url('js/three.js', __FILE__), array("jquery"));
    wp_enqueue_script('zemstljs_three');
    wp_register_script('zemstljs_plane', plugins_url('js/plane.js', __FILE__), array("jquery"));
    wp_enqueue_script('zemstljs_plane');
    wp_register_script('zemstljs_thingiview', plugins_url('js/thingiview.js', __FILE__), array("jquery"));
    wp_enqueue_script('zemstljs_thingiview');
    wp_register_script('zemstljs_core', plugins_url('js/zemstl.js', __FILE__), array("jquery"));
    wp_enqueue_script('zemstljs_core');

}

/***************************
* Integration du shortcode *
***************************/
add_shortcode("zemstl", "zemstl_display");

function zemstl_display($attr, $content) {
    //extract(shortcode_atts(array('id' => ''), $attr));

    $stlurl = null;
    if (isset($attr["url"]) && !empty($attr["url"])){ $stlurl = $attr["url"]; }
    if (($stlurl != null) || ($content != null)){
        $width = 400;
        $height = 350;
        $planes = 1;
        $rotation = 1;
        $camera = 'diagonal';
        $zoom = 4;
        $color = '#C0D8F0';
        $bgcolor = '#FFFFFF';
        $material = 'solid';
        $r = rand(1,100000000);
        if (isset($attr["width"]) && !empty($attr["width"]) && is_numeric($attr["width"])){ $width = $attr["width"]; }
        if (isset($attr["height"]) && !empty($attr["height"]) && is_numeric($attr["height"])){ $height = $attr["height"]; }

        if (isset($attr["planes"]) && is_numeric($attr["planes"])){
            if ($attr["planes"] == 0) { $planes = 0; }
        }
        if (isset($attr["rotation"]) && is_numeric($attr["rotation"])){
            if ($attr["rotation"] == 0) { $rotation = 0; }
        }
        if (isset($attr["camera"]) && !empty($attr["camera"])){
            switch (strtolower($attr["camera"])){
                case 'top': $camera = 'top'; break;
                case 'side': $camera = 'side'; break;
                case 'bottom': $camera = 'bottom'; break;
            }
        }
        if (isset($attr["zoom"]) && is_numeric($attr["zoom"])){ $zoom = $attr["zoom"]; }
        if (isset($attr["color"]) && !empty($attr["color"])){ $color = $attr["color"]; }
        if (isset($attr["bgcolor"]) && !empty($attr["bgcolor"])){ $bgcolor = $attr["bgcolor"]; }
        if (isset($attr["material"]) && !empty($attr["material"]) && strtolower($attr["material"]) == 'wireframe'){ $material = 'wireframe'; }

        $html = '<div id="zemstl'.$r.'" class="zemstl" style="width:'.$width.'px; height:'.$height.'px;" data-planes="'.$planes.'" data-rotation="'.$rotation.'" data-camera="'.$camera.'" data-zoom="'.$zoom.'" data-color="'.$color.'" data-bgcolor="'.$bgcolor.'" data-material="'.$material.'" data-stl="'.$stlurl.'">'.wp_strip_all_tags($content, false).'</div>';
    }
    else {
        $html = '<div class="error">STL url not valid (or embedded STL is empty).</div>';
    }

    return $html;
}

?>