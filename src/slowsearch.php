<?php
if ( !isset($_GET['queryKey']) || empty($_GET['queryKey']) ){
    echo "<script>alert('please input queryKey!'); history.go(-1);</script>";
    return;
}
// *** Default includes	and procedures *** //
define('IN_PHPLOGCON', true);
$gl_root_path = './';

// Now include necessary include files!
include($gl_root_path . 'include/functions_common.php');
include($gl_root_path . 'include/functions_frontendhelpers.php');
include($gl_root_path . 'include/functions_filters.php');

// Include LogStream facility
include($gl_root_path . 'classes/logstream.class.php');
// ---
InitPhpLogCon();
InitSourceConfigs();

$queryKey = $_GET['queryKey'];
$beginLine = 1;
$endLine = 10;
if ( isset($_GET['begin']) && !empty($_GET['begin']) ){
    $beginLine = $_GET['begin'];
}
if ( isset($_GET['end']) && !empty($_GET['end']) ){
    $endLine = $_GET['end'];
}
global $content, $currentSourceID;
$stream_config = $content['Sources'][$currentSourceID]['ObjRef'];

$nextBegin = $endLine + 1;
$nextEnd = $nextBegin + ($endLine - $beginLine);
$url = "slowsearch.php?queryKey=" . $queryKey . "&begin=" . $nextBegin . "&end=" . $nextEnd;
echo "<center><br><br><a href='" . $url . "'><font style='font-weight: bold'>下一页</font></a><br><br></center>";

$results = $stream_config->GetGrepResults($queryKey, $beginLine, $endLine);

if ( empty($results) ){
    echo "nothing to view<br>";
    return;
}
$show = str_replace($queryKey, SetCurrentColor($queryKey, "red"), $results);
$show = ReplaceHost("iZ25itoqi9zZ", $show);
$show = ReplaceHost("iZ255nkwq1lZ", $show);
$show = ReplaceHost("iZ257kmu02vZ", $show);
$show = ReplaceHost("iZ25oc6qp9gZ", $show);
$show = ReplaceHost("iZ25too7l5xZ", $show);
//$show = str_replace("\n", "<br><br>", $show);
$show = str_replace("\n", "<br></td></tr><tr><td style=\"border:1px #a6c9e2 solid\">", $show);
echo("<table style='font-weight: bold'><tr><td style=\"border:1px #a6c9e2 solid\">" . $show . "</td></tr></table>");

echo "<center><br><br><a href='index.php'><font style='font-weight: bold'>返回</font></a></center>";

function ReplaceHost($host, $show){
    global $content;
    $show = str_replace($host, SetCurrentColor('===='.$content[$host].'====', "#3A5FCD"), $show);
    return $show;
}
function SetCurrentColor($text, $color = "#4169e1"){
    return "<font color='" . $color . "' style='font-weight: bold'>" . $text . "</font>";
}
?>