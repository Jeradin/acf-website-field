Advanced Custom Fields - Website field add-on
===

**Contributors:** Jeradin, jmslbam, patrickhafner  
**Tags:** acf, acf add-on, website url, website title  
**Requires at least:** 4.0  
**Tested up to:** 4.0  
**Stable tag:** 4.3  

License: [GPLv2](http://www.gnu.org/licenses/gpl-2.0.html) or later

Description
---

Adds a Website Field to Advanced Custom Fields. Select if link should be an external link, if it should show title or the url.

This works with ACF 4 and ACF5 / ACF5Pro.

This is an add-on for the [Advanced Custom Fields](http://wordpress.org/extend/plugins/advanced-custom-fields/)
WordPress plugin and will not provide any functionality to WordPress unless Advanced Custom Fields is installed
and activated.

The Website field gives a few basic options:

* Show / Hide Title (if checked to No, than the website URL will show on the front end and the title field will not be shown in the admin)
* Open in Current Window - default will make all URLs open a new browser window for external sites. ( if checked to Yes, than the admin section will have a checkbox to specify if the link should open the current window.)
* Return array instead of Link - default will return a formatted URL with option to return as an array.

Source Repository on GitHub
---
[https://github.com/Jeradin/acf-website-field](https://github.com/Jeradin/acf-website-field)

Bugs, Questions or Suggestions
---
(https://github.com/Jeradin/acf-website-field/issues)[https://github.com/Jeradin/acf-website-field/issues]


Installation
===

The Website Field plugin needs to be added to your themes. Download the zip file and upload as any Wordpress plugin.

How to Use
===
```php
<?php the_field('website')?>
```
will output:
```html
<a href="http://www.example.com" target="_blank">http://www.example.com</a>
```

or this (if you select title option):
```html
<a href="http://www.example.com" target="_blank">Catalog</a>
```

or this (if you select current window option):
```html
<a href="http://www.example.com">Example</a>
```

If you have the field return an array:
```php
get_field('website')
array(3) { 
	["title"]=> "Example" 
	["url"]=> "http://example.com" 
	["external"]=> "1" 
} 
```

Frequently Asked Questions
===

**Q**: I've activated the plugin, but nothing happens!  
**A**: Make sure you have [Advanced Custom Fields](http://wordpress.org/extend/plugins/advanced-custom-fields/) installed and
activated. This is not a standalone plugin for WordPress, it only adds additional functionality to Advanced Custom Fields.

Screenshots
===

1. Website Field.
2. Front End View.

Changelog
===
2.1
---
* Fixed settings for 5.1
2.0
---
* Removed Auto github updater bundle, best to install their plugin : https://github.com/afragen/github-updater
* Moved validation to the admin section, added HTML5 validation along with basic URL validation.
* Added placeholder text thanks @chellman
* Now works with ACF4 & ACF5 thanks @patrickhafner
* Fixed display of field in seamless mode

1.5.9.5
---
* Fixed issue with target link and some wording updates

1.5.9
---
* Fixed issue when field was required

1.5.8
---
* Replaced with better auto updater code

1.5.6
---
* Bug fixes

1.5.5
---
* Bug fixes

1.5.1
---
* Fixing blank website fields.

1.5
---
* Can now return array instead of formatted link.

1.4
---
* Auto Update from github!

1.2
---
* Merged fixes from jmslbam
* -slight cleanup

1.1
---
* Fixed bugs
* -trailing urls
* -not howing up in the admin
* -other cleanup

1.0
---
* Made it an uploadable plugin

0.8
---
* Updated code for ACF 4.0

0.7
---
* Initial Release
