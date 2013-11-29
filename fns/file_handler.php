<?php
class FileHandler
{
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

    public function create_new_page($new_file)
    {
        $new_file_name = basename($new_file);
        $dir = '../content/';
        $dir .= dirname($new_file);

        shell_exec('mkdir -p '.$dir);
        shell_exec('touch '.$dir.'/'.$new_file_name);
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