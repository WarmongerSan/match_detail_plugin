<?php
/*
Plugin Name: Riot API Match Plugin
Plugin URI: https://nl.linkedin.com/in/ainsleyw/en
Description: League of Legends API Match plugin.
Author: Ainsley Wheeler
Version: 0.1.1
Author URI: http://lolhistoryapp.com
*/
if(!get_option('eg_setting_api_key')){
	include("settings.php");
}
$options = get_option('eg_setting');
$apiKey = $options['api_key'];
add_shortcode('match_page', 'displayMatch');
add_action( 'wp_enqueue_scripts', 'register_matchdetails_styles' );
function register_matchdetails_styles() {
	wp_register_style( 'match_api_plugin', plugins_url( 'plugin.css',__FILE__ ) );
	wp_enqueue_style( 'match_api_plugin' );
}
function displayMatch() {
    $output = show_match();
    return $output;
}
function get_match($gameId, $region){
    $history = file_get_contents("https://".$region.".api.pvp.net/api/lol/".$region."/v2.2/match/".$gameId."?api_key=".$GLOBALS['apiKey']);
    return $history;
}
function get_match_items(){
    $items = file_get_contents(plugin_dir_path( __FILE__ )."/json/items.txt");
    return $items;
}
function get_match_item_path_for_id($itemId) {
	return plugin_dir_url( __FILE__ ) . "/images/items/" . "item_" . $itemId . ".png";
}
function get_match_sumSpells(){
    $sumSpells = file_get_contents(plugin_dir_path( __FILE__ )."/json/sumSpells.txt");
    return $sumSpells;
}
function get_match_spell_path_for_id($spellId) {
	return plugin_dir_url( __FILE__ ) . "/images/spells/" . "spell_" . $spellId . ".png";
}
function get_match_champions(){
    $champions = file_get_contents(plugin_dir_path( __FILE__ )."/json/champions.txt");
    return $champions;
}
function get_match_champion_path_for_id($champId) {
	return plugin_dir_url( __FILE__ ) . "/images/champions/" . "champ_" . $champId . ".png";
}
function show_match() {
	$game = json_decode(get_match($_GET['matchId'], $_GET['region'] ));
    $champions = get_object_vars(json_decode(get_match_champions()));
    $items = json_decode(get_match_items());
    $sumSpells = json_decode(get_match_sumSpells());
	foreach($sumSpells->data as $spell){
		$sumSpells->actualSums[$spell->id] = $spell->name;
	}
    ob_start();
	include(plugin_dir_path( __FILE__ )."/match.php");	
    return ob_get_clean();
}
?>
