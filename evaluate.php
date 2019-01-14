<?php
header("Content-Type: text/html; charset=utf-8");
session_start();
echo '<html>
<head>
    <title>Evaluate</title>
        <link href="style/eval_style.css" rel="stylesheet" type="text/css" />    
    <meta name="viewport" content="width=device-width,initial-scale=1">
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
/*
echo 'Hungarian: ' . $_POST["hungarian"] . '<br>';
echo 'Your solution: ' . $_POST["english"] . '<br>';
echo 'Correct solution: ' . $_SESSION['row_english'] . '<br>';
*/
$row = [];
if ( $_GET["id"] ) {
    $id = $_GET["id"];
    if ( isset($_POST["english"]) ) {
        $posted_english = $_POST["english"];
    } else {
        $posted_english = "";
    }
    include('connect-db.php');
    $connection->set_charset("utf8");
    $result = mysqli_query($connection,"SELECT * FROM mondatok WHERE id = $id");
    $row = mysqli_fetch_array($result);
    mysqli_close($connection);
    
    echo "<table border='1' cellpadding='10'>";
    renderLine(' Hungarian: ', $row["hungarian"]);
    renderLine(' Your solution: ', $posted_english);
    renderLine(' Correct solution: ', $row["english"]);
    echo "</table>";
    
    if ($posted_english === $row['english']) {
      echo '<div style="color:red;"><b> 100% OK </b><br></div>';
    }
    echo '<br>';
    
    echo '<input type="submit" name="next" value="Try next!" style="height:25px; width:100px" onClick="window.location=\'start.php\';"/>';
} else {
    echo "ERROR...id is missing!";
}
echo '
</body>
</html>
';
?>