<?php
//递归
/*function sum($n){
    if($n==1){
        return 1;
    }
    return $n+sum($n-1);
}
echo sum(100);*/

/*function printdir($path,$lev=1){
    $dh = opendir($path);

    while (($row=readdir($dh)) !== false){
        echo str_repeat('&nbsp;',$lev), $row,'<br />';

        if($row == '.' || $row == '..'){
            continue;
        }

        if(is_dir($path .'/' .$row)){
            printdir($path .'/' .$row,$lev+1);
        }

    }
    closedir($dh);
}
$path = '.';
printdir($path);*/


function t(){
    static $a = 1;
    return $a++;
}

echo t().'<br />';
echo t().'<br />';
echo t().'<br />';

$arr = array(1,2,3,4,5,6,array(7,array(8,9)));
function sum($arr){
    static $sum = 0;
    foreach ($arr as $v){
        if(is_array($v)){
            sum($v);
        }else{
            $sum +=$v;
        }
    }
    echo $sum.'<br />';
}
echo sum($arr);

for($i=1; $i<=10; $i+=1){
    if($i == 4) {
        echo '照片丑,不约'.'<br />';
        continue;
    }
    echo $i,'<br />';
}
?>
