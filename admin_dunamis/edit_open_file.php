<?php
$page_name = 'Edit Open File';
require_once('includes/header.php');

$actual_file = $_GET['file_path'];
$file_path = '../'.$actual_file;

if(is_readable($file_path))
{
    $file_contents = fopen($file_path, "r");

    while(!feof($file_contents))
    {
        $data = fread($file_contents, 500000);
    }
    fclose($file_contents);
}
else
{
    //header('location : change_file_mode.php?file_path='.$file_path);
    header('Location: open_file.php?file_open=unreadable');
    echo 'File is unreadable. Check the file permissions.';
}

if(is_writable($file_path))
{
    $writable = '<i class="success">true</i>';
}
else
{
    $writable = '<i class="error">false</i>';
}

# Get file extension
$file_info = pathinfo($file_path);
$file_extension = $file_info['extension'];

?>


<div class="grid_12" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
    <h3>Edit Open File</h3>
</div>

<div class="grid_4 omega">
    <form method="post" action="change_file_mode.php">
        <input type="hidden" name="file_path" value="<?php echo $file_path; ?>" />
        <!-- <input type="submit" value="Adjust file permissions"> -->
    </form>
</div>

<div id="edit_file" class="grid_12">
    <form method="post" action="write_to_file.php">
        <p class="upper">Selected file: <i class="lower"><?php echo $actual_file; ?></i></p>
        <p class="upper">
            Writable: <?php echo $writable; ?> &nbsp;&nbsp;&nbsp;&nbsp;
            File type: <i class="lower"><?php echo $file_extension; ?></i>
            <input class="form-btn" type="submit" value="Save" <?php if(strpos($writable, 'false') == true) echo 'disabled'?>>
            <input class="form-btn" type="button" value="Close" onclick="view_file_explorer()">
        </p>

        <input type="hidden" name="file_path" value="<?php echo $file_path; ?>" />
        <textarea rows="23" name="file_content" id="file_content"><?php echo $data; ?></textarea>
    </form>
</div>

<?php require_once('includes/footer.php')?>