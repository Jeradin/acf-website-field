=== Advanced Custom Fields - Website field add-on ===
Contributors: Jeradin
Tags: acf, acf add-on, website url, website title
Requires at least: 3.0
Tested up to: 3.3.1
Stable tag: 0.7

Adds a Website Field to Advanced Custom Fields. Select if link should be an external link, if it should show title or the url.

== Description ==

This is an add-on for the [Advanced Custom Fields](http://wordpress.org/extend/plugins/advanced-custom-fields/)
WordPress plugin and will not provide any functionality to WordPress unless Advanced Custom Fields is installed
and activated.

The Website field gives a few basic options:
-Show / Hide Title (if checked to No, than the website URL will show on the front end and the title field will not be shown in the admin)
-Open in New Window - default will make all URLs open a new browser window for external sites. ( if checked to No, than the admin section will have a checkbox to specify if the link should open in  anew window or not.)

= Source Repository on GitHub =
https://github.com/Jeradin/ACF-URL-Field

= Bugs, Questions or Suggestions =
https://github.com/Jeradin/ACF-URL-Field/issues

= Todo =
* Cleanup code
* alter code form feedback
*improve front end look

== Installation ==

The Website Field plugin needs to be added to your themes.


* Added to Theme
	1. Download and extract it to your theme, rename the field from githubs default to "acf-website-field".
	2. Include the `website_url.php` file in you theme's `functions.php` or plugin file.  
	   `include_once( rtrim( dirname( __FILE__ ), '/' ) . '/acf-website-field/website_url.php' );`

== Frequently Asked Questions ==

= I've activated the plugin, but nothing happens! =

Make sure you have [Advanced Custom Fields](http://wordpress.org/extend/plugins/advanced-custom-fields/) installed and
activated. This is not a standalone plugin for WordPress, it only adds additional functionality to Advanced Custom Fields.

== Screenshots ==

1. Website Field.
2. Front End View.

== Changelog ==

= 0.7 =
* Initial Release