<?php
add_action( 'admin_menu', 'apis_add_admin_menu' );

add_action( 'admin_init', 'apis_settings_init' );

function apis_add_admin_menu(  ) { 

	add_options_page( 'LoL API Plugin', 'LoL API Plugin', 'manage_options', 'lol_api_plugin', 'lol_api_plugin_options_page' );

}


function apis_settings_init(  ) { 

	register_setting( 'pluginPage', 'eg_setting' );

	add_settings_section(
		'apis_pluginPage_section', 
		__( 'Your section description', 'wordpress' ), 
		'apis_settings_section_callback', 
		'pluginPage'
	);

	add_settings_field( 
		'api_key', 
		__( 'LoL API key', 'wordpress' ), 
		'apis_text_field_0_render', 
		'pluginPage', 
		'apis_pluginPage_section' 
	);

	add_settings_field( 
		'amount_games', 
		__( 'Amount of games to display', 'wordpress' ), 
		'apis_text_field_1_render', 
		'pluginPage', 
		'apis_pluginPage_section' 
	);


}


function apis_text_field_0_render(  ) { 

	$options = get_option( 'eg_setting' );
	?>
	<input type='text' name='eg_setting[api_key]' value='<?php echo $options['api_key']; ?>'>
	<?php

}


function apis_text_field_1_render(  ) { 

	$options = get_option( 'eg_setting' );
	?>
	<input type='text' name='eg_setting[amount_games]' value='<?php echo $options['amount_games']; ?>'>
	<?php

}


function apis_settings_section_callback(  ) { 

	echo __( 'LoL API Plugin settings', 'wordpress' );

}


function lol_api_plugin_options_page(  ) { 

	?>
	<form action='options.php' method='post'>
		
		<h2>LoL API Plugin</h2>
		
		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>
		
	</form>
	<?php

}

?>