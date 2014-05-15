<?php
# Image manipulation library
class Imagine
{
    public $image_directory = T_IMAGES;

    # Checks if the gallery (directory) suggested exists
    public function verify_destination($destination)
    {
        # returns false if the directory the user specified doesn't exist
        if(!file_exists($destination))
            return false;
        elseif(!is_dir($destination))
            return false;
        else
            return true;
    }

    # Verifies is the file is indeed an image
    public function valid_image($image_location, $return_info = 0)
    {
       $result = getimagesize($image_location);

        if(!$result)
            return false;

        if($return_info == 1) # Returns getimagesize() output if the user is interested in it.
            return $result;
        else
            return true;
    }

    # Retrieves a list of images
    public function image_list($image_directory)
    {
        # returns false if the directory the user specified doesn't exist
        if(!$this->verify_destination($image_directory))
            return false;

        $imagelist = array();

        foreach(glob($image_directory.'*.*') as $filename)
            $imagelist[] = $filename;

        return $imagelist;
    }

    # Outputs images from a specified gallery
    public function display_gallery($gallary, $dimension = 180)
    {
        $image_gallery = $this->image_directory.$gallary.'/';
        $imagelist = $this->image_list($image_gallery);

        # returns false if the directory the user specified doesn't exist
       if(!$imagelist)
           return false;

       foreach($imagelist as $filename)
            # Makes sure that the image is a valid one before it gets displayed
           if($this->valid_image($filename))
                echo '<img src="'.$filename.'" width="'.$dimension.'"> &nbsp;';
    }
}