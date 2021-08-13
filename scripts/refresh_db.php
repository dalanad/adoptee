<pre>
<?php
$query = file_get_contents("database.sql");

$conn = new mysqli("localhost", "root", "root");

$conn->multi_query($query);
$success = true;

while ($conn->more_results()) {
    $conn->next_result();
    if ($conn->error) {
        echo "<span style='color:red;'> $conn->error</span>";
        $success = false;
    }
}

if ($success) {
    echo "<span style='color:green;font-size:2rem'>Execution Successful</span>\n\n";
    echo  $query;
}
