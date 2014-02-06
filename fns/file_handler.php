<?php
class FileHandler
{
    # takes a snapshot of /template/template.php and creates a new file from it.
    public function get_template_content()
    {
        $template_path = '../template/template.php';

        $file_contents = fopen($template_path, "r");

        while(!feof($file_contents))
        {
            $data = fread($file_contents, 500000);
        }
        fclose($file_contents);

        return $data;
    }

    # takes a hold of the contents within the contend directory.
    # better to use require_once() instead.
    public function get_content($file_name)
    {
        $content_path = '../content/'.$file_name;

        $file_contents = fopen($content_path, "r");

        while(!feof($file_contents))
        {
            $data = fread($file_contents, 500000);
        }
        fclose($file_contents);

        return $data;
    }

    # creates a new file as specified by the user and places it within the content directory
    # only works on linux
    public function create_new_page($new_file)
    {
        # file path and file name
        $new_file_name = basename($new_file);
        $dir = '../content/';
        $dir .= dirname($new_file);

        # create the specified file
        shell_exec('mkdir -p '.$dir);
        shell_exec('touch '.$dir.'/'.$new_file_name);

        $path_with_query= $dir;
        $path=explode('/',$path_with_query);
        //$filename=basename($path[0]);
        $query=$path;
        $change_file_perm = $path[0].'/'.$path[1].'/'.$path[2];

//        var_dump($query);
//        var_dump($change_file_perm);

        # change the files permissions
        //$x = chmod($dir.'/'.$new_file_name, 0777);
        $x = chmod($change_file_perm, 0777);
        //var_dump($x);
    }

    public function chmod_R($path, $filemode, $dirmode) {
        if (is_dir($path) ) {
            if (!chmod($path, $dirmode)) {
                $dirmode_str=decoct($dirmode);
                print "Failed applying filemode '$dirmode_str' on directory '$path'\n";
                print "  `-> the directory '$path' will be skipped from recursive chmod\n";
                return;
            }
            $dh = opendir($path);
            while (($file = readdir($dh)) !== false) {
                if($file != '.' && $file != '..') {  // skip self and parent pointing directories
                    $fullpath = $path.'/'.$file;
                    chmod_R($fullpath, $filemode,$dirmode);
                }
            }
            closedir($dh);
        } else {
            if (is_link($path)) {
                print "link '$path' is skipped\n";
                return;
            }
            if (!chmod($path, $filemode)) {
                $filemode_str=decoct($filemode);
                print "Failed applying filemode '$filemode_str' on file '$path'\n";
                return;
            }
        }
    }

    public function fwrite_stream($fp, $string) {

        for ($written = 0; $written < strlen($string); $written += $fwrite) {
            $fwrite = fwrite($fp, substr($string, $written));
            if ($fwrite === false) {
                return $written;
            }
        }
        return $written;
    }
}

$file_handler = new FileHandler();

?>