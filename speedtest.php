<?php
header('Content-Type: application/json');

class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('/var/www/html/admin/scripts/db/speedtest.db');
    }
}
$db = new MyDB();
if (!$db) {
    echo $db->lastErrorMsg();
} else {
    //      echo "Opened database successfully\n";
}

$sql = <<<EOF
     SELECT * from speedtest order by id desc ;
EOF;

$ret = $db->query($sql);
$data = array();
while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
    array_push($data, $row);
}

echo json_encode(array_reverse(array_slice($data,0,24)));

$db->close();

?>
