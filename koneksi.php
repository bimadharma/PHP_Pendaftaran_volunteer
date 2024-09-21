<?php 
$hostname ="localhost";
$username = "root";
$password = "";
$database ="pendaftar_volunteer";

$link = mysqli_connect($hostname, $username, $password, $database);
if ($link -> connect_error) {
    echo "Failed to connect to MySQL: " . $link -> connect_error;
    exit();
}
if(!$link) {
    die("Database tidak terkoneksi");
}


// membuat fungsi query dalam bentuk array
function query($query)
{
    // Koneksi database
    global $link;

    $result = mysqli_query($link, $query);

    // membuat varibale array
    $rows = [];

    // mengambil semua data dalam bentuk array
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

?>