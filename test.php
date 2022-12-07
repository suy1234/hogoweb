<?php
if ($_GET['source'])
{
    highlight_file($_SERVER['SCRIPT_FILENAME']);
    exit;
}

$maxNumKB = 4096;
$defNumKB = 512;
if (!isset($_GET['numKB']) || intval($_GET['numKB']) > $maxNumKB)
{
    header("Location: http://{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}?numKB=$defNumKB");
}
$numKB = intval($_GET['numKB']);
?>
<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Jan! &raquo; PHP &raquo; speed test</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style type="text/css">
    <!--
    html
    {
        font-family: sans-serif;
        color: #000;
        background: #fff;
    }
    *
    {
        font-size: medium;
    }
    #wait
    {
        border-bottom: thin dotted black;
    }
    #wait abbr
    {
        border: none;
    }
    #done
    {
        font-weight: bold;
    }
    #benchmark
    {
        padding: 1em;
        border: 1px solid black;
        background: #ffe;
        color: #000;
    }
    //-->
    </style>
</head>
<body>
<div id="benchmark">
<p>
    <strong>This not a script to benchmark or determine the execution speed
    of PHP scripts.</strong> If you're looking for one, check out the PEAR
    <a href="http://pear.php.net/package/Benchmark">Benchmark package</a>.
</p>
<p>
    This script sends <?php echo $numKB; ?> <abbr title="kilobyte">KB</abbr>
    of HTML comments to your client. Parsing that HTML may add to the total
    transfer time, so don't take this as your raw download speed.
</p>
</div>
<h1>Please wait</h1>
<p>
    <a href="<?php echo "http://{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}?source=1"; ?>">(Show source)</a>
</p>
<p id="wait">
    Transferring <?php echo $numKB; ?> <abbr title="kilobyte">KB</abbr>
</p>
<!--
<?php
function getmicrotime()
{ 
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

flush();
$timeStart = getmicrotime();
$nlLength = strlen("\n");
for ($i = 0; $i < $numKB; $i++)
{
    echo str_pad('', 1024 - $nlLength, '/*\\*') . "\n";
    flush();
}
$timeEnd = getmicrotime();
$timeDiff = round($timeEnd - $timeStart, 3);
?>
-->
<p id="done">
    <?php
        echo "Transferred {$numKB} <abbr title=\"kilobyte\">KB</abbr> in {$timeDiff} seconds, " . 
             ($timeDiff <= 1 ? "more than {$numKB}" : round($numKB / $timeDiff, 3)) . 
             ' <abbr title="kilobytes per second">KB/s</abbr>';
    ?>
</p>
</body>
</html>