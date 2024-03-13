<?php
include '../config.php';

$query = "SELECT * FROM WEB_DAILY_SALES_BRANCH_VIEW";

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
echo '<th>BRANCH_NO</th>';
echo '<th>BRANCH_DESC</th>';
echo '<th>Net DAILY Sales - ACTUAL</th>';
echo '<th>Net DAILY Sales - BUDGET</th>';
echo '<th>Net DAILY Sales - GTH</th>';
echo '<th>Net DAILY Sales - VAR</th>';
echo '<th>CUSTOMER - COUNT</th>';
echo '<th>CUSTOMER - GTH</th>';
echo '<th>QTY SOLD - ACTUAL</th>';
echo '<th>QTY SOLD - GTH</th>';
echo '<th>AVERAGE BASKET - ACTUAL</th>';
echo '<th>AVERAGE BASKET - GTH</th>';
echo '<th>AVG ITEM SELLING PRICE - NET MARGIN</th>';
echo '<th>AVG ITEM SELLING PRICE - WASTE</th>';
echo '<th>AVG ITEM SELLING PRICE - NET MARGIN AFTER WASTE</th>';
echo '<th>MARGIN - ACTUAL</th>';
echo '<th>MARGIN - GTH</th>';
echo '<th>AVERAGE STOCKE</th>';
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
