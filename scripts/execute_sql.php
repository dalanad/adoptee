<pre style="width: 100%; white-space: pre-wrap;">
<?php
$query = file_get_contents($_GET["script"] ?? "database.sql");

$conn = new mysqli("localhost", "root", "root");

$conn->multi_query($query);
$success = true;
$i = 1;
$lines = explode(";", $query);
while ($conn->more_results()) {
    $conn->next_result();
    if ($conn->error) {
        echo "<span style='color:red;'>$conn->errno : $conn->error</span>";
        $success = false;
        echo $lines[$i];
    }
    $i++;
}

if ($success) {
    echo "<span style='color:green;font-size:2rem'>Execution Successful</span>\n\n";
    echo  $query;
}

$files = glob('../uploads'); // get all file names
foreach ($files as $file) { // iterate files
    if (is_file($file)) {
        unlink($file); // delete file
    }
}
