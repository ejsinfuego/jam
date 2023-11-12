<?php

// MySQL database configuration
$host = "localhost";
$user = "root";
$password = "";
$database = "dental";

// Connect to the MySQL database
$conn = mysqli_connect($host, $user, $password, $database);

// Get the list of tables in the database
$tables = array();
$result = mysqli_query($conn, "SHOW TABLES");
while ($row = mysqli_fetch_row($result)) {
    $tables[] = $row[0];
}

// Loop through the tables and get the table structure and data
foreach ($tables as $table) {
    $result = mysqli_query($conn, "SELECT * FROM $table");
    $num_fields = mysqli_num_fields($result);

    // Write the table structure to a file
    $output = "DROP TABLE IF EXISTS $table;\n";
    $row2 = mysqli_fetch_row(mysqli_query($conn, "SHOW CREATE TABLE $table"));
    $output .= $row2[1].";\n\n";

    // Write the table data to a file
    for ($i = 0; $i < $num_fields; $i++) {
        while ($row = mysqli_fetch_row($result)) {
            $output .= "INSERT INTO $table VALUES(";
            for ($j = 0; $j < $num_fields; $j++) {
                $row[$j] = addslashes($row[$j]);
                $row[$j] = str_replace("\n","\\n",$row[$j]);
                if (isset($row[$j])) {
                    $output .= '"'.$row[$j].'"' ;
                } else {
                    $output .= '""';
                }
                if ($j < ($num_fields-1)) {
                    $output .= ',';
                }
            }
            $output .= ");\n";
        }
    }

    // Write the table structure and data to a file
    $timeZone = new DateTime('Asia/Manila');
    $timestamp = date($timeZone->format('Y-m-d_H-i-a'));
    $filename = "dbbackup/".$timestamp."_".$table."_backup.sql";
    $handle = fopen($filename,"w+");
    fwrite($handle,$output);
    fclose($handle);
}
// Close the database connection
mysqli_close($conn);

$_SESSION['show_modal']="myModal";
$_SESSION['message']="Backup Successful!";
header("Location: doctors/check_patients.php");


