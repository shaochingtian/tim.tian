<?php
$path = "./";
$dh = opendir($path);
if($dh===false){
    echo 'wrong';
    exit;
}
$list = array();
while (($item = readdir($dh)) !== false) {
    $list[] = $item;
}
closedir($dh);

$url = $_SERVER['REQUEST_URI'];
if (isset($_GET['dir'])){
    $path = $path .'/'.$_GET['dir'];
} else {
    $url = $url .'?dir=.';
}
// Open a known directory, and proceed to read its contents
$list = array();
if (is_dir($path)) {
    if ($dh = opendir($path)) {
        while (($file = readdir($dh)) !== false) {
            //echo "filename: $file : filetype: " . filetype($dir . $file) . "\n";
            $list[] = $file;
        }
        //print_r($list);
        closedir($dh);
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>文件管理系统</title>
    <style>
        td {
            border: 1px solid blue;
        }
    </style>
</head>
<body>
<h1>文件管理系统</h1>
<table>
    <tr>
        <td>序号</td>
        <td>文件名</td>
        <td>操作</td>
    </tr>
    <?php foreach($list as $k=>$v){
        echo '<tr>';
        echo '<td>', $k, '</td>';
        echo '<td>', $v, '</td>';

        echo '<td>';
        if(is_dir($path.'/'.$v)){
            echo '<a href="file.php?dir=',$v,'">浏览</a>';
        } else {
            echo '<a href="./',$_GET['dir'],'/',$v,'">下载</a>';
        }
        echo '</td>';

        echo '</tr>';
    }
    ?>
</table>

</body>
</html>
