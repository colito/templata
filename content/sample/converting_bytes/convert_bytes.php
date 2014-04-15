[page:Convert Bytes]
<?php
/**
 * Created by JetBrains PhpStorm.
 * User: pride
 * Date: 2014/02/12
 * Time: 2:38 PM
 * To change this template use File | Settings | File Templates.
 */


function HumanSize($Bytes)
{
    $Type=array("", "kilo", "mega", "giga", "tera", "peta", "exa", "zetta", "yotta");
    $Index=0;
    while($Bytes>=1024)
    {
        $Bytes/=1024;
        $Index++;
    }

    $Bytes = round($Bytes, 1);
    return("".$Bytes." ".$Type[$Index]."bytes");
}


echo HumanSize(2443343443434);

?>