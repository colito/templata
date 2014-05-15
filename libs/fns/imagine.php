<?php
# Image manipulation library
class Imagine
{
    public function verify_destination($destination)
    {
        # returns false if the directory the user specified doesn't exist
        if(!file_exists($destination))
        {
            return false;
        }
        elseif(!is_dir($destination))
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public function image_list($image_directory)
    {
        # returns false if the directory the user specified doesn't exist
        if(!$this->verify_destination($image_directory)) { return false; }

        $imagelist = array();
        foreach(glob($image_directory.'*.*') as $filename)
        {
            $imagelist[] = $filename;
        }

        return $imagelist;
    }

    public function display_gallery($gallary, $dimension = 180)
    {
        $image_gallery = T_IMAGES.$gallary.'/';
        $imagelist = $this->image_list($image_gallery);

        # returns false if the directory the user specified doesn't exist
       if(!$imagelist) { return false; }

        foreach(glob($image_gallery.'*.*') as $filename)
        {
            echo '<img src="'.$filename.'" width="'.$dimension.'"> &nbsp;';
        }
    }
}