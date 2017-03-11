<?php
    date_default_timezone_set("Asia/Novosibirsk");
    $fp = fsockopen("ntp.pads.ufrj.br",37,$err,$errstr,5);
    if($fp)
    {
        fputs($fp, "\n");
        $timevalue = fread($fp, 49);
        $timevalue = bin2hex($timevalue);
        $timevalue = abs(HexDec('7fffffff') - HexDec($timevalue) - HexDec('7fffffff'));
        $timestamp = $timevalue - 2208988800; # convert to UNIX epoch time stamp
        $datum = date("Y-m-d (D) H:i:s",$timestamp - date("Z",$timestamp)); /* UTC */
        echo "The current date and universal time is ",$datum," UTC. ";
        fclose($fp); # close the connection
    }
    else
    {
        exit("$err $errstr");
    }
?>