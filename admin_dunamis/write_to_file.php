<?php

session_start();
if(empty($_SESSION['admin_active']))
{
    header('Location: index.php');
}

$file_path = $_POST['file_path'];
$file_content = $_POST['file_content'];
$file_content = stripslashes($file_content);

echo "File Path : " . $file_path . "<br>";

if(!file_exists($file_path))
{
    die('File does not exist!');
}

if(is_writable($file_path))
{
    $fp = fopen($file_path, 'w');

    if(fwrite($fp, $file_content))
    {
        fclose($fp);
        echo "Data written to file <br>";
    }
}
else
{
    echo 'File not writable. Changes not saved. <br>';
}

?>

<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Back</a>