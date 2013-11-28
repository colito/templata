<?php
$page_name = 'Shell Command';
require_once('../includes/header.php');
?>

    <h3>Shell Command</h3>

<?php

# make path dynamic. It should be synonymous to the one the thinks they're in
//echo 'Current path: ' . shell_exec('cd ..; pwd') . ' <i>(path is yet to be made dynamic)</i><br>';

if(!empty($_POST['command']))
{
    $starting_point = $config->file_root();

    $command = $_POST['command'];

    $output = shell_exec('cd '.$starting_point.';'.$command);

    $current_path = 'Current path: ' . shell_exec('cd ..; pwd');

    //var_dump($output);
}

?>

    <!--<div id="shell_form" class="grid_6">-->
    <!--    <form method="post" action="shell_command.php">-->
    <!--        <p>Type in the command you would like executed.</p>-->
    <!--        <input type="text" name="command">-->
    <!--        <input class="open_btn" type="submit" value="Execute">-->
    <!--    </form>-->
    <!--</div>-->

    <div id="shell_results" class="grid_6 omega">
        <?php
        echo $starting_point.'<br>';

        echo '<h5>Results:</h5>';
        echo '<pre>'.$output.'</pre>';
        ?>
    </div>

    <div id="shell_form" class="grid_6">
        <form method="post" action="shell_command.php">
            <p>Type in the command you would like executed:</p>
            <input type="text" name="command">
            <input class="open_btn" type="submit" value="Execute">
        </form>
    </div>

<?php require_once('../includes/footer.php')?>