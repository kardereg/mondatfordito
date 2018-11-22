<?php
header("Content-Type: text/html; charset=utf-8");
session_start();

echo '<html>
<head>
    <title>List</title>
        <link href="style/list_style.css" rel="stylesheet" type="text/css" />
</head>
<body>
';

// connect to the database
include('connect-db.php');

$connection->set_charset("utf8");

$result = mysqli_query($connection,"SELECT * FROM mondatok ORDER BY id");
$column_names = array();  //declare an array for saving fields


//showing fields
echo '<table class="data-table">
        <tr class="data-heading">';  //initialize table tag
while ($field = mysqli_fetch_field($result)) {
    echo '<td>' . $field->name . '</td>';  //get field name for header
    array_push($column_names, $field->name);  //save those to array
}
echo '</tr>'; //end tr tag

//showing all data
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    foreach ($column_names as $item) {
        echo '<td>' . $row[$item] . '</td>'; //get items using column name value
    }
    echo '</tr>';
}
echo "</table>";


echo '
</body>
</html>
';
?>
