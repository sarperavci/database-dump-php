<!DOCTYPE html>
<html>
<head>
    <title>MySQL Dump</title>
</head>
<body>

<?php
$servername = "localhost"; 
$username = "your_username"; //edit here
$password = "your_password"; //edit here


$conn = new mysqli($servername, $username, $password);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully<br>";


$sqlDatabases = "SHOW DATABASES";
$resultDatabases = $conn->query($sqlDatabases);

if ($resultDatabases->num_rows > 0) {
    while ($rowDatabase = $resultDatabases->fetch_assoc()) {
        $databaseName = $rowDatabase["Database"];
        echo "Database: $databaseName<br>";

        
        $conn->select_db($databaseName);
        $sqlTables = "SHOW TABLES";
        $resultTables = $conn->query($sqlTables);

        if ($resultTables->num_rows > 0) {
            while ($rowTable = $resultTables->fetch_assoc()) {
                $tableName = $rowTable["Tables_in_$databaseName"];
                echo "Table: $tableName<br>";

               
                $sqlData = "SELECT * FROM $tableName";
                $resultData = $conn->query($sqlData);

                if ($resultData->num_rows > 0) {
                    echo "Data in $tableName:<br>";
                    while ($rowData = $resultData->fetch_assoc()) {
                        print_r($rowData);
                        echo "<br>";
                    }
                } else {
                    echo "No data found in $tableName";
                }

                echo "<br>";
            }
        } else {
            echo "No tables found in $databaseName";
        }

        echo "<br>";
    }
} else {
    echo "No databases found";
}


$conn->close();
?>

</body>
</html>
