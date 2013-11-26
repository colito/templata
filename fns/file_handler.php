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
}

$file_handler = new FileHandler();

?>