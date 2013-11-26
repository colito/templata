<?php
class FileHandler
{
    public function get_external_file_content()
    {
        $template_path = 'template/index.php';

        $file_contents = fopen($template_path, "r");

        while(!feof($file_contents))
        {
            $data = fread($file_contents, 500000);
        }
        fclose($file_contents);

        return $data;
    }
}
?>