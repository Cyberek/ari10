<?php
$dir = substr(dirname($_SERVER['PHP_SELF']),strlen($_SERVER['DOCUMENT_ROOT']));
echo "<h2>Index of ".$dir.":</h2>";
//$g = glob("*");
$g = array_filter(glob("*.php"), function($v) {
    return false === strpos($v, 'index.php');
});
usort($g,function($a,$b) {
    if(is_dir($a) == is_dir($b))
        return strnatcasecmp($a,$b);
    else
        return is_dir($a) ? -1 : 1;
});
echo implode("<br>",array_map(function($a) {return '<a href="'.$a.'">'.$a.'</a>';},$g));
?>