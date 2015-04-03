<?php
/*
Plugin Name: Advanced Custom Fields: Website Field
Plugin URI: https://github.com/Jeradin/acf-website-field
Description: Website Title field for Advanced Custom Fields
Version: 2.1
Author: Geet Jacobs
Author URI: http://anagr.am
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
GitHub Plugin URI: https://github.com/Jeradin/acf-website-field
GitHub Branch:     master
*/




class acf_website_field_plugin
{
	/*
	*  Construct
	*
	*  @description:
	*  @since: 3.6
	*  @created: 1/04/13
	*/

	function __construct()
	{

		// version 4
		add_action('acf/register_fields', array($this, 'register_field_website_v4'));

		// version 5
		add_action('acf/include_field_types', array($this, 'register_field_website_v5'));

		add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_styles' ) );

		add_action( 'admin_enqueue_scripts', array( $this, 'website_val_enqueue_styles_scripts' ) );


	}


	/*
	*  register_fields
	*
	*  @description:
	*  @since: 3.6
	*  @created: 1/04/13
	*/

	function register_field_website_v4()
	{
		include_once('website_url_v4.php');
	}

	function register_field_website_v5()
	{
		include_once('website_url_v5.php');
	}




	function website_val_enqueue_styles_scripts() {
	    //wp_enqueue_script( 'acf-custom-validation', plugins_url( 'acf-website-field.js', __FILE__ ) );
	}

	/**
 	 * Registers and enqueues admin-specific styles.
 	 */
 	public function register_admin_styles() {
 		wp_enqueue_style( 'acf-website-field', plugins_url( 'acf-website-field.css', __FILE__  ) );
 	} // end register_admin_styles


}

new acf_website_field_plugin();

?>
