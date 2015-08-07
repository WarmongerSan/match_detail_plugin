 <?php 
 // ------------------------------------------------------------------
 // Add all your sections, fields and settings during admin_init
 // ------------------------------------------------------------------
 //
	
 function eg_settings_match_api_init() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
 	// Add the section to reading settings so we can add our
 	// fields to it
 	add_settings_section(
		'eg_setting_section',
		'Riot API settings',
		'eg_setting_section_callback_function',
		'general'
	);
 	
 	// Add the field with the names and function to use for our new
 	// settings, put it in our new section
 	add_settings_field(
		'eg_setting_api_key',
		'API Key',
		'eg_setting_callback_function',
		'general',
		'eg_setting_section'
	);
	
	add_settings_field(
		'eg_setting_amount_games',
		'Amount of games to display',
		'eg_setting_callback_function2',
		'general',
		'eg_setting_section'
	);
 	
 	// Register our setting so that $_POST handling is done for us and
 	// our callback function just has to echo the <input>
 	register_setting( 'general', 'eg_setting' );
 } // eg_settings_api_init()
 
 add_action( 'admin_init', 'eg_settings_api_init' );
 
  
 // ------------------------------------------------------------------
 // Settings section callback function
 // ------------------------------------------------------------------
 //
 // This function is needed if we added a new section. This function 
 // will be run at the start of our section
 //
 
 function eg_setting_section_callback_function() {
 	echo '<p>Change these settings to make to plugin work.</p>';
 }
 
 // ------------------------------------------------------------------
 // Callback function for our example setting
 // ------------------------------------------------------------------
 //
 // creates a checkbox true/false option. Other types are surely possible
 //
 
 function eg_setting_callback_function() {
	 $options = get_option('eg_setting');
 	echo '<input name="eg_setting[api_key]" id="eg_setting_api_key" type="text" value="'.$options['api_key'].'" />';
 }
 
 function eg_setting_callback_function2() {
	 $options = get_option('eg_setting');
 	echo '<input name="eg_setting[amount_games]" id="eg_setting_amount_games" type="number" max="10" min="1" value="'.$options['amount_games'].'" />';
 }