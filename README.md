Developer Notes

2014-01-31 16:00:00 :
* Implemented automated relative pathing for navigation links.
* This currently works best with one level deep directories
* Will need to restructure the program a bit in order to make this work for multi level deep directories
* Thus far as it stands, the key to achieving this is to require the config file within new pages and remove it from files that will be required right after in order to avoid getting error 500