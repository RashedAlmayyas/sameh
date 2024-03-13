<?php
include '../config.php';

$query = "SELECT * FROM  WEB_DAILY_SALES_SUM_DEPT_VIEW";

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
echo '<th>DATE</th>';
echo '<th>GRP1_CODE</th>';
echo '<th>GRP1_DESC</th>';
echo '<th>Net DAILY Sales (ACTUAL)</th>';
echo '<th>Net DAILY Sales (BUDGET)</th>';
echo '<th>SECTION_WEIGHT_IN_STORE</th>';
echo '<th>QTY SOLD (ACTUAL)</th>';
echo '<th>QTY SOLD (GTH)</th>';
echo '<th>AVG ITEM SELLING PRICE (ACTUAL)</th>';
echo '<th>AVG ITEM SELLING PRICE (GTH)</th>';
echo '<th>AVERAGE STOCKE</th>';
echo '</tr>';

while ($row = oci_fetch_assoc($statement)) {
    echo '<tr>';
    foreach ($row as $columnName => $value) {
        // Apply iconv for 'GRP1_DESC' column
        if ($columnName === 'GRP1_DESC') {
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
