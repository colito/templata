<?php
    $page_name = 'Open File';
    require_once('includes/header.php');


    if(!empty($_GET['file_open']))
    {
        $file_open_response = $_GET['file_open'];

        switch($file_open_response)
        {
            case 'not_found':
                $file_open_status = '<i class="error">File not found</i>';
                break;

            case 'invalid_file':
                $file_open_status = '<i class="error">Invalid file (file has no extention)</i>';
                break;

            case 'unreadable':
                $file_open_status = '<i class="error">Unable to read file</i>';
                break;
        }
    }
    else
    {
        $file_open_status = 'Specify the path of the file you want from root';
    }


    if(!empty($_GET['file_create']))
    {
        $file_create_response = $_GET['file_create'];

        switch($file_create_response)
        {
            case 'true':
                $creation_status = '<i class="success">File successfully created</i>';
                break;

            case 'false':
                $creation_status = '<i class="error">File could not be created</i>';
                break;

            case 'exists':
                $creation_status = '<i class="error">File already exists</i>';
        }
    }
    else
    {
        $creation_status = 'Specify the path of the file you want to create from root';
    }

?>

            <div class="grid_4">
                <h3>File path</h3>
            </div>

            <div class="grid_8">
                <p><? echo $file_open_status; ?></p>
                <form method="post" action="validator.php">
                    <input type="hidden" name="file_job" value="open">
                    <input type="text" name="file_path" width="80" placeholder="File path">
<!--                    <br><br>-->
                    <input class="open_btn" type="submit" value="Open file">
                    <input class="open_btn" type="button" value="Browse" onclick="view_file_explorer()">
                </form>
            </div>

            <div class="grid_8">
                <p><?php echo $creation_status; ?></p>
                <form method="post" action="validator.php">
                    <input type="hidden" name="file_job" value="create">
                    <input type="text" name="new_file" width="80" placeholder="File path">
<!--                    <br><br>-->
                    <input class="open_btn" type="submit" value="Create file">
                </form>
            </div>

<?php require_once('includes/footer.php')?>