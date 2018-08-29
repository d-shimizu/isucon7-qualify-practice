<?php

//$db['host'] = 'localhost'; 
$db['host'] = '127.0.0.1'; 
$db['port'] = '3306';
$db['user'] = 'isucon'; 
$db['password'] = 'isucon';
$db['dbname'] = 'isubata';
$db_table = 'image';
	
$mysqli = new mysqli($db['host'], $db['user'], $db['password'], $db['dbname'], $db['port']);

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

printf("Host info: %s\n", $mysqli->host_info);

if ($result = $mysqli->query("select id,name,data from isubata.image",MYSQLI_USE_RESULT)) {
    while ($row = $result->fetch_assoc()) {
	
        $dir_path = '/home/isucon/isubata/webapp/public/icons';
        $file_path = $dir_path . '/' . $row['name'];
        $handle = fopen($file_path, 'w');
        fwrite($handle, $row['data']);
        fclose($handle);

        echo $row['id'] . ': ' .  $row['name'] . " Success. \n";
    }

    $result->free();
}

$mysqli->close(); 
?>
