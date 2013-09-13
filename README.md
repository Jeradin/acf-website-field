=== Advanced Custom Fields - Website field add-on ===

Contributors: Jeradin, jmslbam  
Tags: acf, acf add-on, website url, website title  
Requires at least: 4.0   
Tested up to: 3.3.1  
Stable tag: 4.3

License: GPLv2 or later 

License URI: http://www.gnu.org/licenses/gpl-2.0.html 


== Description ==
Adds a Website Field to Advanced Custom Fields. Select if link should be an external link, if it should show title or the url.

This is an add-on for the [Advanced Custom Fields](http://wordpress.org/extend/plugins/advanced-custom-fields/)
WordPress plugin and will not provide any functionality to WordPress unless Advanced Custom Fields is installed
and activated.

The Website field gives a few basic options:
-Show / Hide Title (if checked to No, than the website URL will show on the front end and the title field will not be shown in the admin)
-Open in Current Window - default will make all URLs open a new browser window for external sites. ( if checked to Yes, than the admin section will have a checkbox to specify if the link should open the current window.)
-Return array instead of Link - default will return a formatted URL with option to return as an array.

= Source Repository on GitHub =
https://github.com/Jeradin/acf-website-field

= Bugs, Questions or Suggestions =
https://github.com/Jeradin/acf-website-field/issues


== Installation ==

The Website Field plugin needs to be added to your themes.

	1. Download the zip file and upload as any Wordpress plugin.
	
== Frequently Asked Questions ==

= I've activated the plugin, but nothing happens! =

Make sure you have [Advanced Custom Fields](http://wordpress.org/extend/plugins/advanced-custom-fields/) installed and
activated. This is not a standalone plugin for WordPress, it only adds additional functionality to Advanced Custom Fields.

== Screenshots ==

1. Website Field.
2. Front End View.


## Future Features ##

Add admin validation of URL.


## Changelog ##
### 1.5.9.5 ###
* Fixed issue with target link and some wording updates

### 1.5.9 ###
* Fixed issue when field was required

### 1.5.8 ###
* Replaced with better auto updater code

### 1.5.6 ###
* Bug fixes

### 1.5.5 ###
* Bug fixes

### 1.5.1 ###
* Fixing blank website fields.

### 1.5 ###
* Can now return array instead of formatted link.

### 1.4 ###
* Auto Update from github!

### 1.2 ###
* Merged fixes from jmslbam
* -slight cleanup

### 1.1
* Fixed bugs
* -trailing urls
* -not howing up in the admin
* -other cleanup

### 1.0
* Made it an uploadable plugin

### 0.8
* Updated code for ACF 4.0

### 0.7
* Initial Release
