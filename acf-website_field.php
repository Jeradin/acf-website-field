<?php
/*
Plugin Name: Advanced Custom Fields: website_field
Plugin URI: https://github.com/Jeradin/ACF-URL-Field
Description: Website Title field for Advanced Custom Fields
Version: 1.2
Author: Geet Jacobs
Author URI: http://anagr.am
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
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

		// version 4+
		add_action('acf/register_fields', array($this, 'register_fields'));


	}


	/*
	*  register_fields
	*
	*  @description:
	*  @since: 3.6
	*  @created: 1/04/13
	*/

	function register_fields()
	{
		include_once('website_url.php');
	}


}

new acf_website_field_plugin();

?>
