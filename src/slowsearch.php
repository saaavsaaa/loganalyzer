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

echo "&logs=20160705.log{blank_space}20160706.log<br>";
if ( isset($_GET['logs']) && !empty($_GET['logs']) ){
    //echo $_GET['logs'] . "<br>";
    //$logs = str_replace("{blank_space}", " ", $_GET['logs']);
    $logs = $_GET['logs'];
} else {
    $logs = "*.*";
}

$pageSize = $endLine - $beginLine + 1;

$nextBegin = $endLine + 1;
$nextEnd = $nextBegin + $pageSize - 1;

if ($beginLine > $pageSize){
    $preBegin = $beginLine - $pageSize;
} else {
    $preBegin = 1;
}
$preEnd = $preBegin + $pageSize - 1;

$count = $stream_config->GetRowCounts($queryKey, $logs);
echo "RowCounts : " . $count . "<br>";

$pattern = "slowsearch.php?queryKey=%s&begin=%d&end=%d";
$startUrl = sprintf($pattern, $queryKey, 1, $pageSize);//$pageUrl . "queryKey=" . $queryKey . "&begin=1&end=" . $beginLine + $pageSize - 1;
$preUrl = sprintf($pattern, $queryKey, $preBegin, $preEnd);//$pageUrl . "queryKey=" . $queryKey . "&begin=" . $preBegin . "&end=" . $preEnd;
$nextUrl = sprintf($pattern, $queryKey, $nextBegin, $nextEnd);//$pageUrl . "queryKey=" . $queryKey . "&begin=" . $nextBegin . "&end=" . $nextEnd;
$lastUrl = sprintf($pattern, $queryKey, $count - $pageSize + 1, $count);//$pageUrl . "queryKey=" . $queryKey . "&begin=" . $count - $pageSize + 1 . "&end=" . $count;

if ( !empty( $logs ) && $logs != "*.*"){
    $logs = str_replace("{blank_space}", " ", $logs);
    $preUrl .= "&logs=" . $logs;
    $nextUrl .= "&logs=" . $logs;
    $startUrl .= "&logs=" . $logs;
    $lastUrl .= "&logs=" . $logs;
}

$pageButtons = "<center><br><br>";
$pageButtons .= "<a href='" . $startUrl . "'><font style='font-weight: bold'>首页</font></a>&nbsp;&nbsp;&nbsp;";
$pageButtons .= "<a href='" . $preUrl . "'><font style='font-weight: bold'>上一页</font></a>&nbsp;&nbsp;&nbsp;";
$pageButtons .= "<a href='" . $nextUrl . "'><font style='font-weight: bold'>下一页</font></a>&nbsp;&nbsp;&nbsp;";
$pageButtons .= "<a href='" . $lastUrl . "'><font style='font-weight: bold'>尾页</font></a>";
$pageButtons .= "<br><br></center>";
echo $pageButtons;

$results = $stream_config->GetGrepResults($queryKey, $beginLine, $endLine, $logs);

if ( empty($results) ){
    echo "nothing to view<br>";
    echo "<center><br><br><a href='index.php'><font style='font-weight: bold'>返回</font></a></center>";
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