<?php

DEFINE ('DBUSER', 'b723fca1db27e2');
DEFINE ('DBPW', 'dbed8501');
DEFINE ('DBHOST', 'us-cdbr-iron-east-03.cleardb.net');
DEFINE ('DBNAME', 'heroku_45e38719d30ca4e');
  
$dbc = mysqli_connect(DBHOST,DBUSER,DBPW);
if (!$dbc) {
    die("Database connection failed: " . mysqli_error($dbc));
    exit();
}

$dbs = mysqli_select_db($dbc, DBNAME);
if (!$dbs) {
    die("Database selection failed: " . mysqli_error($dbc));
    exit();
}
$csv_output = '';
$result = mysqli_query($dbc, "SHOW COLUMNS FROM locations");
$numberOfRows = mysqli_num_rows($result);
if ($numberOfRows > 0) {
    $values = mysqli_query($dbc, "SELECT * FROM locations");
    while ($rowr = mysqli_fetch_row($values)) {
        for ($j=0;$j<$numberOfRows;$j++) {
            $csv_output .= $rowr[$j].",";
        }
    $csv_output = substr($csv_output, 0, (strlen($csv_output) - 1));
    $csv_output .= ", ";
    }
$csv_output = substr($csv_output, 0, (strlen($csv_output) - 2));
}
 
print $csv_output;
exit;
?>