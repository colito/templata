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
