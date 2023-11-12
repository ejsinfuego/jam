<?php 

// MySQL server configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dental";

// Connect to MySQL server
$conn = mysqli_connect($servername, $username, $password);

// Select the database
mysqli_select_db($conn, $dbname);

// Open the backup file
$backup_file = fopen("backup.sql", "r");

// Read the backup file
$backup_query = fread($backup_file, filesize("backup.sql"));

// Execute the SQL queries
mysqli_multi_query($conn, $backup_query);

// Close the backup file
fclose($backup_file);

// Close the MySQL connection
mysqli_close($conn);


