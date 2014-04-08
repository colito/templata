Developer Notes

2014-01-31:

16:00 :
* Implemented automated relative pathing for navigation links.
* This currently works best with one level deep directories
* Will need to restructure the program a bit in order to make this work for multi level deep directories
* Thus far as it stands, the key to achieving this is to require the config file within new pages and remove it from files that will be required right after in order to avoid getting error 500

17:05 :
* Implemented restructuring and thus far seems to have been a success.
* Still under careful observation.


2014-02-04:

10:35
* Fixed link to home page when clicking on the site name

2014-02-06:

12:15
* Added .htaccess for re-writing urls to make them cleaner (tested, yet to be fully implemented)
* Added robots.txt to restrict bot crawling on certain directories and files
* Definitions have been moved away from the root config file and now reside in includes/definitions.php
* Moved function for ataining a relative link path from the file handler class to the page handler class
* Page handler class now contains a function to create slugs
* Added a favicon for the site

17:07
* Attempted to dynamisize url re-writing (still needs a lot of work)

2014-02-11

16:39
* Restructured app to be based off a template file with all the necessary styling
* Restructural change has only been implemented and tested in home/test/index.php
* Navigation menu's are currently not displaying correctly
* App is still pending the ability to display any given content
* App needs to be able to validate if the given template name in the config is accurate
* Need to standardize placeholders within the index.php file of the template
* Need to create a 'libs' directory where CSS, JS, and PHP classes will reside

2014-02-13

16:20
* Rendering a page based on a template has been resolved
* Code requires clean up
* All testing has been conducted oh home/test/index.php

16:26
* Restored navigation menu toggle for smartphone screen resolutions

2014-02-14

14:55
* home/test/index.php displays content of a specified file when outputting the template

2014-02-17:

14:17
== OBJECTIVES ==
* Read folder contents
* Read jQuery file name from specified directory
* Create a new template to test for establishing a site
* Read and retreive content from a designated folder
* Set a home page specied within the config file


2014-02-19:

10:47
== OBJECTIVES ==
* Read jQuery file name from specified directory (ACHIEVED)
* Create a new template to test for establishing a site
* Read and retreive content from a designated folder
* Set a home page specied within the config file


* Created a special function which gets the jquery file path
* Minor code clean-up

2014-02-26:

12:17
* Created a new template to test establishing a site from scratch
* Site retreives content specified within GET parameters
* Home page can specified within the config file
* Page name can now be specified on the a page using the following notation: [page:Page Name]
* Removed unused files
* Cleaned up the code a bit

== FUTURE OBJECTIVES ==
* Implement use of clean URL's
* Explore ways of injecting some PHP code in the form of modules

2014-02-27

10:49
* Fixed pathing to email validation js located in the theone template js directory
* Added contact form validation script under tools/validation
* All navigation links are now retrieved from includes/nav_links.php

== FUTURE OBJECTIVES ==
* Standardize and dynamisize placeholders especially placeholders that represent specific files

13:39
* Now has allowance to output php generated content

14:39
* Active template can now be overridden within a content source file
* get_content function now verifies if a file exists and only caters for .html and .php files

2014-04-08

16:52
* Implemented clean URLs (now working)
* Base url for sustaining relative paths when rewriting URLs is adjustable from the config file
* Added base_url placeholder to template index file
* Created Operator abstract class which comprises of the more fundamental function
* PageHandler class now only handles page processing
* Templates are now to contain their own navigation_links file
* Templates are now also to have all their own CSS files that they will require