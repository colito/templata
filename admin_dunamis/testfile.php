<?php

create_function ('$a,$b', '
                            return	is_dir ($a) ? (is_dir ($b) ? strnatcasecmp ($a, $b) : -1)
                                : (is_dir ($b) ? 1 : (
                                    strcasecmp (pathinfo ($a, PATHINFO_EXTENSION), pathinfo ($b, PATHINFO_EXTENSION)) == 0
                                    ? strnatcasecmp ($a, $b)
                                    : strcasecmp (pathinfo ($a, PATHINFO_EXTENSION), pathinfo ($b, PATHINFO_EXTENSION))
                                ))
                            ;
                        ')

?>