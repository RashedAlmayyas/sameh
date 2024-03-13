<?php
include '../config.php';

$query = "SELECT * FROM WEB_ZERO_LOST_SALES_BR_VIEW";

$statement = oci_parse($conn, $query);
oci_set_client_identifier($conn, 'AL32UTF8');

oci_execute($statement);

// Output headers for download
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="exported_data.xls"');
header('Cache-Control: max-age=0');

// Output the Excel file
echo '<table border="1">';
echo '<tr>';
echo '<th>COMP_NO</th>';
echo '<th>BRANCH_NO</th>';
echo '<th>BRANCH_NAME</th>';
echo '<th>LOST_SALES_VALUE</th>';
echo '</tr>';

while ($row = oci_fetch_assoc($statement)) {
    echo '<tr>';
    foreach ($row as $columnName => $value) {
        // Apply iconv for 'BRANCH_NAME' column
        if ($columnName === 'BRANCH_NAME') {
            $value = iconv('WINDOWS-1256', 'UTF-8', $value);
        }
        echo '<td>' . $value . '</td>';
    }
    echo '</tr>';
}

echo '</table>';

oci_close($conn);
exit;
?>
