<?php
/*
 * Plugin Name: PRyC WP: Add content to comment form
 * Plugin URI: http://PRyC.pl
 * Description: Add custom content to comment form. Simple, but work...
 * Author: PRyC
 * Author URI: http://PRyC.pl
 * Version: 1.0.6
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/


if ( ! defined( 'ABSPATH' ) ) exit;




if ( !function_exists( 'pryc_wp_comment_form_info_textarea' ) ) {

	function pryc_wp_comment_form_info_textarea( $args ) {
	
		$options = get_option( 'pryc_wp_add_comment_form_info_settings' );
	
		if ( ( isset( $options['pryc_wp_add_comment_form_info_section1_textarea_field_1'] ) ) && ( !empty( $options['pryc_wp_add_comment_form_info_section1_textarea_field_1'] ) ) && ( !isset( $options['pryc_wp_add_comment_form_info_section1_checkbox_field_1'] ) ) && ( empty( $options['pryc_wp_add_comment_form_info_section1_checkbox_field_1'] ) ) ) {
			$pryc_wp_comment_notes_before = stripslashes( $options['pryc_wp_add_comment_form_info_section1_textarea_field_1'] );
			$args['comment_notes_before'] = '<p>' . $pryc_wp_comment_notes_before . '</p>';
		}
		

		if ( ( isset( $options['pryc_wp_add_comment_form_info_section2_textarea_field_1'] ) ) && ( !empty( $options['pryc_wp_add_comment_form_info_section2_textarea_field_1'] ) ) && ( !isset( $options['pryc_wp_add_comment_form_info_section2_checkbox_field_1'] ) ) && ( empty( $options['pryc_wp_add_comment_form_info_section2_checkbox_field_1'] ) ) ) {
			$pryc_wp_comment_notes_after = stripslashes( $options['pryc_wp_add_comment_form_info_section2_textarea_field_1'] );
			$args['comment_notes_after'] = '<p>' . $pryc_wp_comment_notes_after . '</p>';
		}
					
	return $args;
	
	}	
		
	add_filter( 'comment_form_defaults', 'pryc_wp_comment_form_info_textarea' );
	
}

if ( !function_exists( 'pryc_wp_comment_form_info_submit_button' ) ) {

	function pryc_wp_comment_form_info_submit_button( $submit_button ) {
	
		$options = get_option( 'pryc_wp_add_comment_form_info_settings' );
	
		if ( ( isset( $options['pryc_wp_add_comment_form_info_section3_textarea_field_1'] ) ) && ( !empty( $options['pryc_wp_add_comment_form_info_section3_textarea_field_1'] ) ) && ( !isset( $options['pryc_wp_add_comment_form_info_section3_checkbox_field_1'] ) ) && ( empty( $options['pryc_wp_add_comment_form_info_section3_checkbox_field_1'] ) ) ) {
			$pryc_wp_comment_notes_before = stripslashes( $options['pryc_wp_add_comment_form_info_section3_textarea_field_1'] );
			$submit_button_before = $pryc_wp_comment_notes_before . '<br /><br />';				
		} else { $submit_button_before = ""; }
		

		if ( ( isset( $options['pryc_wp_add_comment_form_info_section4_textarea_field_1'] ) ) && ( !empty( $options['pryc_wp_add_comment_form_info_section4_textarea_field_1'] ) ) && ( !isset( $options['pryc_wp_add_comment_form_info_section4_checkbox_field_1'] ) ) && ( empty( $options['pryc_wp_add_comment_form_info_section4_checkbox_field_1'] ) ) ) {
			$pryc_wp_comment_notes_after = stripslashes( $options['pryc_wp_add_comment_form_info_section4_textarea_field_1'] );
			$submit_button_after = $pryc_wp_comment_notes_after;				
		} else { $submit_button_after = ""; }

					
	return $submit_button_before . $submit_button . $submit_button_after;
	
	}	
		
	add_filter( 'comment_form_submit_button', 'pryc_wp_comment_form_info_submit_button' );
	
}



		
/* ----- WP Admin ----- */

add_action( 'admin_menu', 'pryc_wp_add_comment_form_info_add_admin_menu' );
add_action( 'admin_init', 'pryc_wp_add_comment_form_info_settings_init' );

# Menu
function pryc_wp_add_comment_form_info_add_admin_menu() { 

	add_options_page( 'PRyC WP: Add content to comment form', 'PRyC WP: Add content to comment form', 'manage_options', 'pryc_wp_add_comment_form_info', 'pryc_wp_add_comment_form_info_options_page' );

}

# Prepare
function pryc_wp_add_comment_form_info_settings_init() { 

	register_setting( 'PRyC WP: Add content to comment form (pluginPage)', 'pryc_wp_add_comment_form_info_settings' );

	# Define section 1 + header h2 (info)
	add_settings_section(
		'pryc_wp_add_comment_form_info_section1', 
		__( 'Before comment text form:', 'pryc_wp_add_comment_form_info' ), 
		'pryc_wp_add_comment_form_info_settings_section_callback1', 
		'PRyC WP: Add content to comment form (pluginPage)'
	);

	# Define section 2 + header h2 (info)
	add_settings_section(
		'pryc_wp_add_comment_form_info_section2', 
		__( 'After comment text form:', 'pryc_wp_add_comment_form_info' ), 
		'pryc_wp_add_comment_form_info_settings_section_callback2', 
		'PRyC WP: Add content to comment form (pluginPage)'
	);

	
	# Define section 3 + header h2 (info)
	add_settings_section(
		'pryc_wp_add_comment_form_info_section3', 
		__( 'Before submit button:', 'pryc_wp_add_comment_form_info' ), 
		'pryc_wp_add_comment_form_info_settings_section_callback3', 
		'PRyC WP: Add content to comment form (pluginPage)'
	);	
	
	# Define section 4 + header h2 (info)
	add_settings_section(
		'pryc_wp_add_comment_form_info_section4', 
		__( 'After submit button:', 'pryc_wp_add_comment_form_info' ), 
		'pryc_wp_add_comment_form_info_settings_section_callback4', 
		'PRyC WP: Add content to comment form (pluginPage)'
	);
	
	
	# Define section 99 + header h2 (info)
	add_settings_section(
		'pryc_wp_add_comment_form_info_section99', 
		__( 'Other settings:', 'pryc_wp_add_comment_form_info' ), 
		'pryc_wp_add_comment_form_info_settings_section_callback99', 
		'PRyC WP: Add content to comment form (pluginPage)'
	);
	
	
	/* --- --- --- */
	
	# Disable content (txt1)
	add_settings_field( 
		'pryc_wp_add_comment_form_info_section1_checkbox_field_1', 
		__( 'Don\'t display content (before comment text form):', 'pryc_wp_add_comment_form_info' ), 
		'pryc_wp_add_comment_form_info_section1_checkbox_field_1_render', 
		'PRyC WP: Add content to comment form (pluginPage)', 
		'pryc_wp_add_comment_form_info_section1' 
	);
	
	# Define content field (txt1)
	add_settings_field( 
		'pryc_wp_add_comment_form_info_section1_textarea_field_1', 
		__( 'Content (before comment text form):', 'pryc_wp_add_comment_form_info' ), 
		'pryc_wp_add_comment_form_info_section1_textarea_field_1_render', 
		'PRyC WP: Add content to comment form (pluginPage)', 
		'pryc_wp_add_comment_form_info_section1' 
	);

	# Disable content (txt2)
	add_settings_field( 
		'pryc_wp_add_comment_form_info_section2_checkbox_field_1', 
		__( 'Don\'t display content (after comment text form):', 'pryc_wp_add_comment_form_info' ), 
		'pryc_wp_add_comment_form_info_section2_checkbox_field_1_render', 
		'PRyC WP: Add content to comment form (pluginPage)', 
		'pryc_wp_add_comment_form_info_section2' 
	);
	
	# Define content field (txt2)
	add_settings_field( 
		'pryc_wp_add_comment_form_info_section2_textarea_field_1', 
		__( 'Content (after comment text corm):', 'pryc_wp_add_comment_form_info' ), 
		'pryc_wp_add_comment_form_info_section2_textarea_field_1_render', 
		'PRyC WP: Add content to comment form (pluginPage)', 
		'pryc_wp_add_comment_form_info_section2' 
	);
	
	# Disable content (btn1)
	add_settings_field( 
		'pryc_wp_add_comment_form_info_section3_checkbox_field_1', 
		__( 'Don\'t display content (before submit button):', 'pryc_wp_add_comment_form_info' ), 
		'pryc_wp_add_comment_form_info_section3_checkbox_field_1_render', 
		'PRyC WP: Add content to comment form (pluginPage)', 
		'pryc_wp_add_comment_form_info_section3' 
	);
	
	# Define content field (btn1)
	add_settings_field( 
		'pryc_wp_add_comment_form_info_section3_textarea_field_1', 
		__( 'Content (before submit button):', 'pryc_wp_add_comment_form_info' ), 
		'pryc_wp_add_comment_form_info_section3_textarea_field_1_render', 
		'PRyC WP: Add content to comment form (pluginPage)', 
		'pryc_wp_add_comment_form_info_section3' 
	);
	
	# Disable content (btn2)
	add_settings_field( 
		'pryc_wp_add_comment_form_info_section4_checkbox_field_1', 
		__( 'Don\'t display content (after submit button):', 'pryc_wp_add_comment_form_info' ), 
		'pryc_wp_add_comment_form_info_section4_checkbox_field_1_render', 
		'PRyC WP: Add content to comment form (pluginPage)', 
		'pryc_wp_add_comment_form_info_section4' 
	);
	
	# Define content field (btn2)
	add_settings_field( 
		'pryc_wp_add_comment_form_info_section4_textarea_field_1', 
		__( 'Content (after submit button):', 'pryc_wp_add_comment_form_info' ), 
		'pryc_wp_add_comment_form_info_section4_textarea_field_1_render', 
		'PRyC WP: Add content to comment form (pluginPage)', 
		'pryc_wp_add_comment_form_info_section4' 
	);
	
	
	
	
	# Clear at uninstall
	add_settings_field( 
		'pryc_wp_add_comment_form_info_section99_checkbox_field_1', 
		__( 'Clear plugin data:', 'pryc_wp_add_comment_form_info' ), 
		'pryc_wp_add_comment_form_info_section99_checkbox_field_1_render', 
		'PRyC WP: Add content to comment form (pluginPage)', 
		'pryc_wp_add_comment_form_info_section99' 
	);

}	

# Make disable (top textarea)
function pryc_wp_add_comment_form_info_section1_checkbox_field_1_render() { 

	$options = get_option( 'pryc_wp_add_comment_form_info_settings' );
	?>
	<input type='checkbox' name='pryc_wp_add_comment_form_info_settings[pryc_wp_add_comment_form_info_section1_checkbox_field_1]' <?php if ( isset( $options['pryc_wp_add_comment_form_info_section1_checkbox_field_1'] ) ) { checked( $options['pryc_wp_add_comment_form_info_section1_checkbox_field_1'], 1 ); } ?> value='1'>
	
	<?php
	
	echo __( 'If chcecked - don\'t show content (before comment text form)', 'pryc_wp_add_comment_form_info' );

}	
	
# Make disable (bottom textarea)
function pryc_wp_add_comment_form_info_section2_checkbox_field_1_render() { 

	$options = get_option( 'pryc_wp_add_comment_form_info_settings' );
	?>
	<input type='checkbox' name='pryc_wp_add_comment_form_info_settings[pryc_wp_add_comment_form_info_section2_checkbox_field_1]' <?php if ( isset( $options['pryc_wp_add_comment_form_info_section2_checkbox_field_1'] ) ) { checked( $options['pryc_wp_add_comment_form_info_section2_checkbox_field_1'], 1 ); } ?> value='1'>
	
	<?php
	
	echo __( 'If chcecked - don\'t show content (after comment text form)', 'pryc_wp_add_comment_form_info' );

}	
	
# Make disable (top btn)
function pryc_wp_add_comment_form_info_section3_checkbox_field_1_render() { 

	$options = get_option( 'pryc_wp_add_comment_form_info_settings' );
	?>
	<input type='checkbox' name='pryc_wp_add_comment_form_info_settings[pryc_wp_add_comment_form_info_section3_checkbox_field_1]' <?php if ( isset( $options['pryc_wp_add_comment_form_info_section3_checkbox_field_1'] ) ) { checked( $options['pryc_wp_add_comment_form_info_section3_checkbox_field_1'], 1 ); } ?> value='1'>
	
	<?php
	
	echo __( 'If chcecked - don\'t show content (before submit button)', 'pryc_wp_add_comment_form_info' );

}	

# Make disable (bottom btn)
function pryc_wp_add_comment_form_info_section4_checkbox_field_1_render() { 

	$options = get_option( 'pryc_wp_add_comment_form_info_settings' );
	?>
	<input type='checkbox' name='pryc_wp_add_comment_form_info_settings[pryc_wp_add_comment_form_info_section4_checkbox_field_1]' <?php if ( isset( $options['pryc_wp_add_comment_form_info_section4_checkbox_field_1'] ) ) { checked( $options['pryc_wp_add_comment_form_info_section4_checkbox_field_1'], 1 ); } ?> value='1'>
	
	<?php
	
	echo __( 'If chcecked - don\'t show content (after submit button)', 'pryc_wp_add_comment_form_info' );

}	




# Make content field (top textarea)
function pryc_wp_add_comment_form_info_section1_textarea_field_1_render() { 

	$options = get_option( 'pryc_wp_add_comment_form_info_settings' );
	?>
	
	<textarea cols='' rows='21' style='width:100%' name='pryc_wp_add_comment_form_info_settings[pryc_wp_add_comment_form_info_section1_textarea_field_1]'><?php if ( isset( $options['pryc_wp_add_comment_form_info_section1_textarea_field_1'] ) && !empty( $options['pryc_wp_add_comment_form_info_section1_textarea_field_1'] )) { echo $options['pryc_wp_add_comment_form_info_section1_textarea_field_1']; } else { echo ""; } ?></textarea>
	
	<?php
	//echo '<br /><br />';
	echo __( 'You may use text or HTML', 'pryc_wp_add_comment_form_info' );
}


# Make content field (bottom textarea)
function pryc_wp_add_comment_form_info_section2_textarea_field_1_render() { 

	$options = get_option( 'pryc_wp_add_comment_form_info_settings' );
	?>
	
	<textarea cols='' rows='21' style='width:100%' name='pryc_wp_add_comment_form_info_settings[pryc_wp_add_comment_form_info_section2_textarea_field_1]'><?php if ( isset( $options['pryc_wp_add_comment_form_info_section2_textarea_field_1'] ) && !empty( $options['pryc_wp_add_comment_form_info_section2_textarea_field_1'] )) { echo $options['pryc_wp_add_comment_form_info_section2_textarea_field_1']; } else { echo ""; } ?></textarea>
	
	<?php
	//echo '<br /><br />';
	echo __( 'You may use text or HTML', 'pryc_wp_add_comment_form_info' );
}

# Make content field (top btn)
function pryc_wp_add_comment_form_info_section3_textarea_field_1_render() { 

	$options = get_option( 'pryc_wp_add_comment_form_info_settings' );
	?>
	
	<textarea cols='' rows='21' style='width:100%' name='pryc_wp_add_comment_form_info_settings[pryc_wp_add_comment_form_info_section3_textarea_field_1]'><?php if ( isset( $options['pryc_wp_add_comment_form_info_section3_textarea_field_1'] ) && !empty( $options['pryc_wp_add_comment_form_info_section3_textarea_field_1'] )) { echo $options['pryc_wp_add_comment_form_info_section3_textarea_field_1']; } else { echo ""; } ?></textarea>
	
	<?php
	//echo '<br /><br />';
	echo __( 'You may use text or HTML', 'pryc_wp_add_comment_form_info' );
}

# Make content field (bottom btn)
function pryc_wp_add_comment_form_info_section4_textarea_field_1_render() { 

	$options = get_option( 'pryc_wp_add_comment_form_info_settings' );
	?>
	
	<textarea cols='' rows='21' style='width:100%' name='pryc_wp_add_comment_form_info_settings[pryc_wp_add_comment_form_info_section4_textarea_field_1]'><?php if ( isset( $options['pryc_wp_add_comment_form_info_section4_textarea_field_1'] ) && !empty( $options['pryc_wp_add_comment_form_info_section4_textarea_field_1'] )) { echo $options['pryc_wp_add_comment_form_info_section4_textarea_field_1']; } else { echo ""; } ?></textarea>
	
	<?php
	//echo '<br /><br />';
	echo __( 'You may use text or HTML', 'pryc_wp_add_comment_form_info' );
}




# Make clear data checkbox
function pryc_wp_add_comment_form_info_section99_checkbox_field_1_render() { 

	$options = get_option( 'pryc_wp_add_comment_form_info_settings' );
	?>
	<input type='checkbox' name='pryc_wp_add_comment_form_info_settings[pryc_wp_add_comment_form_info_section99_checkbox_field_1]' <?php if ( isset( $options['pryc_wp_add_comment_form_info_section99_checkbox_field_1'] ) ) { checked( $options['pryc_wp_add_comment_form_info_section99_checkbox_field_1'], 1 ); } ?> value='1'>
	
	<?php
	
	echo __( 'Remove all plugin data when uninstall this plugin', 'pryc_wp_add_comment_form_info' );

}

# Section 1 text/description
function pryc_wp_add_comment_form_info_settings_section_callback1() { 
	echo __( 'Visible only for unlogged users', 'pryc_wp_add_comment_form_info' );
}

# Section 2 text/description
function pryc_wp_add_comment_form_info_settings_section_callback2() { 
	echo __( 'Visible for all users', 'pryc_wp_add_comment_form_info' );
}

# Section 3 text/description
function pryc_wp_add_comment_form_info_settings_section_callback3() { 
	echo __( 'Visible for all users', 'pryc_wp_add_comment_form_info' );
}

# Section 4 text/description
function pryc_wp_add_comment_form_info_settings_section_callback4() { 
	echo __( 'Visible for all users', 'pryc_wp_add_comment_form_info' );
}


# Section 99 text/description
function pryc_wp_add_comment_form_info_settings_section_callback99() { 
	echo __( 'Other plugin settings', 'pryc_wp_add_comment_form_info' );
}


# Save
function pryc_wp_add_comment_form_info_options_page() { 

	?>
	<form action='options.php' method='post'>
		
		<h2>PRyC WP: Add content to comment form</h2>
		
		<?php
				
		settings_fields( 'PRyC WP: Add content to comment form (pluginPage)' );
		do_settings_sections( 'PRyC WP: Add content to comment form (pluginPage)' );
		submit_button();
		?>
		
	</form>
	<?php
	
	echo __( 'Remember clear CACHE after change settings/content!', 'pryc_wp_add_comment_form_info' );
	
	echo '<br /><br />';
	
	echo '<a href="https://cdn.pryc.eu/add/link/?link=paypal-wp-plugin-pryc-wp-add-comment-form-info" target="_blank">' . __( 'Like my plugin? Give for a tidbit for my dogs :-)', 'pryc_wp_add_comment_form_info' ) . '</a>';	
	
}

# Uninstall plugin

register_uninstall_hook( __FILE__, 'pryc_wp_add_comment_form_info_uninstall' );
#register_deactivation_hook( __FILE__, 'pryc_wp_add_comment_form_info_uninstall' );

function pryc_wp_add_comment_form_info_uninstall() {

	$options = get_option( 'pryc_wp_add_comment_form_info_settings' );

	if ( ( isset( $options['pryc_wp_add_comment_form_info_section99_checkbox_field_1'] ) ) && ( !empty( $options['pryc_wp_add_comment_form_info_section99_checkbox_field_1'] ) ) ) {
		
		# Clear at uninstall
		$option_to_delete = 'pryc_wp_add_comment_form_info_settings';
		delete_option( $option_to_delete );
	}
	
}

