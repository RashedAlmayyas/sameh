
<?php

// Create conn to Oracle
$conn = oci_connect("WEB_USER", "WEB_DEV$02", "192.168.0.10:1521/Orcl2");

if (!$conn) {
  
$m = oci_error();
  
echo $m['message'], "\n";

exit;

}


// Close the Oracle conn

?>
