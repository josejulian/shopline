<?php
$pass = "1q2w3e4r";
$salt = "noloromperas:)";
// $hash1 = sha1($pass);
$hash2 = sha1($pass.$salt);
// echo $hash1;
echo "<br>";
echo $hash2;
for($i=1;$i<=10;$i++){
    // $hash1 = sha1($hash1);
    $hash2 = sha1($hash2.$salt);
    echo "<br>";
    // echo $hash1;
    echo "<br>";
    echo $hash2;
}

// phpinfo();
?>