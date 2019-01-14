<?php
header("Content-Type: text/html; charset=utf-8");
session_start();

echo '<html>
<head>
    <title>List</title>
        <link href="style/history_style.css" rel="stylesheet" type="text/css" />
</head>
<body>
';
function renderLine($column1, $column2)
{
    echo "<tr>";
    echo '<td>' . $column1 . '</td>';
    echo '<td>' . $column2 . '</td>';
    echo "</tr>";
}

// connect to the database
include('connect-db.php');

$connection->set_charset("utf8");

$sql_history = "SELECT mondat_id FROM history where DATE(datetime)=CURDATE() ORDER BY ID";
if (!(empty($_GET))) {
    if ( $_GET["dt"] ) {
        $datetime_get = $_GET["dt"];
        $sql_history = "SELECT mondat_id FROM history where DATE(datetime)='$datetime_get' ORDER BY ID";
        //echo $sql_history;
    }    
}
$result_history = mysqli_query($connection,$sql_history);

while ($row_history = mysqli_fetch_array($result_history)) {    
    $result_mondatok = mysqli_query($connection,"SELECT * FROM mondatok WHERE id = " . $row_history['mondat_id']);
    $row_mondatok = mysqli_fetch_array($result_mondatok);
    
    echo "<table border='1' cellpadding='10'>";
    renderLine(' Hungarian: ', '<b><span style="background-color:#ffe0cc;">' .$row_mondatok["hungarian"] . '</span></b>');
    //renderLine(' id: ' . $row_history['mondat_id'], '');
    renderLine(' Correct solution: ', $row_mondatok["english"]);
    echo "</table>";
    echo "<br />";
}
mysqli_close($connection);

echo '
</body>
</html>
';
?>
