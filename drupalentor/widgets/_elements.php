<?php
function drupalentor_set_elements(){
   return $shortcodes = array(
    'gva_column',
    'gva_row',
    'gva_accordion',
    'gva_box_color', 
    'gva_box_hover', 
    'gva_call_to_action',
    'gva_chart',
    'gva_code',
    'gva_text',
    'gva_text_noeditor',
    'gva_counter',
    'gva_drupal_block',
    'gva_heading',
    'gva_icon_box_classic',
    'gva_icon_box',
    'gva_icon_box_color',
    'gva_image',
    'gva_our_team',
    'gva_pricing_item',
    'gva_progress',
    'gva_tabs',
    'gva_tabs_content',
    'gva_video_box',
    'gva_gmap',
    'gva_button',
    'gva_view',
    'gva_quote_text',
    'gva_image_content',
    'gva_image_content_parallax',
    'gva_services_carousel',
    'gva_gallery',
    'gva_our_partners',
    'gva_download',
    'gva_socials',
    'gva_instagram',
    'gva_text_rotate',
    'gva_quotes_rotator',
    'gva_links',
    'gva_work_process',
    'gva_job_box',
    'gva_slideshow'
  );
}

function gavias_merge_atts( $pairs, $atts, $shortcode = '' ) {
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

function scrape_insta_hash($tag) {
   $insta_source = file_get_contents('https://www.instagram.com/'.trim($tag)); // instagrame tag url
   $shards = explode('window._sharedData = ', $insta_source);
   $insta_json = explode(';</script>', $shards[1]); 
   $insta_array = json_decode($insta_json[0], TRUE);
   return $insta_array; // this return a lot things print it and see what else you need
}