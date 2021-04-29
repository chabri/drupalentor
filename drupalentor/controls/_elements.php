<?php
function drupalentor_set_elements(){
   return $shortcodes = array(
    'gva_row',
  );
}

function drupalentor_merge_atts( $pairs, $atts, $shortcode = '' ) {
    $atts = (array)$atts;
    $out = array();
    foreach($pairs as $name => $default) {
        if ( array_key_exists($name, $atts) )
            $out[$name] = $atts[$name];
        else
            $out[$name] = $default;
    }
    return $out;
}
