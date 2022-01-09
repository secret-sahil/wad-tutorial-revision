<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hello world</h1>
</body>
</html>

<?php
$a=10;
$b=34;
$c=600;
if ($a>$b and $a>$c) {
    echo $a .' is greatest among all';
}
elseif ($b>$a and $b>$c) {
    echo $b .' is greatest among all';
}
elseif ($c>$b and $c>$a) {
    echo $c .' is greatest among all';
}
else{
    echo 'All are equal';
}

echo "<br>=====================================";
// array 
$list = [1,2,3,4,5,6,7,8];
echo '<br>';

// for loop
for ($i=0; $i <8 ; $i++) { 
    echo $list[$i];
}
echo '<br>';

// while loop
$len=0;
while ($len < sizeof($list)) {
    echo $list[$len];
    $len+=1;
}

?>