<?php
/*
Plugin Name: LoL API plugin
Plugin URI: https://nl.linkedin.com/in/ainsleyw/en
Description: League of Legends API match plugin.
Author: Ainsley Wheeler
Version: 0.1
Author URI: http://lolhistoryapp.com
*/
$apiKey = $options['api_key'];
	wp_register_style( 'style', plugins_url( 'Match-details/assets/css/plugin.css' ) );
	wp_enqueue_style( 'style' );
}
function displayMatch() {
    $output = show_match();
    return $output;
}
function get_match_items(){
    $items = file_get_contents(plugin_dir_path( __FILE__ )."/json/items.txt");
    return $items;
}
function get_match_sumSpells(){
    $sumSpells = file_get_contents(plugin_dir_path( __FILE__ )."/json/sumSpells.txt");
    return $sumSpells;
}
function get_match_champions(){
    $champions = file_get_contents(plugin_dir_path( __FILE__ )."/json/champions.txt");
    return $champions;
}
function show_match() {
    $champions = get_object_vars(json_decode(get_match_champions()));
    $items = json_decode(get_match_items());
    $sumSpells = json_decode(get_match_sumSpells());
	foreach($sumSpells->data as $spell){
		$sumSpells->actualSums[$spell->id] = $spell->name;
	}
    ob_start(); 
    return ob_get_clean();
}