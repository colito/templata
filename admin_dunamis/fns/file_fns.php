<?php

    class FileFns
    {
        public function list_directories($file)
        {
            # get a directory listing
            $dir = array_diff (scandir (realpath($file)),
                #folders / files to ignore
                array ('.', '..', '.DS_Store', 'Thumbs.db', 'admin', '.idea')
            );

            #sort folders first, then by type, then alphabetically
            usort ($dir, create_function ('$a,$b', '
                            return	is_dir ($a)
                                ? (is_dir ($b) ? strnatcasecmp ($a, $b) : -1)
                                : (is_dir ($b) ? 1 : (
                                    strcasecmp (pathinfo ($a, PATHINFO_EXTENSION), pathinfo ($b, PATHINFO_EXTENSION)) == 0
                                    ? strnatcasecmp ($a, $b)
                                    : strcasecmp (pathinfo ($a, PATHINFO_EXTENSION), pathinfo ($b, PATHINFO_EXTENSION))
                                ))
                            ;
                        '));
            return $dir;
        }
    }

?>