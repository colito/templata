<?php

//var_dump($_SERVER);

//foreach($_SERVER as $server_detail)
//{
//    echo '
//    <pre>'.$server_detail.'</pre>
//';
//}

echo '<br>';
echo 'HTTP HOST: '. $_SERVER['HTTP_HOST'] ."<br>";
echo 'SERVER NAME: '. $_SERVER['SERVER_NAME'] ."<br>";
echo 'SERVER ADDRESS: '. $_SERVER['SERVER_ADDR'];

?>