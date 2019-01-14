<?php
session_start();
header("Content-Type: text/html; charset=utf-8");
echo '<html>
<head>
<meta name="viewport" content="width=device-width,initial-scale=1">
</head>
<body>
';
// connect to the database
include('connect-db.php');
$connection->set_charset("utf8");
$result = mysqli_query($connection,"SELECT * FROM mondatok ORDER BY RAND() LIMIT 1");
$row = mysqli_fetch_array($result);
mysqli_close($connection);
$_SESSION['row_english'] = $row['english'];
echo '
<b>Translate it to English!</b><br><br>
<form action="evaluate.php?id=' . $row['id'] . '" name="confirmationForm" method="post">
    Hungarian:<br><b><span style="background-color:#ffe0cc;">' . $row['hungarian'] . '</span>
    <input type="hidden" name="hungarian" value="' . $row['hungarian'] . '" size="40" readonly></br></br>
    English:<br><textarea id="confirmationText" class="text" cols="40" rows ="0" name="english"></textarea><br><br>
   <input type="submit" value="Check Solution" class="submitButton" style="height:25px; width:120px">
</form>
';
echo '
</body>
</html>
';

include('connect-db.php');
$connection->set_charset("utf8");
$insert_sql = "INSERT INTO history (mondat_id, datetime) VALUES ( " . $row['id'] . ",now())";
if (!(mysqli_query($connection, $insert_sql))) {
    echo "Error: " . $insert_sql . "<br>" . mysqli_error($connection);    
//} else {
//    echo "New record created successfully";
}
mysqli_close($connection);

?>
