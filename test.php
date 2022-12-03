<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // Make MySQLi throw exceptions.
try {
    // Try Connect to the DB with mysqli_connect function - Params {hostname, userid, password, dbname}
    $link = mysqli_connect("localhost", "wall_holds_mysql", "", "wall_holds_recognition_web_stats");
    $result = mysqli_query($link, "select nb_of_visits, number_of_images_converted, total_size_of_images_converted from general_information");
} 
catch (mysqli_sql_exception $e) { // Failed to connect? Lets see the exception details..
  echo "MySQLi Error Code: " . $e->getCode() . "<br />";
  echo "Exception Msg: " . $e->getMessage();
  exit; // exit and close connection.
}

while ($row = mysqli_fetch_array($result, MYSQLI_BOTH))
{
  var_dump($row);
}


//No Exceptions were thrown, we connected successfully, yay!
echo "<br><br>";
echo "Success, we connected without failure! <br />";
echo "Connection Info: " . mysqli_get_host_info($link) . PHP_EOL;

mysqli_close($link); // finally, close the connection if ($result = $mysqli->query($query)) {

?>
