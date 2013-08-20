<?php
/*
Plugin Name: Advanced Custom Fields: Website Field
Plugin URI: https://github.com/Jeradin/acf-website-field
Description: Website Title field for Advanced Custom Fields
Version: 1.5.6
Author: Geet Jacobs
Author URI: http://anagr.am
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

/*
include_once('updater.php');


if (is_admin()) { // note the use of is_admin() to double check that this is happening in the admin
    $config = array(
        'slug' => plugin_basename(__FILE__), // this is the slug of your plugin
        'proper_folder_name' => 'acf-website-field', // this is the name of the folder your plugin lives in
        'api_url' => 'https://github.com/Jeradin/acf-website-field', // the github API url of your github repo
        'raw_url' => 'https://raw.github.com/Jeradin/acf-website-field/master', // the github raw url of your github repo
        'github_url' => 'https://github.com/Jeradin/acf-website-field', // the github url of your github repo
        'zip_url' => 'https://github.com/Jeradin/acf-website-field/zipball/master', // the zip url of the github repo
        'sslverify' => true, // wether WP should check the validity of the SSL cert when getting an update, see https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/2 and https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/4 for details
        'requires' => '3.0', // which version of WordPress does your plugin require?
        'tested' => '3.3', // which version of WordPress is your plugin tested up to?
        'readme' => 'README.md', // which file to use as the readme for the version number
        'access_token' => '', // Access private repositories by authorizing under Appearance > Github Updates when this example plugin is installed
    );
    new WP_GitHub_Updater($config);
}
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
